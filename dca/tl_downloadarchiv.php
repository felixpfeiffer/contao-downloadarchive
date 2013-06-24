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
 * Load tl_content language file
 */
$this->loadLanguageFile('tl_content');

/**
 * Table tl_downloadarchiv 
 */
$GLOBALS['TL_DCA']['tl_downloadarchiv'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'					  => array('tl_downloadarchivitems'),
		'enableVersioning'            => true,
		'switchToEdit'				  => true,
		'onload_callback' => array
		(
			array('tl_downloadarchiv', 'checkPermission')
		),
		'onsubmit_callback'			  => array(array('tl_downloadarchiv','loadDirectory')),
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'			  => 'sort,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['edit'],
				'href'                => 'table=tl_downloadarchivitems',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
				'button_callback'     => array('tl_downloadarchiv', 'copyArchive')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_downloadarchiv']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
				'button_callback'     => array('tl_downloadarchiv', 'deleteArchive')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('loadDirectory'),
		'default'                     => '{title_legend},title,class;{directory_legend:hide},loadDirectory;{publish_legend},published,start,stop'
	),
	
	// Subpalettes
	'subpalettes' => array
	(
		'loadDirectory'                   => 'loadSubdir,extension,prefix,dirSRC,publishAll'
	),
	
	// Fields
	'fields' => array
	(
        'id' => array
        (
            'label'                   => array('ID'),
            'search'                  => true,
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['title'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'loadDirectory' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['loadDirectory'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'loadSubdir' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['loadSubdir'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array(),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'dirSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['dirSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('files'=>false, 'fieldType'=>'radio'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'prefix' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['prefix'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>100),
            'sql'                     => "varchar(100) NOT NULL default ''"
		),
		'extension' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['extension'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'publishAll' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['publishAll'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array(),
            'sql'                     => "char(1) NOT NULL default '0'"
		),
		'class' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['class'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['published'],
			'default'				  => true,
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default '1'"
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiv']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);


/**
 * Class tl_downloadarchiv
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2008 Felix Pfeiffer : Neue Medien
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    Downlaodarchiv
 */
class tl_downloadarchiv extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	
	/**
	 * Check permissions to edit table tl_downloadarchiv
	 */
	public function checkPermission()
	{

		if ($this->User->isAdmin)
		{
			return;
		}

		// Set root IDs
		if (!is_array($this->User->downloadarchives) || empty($this->User->downloadarchives))
		{
			$root = array(0);
		}
		else
		{
			$root = $this->User->downloadarchives;
		}

		$GLOBALS['TL_DCA']['tl_downloadarchiv']['list']['sorting']['root'] = $root;

		
		// Check permissions to add downloadarchives
		if (!$this->User->hasAccess('create', 'downloadarchivep'))
		{
			$GLOBALS['TL_DCA']['tl_downloadarchiv']['config']['closed'] = true;
		}

		// Check current action
		switch ($this->Input->get('act'))
		{
			case 'create':
			case 'select':
				// Allow
				break;

			case 'edit':
				// Dynamically add the record to the user profile
				if (!in_array($this->Input->get('id'), $root))
				{
					$arrNew = $this->Session->get('new_records');

					if (is_array($arrNew['tl_downloadarchiv']) && in_array($this->Input->get('id'), $arrNew['tl_downloadarchiv']))
					{
						
						// Add permissions on user level
						if ($this->User->inherit == 'custom' || !$this->User->groups[0])
						{
							$objUser = $this->Database->prepare("SELECT downloadarchives, downloadarchivep FROM tl_user WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->id);

							$arrDownloadarchivep = deserialize($objUser->downloadarchivep);

							if (is_array($arrDownloadarchivep) && in_array('create', $arrDownloadarchivep))
							{
								$arrdownloadarchives = deserialize($objUser->downloadarchives);
								$arrdownloadarchives[] = $this->Input->get('id');

								$this->Database->prepare("UPDATE tl_user SET downloadarchives=? WHERE id=?")
											   ->execute(serialize($arrdownloadarchives), $this->User->id);
							}
						}

						// Add permissions on group level
						elseif ($this->User->groups[0] > 0)
						{
							$objGroup = $this->Database->prepare("SELECT downloadarchives, downloadarchivep FROM tl_user_group WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->groups[0]);

							$arrDownloadarchivep = deserialize($objGroup->downloadarchivep);

							if (is_array($arrDownloadarchivep) && in_array('create', $arrDownloadarchivep))
							{
								$arrdownloadarchives = deserialize($objGroup->downloadarchives);
								$arrdownloadarchives[] = $this->Input->get('id');

								$this->Database->prepare("UPDATE tl_user_group SET downloadarchives=? WHERE id=?")
											   ->execute(serialize($arrdownloadarchives), $this->User->groups[0]);
							}
						}

						// Add new element to the user object
						$root[] = $this->Input->get('id');
						$this->User->downloadarchives = $root;
					}
				}
				// No break;

			case 'copy':
			case 'delete':
			case 'show':
				if (!in_array($this->Input->get('id'), $root) || ($this->Input->get('act') == 'delete' && !$this->User->hasAccess('delete', 'downloadarchivep')))
				{
					$this->log('Not enough permissions to '.$this->Input->get('act').' calendar ID "'.$this->Input->get('id').'"', 'tl_downloadarchiv checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'editAll':
			case 'deleteAll':
			case 'overrideAll':
				$session = $this->Session->getData();
				if ($this->Input->get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'downloadarchivep'))
				{
					$session['CURRENT']['IDS'] = array();
				}
				else
				{
					$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
				}
				$this->Session->setData($session);
				break;

			default:
				if (strlen($this->Input->get('act')))
				{
					$this->log('Not enough permissions to '.$this->Input->get('act').' downloadarchives', 'tl_downloadarchiv checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;
		}
	}
	
	
	/**
	 * Add the type of input field
	 * @param array
	 * @return string
	 */
	public function loadDirectory(DC_Table $dc)
	{
		$objPS = $this->Database->prepare("SELECT * FROM tl_downloadarchiv WHERE id=?")
					  ->limit(1)
					  ->execute($dc->id);
		
		$objPSI = $this->Database->prepare("SELECT * FROM tl_downloadarchivitems WHERE pid=?")
					   ->execute($dc->id);
		
		if($objPS->loadDirectory==1 && $objPSI->numRows==0)
		{
			$strDirectory = $objPS->dirSRC;
			$loadSubdir = $objPS->loadSubdir == 1 ? true : false;
			$this->extension = $objPS->extension != "" ? explode(',',$objPS->extension) : array();
			
			$this->i = 0;
			
			$arrFiles = $this->getFiles($strDirectory, $objPS->prefix, $loadSubdir);
			
			ksort($arrFiles);
			
			$j = 0;
			
			foreach($arrFiles as $key=>$value)
			{
				$arrValues = array(
					'pid'		=>$dc->id,
					'sorting'	=>++$j * 64,
					'tstamp'	=>time(),
					'title'		=>str_replace('_',' ',$key),
					'singleSRC'	=>$value,
					'published' =>($objPS->publishAll == 1 ? 1 : 0) 
				);
				
				$objPSIW = $this->Database->prepare("INSERT INTO tl_downloadarchivitems %s")
										  ->set($arrValues)
										  ->execute();
			}
			
		}
		
		
	}
	
	public function getFiles($directory, $prefix, $loadSubdir=false)
	{
		$arrFiles = array();
		
		foreach (scan(TL_ROOT . '/' . $directory) as $file)
		{
			
			if (is_dir(TL_ROOT . '/' . $directory . '/' . $file))
			{
				if($loadSubdir)
				{
					$arrNew = $this->getFiles($directory . '/' . $file, $prefix, $loadSubdir);
					if(is_array($arrNew) && is_array($arrFiles)) $arrFiles = array_merge($arrFiles, $arrNew);
					elseif(is_array($arrNew) && !is_array($arrFiles)) $arrFiles = $arrNew;
				}
				else 
				{
					continue;
				}
			}
			else
			{	
				$objFile = new File('/' . $directory . '/' . $file);
				
				if(count($this->extension) > 0 && !in_array($objFile->extension,$this->extension))
				{
					$objFile->close();
					continue;
				}
				
				$key = $prefix != "" ? $prefix . " " . str_pad(++$this->i,3,'0',STR_PAD_LEFT) : $objFile->filename;
				$arrFiles[$key] = $directory . '/' . $file;

				$objFile->close();
			}
			
		}
		
		return $arrFiles;
		
	}
	


	/**
	 * Return the copy archive button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function copyArchive($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('create', 'downloadarchivep')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Return the delete archive button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function deleteArchive($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || $this->User->hasAccess('delete', 'downloadarchivep')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}
}

?>