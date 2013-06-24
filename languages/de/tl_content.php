<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 *
 * The TYPOlight webCMS is an accessible web content management system that 
 * specializes in accessibility and generates W3C-compliant HTML code. It 
 * provides a wide range of functionality to develop professional websites 
 * including a built-in search engine, form generator, file and user manager, 
 * CSS engine, multi-language support and many more. For more information and 
 * additional TYPOlight applications like the TYPOlight MVC Framework please 
 * visit the project website http://www.typolight.org.
 *
 * Language file for table tl_content (de).
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer 2008 
 * @author     Felix Pfeiffer :: Neue Medien 
 * @package    downloadarchiv 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['downloadarchiv'] = array('Downloadarchiv', 'Wählen Sie eins der Downloadarchive aus.');
$GLOBALS['TL_LANG']['tl_content']['downloadShowMeta']     = array('Metadaten Anzeigen?', 'Sollen Upload-Datum und Größe der Dateien angezeigt werden?');
$GLOBALS['TL_LANG']['tl_content']['downloadHideDate']     = array('Datum ausblenden', 'Die Anzeige des Upload-Datums ausblenden.');
$GLOBALS['TL_LANG']['tl_content']['downloadNumberOfItems'] = array('Gesamtzahl der Dateien', 'Hier können Sie die Gesamtzahl der Dateien festlegen. Geben Sie 0 ein, um alle anzuzeigen.');
$GLOBALS['TL_LANG']['tl_content']['downloadSorting'] = array('Sortierreihenfolge', 'Hier können Sie die Sortierreihenfolge der Dateien festlegen.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions']['sorting ASC'] = "Sortierreihenfolge aufsteigend";
$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions']['sorting DESC'] = "Sortierreihenfolge absteigend";
$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions']['title ASC'] = "Titel aufsteigend";
$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions']['title DESC'] = "Title absteigend";
$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions']['tstamp ASC'] = "Upload-Datum aufsteigend";
$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions']['tstamp DESC'] = "Upload-Datum absteigend";

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['downloadmeta_legend'] 	= 'Meta-Angaben';
$GLOBALS['TL_LANG']['tl_content']['downloadarchive_legend'] = 'Archivauswahl';

?>