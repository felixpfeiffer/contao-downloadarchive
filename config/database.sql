-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

--
-- Table `tl_downloadarchiv`
--

CREATE TABLE `tl_downloadarchiv` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `loadDirectory` char(1) NOT NULL default '',
  `loadSubdir` char(1) NOT NULL default '',
  `dirSRC` varchar(255) NOT NULL default '',
  `prefix` varchar(100) NOT NULL default '',
  `extension` varchar(255) NOT NULL default '',
  `publishAll` char(1) NOT NULL default '0',
  `class` varchar(255) NOT NULL default '',
  `published` char(1) NOT NULL default '1',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table `tl_downloadarchivitems`
--

CREATE TABLE `tl_downloadarchivitems` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `description` text NULL,
  `singleSRC` varchar(255) NOT NULL default '',
  `protected` char(1) NOT NULL default '',
  `guests` char(1) NOT NULL default '',
  `groups` blob NULL,
  `addImage` char(1) NOT NULL default '',
  `imgSRC` varchar(255) NOT NULL default '',
  `size` varchar(255) NOT NULL default '',
  `alt` varchar(255) NOT NULL default '',
  `caption` varchar(255) NOT NULL default '',
  `floating` varchar(32) NOT NULL default '',
  `imagemargin` varchar(255) NOT NULL default '',
  `useImage` char(1) NOT NULL default '0',
  `published` char(1) NOT NULL default '0',
  `start` varchar(10) NOT NULL default '',
  `stop` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table `tl_module`
--

CREATE TABLE `tl_module` (
  `downloadarchiv` text NULL,
  `downloadShowMeta` char(1) NOT NULL default '1',
  `downloadHideDate` char(1) NOT NULL default '0',
  `downloadSorting` varchar(25) NOT NULL default '',
  `downloadNumberOfItems` smallint(5) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table `tl_content`
--

CREATE TABLE `tl_content` (
  `downloadarchiv` varchar(255) NOT NULL default '',
  `downloadShowMeta` char(1) NOT NULL default '1',
  `downloadHideDate` char(1) NOT NULL default '0',
  `downloadSorting` varchar(25) NOT NULL default '',
  `downloadNumberOfItems` smallint(5) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_user`
--

CREATE TABLE `tl_user` (
  `downloadarchives` blob NULL,
  `downloadarchivep` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table `tl_user_group`
--

CREATE TABLE `tl_user_group` (
  `downloadarchives` blob NULL,
  `downloadarchivep` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
