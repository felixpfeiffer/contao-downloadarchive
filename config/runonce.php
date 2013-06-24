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

        if (!$this->Database->fieldExists('languageAlias', 'tl_page'))
        {
            $this->Database->query("ALTER TABLE tl_page ADD `languageAlias` varchar(8) NOT NULL default ''");
            $this->Database->prepare("UPDATe tl_page SET languageAlias=? WHERE type='root'")->execute($GLOBALS['TL_CONFIG']['languageAlias']);
        }
    }
}


$objDownloadarchiveRunonce = new DownloadarchiveRunonce();
$objDownloadarchiveRunonce->run();
