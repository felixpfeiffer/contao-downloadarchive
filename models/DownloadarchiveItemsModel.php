<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.assets LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace FelixPfeiffer\Downloadarchive;


/**
 * Reads and writes news
 *
 * @package   Models
 * @copyright  Felix Pfeiffer 2008 - 2014
 * @author     Felix Pfeiffer :: Neue Medien
 */
class DownloadarchiveItemsModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_downloadarchiveitems';

}
