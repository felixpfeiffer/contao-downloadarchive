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

use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\elements\ContentDownloadarchive;
use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\models\DownloadarchiveitemsModel;
use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\models\DownloadarchiveModel;
use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\modules\ModuleDownloadarchive;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['downloadarchive'] =
        [
            'tables' => ['tl_downloadarchive', 'tl_downloadarchiveitems'],
            'icon'   => 'system/modules/downloadarchive/assets/downloadarchive.gif'
        ];

/**
 * Front end modules
 */
\Contao\ArrayUtil::arrayInsert(
    $GLOBALS['FE_MOD'],
    4,
    [
    'application' =>
    [
        'downloadarchive' => ModuleDownloadarchive::class,
    ]
    ]
);

/**
 * Content Element
 */
$GLOBALS['TL_CTE']['files']['downloadarchive'] = ContentDownloadarchive::class;

/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'downloadarchives';
$GLOBALS['TL_PERMISSIONS'][] = 'downloadarchivep';

/**
 * Register the model
 */
$GLOBALS['TL_MODELS']['tl_downloadarchive'] = DownloadarchiveModel::class;
$GLOBALS['TL_MODELS']['tl_downloadarchiveitems'] = DownloadarchiveitemsModel::class;
