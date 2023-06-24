<?php

/**
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category   contao-downloadarchive
 * @author     Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright  ©2023 laemmi
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    1.0.0
 * @since      23.06.23
 */

declare(strict_types=1);

namespace Laemmi\ContaoDownloadarchiveBundle\Resources\contao\classes;

use Contao\Backend;
use Contao\File;
use Contao\StringUtil;
use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\models\DownloadarchiveitemsModel;

class DownloadarchiveBackend extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Check permissions to edit table tl_downloadarchive
     */
    public function checkPermission()
    {
        if ($this->User->isAdmin) {
            return;
        }

        // Set root IDs
        if (!is_array($this->User->downloadarchives) || empty($this->User->downloadarchives)) {
            $root = [0];
        } else {
            $root = $this->User->downloadarchives;
        }

        $GLOBALS['TL_DCA']['tl_downloadarchive']['list']['sorting']['root'] = $root;

        // Check permissions to add downloadarchives
        if (!$this->User->hasAccess('create', 'downloadarchivep')) {
            $GLOBALS['TL_DCA']['tl_downloadarchive']['config']['closed'] = true;
        }

        // Check current action
        switch ($this->Input->get('act')) {
            case 'create':
            case 'select':
                // Allow
                break;

            case 'edit':
                // Dynamically add the record to the user profile
                if (!in_array($this->Input->get('id'), $root)) {
                    $arrNew = $this->Session->get('new_records');

                    if (is_array($arrNew['tl_downloadarchive']) && in_array($this->Input->get('id'), $arrNew['tl_downloadarchive'])) {
                        // Add permissions on user level
                        if ($this->User->inherit == 'custom' || !$this->User->groups[0]) {
                            $objUser = $this->Database->prepare("SELECT downloadarchives, downloadarchivep FROM tl_user WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->id);

                            $arrDownloadarchivep = deserialize($objUser->downloadarchivep);

                            if (is_array($arrDownloadarchivep) && in_array('create', $arrDownloadarchivep)) {
                                $arrdownloadarchives = deserialize($objUser->downloadarchives);
                                $arrdownloadarchives[] = $this->Input->get('id');

                                $this->Database->prepare("UPDATE tl_user SET downloadarchives=? WHERE id=?")
                                    ->execute(serialize($arrdownloadarchives), $this->User->id);
                            }
                        }

                        // Add permissions on group level
                        elseif ($this->User->groups[0] > 0) {
                            $objGroup = $this->Database->prepare("SELECT downloadarchives, downloadarchivep FROM tl_user_group WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->groups[0]);

                            $arrDownloadarchivep = deserialize($objGroup->downloadarchivep);

                            if (is_array($arrDownloadarchivep) && in_array('create', $arrDownloadarchivep)) {
                                $arrdownloadarchives = deserialize($objGroup->downloadarchives);
                                $arrdownloadarchives[] = $this->Input->get('id');

                                $this->Database->prepare("UPDATE tl_user_group SET downloadarchives=? WHERE id=?")
                                    ->execute(serialize($arrdownloadarchives), $this->User->groups[0]);
                            }
                        }

                        // Add new element to the user object
                        $root[] = $this->Input->get('id');
                        $this->User->downloadarchives = $root;
                    }
                }
            // No break;

            case 'copy':
            case 'delete':
            case 'show':
                if (!in_array($this->Input->get('id'), $root) || ($this->Input->get('act') == 'delete' && !$this->User->hasAccess('delete', 'downloadarchivep'))) {
                    $this->log('Not enough permissions to ' . $this->Input->get('act') . ' calendar ID "' . $this->Input->get('id') . '"', 'tl_downloadarchive checkPermission', TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;

            case 'editAll':
            case 'deleteAll':
            case 'overrideAll':
                $session = $this->Session->getData();
                if ($this->Input->get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'downloadarchivep')) {
                    $session['CURRENT']['IDS'] = [];
                } else {
                    $session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
                }
                $this->Session->setData($session);
                break;

            default:
                if (strlen($this->Input->get('act'))) {
                    $this->log('Not enough permissions to ' . $this->Input->get('act') . ' downloadarchives', 'tl_downloadarchive checkPermission', TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;
        }
    }

    /**
     * Add the type of input field
     * @param array
     * @return string
     */
    public function loadDirectory(\DC_Table $dc)
    {
        $objItems = DownloadarchiveitemsModel::findPublishedByPid($dc->id);

        if (($objItems !== null && $objItems->numRows > 0) || !$dc->activeRecord->loadDirectory) {
            return;
        }

        $objFolder = \FilesModel::findByUuid($dc->activeRecord->dirSRC);

        if ($objFolder->type == 'file') {
            return;
        }

        $this->extension = $dc->activeRecord->extension != '' ? explode(',', $dc->activeRecord->extension) : false;

        $arrFiles = $this->getFiles($objFolder->uuid, $dc->activeRecord->loadSubdir);

        if (!$arrFiles) {
            return;
        }

        $i = 0;

        foreach ($arrFiles as $file) {
            $objFile = new File($file->path);

            $title = StringUtil::specialchars($objFile->basename);

            if ($dc->activeRecord->prefix != '') {
                $title = $dc->activeRecord->prefix . ' ' . $i;
            }

            $varSet = [
                'pid'       => $dc->activeRecord->id,
                'sorting'   => ++$i * 64,
                'tstamp'    => time(),
                'title'     => $title,
                'singleSRC' => $file->uuid,
                'published' => $dc->activeRecord->publishAll
            ];

            \Database::getInstance()->prepare("INSERT INTO tl_downloadarchiveitems %s")
                ->set($varSet)
                ->execute();
        }
    }

    public function getFiles($varFolder, $loadSubdir = false)
    {
        $arrFiles = [];

        $objFiles = \FilesModel::findByPid($varFolder);

        if ($objFiles === null) {
            return false;
        }

        while ($objFiles->next()) {
            // Skip subfolders
            if ($objFiles->type == 'folder') {
                #echo $objFiles->path . "<br>";
                $varSubfiles = $this->getFiles($objFiles->uuid, $loadSubdir);

                if ($varSubfiles) {
                    $arrFiles = array_merge($arrFiles, $varSubfiles);
                }

                continue;
            }

            if ($this->extension && !in_array($objFiles->extension, $this->extension)) {
                continue;
            }

            $arrFiles[] = $objFiles;
        }

        if (is_array($arrFiles) && count($arrFiles) > 0) {
            return $arrFiles;
        } else {
            return false;
        }
    }

    /**
     * Return the copy archive button
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function copyArchive($row, $href, $label, $title, $icon, $attributes)
    {
        return ($this->User->isAdmin || $this->User->hasAccess('create', 'downloadarchivep')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . StringUtil::specialchars($title) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
    }

    /**
     * Return the delete archive button
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function deleteArchive($row, $href, $label, $title, $icon, $attributes)
    {
        return ($this->User->isAdmin || $this->User->hasAccess('delete', 'downloadarchivep')) ? '<a href="' . $this->addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . StringUtil::specialchars($title) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)) . ' ';
    }
}
