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
 * Class ContentDownload
 *
 * Front end content element "download".
 * @copyright  Felix Pfeiffer 2008 
 * @author     Felix Pfeiffer :: Neue Medien 
 * @package    downloadarchive
 */
class ContentDownloadarchive extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_downloadarchiv';
	
	/**
	 * Download-archives
	 * @var string
	 */
	protected $arrDownloadarchives = array();


	/**
	 * Return if the file does not exist
	 * @return string
	 */
	public function generate()
	{
		$this->arrDownloadarchives = unserialize($this->downloadarchiv);
		
		if( $this->downloadarchiv != null && !is_array($this->arrDownloadarchives) )
		{
			$this->arrDownloadarchives = array($this->downloadarchiv);
		}
		
		// Return if there are no categories
		if (count($this->arrDownloadarchives) < 1)
		{
			return '';
		}
		
		if (TL_MODE == 'BE')
		{
			$title = array();
			foreach($this->arrDownloadarchives as $archive)
			{
				$objDownloadarchiv = $this->Database->prepare("SELECT * FROM tl_downloadarchiv WHERE id=?")
												->limit(1)
										  		->execute($archive);
			
				$title[] = $objDownloadarchiv->title;
			}

			
					
			$this->Template = new BackendTemplate('be_wildcard');
			$this->Template->wildcard = '### Downloadarchiv: ' . implode(", ",$title) . ' ###';

			return $this->Template->parse();
		}	

		$this->checkForPublishedArchives();
		
		
		// Send file to the browser
		if (strlen($this->Input->get('file')))
		{
			$time = time();
			$objDownloadarchiv = $this->Database->prepare("SELECT * FROM tl_downloadarchivitems WHERE pid IN (".implode(',',$this->arrDownloadarchives).") AND singleSRC=?" . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<$time) AND (stop='' OR stop>$time) AND published=1" : ""))
										  		->execute($this->Input->get('file'));
			
			if($objDownloadarchiv->numRows < 1)
			{
				return;
			}
			
			$this->sendFileToBrowser($this->Input->get('file'));
		}


		return parent::generate();
	}


	/**
	 * Generate content element
	 */
	protected function compile()
	{
		global $objPage;
        $this->import('String');
		
		$arrDownloadFiles = array();
		
		$time = time();
		
		foreach($this->arrDownloadarchives as $archive)
		{
			
			$objArchive = $this->Database->prepare("SELECT * FROM tl_downloadarchiv WHERE id=?")
											  ->execute($archive);
			
			$objDownloadarchiv = $this->Database->prepare("SELECT * FROM tl_downloadarchivitems WHERE pid=? " . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<$time) AND (stop='' OR stop>$time) AND published=1" : "") . " ORDER BY ".$this->downloadSorting)
											  ->execute($archive);
											  
			if($objDownloadarchiv->numRows < 1)
			{
				continue;
			}
			
			if ($objPage->outputFormat == 'xhtml')
			{
				$strLightboxId = 'lightbox';
			}
			else
			{
				$strLightboxId = 'lightbox[' . substr(md5($objArchive->title . '_' . $objArchive->id), 0, 6) . ']';
			}
			
			while($objDownloadarchiv->next())
			{
	
				if(!file_exists($objDownloadarchiv->singleSRC) || ($objDownloadarchiv->guests && FE_USER_LOGGED_IN) || ($objDownloadarchiv->protected == 1 && !FE_USER_LOGGED_IN && !BE_USER_LOGGED_IN))
				{	
					continue;
				}
	
				$this->import('FrontendUser', 'User');
				$arrGroups = deserialize($objDownloadarchiv->groups);
				
				if ($objDownloadarchiv->protected == 1 && is_array($arrGroups) && count(array_intersect($this->User->groups, $arrGroups)) < 1 && !BE_USER_LOGGED_IN)
				{
					continue;
				}
	
				$arrFile = $objDownloadarchiv->row();
				
				$objFile = new File($objDownloadarchiv->singleSRC);
				$allowedDownload = trimsplit(',', strtolower($GLOBALS['TL_CONFIG']['allowedDownload']));
				
				if (!in_array($objFile->extension, $allowedDownload))
				{
					continue;
				}

                // Clean the RTE output
                if ($objPage->outputFormat == 'xhtml')
                {
                    $objDownloadarchiv->description = $this->String->toXhtml($objDownloadarchiv->description);
                }
                else
                {
                    $objDownloadarchiv->description = $this->String->toHtml5($objDownloadarchiv->description);
                }

                $arrFile['description'] = $this->String->encodeEmail($objDownloadarchiv->description);
				$arrFile['css'] = ( $objArchive->class != "" ) ? $objArchive->class . ' ' : '';
				$arrFile['ctime'] = $objFile->ctime;
				$arrFile['ctimeformated'] = date($GLOBALS['TL_CONFIG']['dateFormat'], $objFile->ctime);
                $arrFile['mtime'] = $objFile->mtime;
				$arrFile['mtimeformated'] = date($GLOBALS['TL_CONFIG']['dateFormat'], $objFile->mtime);
                $arrFile['atime'] = $objFile->mtime;
				$arrFile['atimeformated'] = date($GLOBALS['TL_CONFIG']['dateFormat'], $objFile->atime);
				
				// Add an image
				if ($objDownloadarchiv->addImage && is_file(TL_ROOT . '/' . $objDownloadarchiv->imgSRC))
				{
					$size = deserialize($objDownloadarchiv->size);
					$src = $this->getImage($this->urlEncode($objDownloadarchiv->imgSRC), $size[0], $size[1], $size[2]);
	
					if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
					{
						$arrFile['imgSize'] = ' ' . $imgSize[3];
					}
	
					$arrFile['imgSrc'] = $src;
					$arrFile['imgHref'] = $objDownloadarchiv->imgSRC;
					$arrFile['alt'] = specialchars($objDownloadarchiv->alt);
					$arrFile['imagemargin'] = $this->generateMargin(deserialize($objDownloadarchiv->imagemargin), 'padding');
					$arrFile['floating'] = in_array($objDownloadarchiv->floating, array('left', 'right')) ? sprintf(' float:%s;', $objDownloadarchiv->floating) : '';
					$arrFile['caption'] = $objDownloadarchiv->caption;
					$arrFile['addImage'] = true;
					
					$arrFile['lightbox'] = ($objPage->outputFormat == 'xhtml' || VERSION < 2.11) ? ' rel="' . $strLightboxId . '"' : ' data-lightbox="' . substr($strLightboxId, 9, -1) . '"';
					
					$arrFile['useImage'] = $objDownloadarchiv->useImage;
					
				}
				
				$arrFile['size'] = $this->getReadableSize($objFile->filesize);
				
				$src = 'system/themes/' . $this->getTheme() . '/images/' . $objFile->icon;
				
				if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
				{
					$arrFile['iconSize'] = ' ' . $imgSize[3];
				}
		
				$arrFile['icon'] = $src;
				$arrFile['href'] = $this->Environment->request . (stristr($this->Environment->request,'?') ? '&' : '?') . 'file=' . $this->urlEncode($objDownloadarchiv->singleSRC);
				
				$arrFile['archive'] = $objArchive->title;
				
				$strSorting = str_replace(array(' ASC',' DESC'),'',$this->downloadSorting);
				
				$arrDownloadFiles[$objDownloadarchiv->$strSorting][] =  $arrFile;
				
			}
		}
		
		if(stristr($this->downloadSorting,'DESC')) krsort($arrDownloadFiles);
		else ksort($arrDownloadFiles);
		
		$arrFiles = array();
		
		foreach($arrDownloadFiles as $row)
		{
			foreach($row as $file)
			{
				$arrFiles[] = $file;
			} 
		}
		
		if($this->downloadNumberOfItems > 0)
		{
			$arrFiles = array_slice($arrFiles,0,$this->downloadNumberOfItems);
		}
		
		$i=0;
		$length = count($arrFiles);
		
		if($this->perPage > 0)
		{
			
			// Get the current page
			$page = $this->Input->get('page') ? $this->Input->get('page') : 1;

			if ($page > ($length/$this->perPage))
			{
				$page = ceil($length/$this->perPage);
			}
			
			$offset = ((($page > 1) ? $page : 1) - 1) * $this->perPage;
			
			$arrFiles = array_slice($arrFiles,$offset,$this->perPage);
			
			// Add pagination menu
			$objPagination = new Pagination($length, $this->perPage);
			$this->Template->pagination = $objPagination->generate("\n  ");
			
			$length = count($arrFiles);
			
		}
		
		foreach($arrFiles as $file)
		{
			$class = "";
			if($i++ == 0) $class = "first ";
			$class .= ( $i % 2 == 0 ) ? "even" : "odd";
			if($i == $length) $class .= " last";
			
			$arrFiles[$i-1]['css'] .= $class;
		}
		
		
		if(count($arrFiles) < 1)
		{
			$this->Template->arrFiles = $GLOBALS['TL_LANG']['MSC']['keinDownload'];
		}
		else 
		{
			$this->Template->showMeta = $this->downloadShowMeta ? true : false;
			$this->Template->hideDate = $this->downloadHideDate ? true : false;
			$this->Template->arrFiles = $arrFiles;
		}
	}
	
	protected function checkForPublishedArchives()
	{
		$time = time();
		$arrNew = array();
		
		foreach($this->arrDownloadarchives as $archive)
		{
			$objDownloadarchiv = $this->Database->prepare("SELECT id FROM tl_downloadarchiv WHERE id=?" . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<$time) AND (stop='' OR stop>$time) AND published=1" : ""))
											->limit(1)
											->execute($archive);
			
			if($objDownloadarchiv->numRows > 0) $arrNew[] = $objDownloadarchiv->id;
			
		}
		
		$this->arrDownloadarchives = $arrNew;
		
	}
}

?>