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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['downloadarchiv']   = '{title_legend},name,headline,type;{downloadarchive_legend},downloadarchiv,downloadSorting,downloadNumberOfItems,perPage;{downloadmeta_legend:hide},downloadShowMeta,downloadHideDate;{expert_legend:hide},cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['downloadarchiv'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['downloadarchiv'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_downloadarchiv.title',
	'eval'                    => array('multiple'=>true, 'mandatory'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['downloadShowMeta'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['downloadShowMeta'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array()
);

$GLOBALS['TL_DCA']['tl_module']['fields']['downloadHideDate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['downloadHideDate'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array()
);

$GLOBALS['TL_DCA']['tl_module']['fields']['downloadSorting'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['downloadSorting'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'		  => 'sorting ASC',
	'options'                 => array('sorting ASC','sorting DESC','tstamp ASC','tstamp DESC','title ASC','title DESC'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_module']['downloadarchivSortingOptions'],
	'eval'                    => array()
);

$GLOBALS['TL_DCA']['tl_module']['fields']['downloadNumberOfItems'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['downloadNumberOfItems'],
	'default'                 => 0,
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50')
);

?>