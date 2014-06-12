<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Downloadarchive
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.assets LGPL
 */


class DownloadarchiveRunonce
{

    public function run()
    {
        $objDatabase = \Database::getInstance();

        if ($objDatabase->tabelExists('tl_downloadarchiv') && $objDatabase->tabelExists('tl_downloadarchivitems'))
        {
            $objDatabase->execute("RENAME TABLE tl_downloadarchiv TO tl_downloadarchive, tl_downloadarchivitems TO tl_downloadarchiveitems;");
        }
    }
}


$objDownloadarchiveRunonce = new DownloadarchiveRunonce();
$objDownloadarchiveRunonce->run();
