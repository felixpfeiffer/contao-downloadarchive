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
$GLOBALS['TL_LANG']['tl_module']['downloadarchiv'] = array('Download archive', 'Please select the download archive that\'s supposed to be displayed in this module.');
$GLOBALS['TL_LANG']['tl_module']['downloadShowMeta']     = array('Show metadata?', 'Do you want to show the upload time and file size?');
$GLOBALS['TL_LANG']['tl_module']['downloadHideDate']     = array('Hide upload date', 'The upload date will be hidden.');
$GLOBALS['TL_LANG']['tl_module']['downloadNumberOfItems'] = array('Total number of files', 'Here you can limit the total number of files. Set to 0 to show all.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['sorting ASC'] = "Sorting ascending";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['sorting DESC'] = "Sorting descending";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['title ASC'] = "Title ascending";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['title DESC'] = "Title descending";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['tstamp ASC'] = "Upload date ascending";
$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions']['tstamp DESC'] = "Upload date descending";


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['downloadmeta_legend'] 	= 'Meta data';
$GLOBALS['TL_LANG']['tl_module']['downloadarchive_legend'] = 'Downloadarchive';
?>