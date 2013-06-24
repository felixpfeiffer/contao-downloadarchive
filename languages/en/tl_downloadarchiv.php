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
 * @copyright  Felix Pfeiffer 2008 
 * @author     Felix Pfeiffer :: Neue Medien 
 * @package    downloadarchiv 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['title'] = array('Name', 'Enter a name for the download archive. This name will only be displayed in the backend.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['showMeta']     = array('Show meta data?', 'Do you want to show the upload date and the file size for each item?');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['loadDirectory'] = array('Read a directory?', 'You can add all files inside a choosen directory. This only works if there are no files connected to this download archive.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['loadSubdir'] = array('Scan subdirectories?', 'Do you want to scan all subdirectories?');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['dirSRC'] = array('Select a directory', 'Select the directory you want to scan.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['prefix'] = array('Use a name prefix', 'You can autogenerate the title for each download element by using this prefix string and an increasing number (Example: "Our Products 0001").');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['extension'] = array('Extensions', 'You can limit the scan to special file extensions. Please enter a comma separated list of extensions you want to be added.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['publishAll'] = array('Auto publish all files', 'Check this option to publish all files when you import the folder.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['class'] = array('CSS class', 'You can add an css class to the archive. This class will be set to every file.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['published']     = array('Published', 'Unless you choose this option the archive is not visible to the visitors of your website.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['start']        	= array('Show from', 'Do not show the archive on the website before this day.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['stop']         	= array('Show until', 'Do not show the archive on the website on and after this day.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['deleteConfirm'] = 'Do you really want to remove the download archive ID%?\n(The files WILL NOT be deleted from the server)';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['new']    = array('New archive', 'Create a new download archive.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['edit']   = array('Edit archive', 'Edit the archive with the ID %s.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['copy']   = array('Copy archive', 'Copy the archive with the ID %s.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['delete'] = array('Delete archive', 'Delete the archive with the ID %s.');
$GLOBALS['TL_LANG']['tl_downloadarchiv']['show']   =array('Show details', 'Show the details of the archive with the ID %s.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_downloadarchiv']['title_legend']      = 'Titel';
$GLOBALS['TL_LANG']['tl_downloadarchiv']['directory_legend']  = 'Read folder';
?>