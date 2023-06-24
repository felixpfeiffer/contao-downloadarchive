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
 * @since      22.06.23
 */

declare(strict_types=1);

namespace Laemmi\ContaoDownloadarchiveBundle\Resources\contao\classes;

use Contao\Backend;

class DownloadarchiveitemsBackend extends Backend
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
     * Add the type of input field
     * @param array $arrRow
     * @return string
     */
    public function listFiles(array $arrRow): string
    {
        $time = time();

        $objFile = \FilesModel::findByUuid($arrRow['singleSRC']);

        $key = ($arrRow['published'] && ($arrRow['start'] == '' || $arrRow['start'] < $time) && ($arrRow['stop'] == '' || $arrRow['stop'] > $time)) ? 'published' : 'unpublished';

        return '
<div class="cte_type ' . $key . '"><strong>' . $arrRow['title'] . '</strong></div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? '
h52' : '') . 'block">
' . ($objFile ? $objFile->path : 'File not found!') . '<br /><br />
' . $arrRow['description'] . '
</div>' . "\n";
    }

    /**
     * Return the "toggle visibility" button
     * @param array $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @return string
     */
    public function toggleIcon(
        array $row,
        ?string $href,
        string $label,
        string $title,
        string $icon,
        string $attributes
    ): string {
        if ($this->Input->get('tid')) {
            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_downloadarchiveitems::published', 'alexf')) {
            return '';
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ';
    }

    /**
     * Disable/enable a user group
     * @param int $intId
     * @param bool $blnVisible
     * @return void
     */
    public function toggleVisibility(int $intId, bool $blnVisible): void
    {
        // Check permissions to edit
        $this->Input->setGet('id', $intId);
        $this->Input->setGet('act', 'toggle');

        $this->createInitialVersion('tl_downloadarchiveitems', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_downloadarchiveitems']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_downloadarchiveitems']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_downloadarchiveitems SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
            ->execute($intId);

        $this->createNewVersion('tl_downloadarchiveitems', $intId);
    }
}
