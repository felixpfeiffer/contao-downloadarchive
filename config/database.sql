-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************



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
