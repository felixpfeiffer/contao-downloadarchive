<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  2008 
 * @author     Felix Pfeiffer : Neue Medien
 * @package    nesiumplayer 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['downloadarchiv'] = array('Download-Archiv', 'Bitte wählen Sie das Download-Archiv aus, das dieses Modul anzeigen soll.');
$GLOBALS['TL_LANG']['tl_module']['downloadShowMeta']     = array('Metadaten Anzeigen?', 'Sollen Upload-Datum und Größe der Dateien angezeigt werden?');
$GLOBALS['TL_LANG']['tl_module']['downloadHideDate']     = array('Datum ausblenden', 'Die Anzeige des Upload-Datums ausblenden.');
$GLOBALS['TL_LANG']['tl_module']['downloadSorting']     = array('Sortierreihenfolge', 'Legen Sie die Sortierreihenfolge für die Ausgabe fest.');
$GLOBALS['TL_LANG']['tl_module']['downloadNumberOfItems'] = array('Gesamtzahl der Dateien', 'Hier können Sie die Gesamtzahl der Dateien festlegen. Geben Sie 0 ein, um alle anzuzeigen.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['sorting ASC'] = "Sortierreihenfolge aufsteigend";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['sorting DESC'] = "Sortierreihenfolge absteigend";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['title ASC'] = "Titel aufsteigend";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['title DESC'] = "Title absteigend";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['tstamp ASC'] = "Upload-Datum aufsteigend";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['tstamp DESC'] = "Upload-Datum absteigend";

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['downloadmeta_legend'] 	= 'Meta-Angaben';
$GLOBALS['TL_LANG']['tl_module']['downloadarchive_legend'] = 'Archivauswahl';

?>