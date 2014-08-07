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
 * @copyright  Felix Pfeiffer 2008-2012 
 * @author     Felix Pfeiffer :: Neue Medien 
 * @package    downloadarchiv 
 * @license    LGPL 
 * @filesource
 */


/**
 * Add back end modules
 */

$GLOBALS['BE_MOD']['content']['downloadarchive'] = array
		(
			'tables' => array('tl_downloadarchive', 'tl_downloadarchiveitems'),
			'icon'   => 'system/modules/downloadarchive/assets/downloadarchive.gif'
		);

/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'application' => array
	(
		'downloadarchive'   => 'ModuleDownloadarchive'
	)
));

/**
 * Content Element
 */
$GLOBALS['TL_CTE']['files']['downloadarchive'] = 'Downloadarchive\\ContentDownloadarchive';

/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'downloadarchives';
$GLOBALS['TL_PERMISSIONS'][] = 'downloadarchivep';


/**
 * Register the model
 */
$GLOBALS['TL_MODELS']['downloadarchive'] = 'FelixPfeiffer\Downloadarchive\DownloadarchiveModel';
$GLOBALS['TL_MODELS']['downloadarchive'] = 'FelixPfeiffer\Downloadarchive\DownloadarchiveItemsModel';
?>