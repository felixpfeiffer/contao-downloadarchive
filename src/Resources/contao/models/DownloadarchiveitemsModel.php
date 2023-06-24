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

namespace Laemmi\ContaoDownloadarchiveBundle\Resources\contao\models;

use Contao\Model;
use Contao\Model\Collection;

/**
 * Reads and writes news
 */
class DownloadarchiveitemsModel extends Model
{
    protected static $strTable = 'tl_downloadarchiveitems';

    /**
     * Find all published files by their parent IDs
     * @param int $intPid
     * @param array $arrOptions
     * @return Collection|null
     */
    public static function findPublishedByPid(int | string $intPid, array $arrOptions = []): ?Collection
    {
        $t = static::$strTable;
        $arrColumns = ["$t.pid=?"];

        if (!BE_USER_LOGGED_IN) {
            $time = time();
            $arrColumns[] = "($t.start='' OR $t.start<$time) AND ($t.stop='' OR $t.stop>$time) AND $t.published=1";
        }

        return static::findBy($arrColumns, $intPid, $arrOptions);
    }
}
