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
 * @since      20.06.23
 */

declare(strict_types=1);

/**
 * Table tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['downloadarchive'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadarchive'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'foreignKey'              => 'tl_downloadarchive.title',
    'eval'                    => ['multiple' => true, 'mandatory' => true],
    'sql'                     => "text NULL"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadShowMeta'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadShowMeta'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => [],
    'sql'                     => "char(1) NOT NULL default '1'"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadHideDate'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadHideDate'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => [],
    'sql'                     => "char(1) NOT NULL default '0'"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadNumberOfItems'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadNumberOfItems'],
    'default'                 => 0,
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => ['rgxp' => 'digit', 'tl_class' => 'w50'],
    'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadSorting'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadSorting'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['sorting ASC','sorting DESC','tstamp ASC','tstamp DESC','title ASC','title DESC'],
    'reference'               => &$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions'],
    'eval'                    => [],
    'sql'                     => "varchar(25) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['palettes']['downloadarchive'] = '{type_legend},type,headline;{downloadarchive_legend},downloadarchive,downloadSorting,downloadNumberOfItems,perPage;{downloadmeta_legend:hide},downloadShowMeta,downloadHideDate;{template_legend:hide},customTpl;{protected_legend:hide},protected,guests;{expert_legend:hide},cssID,space';
