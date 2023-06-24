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
 * @since      24.06.23
 */

declare(strict_types=1);

namespace Laemmi\ContaoDownloadarchiveBundle\Resources\contao\modules;

use Contao\File;
use Contao\Pagination;
use Contao\StringUtil;
use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\models\DownloadarchiveitemsModel;
use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\models\DownloadarchiveModel;

trait DownloadarchiveFrontendTrait
{
    protected $arrDownloadarchives = [];

    protected $arrDownloadfiles = [];

    /**
     * Return if the file does not exist
     * @return string
     */
    public function generate()
    {
        $this->arrDownloadarchives = unserialize($this->downloadarchive);

        if ($this->downloadarchive != null && !is_array($this->arrDownloadarchives)) {
            $this->arrDownloadarchives = [$this->downloadarchive];
        }

        // Return if there are no categories
        if (count($this->arrDownloadarchives) < 1) {
            return '';
        }

        if (TL_MODE == 'BE') {
            $title = [];
            foreach ($this->arrDownloadarchives as $archive) {
                $objDownloadarchivee = DownloadarchiveModel::findByPk($archive);

                $title[] = $objDownloadarchivee->title;
            }

            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ' . mb_strtoupper($GLOBALS['TL_LANG']['FMD']['downloadarchive'][0]) . ' - ' . implode(", ", $title) . ' ###';

            return $objTemplate->parse();
        }

        $this->checkForPublishedArchives();

        $this->import('FrontendUser', 'User');

        foreach ($this->arrDownloadarchives as $archive) {
            $objFiles = DownloadarchiveitemsModel::findPublishedByPid($archive);

            if ($objFiles === null) {
                continue;
            }

            while ($objFiles->next()) {
                $objFile = \FilesModel::findByUuid($objFiles->singleSRC);

                if (!$objFile) {
                    continue;
                }

                if (!file_exists(TL_ROOT . '/' . $objFile->path) || ($objFiles->guests && FE_USER_LOGGED_IN) || ($objFiles->protected == 1 && !FE_USER_LOGGED_IN && !BE_USER_LOGGED_IN)) {
                    continue;
                }

                $arrGroups = StringUtil::deserialize($objFiles->groups);

                if ($objFiles->protected == 1 && is_array($arrGroups) && count(array_intersect($this->User->groups, $arrGroups)) < 1 && !BE_USER_LOGGED_IN) {
                    continue;
                }

                $allowedDownload = StringUtil::trimsplit(',', strtolower($GLOBALS['TL_CONFIG']['allowedDownload']));

                if (!in_array($objFile->extension, $allowedDownload)) {
                    continue;
                }

                $arrFile = $objFiles->row();

                $filename = $objFile->path;

                $arrFile['filename'] = $filename;

                $this->arrDownloadfiles[$archive][$filename] = $arrFile;
            }
        }

        $file = \Input::get('file', true);

        // Send the file to the browser and do not send a 404 header (see #4632)
        if ($file != '' && !preg_match('/^meta(_[a-z]{2})?\.txt$/', basename($file))) {
            foreach ($this->arrDownloadfiles as $k => $archive) {
                if (array_key_exists($file, $archive)) {
                    \Controller::sendFileToBrowser($file);
                }
            }
        }

        return parent::generate();
    }

