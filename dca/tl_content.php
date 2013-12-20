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
 * This is the data container array for table tl_content.
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer 2008 
 * @author     Felix Pfeiffer :: Neue Medien 
 * @package    downloadarchiv 
 * @license    LGPL 
 * @filesource
 */


/**
 * Table tl_content 
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadarchiv'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadarchiv'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_downloadarchiv.title',
	'eval'                    => array('multiple'=>true, 'mandatory'=>true),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadShowMeta'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadShowMeta'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(),
    'sql'                     => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadHideDate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadHideDate'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(),
    'sql'                     => "char(1) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadNumberOfItems'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadNumberOfItems'],
	'default'                 => 0,
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50'),
    'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['downloadSorting'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['downloadSorting'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('sorting ASC','sorting DESC','tstamp ASC','tstamp DESC','title ASC','title DESC'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_content']['downloadarchivSortingOptions'],
	'eval'                    => array(),
    'sql'                     => "varchar(25) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['palettes']['downloadarchiv'] = '{type_legend},type,headline;{downloadarchive_legend},downloadarchiv,downloadSorting,downloadNumberOfItems,perPage;{downloadmeta_legend:hide},downloadShowMeta,downloadHideDate;{protected_legend:hide},protected,guests;{expert_legend:hide},cssID,space';

?>