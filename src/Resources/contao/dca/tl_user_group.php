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
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] = str_replace('fop;', 'fop;{downloadarchive_legend},downloadarchives,downloadarchivep;', $GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);

/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['downloadarchives'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_user']['downloadarchives'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'foreignKey'              => 'tl_downloadarchive.title',
    'eval'                    => ['multiple' => true],
    'sql'                     => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_user_group']['fields']['downloadarchivep'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_user']['downloadarchivep'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options'                 => ['create', 'delete'],
    'reference'               => &$GLOBALS['TL_LANG']['MSC'],
    'eval'                    => ['multiple' => true],
    'sql'                     => "blob NULL"
];
