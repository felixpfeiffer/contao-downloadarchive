<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Downloadarchive
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.assets LGPL
 */


class DownloadarchiveRunonce extends Controller
{

    public function run()
    {
        $this->import('Database');

        if ($this->Database->tabelExists('tl_downloadarchiv') && $this->Database->tabelExists('tl_downloadarchivitems'))
        {
            $this->Database->execute("RENAME TABLE tl_downloadarchiv TO tl_downloadarchive, tl_downloadarchivitems TO tl_downloadarchiveitems;");
        }
    }
}


$objDownloadarchiveRunonce = new DownloadarchiveRunonce();
$objDownloadarchiveRunonce->run();