    /**
     * Generate content element
     */
    protected function compile()
    {
        $arrDownloadFiles = [];
        foreach ($this->arrDownloadfiles as $k => $archive) {
            $objArchive = DownloadarchiveModel::findByPk($k);

            $strLightboxId = 'lightbox[' . substr(md5($objArchive->title . '_' . $objArchive->id), 0, 6) . ']';

            foreach ($archive as $f => $arrFile) {
                $objFile = new File($f);

                // Clean the RTE output
                $arrFile['description'] = StringUtil::toHtml5($arrFile['description']);
                $arrFile['description'] = StringUtil::encodeEmail($arrFile['description']);
                $arrFile['css'] = ( $objArchive->class != "" ) ? $objArchive->class . ' ' : '';
                $arrFile['ctime'] = $objFile->ctime;
                $arrFile['ctimeformated'] = date($GLOBALS['TL_CONFIG']['dateFormat'], (int)$objFile->ctime);
                $arrFile['mtime'] = $objFile->mtime;
                $arrFile['mtimeformated'] = date($GLOBALS['TL_CONFIG']['dateFormat'], (int)$objFile->mtime);
                $arrFile['atime'] = $objFile->mtime;
                $arrFile['atimeformated'] = date($GLOBALS['TL_CONFIG']['dateFormat'], (int)$objFile->atime);

                // Add an image
                if ($arrFile['addImage'] && $arrFile['imgSRC'] != '') {
                    $objModel = \FilesModel::findByUuid($arrFile['imgSRC']);

                    if (is_file(TL_ROOT . '/' . $objModel->path)) {
                        $size = StringUtil::deserialize($arrFile['size']);

                        $arrFile['imgSRC'] = $arrFile['imgSrc'] = \Image::get($objModel->path, $size[0], $size[1], $size[2]);

                        // Image dimensions
                        if (($imgSize = @getimagesize(TL_ROOT . '/' . rawurldecode($arrFile['imgSRC']))) !== false) {
                            $arrFile['arrSize'] = $imgSize;
                            $arrFile['imageSize'] = ' ' . $imgSize[3];
                        }

                        $arrFile['imgHref'] = $objModel->path;
                        $arrFile['alt'] = StringUtil::specialchars($arrFile['alt']);
                        $arrFile['imagemargin'] = $this->generateMargin(deserialize($arrFile['imagemargin']), 'padding');
                        $arrFile['floating'] = in_array($arrFile['floating'], ['left', 'right']) ? sprintf(' float:%s;', $arrFile['floating']) : '';
                        $arrFile['addImage'] = true;
                        $arrFile['lightbox'] = ' data-lightbox="' . substr($strLightboxId, 9, -1) . '"';
                    }
                }

                $arrFile['size'] = $this->getReadableSize($objFile->filesize);

                $src = TL_ASSETS_URL . 'assets/contao/images/' . $objFile->icon;

//                $FileIcon = new Imagine();
//                $FileIconSize = $FileIcon->open(TL_ROOT . '/' . $src)->getSize();
//                dd($FileIconSize);

                $arrFile['iconSize'] = '';
                if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false) {
                    $arrFile['iconSize'] = ' ' . $imgSize[3];
                }

                $arrFile['icon'] = $src;
                $arrFile['href'] = $this->Environment->request . (stristr($this->Environment->request, '?') ? '&' : '?') . 'file=' . $this->urlEncode($f);

                $arrFile['archive'] = $objArchive->title;

                $strSorting = str_replace([' ASC',' DESC'], '', $this->downloadSorting);

                $arrDownloadFiles[$arrFile[$strSorting]][] =  $arrFile;
            }
        }

        if (stristr($this->downloadSorting, 'DESC')) {
            krsort($arrDownloadFiles);
        } else {
            ksort($arrDownloadFiles);
        }

        $arrFiles = [];

        foreach ($arrDownloadFiles as $row) {
            foreach ($row as $file) {
                $arrFiles[] = $file;
            }
        }

        if ($this->downloadNumberOfItems > 0) {
            $arrFiles = array_slice($arrFiles, 0, $this->downloadNumberOfItems);
        }

        $i = 0;
        $length = count($arrFiles);

        if ($this->perPage > 0) {
            // Get the current page
            $page = $this->Input->get('page') ? $this->Input->get('page') : 1;

            if ($page > ($length / $this->perPage)) {
                $page = ceil($length / $this->perPage);
            }

            $offset = ((($page > 1) ? $page : 1) - 1) * $this->perPage;

            $arrFiles = array_slice($arrFiles, $offset, $this->perPage);

            // Add pagination menu
            $objPagination = new Pagination($length, $this->perPage);
            $this->Template->pagination = $objPagination->generate("\n  ");

            $length = count($arrFiles);
        }

        foreach ($arrFiles as $file) {
            $class = "";
            if ($i++ == 0) {
                $class = "first ";
            }
            $class .= ( $i % 2 == 0 ) ? "even" : "odd";
            if ($i == $length) {
                $class .= " last";
            }

            $arrFiles[$i - 1]['css'] .= $class;
        }

        if (count($arrFiles) < 1) {
            $this->Template->arrFiles = $GLOBALS['TL_LANG']['MSC']['keinDownload'];
        } else {
            $this->Template->showMeta = $this->downloadShowMeta ? true : false;
            $this->Template->hideDate = $this->downloadHideDate ? true : false;
            $this->Template->arrFiles = $arrFiles;
        }
    }

    protected function checkForPublishedArchives()
    {
        $arrNew = [];
        foreach ($this->arrDownloadarchives as $archive) {
            $objDownloadarchive = DownloadarchiveModel::findPublishedById($archive);

            if ($objDownloadarchive !== null) {
                $arrNew[] = $objDownloadarchive->id;
            }
        }

        $this->arrDownloadarchives = $arrNew;
    }
}