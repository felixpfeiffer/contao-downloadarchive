<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Downloadarchive
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.assets LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'ContentDownloadarchive' => 'system/modules/downloadarchive/elements/ContentDownloadarchive.php',

	// Modules
	'ModuleDownloadarchive'  => 'system/modules/downloadarchive/modules/ModuleDownloadarchive.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_downloadarchiv'  => 'system/modules/downloadarchive/templates',
	'mod_downloadarchiv' => 'system/modules/downloadarchive/templates',
));
