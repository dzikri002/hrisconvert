-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: fdb1.awardspace.com
-- Generation Time: Feb 10, 2009 at 06:42 AM
-- Server version: 4.1.18
-- PHP Version: 5.2.5
-- 
-- Database: `dnmuturi_hrmis`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `coinanalysis`
-- 

DROP TABLE IF EXISTS `coinanalysis`;
CREATE TABLE IF NOT EXISTS `coinanalysis` (
  `MemberNo` varchar(10) NOT NULL default '',
  `LastName` varchar(15) NOT NULL default '',
  `OtherNames` varchar(30) NOT NULL default '',
  `Designation` varchar(10) NOT NULL default '',
  `IDNumber` varchar(13) NOT NULL default '',
  `Dept` varchar(10) NOT NULL default '',
  `Station` varchar(10) NOT NULL default '',
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `Amount` double NOT NULL default '0',
  `Tax` double NOT NULL default '0',
  `PayFor` varchar(20) NOT NULL default '',
  `D1000` double NOT NULL default '0',
  `D500` double NOT NULL default '0',
  `D200` double NOT NULL default '0',
  `D100` double NOT NULL default '0',
  `D50` double NOT NULL default '0',
  `D20` double NOT NULL default '0',
  `D10` double NOT NULL default '0',
  `D5` double NOT NULL default '0',
  `D1` double NOT NULL default '0',
  `Cts` double NOT NULL default '0',
  `DNew1` double NOT NULL default '0',
  `DNew2` double NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `coinanalysis`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `designation`
-- 

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `Designation` varchar(100) NOT NULL default '',
  `Title` varchar(50) NOT NULL default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Designation` (`Designation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

-- 
-- Dumping data for table `designation`
-- 

INSERT INTO `designation` VALUES ('Transport Manager', 'TRM', '0000-00-00 00:00:00', 93);
INSERT INTO `designation` VALUES ('Transport Supervisor', '', '0000-00-00 00:00:00', 94);
INSERT INTO `designation` VALUES ('Driver', 'Driver', '0000-00-00 00:00:00', 95);
INSERT INTO `designation` VALUES ('Mechanic', 'Mech', '0000-00-00 00:00:00', 96);
INSERT INTO `designation` VALUES ('Chief Executive Officer', 'CEO', '0000-00-00 00:00:00', 97);
INSERT INTO `designation` VALUES ('ICT Manager', 'ICT Manager', '0000-00-00 00:00:00', 98);
INSERT INTO `designation` VALUES ('Database Administrator', 'DBA', '0000-00-00 00:00:00', 99);

-- --------------------------------------------------------

-- 
-- Table structure for table `hrsettings`
-- 

DROP TABLE IF EXISTS `hrsettings`;
CREATE TABLE IF NOT EXISTS `hrsettings` (
  `id` int(11) NOT NULL auto_increment,
  `retirement` int(11) default NULL,
  `leave` int(11) default NULL,
  `contract` int(11) default NULL,
  `retage` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `hrsettings`
-- 

INSERT INTO `hrsettings` VALUES (2, 1, 2, 3, 55);

-- --------------------------------------------------------

-- 
-- Table structure for table `hrusers`
-- 

DROP TABLE IF EXISTS `hrusers`;
CREATE TABLE IF NOT EXISTS `hrusers` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `isadmin` char(1) default NULL,
  `loggedoff` char(1) default NULL,
  `loggedofftime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `hrusers`
-- 

INSERT INTO `hrusers` VALUES (10, 'admin', '7b49993fa97555a00841cc95bee6bf70', 'dnmuturi@gmail.com', 'y', '1', '2009-02-06 11:13:45');
INSERT INTO `hrusers` VALUES (11, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'dnmuturi@yahoo.com', '', '1', '2009-02-07 02:08:50');

-- --------------------------------------------------------

-- 
-- Table structure for table `intranet_apps`
-- 

DROP TABLE IF EXISTS `intranet_apps`;
CREATE TABLE IF NOT EXISTS `intranet_apps` (
  `id` bigint(20) NOT NULL auto_increment,
  `ApplicationName` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- 
-- Dumping data for table `intranet_apps`
-- 

INSERT INTO `intranet_apps` VALUES (1, 'Add/Edit Employee');
INSERT INTO `intranet_apps` VALUES (2, 'Add/Edit Banks');
INSERT INTO `intranet_apps` VALUES (4, 'Add/Edit Departments');
INSERT INTO `intranet_apps` VALUES (5, 'Add/Edit Designations');
INSERT INTO `intranet_apps` VALUES (6, 'Add/Edit Qualifications');
INSERT INTO `intranet_apps` VALUES (7, 'Add/Edit Leave Type');
INSERT INTO `intranet_apps` VALUES (8, 'View Amended Records');
INSERT INTO `intranet_apps` VALUES (9, 'Totals by Departments');
INSERT INTO `intranet_apps` VALUES (10, 'Add/Edit Nationality');
INSERT INTO `intranet_apps` VALUES (11, 'Add/Edit WorkStations');
INSERT INTO `intranet_apps` VALUES (12, 'Add/Edit Leave Type');
INSERT INTO `intranet_apps` VALUES (13, 'View Amended Records');
INSERT INTO `intranet_apps` VALUES (14, 'Totals By Departments');
INSERT INTO `intranet_apps` VALUES (15, 'Totals By Qualifications');
INSERT INTO `intranet_apps` VALUES (16, 'Totals By Status');
INSERT INTO `intranet_apps` VALUES (17, 'Totals By Service types');
INSERT INTO `intranet_apps` VALUES (18, 'Totals By Leave Types');
INSERT INTO `intranet_apps` VALUES (19, 'Totals By Designations');
INSERT INTO `intranet_apps` VALUES (20, 'Total Disciplinary Cases');
INSERT INTO `intranet_apps` VALUES (21, 'Total by Job Groups');
INSERT INTO `intranet_apps` VALUES (22, 'Convert Employees List to Excel');
INSERT INTO `intranet_apps` VALUES (23, 'Dependants Report');
INSERT INTO `intranet_apps` VALUES (24, 'Next of Kin Report');
INSERT INTO `intranet_apps` VALUES (25, 'Staff Training Report');
INSERT INTO `intranet_apps` VALUES (27, 'Staff Retirement Report');
INSERT INTO `intranet_apps` VALUES (28, 'Staff TurnOver Report');
INSERT INTO `intranet_apps` VALUES (29, 'Totals By Gender');
INSERT INTO `intranet_apps` VALUES (30, 'Attached Documents Report');
INSERT INTO `intranet_apps` VALUES (32, 'Totals By Station');
INSERT INTO `intranet_apps` VALUES (33, 'New Employees Report');
INSERT INTO `intranet_apps` VALUES (34, 'Suspended Staff Report');
INSERT INTO `intranet_apps` VALUES (35, 'Add/Edit HR Settings');
INSERT INTO `intranet_apps` VALUES (36, 'Add/Edit Job Groups');

-- --------------------------------------------------------

-- 
-- Table structure for table `intranet_leavedays`
-- 

DROP TABLE IF EXISTS `intranet_leavedays`;
CREATE TABLE IF NOT EXISTS `intranet_leavedays` (
  `id` int(11) NOT NULL auto_increment,
  `userid_fk` int(11) default NULL,
  `entitleddays` int(11) default NULL,
  `takendays` int(11) default NULL,
  `leavebalance` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `intranet_leavedays`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `intranet_perms`
-- 

DROP TABLE IF EXISTS `intranet_perms`;
CREATE TABLE IF NOT EXISTS `intranet_perms` (
  `id` bigint(20) NOT NULL auto_increment,
  `userid_fk` bigint(20) default NULL,
  `applicationid_fk` bigint(20) default NULL,
  `deptid_fk` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=611 ;

-- 
-- Dumping data for table `intranet_perms`
-- 

INSERT INTO `intranet_perms` VALUES (545, 10, 1, 45);
INSERT INTO `intranet_perms` VALUES (546, 10, 2, 45);
INSERT INTO `intranet_perms` VALUES (547, 10, 4, 45);
INSERT INTO `intranet_perms` VALUES (548, 10, 5, 45);
INSERT INTO `intranet_perms` VALUES (549, 10, 6, 45);
INSERT INTO `intranet_perms` VALUES (550, 10, 7, 45);
INSERT INTO `intranet_perms` VALUES (551, 10, 8, 45);
INSERT INTO `intranet_perms` VALUES (552, 10, 9, 45);
INSERT INTO `intranet_perms` VALUES (553, 10, 10, 45);
INSERT INTO `intranet_perms` VALUES (554, 10, 11, 45);
INSERT INTO `intranet_perms` VALUES (555, 10, 12, 45);
INSERT INTO `intranet_perms` VALUES (556, 10, 13, 45);
INSERT INTO `intranet_perms` VALUES (557, 10, 14, 45);
INSERT INTO `intranet_perms` VALUES (558, 10, 15, 45);
INSERT INTO `intranet_perms` VALUES (559, 10, 16, 45);
INSERT INTO `intranet_perms` VALUES (560, 10, 17, 45);
INSERT INTO `intranet_perms` VALUES (561, 10, 18, 45);
INSERT INTO `intranet_perms` VALUES (562, 10, 19, 45);
INSERT INTO `intranet_perms` VALUES (563, 10, 20, 45);
INSERT INTO `intranet_perms` VALUES (564, 10, 21, 45);
INSERT INTO `intranet_perms` VALUES (565, 10, 22, 45);
INSERT INTO `intranet_perms` VALUES (566, 10, 23, 45);
INSERT INTO `intranet_perms` VALUES (567, 10, 24, 45);
INSERT INTO `intranet_perms` VALUES (568, 10, 25, 45);
INSERT INTO `intranet_perms` VALUES (569, 10, 27, 45);
INSERT INTO `intranet_perms` VALUES (570, 10, 28, 45);
INSERT INTO `intranet_perms` VALUES (571, 10, 29, 45);
INSERT INTO `intranet_perms` VALUES (572, 10, 30, 45);
INSERT INTO `intranet_perms` VALUES (573, 10, 32, 45);
INSERT INTO `intranet_perms` VALUES (574, 10, 33, 45);
INSERT INTO `intranet_perms` VALUES (575, 10, 34, 45);
INSERT INTO `intranet_perms` VALUES (576, 10, 35, 45);
INSERT INTO `intranet_perms` VALUES (577, 10, 36, 45);
INSERT INTO `intranet_perms` VALUES (578, 11, 1, 45);
INSERT INTO `intranet_perms` VALUES (579, 11, 2, 45);
INSERT INTO `intranet_perms` VALUES (580, 11, 4, 45);
INSERT INTO `intranet_perms` VALUES (581, 11, 5, 45);
INSERT INTO `intranet_perms` VALUES (582, 11, 6, 45);
INSERT INTO `intranet_perms` VALUES (583, 11, 7, 45);
INSERT INTO `intranet_perms` VALUES (584, 11, 8, 45);
INSERT INTO `intranet_perms` VALUES (585, 11, 9, 45);
INSERT INTO `intranet_perms` VALUES (586, 11, 10, 45);
INSERT INTO `intranet_perms` VALUES (587, 11, 11, 45);
INSERT INTO `intranet_perms` VALUES (588, 11, 12, 45);
INSERT INTO `intranet_perms` VALUES (589, 11, 13, 45);
INSERT INTO `intranet_perms` VALUES (590, 11, 14, 45);
INSERT INTO `intranet_perms` VALUES (591, 11, 15, 45);
INSERT INTO `intranet_perms` VALUES (592, 11, 16, 45);
INSERT INTO `intranet_perms` VALUES (593, 11, 17, 45);
INSERT INTO `intranet_perms` VALUES (594, 11, 18, 45);
INSERT INTO `intranet_perms` VALUES (595, 11, 19, 45);
INSERT INTO `intranet_perms` VALUES (596, 11, 20, 45);
INSERT INTO `intranet_perms` VALUES (597, 11, 21, 45);
INSERT INTO `intranet_perms` VALUES (598, 11, 22, 45);
INSERT INTO `intranet_perms` VALUES (599, 11, 23, 45);
INSERT INTO `intranet_perms` VALUES (600, 11, 24, 45);
INSERT INTO `intranet_perms` VALUES (601, 11, 25, 45);
INSERT INTO `intranet_perms` VALUES (602, 11, 27, 45);
INSERT INTO `intranet_perms` VALUES (603, 11, 28, 45);
INSERT INTO `intranet_perms` VALUES (604, 11, 29, 45);
INSERT INTO `intranet_perms` VALUES (605, 11, 30, 45);
INSERT INTO `intranet_perms` VALUES (606, 11, 32, 45);
INSERT INTO `intranet_perms` VALUES (607, 11, 33, 45);
INSERT INTO `intranet_perms` VALUES (608, 11, 34, 45);
INSERT INTO `intranet_perms` VALUES (609, 11, 35, 45);
INSERT INTO `intranet_perms` VALUES (610, 11, 36, 45);

-- --------------------------------------------------------

-- 
-- Table structure for table `intsetup`
-- 

DROP TABLE IF EXISTS `intsetup`;
CREATE TABLE IF NOT EXISTS `intsetup` (
  `Licencee` char(50) NOT NULL default '',
  `Address` char(40) NOT NULL default '',
  `Town` char(20) NOT NULL default '',
  `Country` char(20) NOT NULL default '',
  `CurrentPeriod` char(15) NOT NULL default '',
  `PinNo` char(13) NOT NULL default '',
  `TelNo` char(13) NOT NULL default '',
  `FaxNO` char(13) NOT NULL default '',
  `Registration` char(10) NOT NULL default '',
  `LicenseNo` char(10) NOT NULL default '',
  `nssfCode` char(20) NOT NULL default '',
  `nhifCode` char(20) NOT NULL default '',
  `RndCurrency` char(10) NOT NULL default '',
  `RndPaye` char(10) NOT NULL default '',
  `PaySlipFor` char(25) NOT NULL default '',
  `LastEOyPost` char(15) NOT NULL default '',
  `SortBy` char(10) NOT NULL default '',
  `HseBenefitRt` float NOT NULL default '15',
  `GLLinked` tinyint(4) NOT NULL default '0',
  `GLPath` char(50) NOT NULL default '',
  `SaccoLinked` tinyint(4) NOT NULL default '0',
  `SaccoPath` char(50) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `intsetup`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jobgroup`
-- 

DROP TABLE IF EXISTS `jobgroup`;
CREATE TABLE IF NOT EXISTS `jobgroup` (
  `JobGroup` varchar(20) NOT NULL default '',
  `Description` varchar(35) default NULL,
  `Lower` double NOT NULL default '0',
  `Upper` double NOT NULL default '0',
  `Increment` varchar(10) NOT NULL default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`JobGroup`),
  UNIQUE KEY `JobGroup` (`JobGroup`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `jobgroup`
-- 

INSERT INTO `jobgroup` VALUES ('MG01', 'Management staff', 1, 1.12, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `menuitems`
-- 

DROP TABLE IF EXISTS `menuitems`;
CREATE TABLE IF NOT EXISTS `menuitems` (
  `ANo` int(11) NOT NULL default '0',
  `mainmenuitem` char(30) NOT NULL default '',
  `menuItem` char(20) NOT NULL default '',
  `MenuDesc` char(35) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `menuitems`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `p9a`
-- 

DROP TABLE IF EXISTS `p9a`;
CREATE TABLE IF NOT EXISTS `p9a` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `TxbleCashPay_A` double NOT NULL default '0',
  `TxbleBenefit_B` double NOT NULL default '0',
  `Housing_C` double NOT NULL default '0',
  `ABCtotal_D` double NOT NULL default '0',
  `Pension_E` double NOT NULL default '0',
  `MortgageInt_F` double NOT NULL default '0',
  `HOSP_F` double NOT NULL default '0',
  `TaxableAmt_H` double NOT NULL default '0',
  `Tax_K` double NOT NULL default '0',
  `I` double NOT NULL default '0',
  `J` double NOT NULL default '0',
  `mpr_L` double NOT NULL default '0',
  `InsRelief` double NOT NULL default '0',
  `paye_M` double NOT NULL default '0',
  `Employer` char(60) NOT NULL default '',
  `EmployerPin` char(15) NOT NULL default '',
  `EmployerNssf` char(15) NOT NULL default '',
  `EmployerNhif` char(15) NOT NULL default '',
  `HOSP` tinyint(4) NOT NULL default '0',
  `User` char(15) NOT NULL default '',
  `TimeStamp` char(15) NOT NULL default '',
  PRIMARY KEY  (`MemberNo`,`Period`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `p9a`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `p9a_copy`
-- 

DROP TABLE IF EXISTS `p9a_copy`;
CREATE TABLE IF NOT EXISTS `p9a_copy` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `TxbleCashPay_A` double NOT NULL default '0',
  `TxbleBenefit_B` double NOT NULL default '0',
  `Housing_C` double NOT NULL default '0',
  `ABCtotal_D` double NOT NULL default '0',
  `Pension_E` double NOT NULL default '0',
  `MortgageInt_F` double NOT NULL default '0',
  `HOSP_F` double NOT NULL default '0',
  `TaxableAmt_H` double NOT NULL default '0',
  `Tax_K` double NOT NULL default '0',
  `I` double NOT NULL default '0',
  `J` double NOT NULL default '0',
  `mpr_L` double NOT NULL default '0',
  `InsRelief` double NOT NULL default '0',
  `paye_M` double NOT NULL default '0',
  `Employer` char(60) NOT NULL default '',
  `EmployerPin` char(15) NOT NULL default '',
  `EmployerNssf` char(15) NOT NULL default '',
  `EmployerNhif` char(15) NOT NULL default '',
  `HOSP` tinyint(4) NOT NULL default '0',
  `User` char(15) NOT NULL default '',
  `TimeStamp` char(15) NOT NULL default '',
  PRIMARY KEY  (`MemberNo`,`Period`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `p9a_copy`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `payroll`
-- 

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `MemberNo` varchar(10) NOT NULL default '',
  `TransCode` varchar(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `Period` varchar(15) NOT NULL default '',
  `LedgerCode` varchar(13) NOT NULL default '',
  `TransType` varchar(10) NOT NULL default '',
  `Grp` varchar(5) NOT NULL default '',
  `Description` varchar(35) NOT NULL default '',
  `Units` float NOT NULL default '0',
  `Amount` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `Taxed` tinyint(4) NOT NULL default '0',
  `BaseOnAmt` double NOT NULL default '0',
  `ContribAmt` double NOT NULL default '0',
  `TransDate` datetime default NULL,
  `Reference` varchar(15) NOT NULL default '',
  `User` varchar(15) NOT NULL default '',
  `TimeStamp` varchar(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0',
  `PensionDed` char(1) NOT NULL default '',
  PRIMARY KEY  (`MemberNo`,`TransCode`,`Category`,`Period`),
  KEY `LedgerCode` (`LedgerCode`),
  KEY `TransCode` (`TransCode`),
  KEY `MemberNo` (`MemberNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `payroll`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `payslips`
-- 

DROP TABLE IF EXISTS `payslips`;
CREATE TABLE IF NOT EXISTS `payslips` (
  `MemberNo` varchar(10) NOT NULL default '',
  `LastName` varchar(15) NOT NULL default '',
  `OtherNames` varchar(30) NOT NULL default '',
  `Licencee` varchar(100) NOT NULL default '',
  `Station` varchar(10) NOT NULL default '',
  `Dept` varchar(10) NOT NULL default '',
  `Period` varchar(15) NOT NULL default '',
  `Description1` varchar(35) NOT NULL default '',
  `Amount1` double NOT NULL default '0',
  `Balance1` double NOT NULL default '0',
  `Description2` varchar(35) NOT NULL default '',
  `Amount2` double NOT NULL default '0',
  `Balance2` double NOT NULL default '0',
  `Description3` varchar(35) NOT NULL default '',
  `Amount3` double NOT NULL default '0',
  `Balance3` double NOT NULL default '0',
  `Description4` varchar(35) NOT NULL default '',
  `Amount4` double NOT NULL default '0',
  `Balance4` double NOT NULL default '0',
  `Description5` varchar(35) NOT NULL default '',
  `Amount5` double NOT NULL default '0',
  `Balance5` double NOT NULL default '0',
  `Description6` varchar(35) NOT NULL default '',
  `Amount6` double NOT NULL default '0',
  `Balance6` double NOT NULL default '0',
  `Description7` varchar(35) NOT NULL default '',
  `Amount7` double NOT NULL default '0',
  `Balance7` double NOT NULL default '0',
  `Description8` varchar(35) NOT NULL default '',
  `Amount8` double NOT NULL default '0',
  `Balance8` double NOT NULL default '0',
  `Description9` varchar(35) NOT NULL default '',
  `Amount9` double NOT NULL default '0',
  `Balance9` double NOT NULL default '0',
  `Description10` varchar(35) NOT NULL default '',
  `Amount10` double NOT NULL default '0',
  `Balance10` double NOT NULL default '0',
  `Description11` varchar(35) NOT NULL default '',
  `Amount11` double NOT NULL default '0',
  `Balance11` double NOT NULL default '0',
  `Description12` varchar(35) NOT NULL default '',
  `Amount12` double NOT NULL default '0',
  `Balance12` double NOT NULL default '0',
  `Description13` varchar(35) NOT NULL default '',
  `Amount13` double NOT NULL default '0',
  `Balance13` double NOT NULL default '0',
  `Description14` varchar(35) NOT NULL default '',
  `Amount14` double NOT NULL default '0',
  `Balance14` double NOT NULL default '0',
  `Description15` varchar(35) NOT NULL default '',
  `Amount15` double NOT NULL default '0',
  `Balance15` double NOT NULL default '0',
  `Description16` varchar(35) NOT NULL default '',
  `Amount16` double NOT NULL default '0',
  `Balance16` double NOT NULL default '0',
  `Description17` varchar(35) NOT NULL default '',
  `Amount17` double NOT NULL default '0',
  `Balance17` double NOT NULL default '0',
  `Description18` varchar(35) NOT NULL default '',
  `Amount18` double NOT NULL default '0',
  `Balance18` double NOT NULL default '0',
  `Description19` varchar(35) NOT NULL default '',
  `Amount19` double NOT NULL default '0',
  `Balance19` double NOT NULL default '0',
  `Description20` varchar(35) NOT NULL default '',
  `Amount20` double NOT NULL default '0',
  `Balance20` double NOT NULL default '0',
  `Description21` varchar(35) NOT NULL default '',
  `Amount21` double NOT NULL default '0',
  `Balance21` double NOT NULL default '0',
  `Description22` varchar(35) NOT NULL default '',
  `Amount22` double NOT NULL default '0',
  `Balance22` double NOT NULL default '0',
  `Description23` varchar(35) NOT NULL default '',
  `Amount23` double NOT NULL default '0',
  `Balance23` double NOT NULL default '0',
  `Description24` varchar(35) NOT NULL default '',
  `Amount24` double NOT NULL default '0',
  `Balance24` double NOT NULL default '0',
  `Description25` varchar(35) NOT NULL default '',
  `Amount25` double NOT NULL default '0',
  `Balance25` double NOT NULL default '0',
  `Description26` varchar(35) NOT NULL default '',
  `Amount26` double NOT NULL default '0',
  `Balance26` double NOT NULL default '0',
  `Description27` varchar(35) NOT NULL default '',
  `Amount27` double NOT NULL default '0',
  `Balance27` double NOT NULL default '0',
  `Description28` varchar(35) NOT NULL default '',
  `Amount28` double NOT NULL default '0',
  `Balance28` double NOT NULL default '0',
  `Description29` varchar(35) NOT NULL default '',
  `Amount29` double NOT NULL default '0',
  `Balance29` double NOT NULL default '0',
  `Description30` varchar(35) NOT NULL default '',
  `Amount30` double NOT NULL default '0',
  `Balance30` double NOT NULL default '0',
  `Description31` varchar(35) NOT NULL default '',
  `Amount31` double NOT NULL default '0',
  `Balance31` double NOT NULL default '0',
  `Description32` varchar(35) NOT NULL default '',
  `Amount32` double NOT NULL default '0',
  `Balance32` double NOT NULL default '0',
  `Description33` varchar(35) NOT NULL default '',
  `Amount33` double NOT NULL default '0',
  `Balance33` double NOT NULL default '0',
  `Description34` varchar(35) NOT NULL default '',
  `Amount34` double NOT NULL default '0',
  `Balance34` double NOT NULL default '0',
  `Description35` varchar(35) NOT NULL default '',
  `Amount35` double NOT NULL default '0',
  `Balance35` double NOT NULL default '0',
  `Description36` varchar(35) NOT NULL default '',
  `Amount36` double NOT NULL default '0',
  `Balance36` double NOT NULL default '0',
  `Description37` varchar(35) NOT NULL default '',
  `Amount37` double NOT NULL default '0',
  `Balance37` double NOT NULL default '0',
  `Description38` varchar(35) NOT NULL default '',
  `Amount38` double NOT NULL default '0',
  `Balance38` double NOT NULL default '0',
  `Description39` varchar(35) NOT NULL default '',
  `Amount39` double NOT NULL default '0',
  `Balance39` double NOT NULL default '0',
  `Description40` varchar(35) NOT NULL default '',
  `Amount40` double NOT NULL default '0',
  `Balance40` double NOT NULL default '0',
  `Description41` varchar(35) NOT NULL default '',
  `Amount41` double NOT NULL default '0',
  `Balance41` double NOT NULL default '0',
  `Description42` varchar(35) NOT NULL default '',
  `Amount42` double NOT NULL default '0',
  `Balance42` double NOT NULL default '0',
  `Description43` varchar(35) NOT NULL default '',
  `Amount43` double NOT NULL default '0',
  `Balance43` double NOT NULL default '0',
  `Description44` varchar(35) NOT NULL default '',
  `Amount44` double NOT NULL default '0',
  `Balance44` double NOT NULL default '0',
  `Description45` varchar(35) NOT NULL default '',
  `Amount45` double NOT NULL default '0',
  `Balance45` double NOT NULL default '0',
  `Description46` varchar(35) NOT NULL default '',
  `Amount46` double NOT NULL default '0',
  `Balance46` double NOT NULL default '0',
  `Description47` varchar(35) NOT NULL default '',
  `Amount47` double NOT NULL default '0',
  `Balance47` double NOT NULL default '0',
  `Description48` varchar(35) NOT NULL default '',
  `Amount48` double NOT NULL default '0',
  `Balance48` double NOT NULL default '0',
  `Description49` varchar(35) NOT NULL default '',
  `Amount49` double NOT NULL default '0',
  `Balance49` double NOT NULL default '0',
  `Description50` varchar(35) NOT NULL default '',
  `Amount50` double NOT NULL default '0',
  `Balance50` double NOT NULL default '0',
  `Description51` varchar(35) NOT NULL default '',
  `Amount51` double NOT NULL default '0',
  `Balance51` double NOT NULL default '0',
  `Description52` varchar(35) NOT NULL default '',
  `Amount52` double NOT NULL default '0',
  `Balance52` double NOT NULL default '0',
  `Description53` varchar(35) NOT NULL default '',
  `Amount53` double NOT NULL default '0',
  `Balance53` double NOT NULL default '0',
  `Description54` varchar(35) NOT NULL default '',
  `Amount54` double NOT NULL default '0',
  `Balance54` double NOT NULL default '0',
  `Description55` varchar(35) NOT NULL default '',
  `Amount55` double NOT NULL default '0',
  `Balance55` double NOT NULL default '0',
  `Description56` varchar(35) NOT NULL default '',
  `Amount56` double NOT NULL default '0',
  `Balance56` double NOT NULL default '0',
  `Description57` varchar(35) NOT NULL default '',
  `Amount57` double NOT NULL default '0',
  `Balance57` double NOT NULL default '0',
  `Description58` varchar(35) NOT NULL default '',
  `Amount58` double NOT NULL default '0',
  `Balance58` double NOT NULL default '0',
  `Description59` varchar(35) NOT NULL default '',
  `Amount59` double NOT NULL default '0',
  `Balance59` double NOT NULL default '0',
  `Description60` varchar(35) NOT NULL default '',
  `Amount60` double NOT NULL default '0',
  `Balance60` double NOT NULL default '0',
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `Designation` varchar(25) NOT NULL default '',
  `NSSFNo` varchar(13) NOT NULL default '',
  `NHIFNO` varchar(13) NOT NULL default '',
  `IDNumber` varchar(13) NOT NULL default '',
  `PINNumber` varchar(13) NOT NULL default '',
  `BirthDate` date NOT NULL default '0000-00-00',
  `EmpDate` date default '0000-00-00',
  `JobGroup` varchar(10) NOT NULL default '',
  `IncrMonth` int(3) NOT NULL default '0',
  `revTaxableAmt` double NOT NULL default '0',
  `MPR_Original` double NOT NULL default '0',
  `MPR_Revised` double NOT NULL default '0',
  `BankName` varchar(25) NOT NULL default '',
  `BankAddr` varchar(60) NOT NULL default '',
  `AccountNo` varchar(20) NOT NULL default '',
  `SortBy` varchar(10) NOT NULL default '',
  `User` varchar(15) NOT NULL default '',
  UNIQUE KEY `MemberNo` (`MemberNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `payslips`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prbank`
-- 

DROP TABLE IF EXISTS `prbank`;
CREATE TABLE IF NOT EXISTS `prbank` (
  `BankCode` varchar(10) NOT NULL default '',
  `BankName` varchar(25) NOT NULL default '',
  `BankGroup` varchar(10) NOT NULL default '',
  `BankAddr1` varchar(18) NOT NULL default '',
  `BankAddr2` varchar(18) NOT NULL default '',
  `BankAddr3` varchar(18) NOT NULL default '',
  `BankAddr4` varchar(18) NOT NULL default '',
  PRIMARY KEY  (`BankCode`),
  KEY `BankGroup` (`BankGroup`),
  KEY `BNKCODE` (`BankCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prbank`
-- 

INSERT INTO `prbank` VALUES ('001', 'Barclays Bank', '', '909', 'Kilifi', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `prdept`
-- 

DROP TABLE IF EXISTS `prdept`;
CREATE TABLE IF NOT EXISTS `prdept` (
  `DeptCode` varchar(10) NOT NULL default '',
  `DeptName` varchar(25) NOT NULL default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  `Suspended` tinyint(4) NOT NULL default '0',
  `id` int(11) NOT NULL auto_increment,
  `depthead` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `DEPT_CODE` (`DeptCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- 
-- Dumping data for table `prdept`
-- 

INSERT INTO `prdept` VALUES ('Transport', 'Transport', '2009-02-06 00:00:00', 0, 45, NULL);
INSERT INTO `prdept` VALUES ('Engineerin', 'Engineering', '0000-00-00 00:00:00', 0, 46, NULL);
INSERT INTO `prdept` VALUES ('ict', 'information and communica', '0000-00-00 00:00:00', 0, 47, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `prledgercode`
-- 

DROP TABLE IF EXISTS `prledgercode`;
CREATE TABLE IF NOT EXISTS `prledgercode` (
  `LedgerCode` varchar(13) NOT NULL default '',
  `LedgerName` varchar(50) NOT NULL default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`LedgerCode`),
  UNIQUE KEY `LedgerCode` (`LedgerCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prledgercode`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prloan`
-- 

DROP TABLE IF EXISTS `prloan`;
CREATE TABLE IF NOT EXISTS `prloan` (
  `LoanCode` varchar(15) NOT NULL default '',
  `LoanName` varchar(25) NOT NULL default '',
  `LoanInterest` float NOT NULL default '0',
  `RepayPrd` float NOT NULL default '0',
  `MarketInt` float NOT NULL default '0',
  `TaxRate` float NOT NULL default '0',
  `Grp` char(1) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `LedgerCode` varchar(13) NOT NULL default '',
  `RemitBnkCode` varchar(10) NOT NULL default '',
  `RemitBnkAcc` varchar(15) NOT NULL default '',
  `RemitAccName` varchar(75) NOT NULL default '',
  PRIMARY KEY  (`LoanCode`),
  KEY `LOAN_CODE` (`LoanCode`),
  KEY `LedgerCode` (`LedgerCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prloan`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prmember`
-- 

DROP TABLE IF EXISTS `prmember`;
CREATE TABLE IF NOT EXISTS `prmember` (
  `MemberNo` varchar(10) NOT NULL default '',
  `LastName` varchar(15) NOT NULL default '',
  `OtherNames` varchar(30) default NULL,
  `FullName` varchar(60) NOT NULL default '',
  `Designation` varchar(10) NOT NULL default '',
  `DesigDesc` varchar(25) NOT NULL default '',
  `JobGroup` varchar(10) NOT NULL default '',
  `Sex` varchar(7) NOT NULL default '',
  `MaritalStatus` varchar(11) NOT NULL default '',
  `NSSFNo` varchar(13) NOT NULL default '',
  `NHIFNO` varchar(13) NOT NULL default '',
  `IDNumber` varchar(13) NOT NULL default '',
  `PINNumber` varchar(13) NOT NULL default '',
  `BirthDate` datetime default NULL,
  `EmpDate` datetime default NULL,
  `Photo` blob NOT NULL,
  `PhotoPath` varchar(50) NOT NULL default '',
  `sign` blob,
  `Reference` varchar(20) NOT NULL default '',
  `QuitDate` datetime default NULL,
  `EndPrd` varchar(10) NOT NULL default '',
  `M_days_Hrs` float NOT NULL default '0',
  `Hr_PayRate` float NOT NULL default '0',
  `AnnIncrement` double default NULL,
  `IncrementDate` datetime default NULL,
  `IncrMonth` int(3) NOT NULL default '0',
  `MaxSalary` double NOT NULL default '0',
  `MPR_Original` double NOT NULL default '0',
  `MPR_Revised` double NOT NULL default '0',
  `MPR_CF` double NOT NULL default '0',
  `MPR_OrigDate` date default '0000-00-00',
  `MPR_RevDate` date default NULL,
  `Station` varchar(10) NOT NULL default '',
  `StationDesc` varchar(25) NOT NULL default '',
  `Dept` varchar(10) NOT NULL default '',
  `DeptDesc` varchar(25) NOT NULL default '',
  `BankCode` varchar(10) NOT NULL default '',
  `BankName` varchar(45) NOT NULL default '',
  `AccountNo` varchar(20) NOT NULL default '',
  `Pensionable` tinyint(4) NOT NULL default '0',
  `PensionLimit` double NOT NULL default '0',
  `Housed` tinyint(4) NOT NULL default '0',
  `HouseCost` double NOT NULL default '0',
  `Suspended` tinyint(4) NOT NULL default '0',
  `Suspend_bk` tinyint(4) NOT NULL default '0',
  `UnionMember` tinyint(4) NOT NULL default '0',
  `OwnerOccupier` tinyint(4) NOT NULL default '0',
  `TaxFree` tinyint(4) NOT NULL default '0',
  `HOSP` tinyint(4) NOT NULL default '0',
  `HospAmt` double NOT NULL default '0',
  `OOIAmt` double NOT NULL default '0',
  `PrevEmpName` varchar(30) NOT NULL default '',
  `PrevEmpAddress` varchar(30) NOT NULL default '',
  `NewEmpName` varchar(30) NOT NULL default '',
  `NewEmpAddr` varchar(30) NOT NULL default '',
  `BasicPay` double NOT NULL default '0',
  `HseAllow` double NOT NULL default '0',
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `TaxableAmount` double NOT NULL default '0',
  `revTaxableAmt` double NOT NULL default '0',
  `TaxableCashPay` double NOT NULL default '0',
  `TaxableBenefit` double NOT NULL default '0',
  `Tax` double NOT NULL default '0',
  `PAYEAmt` double NOT NULL default '0',
  `NSSFAmt` double NOT NULL default '0',
  `NHIFAmt` double NOT NULL default '0',
  `PensionAmt` double NOT NULL default '0',
  `PayFor` varchar(20) NOT NULL default '',
  `Period` varchar(10) NOT NULL default '',
  `TimeStamp` varchar(20) NOT NULL default '',
  `nationality` int(11) default '0',
  `empstatus_fk` int(11) default '0',
  `emptitle` int(11) default '0',
  `placeofbirth` varchar(255) default '',
  `curr_res` varchar(255) default '',
  `homeres` varchar(255) default '',
  `physical` varchar(255) default '',
  `province` varchar(255) default '',
  `currdescrip` varchar(255) default '',
  `district` varchar(255) default '',
  `street` varchar(255) default '',
  `division` varchar(255) default '',
  `estate` varchar(255) default '',
  `location` varchar(255) default '',
  `town` varchar(255) default '',
  `sublocation` varchar(255) default '',
  `postaladdr` varchar(255) default '',
  `phonenum` varchar(255) default '',
  `unit_fk` int(11) default '0',
  `dlnum` varchar(30) default '',
  `datedlissued` date default NULL,
  `position_fk` int(11) default '0',
  `dlclasses` varchar(30) default '',
  `depart_fk` int(11) default '0',
  `bankid_fk` int(11) default '0',
  `branchid_fk` int(11) default '0',
  `termsid_fk` int(11) default '0',
  `effdate` date default '0000-00-00',
  `filetype` varchar(100) default '',
  `actposition` int(11) default '0',
  `actscale` varchar(10) default '',
  `acteffdate` date default '0000-00-00',
  `addedon` datetime default '0000-00-00 00:00:00',
  `addedby` varchar(255) default '',
  `updatedon` datetime default '0000-00-00 00:00:00',
  `updatedby` varchar(255) default '',
  `rowid` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`MemberNo`),
  UNIQUE KEY `rowid` (`rowid`),
  KEY `Station` (`Station`),
  KEY `Designation` (`Designation`),
  KEY `ID_NO` (`IDNumber`),
  KEY `MBNO` (`MemberNo`),
  KEY `PRMEMBERBankCode` (`BankCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=344 ;

-- 
-- Dumping data for table `prmember`
-- 

INSERT INTO `prmember` VALUES ('292920', 'Joe', NULL, 'Joe Average', '', '', 'MG01', 'm', '1', '993838', '33737382', '9282920', '223232', '1978-01-01 00:00:00', '2005-01-01 00:00:00', 0xffd8ffe000104a46494600010101006400640000ffdb0043000201010201010202020202020202030503030303030604040305070607070706070708090b0908080a0807070a0d0a0a0b0c0c0c0c07090e0f0d0c0e0b0c0c0cffdb004301020202030303060303060c0807080c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0c0cffc00011080054005403011100021101031101ffc4001d000001040301010000000000000000000008030506070001090402ffc4003e100002010302030604030505090000000001020304051106120007210813142231410915236132517116172491a10a4252d1f0334364818293b1b2f1ffc4001c0100010501010100000000000000000000050001020304060708ffc400351100010302040403050803010000000000010002030411051221311341517106146122528191a115233242b1c1d1f02433e1f1ffda000c03010002110311003f00e9a6ade60de86b1ba48977b9c3fc64db425548020dec30067a0c74e340b5972d2cf2711d671dfaaf31e696a4618fda0bc74ff8b7ff003e1ac1478f2fbc7e691939857d965ded7bbb17f5c9ab933ff9fb70fa26e3cbef15ba7e625fe95b31df2ee87f315727f9f0b44fc797de2959f9a5a92aa32925fef0eadd08f16e33fd786b048d44a7f3148fef06fbd47ceeef86ea7f8c93aff5fd7874dc693de3f349cdcc1bcc519924bddd152243b98d5c9e450771f7f4046787b04dc693de2a2d53cd7bcddae7436c8f5ec36dd4974412d35966ef2695e223bc48f7991477e531204c8f71b481bf80efc45c1c7234597a2d378333533659defb9dedb0f4ba5ad7cd0d61a665a615d5f5b2592b7bb34b75a6a9922889c63eb213f49cb9385c606482d91d75d3d6324394e8503c63c3f5346c32c6e2e605256d7d7c6915cdeaec594000f8b93a60607bfe5c6cd3a2e638f27bc55d1d9baba4bb687ab96aeba7966f1ee374b54e5b1ddc7f7e2b7ee8a50126325c79aa235c4b2c3ad6f0938c4cb5d3871f91ef1b8b3921328b3dddca6bf178ff00e70941678cff0058e124b3c67fac70f649678be1924f5cbabbd92e7f358aba1a7ac9e16ee6256ac3118c951962a0824649ea0faae323af186aeaf84435ba95d6f87fc3ecab61966d072f5ec9a798da7a3d31a7e44f1333415d0ca844e4978b2554f9bd4a9ef7a67a8c632787a6a974b139cedc2863182c5475b13223a3c8d0f71f44317396cb7bb9d8be694a2a8550b9bd74728420c33acccf1cbb970415709838f4503a8cf0001d57d30ca1bd0321b6840faeb7f9ab5b5deb2bbebfaab2e9eb1f8ba63aa69c5d24ab85f6c74293c713c80e0ee5fc751b703d71ebe9c6981cd63b39e5b2f31c4609258bcbb3ad9c7d01fd54c746dbae96bd1511a976b80b7914ed2b49baaa7450aa64281402449bd4e0f509905baf06a9ea048d04eebcaf19c11d4b33b21bb771d6c890ecb3a722bdf2f2ae776ebf309146187b471fd8f16bcd8acf411de327d551dcd1ab2fccbd424b024dcaa3a818cfd46f6e2c1b04367ff63bb94c5e27ee784a959e27ee78492abfb52f6cbd07d8e347535eb5cdd66a186bde48e8a0820334f56e814b2a8185006e5f33103cc3af0e02be0a67cc6cc40ef357fb48762a4597f60f4247758d51cc7517bb9c902bb02147d38226f73d7cfee307df85a7228933083f99ff0020ba11f0fee7e5b3b5b764fd35ae28e829a1bdd706372a587648d49705061755241c00a40527aecc75c8cf006af3c55048e6bd1b0d8a2930f6c26e4345bd45939545ca292cf596d6a14a2348649a7a4799aa1a02d310ca64600943dc960a474f31e36d2bcba2783fdd172fe208c435b4e41bec75f42073ea9aec93c5a92c313cd1acb1d46f0e8de871232907f97000eebea2a0707d2c6eead1fa291729eedfb3e94d1280e22b452c5b89eac125a94dbd7f208064fe5c59d179d55c179e660d838a905a69e97f6f28e5d90c5432abccca7122ee08cbbb047e221d4124e00f2a821ba13a070c842f3ff12d3bd92824e84587ef757ef63dbad3c1caeab5692138b949826451b87771e0f0524dd70f4072b0b7d4a1d3991288398b7f4ca9db72a8191e9fed5bd38b39042a6177bbb94cde23f4e12ab2faac151b8e00c9fb7af092c881df8c6f635d6ddb46bb97d68d2b2d969e1b7c35ed2bdceb9a923333776e146d462c7bb898fb7d8faf117c8d60f6b9908e60b139fc40cd48173d86e571e3b4e6b8b5f31fb54eaeabb15aadd64b3535cda92d76fb5c2b14094f4eab4c8102617ce22dc5b192cc4f52dc393c96fa704462e6e8acf870fc4eef5d88f923adb4e47729ed334b235751b3d1c756de27b89638911643b763b980c8c01da29f201ea0e4ab8b886304697d4f41627f5b05d2e0d2c71c1552be40d73580b0127da7191834162096b4b8906c2d737d13df21be27dda23b2a5aadfa8f98166b96b5d0fccf12df52e57384f869d650cbfc35546008986cdbdd38da800c2638d51b5ad68681a2e56ad8cab90b9cef6faffc46a762af8a872dbb4b5d9ac54374bfdb2fcab2d7bdba4a26a88a38c36e73dfc7b976e580c90a32ea3d4f006a285ecbb85885ef3e19f18d03e9e3a599e5af02da8d0dba1edd6c8a3b36abada0e66d2d86a123eee7b3f885da434903472310ac41e8a44ad82412c4672071948b043a1ace354c8eb7e224fd54d6e5a82af4a5983d35ea3a09aa9a330431d2f7d217120ce5c8654664242e54e0a83d3d413c399a5ecb84f1ad481359aed5a39feddd11fd8c9246e55d608847b12e7228cc7b8f48e2f73c137eeb85a0bf0cf74397362a163e69ea5557deab74a901bf3faadc59c821937fb1ddca8f3d7089198e484058f5c7a0cf095685df88476d68fb15f2f34757dd9aaee779d6cc154eff000f6fb63ec72f1a44a73288b0a1de4decddec45422b0e03baa2695c434d80e8bd4a8f03c2a869454553388e240b136d48bdfb0ed7ea5553c92f8a2e92a0e556afd51596bb26add5955709e7d2f4f98c3dbc180450443728576de6491d658d37e760246de287f1090d71289c030e0c7d4533446e37b340e5c85faef70400b8ff00ce28abe9f9b570afaea58b4955d5d63d6b517819689281a57323471c2c1be8a3164401986d03afb70663702058dd719307079b8b256fb72b35e44331d543c5050423dbda5009e817ca47dbdba7e432736dc75fa285c2ebefc25bb6c696e68f679b2f29682d576ad1a02c7051dcaa2b6821aab4d766493cca09597cc779d8f1b1001c671c619ea5f01b9b107bdd19c33c254f8b877962f6c8d0093a16ebd3623b5d5efcb9e47f2ff92bcf66d6fa2b42d9ec7aa2f16ad94d5963575a7ab85a7332155888898bc88c84840ebdd6d6da481c64ad74845f5ca6cba8f06c38731b2d256e532b43807eba806d717e7f0beeafde5be8c874bd35c2aef750b6e136f91ab7b89182a2ee55456762ee0b292bd4e7767a93d68652bdfbe8129f1f829006b06771df6161d09ea9c3596a9a9bc5fa8a912968a9adf69a7cc53d354ee158922fd3ca6ddca54039dee4ee66c0c60f06a0606b6c365e558dd53a69733f5275f9ff006c893ec59759e2e5556ac6e1545d24f584b7fba8bdf3c49fba8501fbb3dd0c1aeee46a35c5ea46f57b85431ffbadc5bc90a93f19ee9aa4aaee9332f92323a96e831eff00d3870156764d3ccbecabcb8f882f6659f48df29fe651d045050573c23bbaab75c21a65549e9a5704254221552d8292a0d9202a15979b73dd14971ebfaaf648628ea695b1bf70003e86c3eab8d7db4be08fcf0ec77575b77d33495fccbd1d444bad7d862916e3448149dd55440996260704ba7791f4cab81d38dd1d431fa1d0a0953864f0fb4cf687a6ea29a9b91d49cddecc66edaa5ee336aea1b18ba51cb2d6151452365d92a03139591230b8e8cac13dd8f1064b925caddae8bd3e16ca9c3e59e6273b45c1be8399bf71a7743d69a6d394bc849692e1a3e09f525f2e31b5a2fcf34ea20a58982cd16cde23259f1e66048f32e06e56e0916b890ebe8b9b8e68052ba3733ef091676ba0e62d7b5fd4dd1f9d8c2e74fd99f93b5548a6992aae154d5751594f08786a63d8563646072eb8cb0258e031f427a89ae78924f67603ff0057a9f85a98d0d190fb6671b923516d858f3d351dd748f90978d55fb9ad357cb19f0b4e0d5c904971a05f1269268cb4f3a6f21a281245ef2321bbbf302170e78b98f64ad106b61bff000b89c6639e8e69b11bb4b9ee395b6dc13f8bd34d7af553bb3f312f70d352d51b825552ad2aad353494823c6e40177286c3903046e1bb3efd4824f84d5e75f694dae6dd34592ba69ab709288e928d3ba78c9579e79481e690ae42e00f4f524e4e00038981d1607b8b8ddda9467f611b335cf9395b301090d7698799327a4710e2b7ee8a61edfbaf8a1cf4f6818f995ce2d470563d54169b65554d5579a6984733a9a8648e147c1da647382e065551c8c1c1e2351308a3cca58661a6b6acc5cb9a9edcb42e81b2da65a43a33425153d50d924f5f4f148fb49c79ea6add88cfa64b65bf23d7811e6269ae069fdeabbe6e134349671692790b5eff0000bc43963158b9d54b788ae35342134f0a58ad14d2c525aeba9de50d1d6c4633b5997677648f6080e3cbbb3cac7306570df9a234b3473bcc91922da11fbd949eb6d34f72d866883b44731b8256488fe6ac0865ff00911c50b710aa3e7f761ae5df693b54b45acb4b69ed514d5254cff34a46f12e573b0f8aa768a6257271bd9fd78b192b9a6ed3aaae489b230c6fd41dc75f920c3b54ff0067ff0096763e41ea4fddd435fa5eae26f98c34d2de2a2e74e928dab885668cb45bc795cee6dc9d0e7031ae3af7870ce7443ce0d0b98e8e3162ed8ef6ff009d549fe139d8f8f2eb42bd3738392b4ba6b5b69eb9c2f45a9ee36e5ada2bdd2cc923452d1b976804d1ac78388c3618138208e36494ec95dc5077e485c98c555337cab80bb34f97a7ee8acb1f30e4e601863b5e97d40ab6dbac86aaf34e16ae0ad512a85d8c5944a234538540c992ca3a393c30922886406cb11a7adab3c623377fd95742b63b84526e557479240c8e9b7043b02197036b0230570369046063824082010b849a32d91cd70b10765946b0dba01153c514110248489422e4fa9c0f7e12aedcd185d82b53cf45c9bae8e38124517798ee39c9cc509e2a7ee8ad01b47f1431d3f33b52693e60eaca6d2ba7edda82e5a82a65548ab2b9e99290c33cafdf48c91b9788091b72aed624a6d3938e28ae8dae86ee3b227e18a87b6bf8518b97e9ae807aa98dab969abf55783a8d51aa2633533998436ea186869b79465c7764492b20cf4124a4f4cf424f004bb4cb6d17aab38503f88d25ceb5ba0b6e57c57f2d351694bf5a753b6a2baea01a5e8e5a182cd153c30d3f8295c49388a38d54bd433aac9ba4672c5368db9c19ba52e01a760b2c7042c91d20b973f724fcb416564d9ef14f7db5d3d6d24c93d2d546b2c5229e8ea4641fb7e87a83907af15292f570925f124692796541244dd1d7fc43dc70ed22faa8499f29e19b1e47a1500ed5fcedb4e909f4ed2d7d9696b21d4550d6ca69ae332c76bb5f940fa912f570c18795549213f12e33c6d92a8b8656688351e0b95e6498871dfd3b9eaa23169bbf6a2b5d551566a3bed9f525be27ee5a86b3c250db6589372c4b4d1e216a52a000183128c0eecfa63beaba8f2d1f0848d24f755fdef52aea3d5b595c6134d5370a2b6dc2b62c60254cf46923e3ee57bb63f76fbf0770eb986c7aaf27f17b18dc40e5e6d17fa8fd127e271ee78dd65cba2c3b09da2aae9ca2b8cb0bc6a9f389475c673dcc3c54fdd13a2fc07ba1e74b734bf765ccbd47573501b81ae9e5a77eee511c91e2a59c95cf94e481d0e3f0af5e9c5555019a30d69b2d182e26ca1a9749236e0e9a6e35e4ae5d0fcd3b5ebeb652d4d278ba715818c29574ed0b4bb5ca36d3d55b0ca47424f4f4e39f7c658e2d76e17a8d3d43268db2b3676a148c9c74ea08e20b4264829a3d2fa8123863eee92f52c8e541e91d56d2e481ec24557271fde4cff78f093df44fa3d3849969bd384920db9d5c9ce7df694ed44ba635452582d5c9bb05ea3bb5a6f369a74155708045868a6669de48a71b9e3c04556cab038ce2d05805c6eaa697e639be0aff00d53658ec966d437fd6159496fb478255aef0cecc22a54181021c06766ddb0b60348cfb54005471002e6c16bf331c30e679db53d05bf8542cd7ca9d4375b85dab20f095578aa7ac7a6e9fc1a90ab1c1d3a7d38923438e9956c74c71d2c1170e30c5e2b8a571abaa7cfc8edd86cb054638b50f466fc3cec35775e48dc2685d950dea60009b67a450fb60f153f745a847ddfc5069ab2756d577528863435b3ed5ddbb68ef5ba67dff005e2f429db95f7a7f5edff48d2b53d9aef3525348eced45344953452b39cb1689c7b93d4ab29ebebc659a92394ddc35462831daba4688e33768e454df935db312f94029efd4353679127929e0ad6a3a99ed75e91b6c322ca8b2494b960d849f72ed0089083800a68431e5ad37017a750cf24d4cc9a46e52e17b6ffdbeeae2b85dbe7d78d3890c4706a3e60b283be192110caa4a38e84fd4438201c367af5c5165b41eaa4cbd17849aea35cd6d7355cbdd2a6e54b49475d22cf1c462a9ab1488431233de1042e3ee0ff3e1c0ba8bdd61a2aa75bf6ce8745d9a92ae67d28f333c91cf0c3753282548ea8db413e8c98c7e23b812abe6d30d23e43eca175f8cd3d201c53a9d6c3527fbeaab6d75ccebd73b6ed4d5d7c89edb436e9049436782b04f4624524ad5b90aad24b86c2872563c65555989e0c5351b2237dcae0716c7e7ad1c3b656741cfb95e2efbeffd38d960802ceffefc3a746d7c39b544f41c89ae8569ee73225ea7da618d9906628490303f3278a641aa2b42e223f8ab1c7c3fb95b3dceaeaea6c351573564af33f7d709caab3b6e3b40718ea4f11e23968f2515ef65a8be1edca78c383a6e57ddfe2b8d4f97f4fa9c2e239379287a291da3b28680b15534f4da76991cb971e7721415dbb00cfe103d07b1ebebc6434b1937211ffb66b03431afb0000d8724eadc87d2dbcb7cb4f53d419e423ff6fb7f53c37948ba2618cd5dbf1fd07f0961c98d2e8db859a9b39ce09623f96787f2b17baa0715abf7ca425e41e96a82e7e5c63dc31849e4007e9d786f291745318cd58fcdf41fc28cea4ec41cb5d5f7215972b0bd5552a776b2356cea635c600501c018c92303d4e78d11011b72b10cacff002a4e2cda9d93253fc3979550382d67b84b820e1ee739071ff57bfbf16711cb20a288725aabf871f2aeaa7775b4dca00c30123b9ce153a63232c7f5e1711c91a18ba24a3f86df2b136e6dd776dbeb9ba4de6fd7af0fc4726f230f456272c3b3de96e4fd826b65868ea6968e7a86aa746ac9a4fa8caaa4e4b7e48388124eeaf8e16b059abfffd9, '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', '2323123', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 11200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 7, 'KILIFI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 93, NULL, 0, 1, 0, 2, '0000-00-00', 'image/jpeg', 93, NULL, '0000-00-00', '2009-02-06 12:02:36', 'admin', '0000-00-00 00:00:00', '', 330);
INSERT INTO `prmember` VALUES ('001', 'Lilian', NULL, 'Lilian Davids', '', '', 'MG01', 'f', '2', '9282829', '82829', '6262789', '272728', '1982-12-01 00:00:00', '2003-01-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', '272728', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 287939, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 9, 'Kiambu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 97, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, 'MG01', NULL, '2009-02-07 12:02:52', 'demo', '0000-00-00 00:00:00', '', 331);
INSERT INTO `prmember` VALUES ('2425', 'David', NULL, 'David Lee', '', '', 'MG01', 'm', '3', '27229', '27272628', 'A35474748', '2828298', '1968-12-01 00:00:00', '2006-02-23 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', '1818199', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 190000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 2, 1, 10, 'Nairobi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 94, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, 'MG01', NULL, '2009-02-07 01:02:03', 'demo', '0000-00-00 00:00:00', '', 332);
INSERT INTO `prmember` VALUES ('252526', 'Little', NULL, 'Little Sue', '', '', 'MG01', 'f', '2', '16627', '5353678', '626279', '272765', '1984-12-02 00:00:00', '2003-01-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '2009 03', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', '181899', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 90000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 2, 1, 9, 'Nairobi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 96, NULL, 0, 1, 0, 1, '2005-01-01', '', NULL, 'MG01', NULL, '2009-02-07 01:02:30', 'demo', '0000-00-00 00:00:00', '', 333);
INSERT INTO `prmember` VALUES ('73738', 'Steve', NULL, 'Steve Karanja', '', '', 'MG01', 'm', '2', '272289', '272829', '2562626', '266378', '1967-08-01 00:00:00', '2002-07-01 00:00:00', '', '', NULL, '', '2009-02-02 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Engineerin', '', '001', '', '363637', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 120000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 3, 2, 11, 'kilifi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 97, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, NULL, '2009-02-07 01:02:24', 'demo', '0000-00-00 00:00:00', '', 334);
INSERT INTO `prmember` VALUES ('3839', 'Alex', NULL, 'Alex Sonkoh', '', '', 'MG01', 'm', '1', '282829', '272728', '262627', '262628', '1956-11-12 00:00:00', '2004-03-03 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'ict', '', '001', '', '1662728', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 90000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 11, 'Mathira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 93, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, 'MG01', NULL, '2009-02-07 01:02:39', 'demo', '0000-00-00 00:00:00', '', 335);
INSERT INTO `prmember` VALUES ('277739', 'Metal', NULL, 'Metal William', '', '', 'MG01', 'm', '2', '828292', '817189', '172728', '181818', '1956-02-12 00:00:00', '2003-08-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Engineerin', '', '001', '', '282829', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 8900, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 11, 'Kisumu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 96, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, NULL, '2009-02-07 01:02:04', 'demo', '0000-00-00 00:00:00', '', 336);
INSERT INTO `prmember` VALUES ('48887', 'Noella', 'Kamanu Ngendo', 'Noella Kamanu Ngendo', '', '', 'MG01', 'f', '1', '2727289', '26262', '2323456', '272728', '1955-03-10 00:00:00', '2004-12-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '2010 09', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'ict', '', '001', '', '282828', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 90000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 11, 'Mombasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 95, NULL, 0, 1, 0, 1, '2005-01-01', '', NULL, NULL, NULL, '2009-02-07 01:02:59', 'demo', '0000-00-00 00:00:00', '', 337);
INSERT INTO `prmember` VALUES ('171718', 'Penny', NULL, 'Penny Smith', '', '', 'MG01', 'f', '4', '838390', '2828389', '37373798', '27272', '1954-06-06 00:00:00', '2000-01-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', '282828', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 78000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 8, 'Nairobi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 93, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, '0000-00-00', '2009-02-07 01:02:30', 'demo', '2009-02-07 06:02:41', 'demo', 338);
INSERT INTO `prmember` VALUES ('181818', 'George', NULL, 'George Butcher', '', '', 'MG01', 'm', '1', '282829', '272772', '727278', '7272828', '1970-11-01 00:00:00', '1960-03-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', '1881990', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 79000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 10, 'kitui', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 96, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, NULL, '2009-02-07 01:02:56', 'demo', '0000-00-00 00:00:00', '', 339);
INSERT INTO `prmember` VALUES ('383839', 'Charles', NULL, 'Charles Sunday', '', '', 'MG01', 'm', '2', '292020', '3636377', '384849', '282828', '1956-11-01 00:00:00', '2001-02-02 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'ict', '', '001', '', '1828299', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 900000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 7, 'Nairobi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 96, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, NULL, '2009-02-07 02:02:59', 'demo', '0000-00-00 00:00:00', '', 340);
INSERT INTO `prmember` VALUES ('62627', 'David', NULL, 'David Ngetch', '', '', 'MG01', 'm', '1', '77383', '626278', '262279', '2626268', '1984-11-12 00:00:00', '2007-03-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'Transport', '', '001', '', 'W3737738', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 89000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 7, 'KILIFI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 94, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, 'MG01', NULL, '2009-02-07 06:02:25', 'demo', '0000-00-00 00:00:00', '', 341);
INSERT INTO `prmember` VALUES ('373739', 'George', NULL, 'George LATOTI', '', '', 'MG01', 'm', '3', '9191918', '27262627', '26262', '151517', '2003-12-11 00:00:00', '2003-12-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'ict', '', '001', '', '981919', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 80000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 10, 'Kisumu dala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 98, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, NULL, '2009-02-07 06:02:46', 'demo', '0000-00-00 00:00:00', '', 342);
INSERT INTO `prmember` VALUES ('2172728', 'Kim', 'Lee Sanger', 'Kim Lee Sanger', '', '', 'MG01', 'm', '1', '918289', '367379', '3636388', '171719', '1980-06-01 00:00:00', '2002-03-01 00:00:00', '', '', NULL, '', '0000-00-00 00:00:00', '', 0, 0, NULL, NULL, 0, 0, 0, 0, 0, '0000-00-00', NULL, '001', '', 'ict', '', '001', '', '62727', 0, 0, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 60000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2009 02', '', 1, 1, 7, 'Malindi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, 99, NULL, 0, 1, 0, 2, '0000-00-00', '', NULL, NULL, NULL, '2009-02-07 06:02:50', 'demo', '2009-02-07 06:02:25', 'demo', 343);

-- --------------------------------------------------------

-- 
-- Table structure for table `prmloans`
-- 

DROP TABLE IF EXISTS `prmloans`;
CREATE TABLE IF NOT EXISTS `prmloans` (
  `TAutoNo` int(11) NOT NULL auto_increment,
  `MemberNo` varchar(10) NOT NULL default '',
  `LoanCode` varchar(15) NOT NULL default '',
  `LoanRef` varchar(15) NOT NULL default '',
  `LoanDate` datetime default NULL,
  `LoanName` varchar(25) NOT NULL default '',
  `Principal` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `PayPeriod` float NOT NULL default '0',
  `MonthPay` double NOT NULL default '0',
  `LoanTax` float NOT NULL default '0',
  `FixedInterestAmt` double NOT NULL default '0',
  `PerCentInterest` double NOT NULL default '0',
  `InterestType` varchar(10) NOT NULL default '',
  `CummInterestAmt` double NOT NULL default '0',
  `PayStart` datetime default NULL,
  `StartPrd` varchar(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `TimeStamp` varchar(15) NOT NULL default '',
  `CompletionDate` datetime default NULL,
  `User` varchar(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`TAutoNo`),
  KEY `MBNO` (`MemberNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=799 ;

-- 
-- Dumping data for table `prmloans`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prmpd`
-- 

DROP TABLE IF EXISTS `prmpd`;
CREATE TABLE IF NOT EXISTS `prmpd` (
  `MemberNo` varchar(10) NOT NULL default '',
  `PDCode` varchar(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `Amount` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `PDName` varchar(25) NOT NULL default '',
  `PayPeriod` float NOT NULL default '0',
  `PayStart` datetime default NULL,
  `EndDate` datetime default NULL,
  `EndPrd` varchar(10) NOT NULL default '',
  `User` varchar(15) NOT NULL default '',
  `TimeStamp` varchar(15) NOT NULL default '',
  `Reference` varchar(15) NOT NULL default '',
  `Period` varchar(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`MemberNo`,`PDCode`,`Category`),
  KEY `MBNO` (`MemberNo`),
  KEY `CODE1` (`PDCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prmpd`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prpd`
-- 

DROP TABLE IF EXISTS `prpd`;
CREATE TABLE IF NOT EXISTS `prpd` (
  `PDCode` varchar(15) NOT NULL default '',
  `PDName` varchar(25) NOT NULL default '',
  `PDType` char(3) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `KeepBal` tinyint(4) NOT NULL default '0',
  `PDRecur` tinyint(4) NOT NULL default '0',
  `PDTaxed` tinyint(4) NOT NULL default '0',
  `PDPension` tinyint(4) NOT NULL default '0',
  `LedgerCode` varchar(13) NOT NULL default '',
  `ExemptRate` float NOT NULL default '0',
  `ExemptMax` double NOT NULL default '0',
  `BaseOn` varchar(15) NOT NULL default '',
  `Factor` float NOT NULL default '0',
  `Pos_Neg_Amt` tinyint(4) NOT NULL default '1',
  `RemitBnkCode` varchar(10) NOT NULL default '',
  `RemitBnkAcc` varchar(15) NOT NULL default '',
  `RemitAccName` varchar(75) NOT NULL default '',
  PRIMARY KEY  (`PDCode`),
  KEY `PDType` (`PDType`),
  KEY `LedgerCode` (`LedgerCode`),
  KEY `PD_CODE` (`PDCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prpd`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prstn`
-- 

DROP TABLE IF EXISTS `prstn`;
CREATE TABLE IF NOT EXISTS `prstn` (
  `StationCode` varchar(10) NOT NULL default '',
  `StationName` varchar(25) NOT NULL default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  `Suspended` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`StationCode`),
  KEY `STN_CODE` (`StationCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prstn`
-- 

INSERT INTO `prstn` VALUES ('001', 'Transport', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `prtax_tb`
-- 

DROP TABLE IF EXISTS `prtax_tb`;
CREATE TABLE IF NOT EXISTS `prtax_tb` (
  `TaxCode` varchar(15) NOT NULL default '',
  `TaxName` varchar(25) NOT NULL default '',
  `LowerLimit` double NOT NULL default '0',
  `UpperLimit` double NOT NULL default '0',
  `Percent` float NOT NULL default '0',
  `BaseTax` double NOT NULL default '0',
  `TaxMax` double NOT NULL default '0',
  `WithHouseFactor` float NOT NULL default '0',
  `WithoutHouseFactor` float NOT NULL default '0',
  KEY `TAX_CODE` (`TaxCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prtax_tb`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prtaxes`
-- 

DROP TABLE IF EXISTS `prtaxes`;
CREATE TABLE IF NOT EXISTS `prtaxes` (
  `TaxCode` varchar(15) NOT NULL default '',
  `TaxName` varchar(25) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `LedgerCode` varchar(13) NOT NULL default '',
  `Units` varchar(4) NOT NULL default '',
  `TaxExempt` tinyint(4) NOT NULL default '0',
  `BaseOn` varchar(15) NOT NULL default '',
  `ContribRate` double NOT NULL default '0',
  `ContribAmt` double NOT NULL default '0',
  `ContribMax` double NOT NULL default '0',
  `TaxMax` double NOT NULL default '0',
  PRIMARY KEY  (`TaxCode`),
  KEY `TAX_CODE` (`TaxCode`),
  KEY `LedgerCode` (`LedgerCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prtaxes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quitdates`
-- 

DROP TABLE IF EXISTS `quitdates`;
CREATE TABLE IF NOT EXISTS `quitdates` (
  `id` int(11) NOT NULL auto_increment,
  `memberno` int(11) default NULL,
  `cd_qdate` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=308 ;

-- 
-- Dumping data for table `quitdates`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `rptpr`
-- 

DROP TABLE IF EXISTS `rptpr`;
CREATE TABLE IF NOT EXISTS `rptpr` (
  `MemberNo` varchar(10) NOT NULL default '',
  `LastName` varchar(15) NOT NULL default '',
  `OtherNames` varchar(30) NOT NULL default '',
  `JobGroup` varchar(10) NOT NULL default '',
  `Designation` varchar(10) NOT NULL default '',
  `Employer` varchar(60) NOT NULL default '',
  `EmployerPin` varchar(15) NOT NULL default '',
  `EmployerNssf` varchar(15) NOT NULL default '',
  `EmployerNhif` varchar(15) NOT NULL default '',
  `Station` varchar(10) NOT NULL default '',
  `StationName` varchar(30) NOT NULL default '',
  `Dept` varchar(10) NOT NULL default '',
  `DeptName` varchar(30) NOT NULL default '',
  `SortBy` varchar(10) NOT NULL default '',
  `NSSFNo` varchar(13) NOT NULL default '',
  `NHIFNo` varchar(13) NOT NULL default '',
  `IDNumber` varchar(13) NOT NULL default '',
  `PINNumber` varchar(13) NOT NULL default '',
  `EmpDate` date NOT NULL default '0000-00-00',
  `BirthDate` date NOT NULL default '0000-00-00',
  `AnnIncrement` double NOT NULL default '0',
  `IncrementDate` date NOT NULL default '0000-00-00',
  `MPR_Original` double NOT NULL default '0',
  `OwnerOccupier` tinyint(4) NOT NULL default '0',
  `Suspended` tinyint(4) NOT NULL default '0',
  `TransCode` varchar(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `Reference` varchar(15) NOT NULL default '',
  `Period` varchar(15) NOT NULL default '',
  `LedgerCode` varchar(13) NOT NULL default '',
  `TransType` varchar(10) NOT NULL default '',
  `Description` varchar(35) NOT NULL default '',
  `Units` float NOT NULL default '0',
  `Amount` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `Taxed` tinyint(4) NOT NULL default '0',
  `BaseOnAmt` double NOT NULL default '0',
  `ContribAmt` double NOT NULL default '0',
  `TransDate` datetime default NULL,
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `TaxableAmount` double NOT NULL default '0',
  `revTaxableAmt` double NOT NULL default '0',
  `TaxableCashPay` double NOT NULL default '0',
  `TaxableBenefit` double NOT NULL default '0',
  `Tax` double NOT NULL default '0',
  `BankCode` varchar(10) NOT NULL default '',
  `BankName` varchar(25) NOT NULL default '',
  `AccountNo` varchar(15) NOT NULL default '',
  `nssfCode` varchar(15) NOT NULL default '',
  `Grp` varchar(5) NOT NULL default '',
  `Address` varchar(30) NOT NULL default '',
  `Address2` varchar(30) NOT NULL default '',
  `Town` varchar(20) NOT NULL default '',
  `Country` varchar(20) NOT NULL default '',
  `User` varchar(15) NOT NULL default '',
  `TimeStamp` varchar(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `rptpr`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `rptps`
-- 

DROP TABLE IF EXISTS `rptps`;
CREATE TABLE IF NOT EXISTS `rptps` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `Licencee` char(100) NOT NULL default '',
  `Station` char(10) NOT NULL default '',
  `Dept` char(10) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `Description1` char(35) NOT NULL default '',
  `Amount1` double NOT NULL default '0',
  `Balance1` double NOT NULL default '0',
  `Description2` char(35) NOT NULL default '',
  `Amount2` double NOT NULL default '0',
  `Balance2` double NOT NULL default '0',
  `Description3` char(35) NOT NULL default '',
  `Amount3` double NOT NULL default '0',
  `Balance3` double NOT NULL default '0',
  `Description4` char(35) NOT NULL default '',
  `Amount4` double NOT NULL default '0',
  `Balance4` double NOT NULL default '0',
  `Description5` char(35) NOT NULL default '',
  `Amount5` double NOT NULL default '0',
  `Balance5` double NOT NULL default '0',
  `Description6` char(35) NOT NULL default '',
  `Amount6` double NOT NULL default '0',
  `Balance6` double NOT NULL default '0',
  `Description7` char(35) NOT NULL default '',
  `Amount7` double NOT NULL default '0',
  `Balance7` double NOT NULL default '0',
  `Description8` char(35) NOT NULL default '',
  `Amount8` double NOT NULL default '0',
  `Balance8` double NOT NULL default '0',
  `Description9` char(35) NOT NULL default '',
  `Amount9` double NOT NULL default '0',
  `Balance9` double NOT NULL default '0',
  `Description10` char(35) NOT NULL default '',
  `Amount10` double NOT NULL default '0',
  `Balance10` double NOT NULL default '0',
  `Description11` char(35) NOT NULL default '',
  `Amount11` double NOT NULL default '0',
  `Balance11` double NOT NULL default '0',
  `Description12` char(35) NOT NULL default '',
  `Amount12` double NOT NULL default '0',
  `Balance12` double NOT NULL default '0',
  `Description13` char(35) NOT NULL default '',
  `Amount13` double NOT NULL default '0',
  `Balance13` double NOT NULL default '0',
  `Description14` char(35) NOT NULL default '',
  `Amount14` double NOT NULL default '0',
  `Balance14` double NOT NULL default '0',
  `Description15` char(35) NOT NULL default '',
  `Amount15` double NOT NULL default '0',
  `Balance15` double NOT NULL default '0',
  `Description16` char(35) NOT NULL default '',
  `Amount16` double NOT NULL default '0',
  `Balance16` double NOT NULL default '0',
  `Description17` char(35) NOT NULL default '',
  `Amount17` double NOT NULL default '0',
  `Balance17` double NOT NULL default '0',
  `Description18` char(35) NOT NULL default '',
  `Amount18` double NOT NULL default '0',
  `Balance18` double NOT NULL default '0',
  `Description19` char(35) NOT NULL default '',
  `Amount19` double NOT NULL default '0',
  `Balance19` double NOT NULL default '0',
  `Description20` char(35) NOT NULL default '',
  `Amount20` double NOT NULL default '0',
  `Balance20` double NOT NULL default '0',
  `Description21` char(35) NOT NULL default '',
  `Amount21` double NOT NULL default '0',
  `Balance21` double NOT NULL default '0',
  `Description22` char(35) NOT NULL default '',
  `Amount22` double NOT NULL default '0',
  `Balance22` double NOT NULL default '0',
  `Description23` char(35) NOT NULL default '',
  `Amount23` double NOT NULL default '0',
  `Balance23` double NOT NULL default '0',
  `Description24` char(35) NOT NULL default '',
  `Amount24` double NOT NULL default '0',
  `Balance24` double NOT NULL default '0',
  `Description25` char(35) NOT NULL default '',
  `Amount25` double NOT NULL default '0',
  `Balance25` double NOT NULL default '0',
  `Description26` char(35) NOT NULL default '',
  `Amount26` double NOT NULL default '0',
  `Balance26` double NOT NULL default '0',
  `Description27` char(35) NOT NULL default '',
  `Amount27` double NOT NULL default '0',
  `Balance27` double NOT NULL default '0',
  `Description28` char(35) NOT NULL default '',
  `Amount28` double NOT NULL default '0',
  `Balance28` double NOT NULL default '0',
  `Description29` char(35) NOT NULL default '',
  `Amount29` double NOT NULL default '0',
  `Balance29` double NOT NULL default '0',
  `Description30` char(35) NOT NULL default '',
  `Amount30` double NOT NULL default '0',
  `Balance30` double NOT NULL default '0',
  `Description31` char(35) NOT NULL default '',
  `Amount31` double NOT NULL default '0',
  `Balance31` double NOT NULL default '0',
  `Description32` char(35) NOT NULL default '',
  `Amount32` double NOT NULL default '0',
  `Balance32` double NOT NULL default '0',
  `Description33` char(35) NOT NULL default '',
  `Amount33` double NOT NULL default '0',
  `Balance33` double NOT NULL default '0',
  `Description34` char(35) NOT NULL default '',
  `Amount34` double NOT NULL default '0',
  `Balance34` double NOT NULL default '0',
  `Description35` char(35) NOT NULL default '',
  `Amount35` double NOT NULL default '0',
  `Balance35` double NOT NULL default '0',
  `Description36` char(35) NOT NULL default '',
  `Amount36` double NOT NULL default '0',
  `Balance36` double NOT NULL default '0',
  `Description37` char(35) NOT NULL default '',
  `Amount37` double NOT NULL default '0',
  `Balance37` double NOT NULL default '0',
  `Description38` char(35) NOT NULL default '',
  `Amount38` double NOT NULL default '0',
  `Balance38` double NOT NULL default '0',
  `Description39` char(35) NOT NULL default '',
  `Amount39` double NOT NULL default '0',
  `Balance39` double NOT NULL default '0',
  `Description40` char(35) NOT NULL default '',
  `Amount40` double NOT NULL default '0',
  `Balance40` double NOT NULL default '0',
  `Description41` char(35) NOT NULL default '',
  `Amount41` double NOT NULL default '0',
  `Balance41` double NOT NULL default '0',
  `Description42` char(35) NOT NULL default '',
  `Amount42` double NOT NULL default '0',
  `Balance42` double NOT NULL default '0',
  `Description43` char(35) NOT NULL default '',
  `Amount43` double NOT NULL default '0',
  `Balance43` double NOT NULL default '0',
  `Description44` char(35) NOT NULL default '',
  `Amount44` double NOT NULL default '0',
  `Balance44` double NOT NULL default '0',
  `Description45` char(35) NOT NULL default '',
  `Amount45` double NOT NULL default '0',
  `Balance45` double NOT NULL default '0',
  `Description46` char(35) NOT NULL default '',
  `Amount46` double NOT NULL default '0',
  `Balance46` double NOT NULL default '0',
  `Description47` char(35) NOT NULL default '',
  `Amount47` double NOT NULL default '0',
  `Balance47` double NOT NULL default '0',
  `Description48` char(35) NOT NULL default '',
  `Amount48` double NOT NULL default '0',
  `Balance48` double NOT NULL default '0',
  `Description49` char(35) NOT NULL default '',
  `Amount49` double NOT NULL default '0',
  `Balance49` double NOT NULL default '0',
  `Description50` char(35) NOT NULL default '',
  `Amount50` double NOT NULL default '0',
  `Balance50` double NOT NULL default '0',
  `Description51` char(35) NOT NULL default '',
  `Amount51` double NOT NULL default '0',
  `Balance51` double NOT NULL default '0',
  `Description52` char(35) NOT NULL default '',
  `Amount52` double NOT NULL default '0',
  `Balance52` double NOT NULL default '0',
  `Description53` char(35) NOT NULL default '',
  `Amount53` double NOT NULL default '0',
  `Balance53` double NOT NULL default '0',
  `Description54` char(35) NOT NULL default '',
  `Amount54` double NOT NULL default '0',
  `Balance54` double NOT NULL default '0',
  `Description55` char(35) NOT NULL default '',
  `Amount55` double NOT NULL default '0',
  `Balance55` double NOT NULL default '0',
  `Description56` char(35) NOT NULL default '',
  `Amount56` double NOT NULL default '0',
  `Balance56` double NOT NULL default '0',
  `Description57` char(35) NOT NULL default '',
  `Amount57` double NOT NULL default '0',
  `Balance57` double NOT NULL default '0',
  `Description58` char(35) NOT NULL default '',
  `Amount58` double NOT NULL default '0',
  `Balance58` double NOT NULL default '0',
  `Description59` char(35) NOT NULL default '',
  `Amount59` double NOT NULL default '0',
  `Balance59` double NOT NULL default '0',
  `Description60` char(35) NOT NULL default '',
  `Amount60` double NOT NULL default '0',
  `Balance60` double NOT NULL default '0',
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `Designation` char(10) NOT NULL default '',
  `NSSFNo` char(13) NOT NULL default '',
  `NHIFNO` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `BirthDate` date NOT NULL default '0000-00-00',
  `EmpDate` date default '0000-00-00',
  `JobGroup` char(10) NOT NULL default '',
  `IncrementDate` date default '0000-00-00',
  `revTaxableAmt` double NOT NULL default '0',
  `MPR_Original` double NOT NULL default '0',
  `MPR_Revised` double NOT NULL default '0',
  `BankName` char(25) NOT NULL default '',
  `BankAddr` char(60) NOT NULL default '',
  `AccountNo` char(20) NOT NULL default '',
  `User` char(15) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `rptps`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `support_users`
-- 

DROP TABLE IF EXISTS `support_users`;
CREATE TABLE IF NOT EXISTS `support_users` (
  `id` int(100) NOT NULL auto_increment,
  `name` varchar(32) default NULL,
  `email` varchar(50) default NULL,
  `username` varchar(32) default NULL,
  `password` varchar(32) default NULL,
  `group_id` int(5) default NULL,
  `admin` int(1) default NULL,
  `level` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `support_users`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_appraisals`
-- 

DROP TABLE IF EXISTS `tbl_appraisals`;
CREATE TABLE IF NOT EXISTS `tbl_appraisals` (
  `id` int(11) NOT NULL auto_increment,
  `result_fk` int(11) default NULL,
  `empid_fk` int(11) default NULL,
  `appdate` date default NULL,
  `appcomments` varchar(255) default NULL,
  `appraiser` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_appraisals`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_appresults`
-- 

DROP TABLE IF EXISTS `tbl_appresults`;
CREATE TABLE IF NOT EXISTS `tbl_appresults` (
  `id` int(11) NOT NULL auto_increment,
  `appresult` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_appresults`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_banks1`
-- 

DROP TABLE IF EXISTS `tbl_banks1`;
CREATE TABLE IF NOT EXISTS `tbl_banks1` (
  `id` int(11) NOT NULL auto_increment,
  `bankname` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_banks1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_branches1`
-- 

DROP TABLE IF EXISTS `tbl_branches1`;
CREATE TABLE IF NOT EXISTS `tbl_branches1` (
  `id` int(11) NOT NULL auto_increment,
  `branchname` varchar(255) NOT NULL default '',
  `bankid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_branches1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_countries1`
-- 

DROP TABLE IF EXISTS `tbl_countries1`;
CREATE TABLE IF NOT EXISTS `tbl_countries1` (
  `id` int(11) NOT NULL auto_increment,
  `countryname` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `tbl_countries1`
-- 

INSERT INTO `tbl_countries1` VALUES (1, 'Kenyan');
INSERT INTO `tbl_countries1` VALUES (2, 'Tanzanian');
INSERT INTO `tbl_countries1` VALUES (3, 'Ugandan');
INSERT INTO `tbl_countries1` VALUES (4, 'American');
INSERT INTO `tbl_countries1` VALUES (5, 'British');
INSERT INTO `tbl_countries1` VALUES (6, 'German');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_course`
-- 

DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `deptcode` varchar(5) default '',
  `section` varchar(255) default NULL,
  `sopcode` varchar(15) NOT NULL default '',
  `version` varchar(20) default NULL,
  `author` varchar(25) default NULL,
  `reviewer` varchar(25) default NULL,
  `qa` varchar(25) default NULL,
  `approver` varchar(25) default NULL,
  `status` varchar(25) default NULL,
  `authorapproved` date default NULL,
  `reviewerapproval` date default NULL,
  `qaapproval` date default NULL,
  `finalpproval` date default NULL,
  `effective` date default NULL,
  `data` longblob,
  `filesize` int(11) default NULL,
  `filetype` varchar(25) default NULL,
  `filename` varchar(255) default NULL,
  `addedby` varchar(255) default NULL,
  `dateadded` datetime default NULL,
  `qanumber` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_course`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_departments1`
-- 

DROP TABLE IF EXISTS `tbl_departments1`;
CREATE TABLE IF NOT EXISTS `tbl_departments1` (
  `id` int(11) NOT NULL auto_increment,
  `department` varchar(255) default NULL,
  `depcat` varchar(255) default NULL,
  `depthead` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `tbl_departments1`
-- 

INSERT INTO `tbl_departments1` VALUES (1, 'Transport', '1', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_dependants1`
-- 

DROP TABLE IF EXISTS `tbl_dependants1`;
CREATE TABLE IF NOT EXISTS `tbl_dependants1` (
  `id` int(11) NOT NULL auto_increment,
  `mname` varchar(50) default NULL,
  `fname` varchar(100) NOT NULL default '',
  `lname` varchar(100) NOT NULL default '',
  `gender` char(1) NOT NULL default '',
  `dob` date NOT NULL default '0000-00-00',
  `empid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=253 ;

-- 
-- Dumping data for table `tbl_dependants1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_discipaction`
-- 

DROP TABLE IF EXISTS `tbl_discipaction`;
CREATE TABLE IF NOT EXISTS `tbl_discipaction` (
  `id` int(11) NOT NULL auto_increment,
  `action_name` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `tbl_discipaction`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_disciplinary`
-- 

DROP TABLE IF EXISTS `tbl_disciplinary`;
CREATE TABLE IF NOT EXISTS `tbl_disciplinary` (
  `id` int(11) NOT NULL auto_increment,
  `dispdate` date default NULL,
  `reasons` longtext,
  `empid_fk` int(11) default NULL,
  `action` int(11) default NULL,
  `months` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_disciplinary`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_documents1`
-- 

DROP TABLE IF EXISTS `tbl_documents1`;
CREATE TABLE IF NOT EXISTS `tbl_documents1` (
  `id` int(11) NOT NULL auto_increment,
  `filedesc` varchar(255) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `filetype` varchar(50) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  `data` longblob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_documents1`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_empstatus`
-- 

DROP TABLE IF EXISTS `tbl_empstatus`;
CREATE TABLE IF NOT EXISTS `tbl_empstatus` (
  `id` tinyint(4) NOT NULL auto_increment,
  `status` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `tbl_empstatus`
-- 

INSERT INTO `tbl_empstatus` VALUES (1, 'Active');
INSERT INTO `tbl_empstatus` VALUES (2, 'Resigned');
INSERT INTO `tbl_empstatus` VALUES (3, 'Retired');
INSERT INTO `tbl_empstatus` VALUES (4, 'Terminated');
INSERT INTO `tbl_empstatus` VALUES (5, 'Transferred');
INSERT INTO `tbl_empstatus` VALUES (6, 'Deceased');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_leaveapplic`
-- 

DROP TABLE IF EXISTS `tbl_leaveapplic`;
CREATE TABLE IF NOT EXISTS `tbl_leaveapplic` (
  `empid_fk` int(11) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `datefrom` date default NULL,
  `dateto` date default NULL,
  `numdays` int(11) default NULL,
  `leaveaddress` varchar(255) default NULL,
  `leavebal` int(11) default NULL,
  `dateapplied` datetime default NULL,
  `approved` tinyint(4) default NULL,
  `approvedby` varchar(255) default NULL,
  `dateapproved` datetime default NULL,
  `authorised` tinyint(4) default NULL,
  `authorisedby` varchar(255) default NULL,
  `dateauthorised` datetime default NULL,
  `pnumber` varchar(25) default NULL,
  `confirmed` tinyint(4) default NULL,
  `addedby` varchar(200) default NULL,
  `dateadded` datetime default NULL,
  `sessid` varchar(200) default NULL,
  `lastupdated` datetime default NULL,
  `leavetype` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_leaveapplic`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_leavetypes`
-- 

DROP TABLE IF EXISTS `tbl_leavetypes`;
CREATE TABLE IF NOT EXISTS `tbl_leavetypes` (
  `id` int(11) NOT NULL auto_increment,
  `leavetype` varchar(25) default NULL,
  `totaldays` int(11) default NULL,
  `jobgrpfrom` varchar(10) default NULL,
  `jobgrpto` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `tbl_leavetypes`
-- 

INSERT INTO `tbl_leavetypes` VALUES (1, 'Annual Leave', 30, '1.10', '1.2');
INSERT INTO `tbl_leavetypes` VALUES (2, 'Sick Leave', 21, '', '');
INSERT INTO `tbl_leavetypes` VALUES (3, 'Compassionate Leave', 10, '', '');
INSERT INTO `tbl_leavetypes` VALUES (4, 'Maternity', 90, '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_maritalstatus`
-- 

DROP TABLE IF EXISTS `tbl_maritalstatus`;
CREATE TABLE IF NOT EXISTS `tbl_maritalstatus` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `tbl_maritalstatus`
-- 

INSERT INTO `tbl_maritalstatus` VALUES (1, 'Single');
INSERT INTO `tbl_maritalstatus` VALUES (2, 'Married');
INSERT INTO `tbl_maritalstatus` VALUES (3, 'Divorced');
INSERT INTO `tbl_maritalstatus` VALUES (4, 'Widowed');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_months`
-- 

DROP TABLE IF EXISTS `tbl_months`;
CREATE TABLE IF NOT EXISTS `tbl_months` (
  `id` tinyint(4) NOT NULL auto_increment,
  `monthname` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `tbl_months`
-- 

INSERT INTO `tbl_months` VALUES (1, 'Jan');
INSERT INTO `tbl_months` VALUES (2, 'Feb');
INSERT INTO `tbl_months` VALUES (3, 'Mar');
INSERT INTO `tbl_months` VALUES (4, 'Apr');
INSERT INTO `tbl_months` VALUES (5, 'May');
INSERT INTO `tbl_months` VALUES (6, 'June');
INSERT INTO `tbl_months` VALUES (7, 'Jul');
INSERT INTO `tbl_months` VALUES (8, 'Aug');
INSERT INTO `tbl_months` VALUES (9, 'Sep');
INSERT INTO `tbl_months` VALUES (10, 'Oct');
INSERT INTO `tbl_months` VALUES (11, 'Nov');
INSERT INTO `tbl_months` VALUES (12, 'Dec');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_nextofkin`
-- 

DROP TABLE IF EXISTS `tbl_nextofkin`;
CREATE TABLE IF NOT EXISTS `tbl_nextofkin` (
  `id` int(4) NOT NULL auto_increment,
  `fname` varchar(100) default NULL,
  `mname` varchar(100) default NULL,
  `lname` varchar(100) default NULL,
  `address` varchar(100) default NULL,
  `relationship` varchar(100) default NULL,
  `empid_fk` int(4) NOT NULL default '0',
  `mphone` varchar(255) default '',
  `email` varchar(255) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

-- 
-- Dumping data for table `tbl_nextofkin`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_positions`
-- 

DROP TABLE IF EXISTS `tbl_positions`;
CREATE TABLE IF NOT EXISTS `tbl_positions` (
  `id` tinyint(4) NOT NULL auto_increment,
  `position_name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

-- 
-- Dumping data for table `tbl_positions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_promotions`
-- 

DROP TABLE IF EXISTS `tbl_promotions`;
CREATE TABLE IF NOT EXISTS `tbl_promotions` (
  `id` int(11) NOT NULL auto_increment,
  `desigid_fk` int(11) NOT NULL default '0',
  `empid_fk` int(11) NOT NULL default '0',
  `scale` varchar(5) NOT NULL default '',
  `promdate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `tbl_promotions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_publications`
-- 

DROP TABLE IF EXISTS `tbl_publications`;
CREATE TABLE IF NOT EXISTS `tbl_publications` (
  `id` int(11) NOT NULL auto_increment,
  `pyear` int(11) NOT NULL default '0',
  `journal` varchar(255) NOT NULL default '',
  `ptitle` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_publications`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_qlevels`
-- 

DROP TABLE IF EXISTS `tbl_qlevels`;
CREATE TABLE IF NOT EXISTS `tbl_qlevels` (
  `id` int(11) NOT NULL auto_increment,
  `qlevel` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `tbl_qlevels`
-- 

INSERT INTO `tbl_qlevels` VALUES (9, 'High School Certificate');
INSERT INTO `tbl_qlevels` VALUES (10, 'Under Grad');
INSERT INTO `tbl_qlevels` VALUES (11, 'College Diploma');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_qualifications`
-- 

DROP TABLE IF EXISTS `tbl_qualifications`;
CREATE TABLE IF NOT EXISTS `tbl_qualifications` (
  `id` int(11) NOT NULL auto_increment,
  `qualname` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  `yearfrom` int(11) NOT NULL default '0',
  `yearto` int(11) NOT NULL default '0',
  `institution` varchar(50) NOT NULL default '',
  `qlevel` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=358 ;

-- 
-- Dumping data for table `tbl_qualifications`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_terms`
-- 

DROP TABLE IF EXISTS `tbl_terms`;
CREATE TABLE IF NOT EXISTS `tbl_terms` (
  `id` int(11) NOT NULL auto_increment,
  `terms` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `tbl_terms`
-- 

INSERT INTO `tbl_terms` VALUES (1, 'Contract');
INSERT INTO `tbl_terms` VALUES (2, 'Permanent');
INSERT INTO `tbl_terms` VALUES (3, 'Locum');
INSERT INTO `tbl_terms` VALUES (4, 'Intern');
INSERT INTO `tbl_terms` VALUES (5, 'Temporary');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_titles`
-- 

DROP TABLE IF EXISTS `tbl_titles`;
CREATE TABLE IF NOT EXISTS `tbl_titles` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `tbl_titles`
-- 

INSERT INTO `tbl_titles` VALUES (7, 'Mr');
INSERT INTO `tbl_titles` VALUES (8, 'Mrs');
INSERT INTO `tbl_titles` VALUES (9, 'Miss');
INSERT INTO `tbl_titles` VALUES (10, 'Prof');
INSERT INTO `tbl_titles` VALUES (11, 'Dr.');
INSERT INTO `tbl_titles` VALUES (12, 'Hon.');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_training`
-- 

DROP TABLE IF EXISTS `tbl_training`;
CREATE TABLE IF NOT EXISTS `tbl_training` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` int(11) default NULL,
  `course` varchar(255) default NULL,
  `trainerid` int(11) default NULL,
  `trainer` varchar(45) default NULL,
  `trainingdate` date default NULL,
  `trainingsdate` date default NULL,
  `compechieved` int(11) default NULL,
  `comments` text,
  `institution` varchar(255) default NULL,
  `qlevel` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_training`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_units`
-- 

DROP TABLE IF EXISTS `tbl_units`;
CREATE TABLE IF NOT EXISTS `tbl_units` (
  `id` int(11) NOT NULL auto_increment,
  `unit_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `tbl_units`
-- 

INSERT INTO `tbl_units` VALUES (7, 'Mombasa Branch');
INSERT INTO `tbl_units` VALUES (8, 'Head office branch');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_years`
-- 

DROP TABLE IF EXISTS `tbl_years`;
CREATE TABLE IF NOT EXISTS `tbl_years` (
  `yearlabel` int(4) NOT NULL default '0',
  PRIMARY KEY  (`yearlabel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tbl_years`
-- 

INSERT INTO `tbl_years` VALUES (1950);
INSERT INTO `tbl_years` VALUES (1951);
INSERT INTO `tbl_years` VALUES (1952);
INSERT INTO `tbl_years` VALUES (1953);
INSERT INTO `tbl_years` VALUES (1954);
INSERT INTO `tbl_years` VALUES (1955);
INSERT INTO `tbl_years` VALUES (1956);
INSERT INTO `tbl_years` VALUES (1957);
INSERT INTO `tbl_years` VALUES (1958);
INSERT INTO `tbl_years` VALUES (1959);
INSERT INTO `tbl_years` VALUES (1960);
INSERT INTO `tbl_years` VALUES (1961);
INSERT INTO `tbl_years` VALUES (1962);
INSERT INTO `tbl_years` VALUES (1963);
INSERT INTO `tbl_years` VALUES (1964);
INSERT INTO `tbl_years` VALUES (1965);
INSERT INTO `tbl_years` VALUES (1966);
INSERT INTO `tbl_years` VALUES (1967);
INSERT INTO `tbl_years` VALUES (1968);
INSERT INTO `tbl_years` VALUES (1969);
INSERT INTO `tbl_years` VALUES (1970);
INSERT INTO `tbl_years` VALUES (1971);
INSERT INTO `tbl_years` VALUES (1972);
INSERT INTO `tbl_years` VALUES (1973);
INSERT INTO `tbl_years` VALUES (1974);
INSERT INTO `tbl_years` VALUES (1975);
INSERT INTO `tbl_years` VALUES (1976);
INSERT INTO `tbl_years` VALUES (1977);
INSERT INTO `tbl_years` VALUES (1978);
INSERT INTO `tbl_years` VALUES (1979);
INSERT INTO `tbl_years` VALUES (1980);
INSERT INTO `tbl_years` VALUES (1981);
INSERT INTO `tbl_years` VALUES (1982);
INSERT INTO `tbl_years` VALUES (1983);
INSERT INTO `tbl_years` VALUES (1984);
INSERT INTO `tbl_years` VALUES (1985);
INSERT INTO `tbl_years` VALUES (1986);
INSERT INTO `tbl_years` VALUES (1987);
INSERT INTO `tbl_years` VALUES (1988);
INSERT INTO `tbl_years` VALUES (1989);
INSERT INTO `tbl_years` VALUES (1990);
INSERT INTO `tbl_years` VALUES (1991);
INSERT INTO `tbl_years` VALUES (1992);
INSERT INTO `tbl_years` VALUES (1993);
INSERT INTO `tbl_years` VALUES (1994);
INSERT INTO `tbl_years` VALUES (1995);
INSERT INTO `tbl_years` VALUES (1996);
INSERT INTO `tbl_years` VALUES (1997);
INSERT INTO `tbl_years` VALUES (1998);
INSERT INTO `tbl_years` VALUES (1999);
INSERT INTO `tbl_years` VALUES (2000);
INSERT INTO `tbl_years` VALUES (2001);
INSERT INTO `tbl_years` VALUES (2002);
INSERT INTO `tbl_years` VALUES (2003);
INSERT INTO `tbl_years` VALUES (2004);
INSERT INTO `tbl_years` VALUES (2005);
INSERT INTO `tbl_years` VALUES (2006);
INSERT INTO `tbl_years` VALUES (2007);
INSERT INTO `tbl_years` VALUES (2008);
INSERT INTO `tbl_years` VALUES (2009);
INSERT INTO `tbl_years` VALUES (2010);
INSERT INTO `tbl_years` VALUES (2011);
INSERT INTO `tbl_years` VALUES (2012);
INSERT INTO `tbl_years` VALUES (2013);
INSERT INTO `tbl_years` VALUES (2014);
INSERT INTO `tbl_years` VALUES (2015);

-- --------------------------------------------------------

-- 
-- Table structure for table `timerecord`
-- 

DROP TABLE IF EXISTS `timerecord`;
CREATE TABLE IF NOT EXISTS `timerecord` (
  `TAutoNo` int(11) NOT NULL auto_increment,
  `TransNo` varchar(13) NOT NULL default '',
  `MemberNo` varchar(10) NOT NULL default '',
  `MbName` varchar(30) NOT NULL default '',
  `Category` varchar(15) NOT NULL default '',
  `EntryDate` datetime default '0000-00-00 00:00:00',
  `TransDate` date default '0000-00-00',
  `TimeIn` datetime default '0000-00-00 00:00:00',
  `TimeOut` datetime default '0000-00-00 00:00:00',
  `NoHrs` float NOT NULL default '0',
  `Adj_NoHrs` float NOT NULL default '0',
  `Reference` varchar(15) NOT NULL default '',
  `Comment` varchar(50) NOT NULL default '',
  `User` varchar(15) NOT NULL default '',
  `TimeStamp` varchar(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0',
  `Period` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`TAutoNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `timerecord`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tmppr_00`
-- 

DROP TABLE IF EXISTS `tmppr_00`;
CREATE TABLE IF NOT EXISTS `tmppr_00` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `JobGroup` char(10) NOT NULL default '',
  `Designation` char(10) NOT NULL default '',
  `Employer` char(60) NOT NULL default '',
  `EmployerPin` char(15) NOT NULL default '',
  `EmployerNssf` char(15) NOT NULL default '',
  `EmployerNhif` char(15) NOT NULL default '',
  `Station` char(10) NOT NULL default '',
  `StationName` char(30) NOT NULL default '',
  `Dept` char(10) NOT NULL default '',
  `DeptName` char(30) NOT NULL default '',
  `SortBy` char(10) NOT NULL default '',
  `NSSFNo` char(13) NOT NULL default '',
  `NHIFNo` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `EmpDate` date NOT NULL default '0000-00-00',
  `BirthDate` date NOT NULL default '0000-00-00',
  `AnnIncrement` double NOT NULL default '0',
  `IncrementDate` date NOT NULL default '0000-00-00',
  `MPR_Original` double NOT NULL default '0',
  `OwnerOccupier` tinyint(4) NOT NULL default '0',
  `Suspended` tinyint(4) NOT NULL default '0',
  `TransCode` char(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `Reference` char(15) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `LedgerCode` char(13) NOT NULL default '',
  `TransType` char(10) NOT NULL default '',
  `Description` char(35) NOT NULL default '',
  `Units` float NOT NULL default '0',
  `Amount` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `Taxed` tinyint(4) NOT NULL default '0',
  `BaseOnAmt` double NOT NULL default '0',
  `ContribAmt` double NOT NULL default '0',
  `TransDate` datetime default NULL,
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `TaxableAmount` double NOT NULL default '0',
  `revTaxableAmt` double NOT NULL default '0',
  `TaxableCashPay` double NOT NULL default '0',
  `TaxableBenefit` double NOT NULL default '0',
  `Tax` double NOT NULL default '0',
  `BankCode` char(10) NOT NULL default '',
  `BankName` char(25) NOT NULL default '',
  `AccountNo` char(15) NOT NULL default '',
  `nssfCode` char(15) NOT NULL default '',
  `Grp` char(5) NOT NULL default '',
  `Address` char(30) NOT NULL default '',
  `Address2` char(30) NOT NULL default '',
  `Town` char(20) NOT NULL default '',
  `Country` char(20) NOT NULL default '',
  `User` char(15) NOT NULL default '',
  `TimeStamp` char(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tmppr_00`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tmppr_01`
-- 

DROP TABLE IF EXISTS `tmppr_01`;
CREATE TABLE IF NOT EXISTS `tmppr_01` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `JobGroup` char(10) NOT NULL default '',
  `Designation` char(10) NOT NULL default '',
  `Employer` char(60) NOT NULL default '',
  `EmployerPin` char(15) NOT NULL default '',
  `EmployerNssf` char(15) NOT NULL default '',
  `EmployerNhif` char(15) NOT NULL default '',
  `Station` char(10) NOT NULL default '',
  `StationName` char(30) NOT NULL default '',
  `Dept` char(10) NOT NULL default '',
  `DeptName` char(30) NOT NULL default '',
  `SortBy` char(10) NOT NULL default '',
  `NSSFNo` char(13) NOT NULL default '',
  `NHIFNo` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `EmpDate` date NOT NULL default '0000-00-00',
  `BirthDate` date NOT NULL default '0000-00-00',
  `AnnIncrement` double NOT NULL default '0',
  `IncrementDate` date NOT NULL default '0000-00-00',
  `MPR_Original` double NOT NULL default '0',
  `OwnerOccupier` tinyint(4) NOT NULL default '0',
  `Suspended` tinyint(4) NOT NULL default '0',
  `TransCode` char(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `Reference` char(15) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `LedgerCode` char(13) NOT NULL default '',
  `TransType` char(10) NOT NULL default '',
  `Description` char(35) NOT NULL default '',
  `Units` float NOT NULL default '0',
  `Amount` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `Taxed` tinyint(4) NOT NULL default '0',
  `BaseOnAmt` double NOT NULL default '0',
  `ContribAmt` double NOT NULL default '0',
  `TransDate` datetime default NULL,
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `TaxableAmount` double NOT NULL default '0',
  `revTaxableAmt` double NOT NULL default '0',
  `TaxableCashPay` double NOT NULL default '0',
  `TaxableBenefit` double NOT NULL default '0',
  `Tax` double NOT NULL default '0',
  `BankCode` char(10) NOT NULL default '',
  `BankName` char(25) NOT NULL default '',
  `AccountNo` char(15) NOT NULL default '',
  `nssfCode` char(15) NOT NULL default '',
  `Grp` char(5) NOT NULL default '',
  `Address` char(30) NOT NULL default '',
  `Address2` char(30) NOT NULL default '',
  `Town` char(20) NOT NULL default '',
  `Country` char(20) NOT NULL default '',
  `User` char(15) NOT NULL default '',
  `TimeStamp` char(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tmppr_01`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tmpps_00`
-- 

DROP TABLE IF EXISTS `tmpps_00`;
CREATE TABLE IF NOT EXISTS `tmpps_00` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `Licencee` char(100) NOT NULL default '',
  `Station` char(10) NOT NULL default '',
  `Dept` char(10) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `Description1` char(35) NOT NULL default '',
  `Amount1` double NOT NULL default '0',
  `Balance1` double NOT NULL default '0',
  `Description2` char(35) NOT NULL default '',
  `Amount2` double NOT NULL default '0',
  `Balance2` double NOT NULL default '0',
  `Description3` char(35) NOT NULL default '',
  `Amount3` double NOT NULL default '0',
  `Balance3` double NOT NULL default '0',
  `Description4` char(35) NOT NULL default '',
  `Amount4` double NOT NULL default '0',
  `Balance4` double NOT NULL default '0',
  `Description5` char(35) NOT NULL default '',
  `Amount5` double NOT NULL default '0',
  `Balance5` double NOT NULL default '0',
  `Description6` char(35) NOT NULL default '',
  `Amount6` double NOT NULL default '0',
  `Balance6` double NOT NULL default '0',
  `Description7` char(35) NOT NULL default '',
  `Amount7` double NOT NULL default '0',
  `Balance7` double NOT NULL default '0',
  `Description8` char(35) NOT NULL default '',
  `Amount8` double NOT NULL default '0',
  `Balance8` double NOT NULL default '0',
  `Description9` char(35) NOT NULL default '',
  `Amount9` double NOT NULL default '0',
  `Balance9` double NOT NULL default '0',
  `Description10` char(35) NOT NULL default '',
  `Amount10` double NOT NULL default '0',
  `Balance10` double NOT NULL default '0',
  `Description11` char(35) NOT NULL default '',
  `Amount11` double NOT NULL default '0',
  `Balance11` double NOT NULL default '0',
  `Description12` char(35) NOT NULL default '',
  `Amount12` double NOT NULL default '0',
  `Balance12` double NOT NULL default '0',
  `Description13` char(35) NOT NULL default '',
  `Amount13` double NOT NULL default '0',
  `Balance13` double NOT NULL default '0',
  `Description14` char(35) NOT NULL default '',
  `Amount14` double NOT NULL default '0',
  `Balance14` double NOT NULL default '0',
  `Description15` char(35) NOT NULL default '',
  `Amount15` double NOT NULL default '0',
  `Balance15` double NOT NULL default '0',
  `Description16` char(35) NOT NULL default '',
  `Amount16` double NOT NULL default '0',
  `Balance16` double NOT NULL default '0',
  `Description17` char(35) NOT NULL default '',
  `Amount17` double NOT NULL default '0',
  `Balance17` double NOT NULL default '0',
  `Description18` char(35) NOT NULL default '',
  `Amount18` double NOT NULL default '0',
  `Balance18` double NOT NULL default '0',
  `Description19` char(35) NOT NULL default '',
  `Amount19` double NOT NULL default '0',
  `Balance19` double NOT NULL default '0',
  `Description20` char(35) NOT NULL default '',
  `Amount20` double NOT NULL default '0',
  `Balance20` double NOT NULL default '0',
  `Description21` char(35) NOT NULL default '',
  `Amount21` double NOT NULL default '0',
  `Balance21` double NOT NULL default '0',
  `Description22` char(35) NOT NULL default '',
  `Amount22` double NOT NULL default '0',
  `Balance22` double NOT NULL default '0',
  `Description23` char(35) NOT NULL default '',
  `Amount23` double NOT NULL default '0',
  `Balance23` double NOT NULL default '0',
  `Description24` char(35) NOT NULL default '',
  `Amount24` double NOT NULL default '0',
  `Balance24` double NOT NULL default '0',
  `Description25` char(35) NOT NULL default '',
  `Amount25` double NOT NULL default '0',
  `Balance25` double NOT NULL default '0',
  `Description26` char(35) NOT NULL default '',
  `Amount26` double NOT NULL default '0',
  `Balance26` double NOT NULL default '0',
  `Description27` char(35) NOT NULL default '',
  `Amount27` double NOT NULL default '0',
  `Balance27` double NOT NULL default '0',
  `Description28` char(35) NOT NULL default '',
  `Amount28` double NOT NULL default '0',
  `Balance28` double NOT NULL default '0',
  `Description29` char(35) NOT NULL default '',
  `Amount29` double NOT NULL default '0',
  `Balance29` double NOT NULL default '0',
  `Description30` char(35) NOT NULL default '',
  `Amount30` double NOT NULL default '0',
  `Balance30` double NOT NULL default '0',
  `Description31` char(35) NOT NULL default '',
  `Amount31` double NOT NULL default '0',
  `Balance31` double NOT NULL default '0',
  `Description32` char(35) NOT NULL default '',
  `Amount32` double NOT NULL default '0',
  `Balance32` double NOT NULL default '0',
  `Description33` char(35) NOT NULL default '',
  `Amount33` double NOT NULL default '0',
  `Balance33` double NOT NULL default '0',
  `Description34` char(35) NOT NULL default '',
  `Amount34` double NOT NULL default '0',
  `Balance34` double NOT NULL default '0',
  `Description35` char(35) NOT NULL default '',
  `Amount35` double NOT NULL default '0',
  `Balance35` double NOT NULL default '0',
  `Description36` char(35) NOT NULL default '',
  `Amount36` double NOT NULL default '0',
  `Balance36` double NOT NULL default '0',
  `Description37` char(35) NOT NULL default '',
  `Amount37` double NOT NULL default '0',
  `Balance37` double NOT NULL default '0',
  `Description38` char(35) NOT NULL default '',
  `Amount38` double NOT NULL default '0',
  `Balance38` double NOT NULL default '0',
  `Description39` char(35) NOT NULL default '',
  `Amount39` double NOT NULL default '0',
  `Balance39` double NOT NULL default '0',
  `Description40` char(35) NOT NULL default '',
  `Amount40` double NOT NULL default '0',
  `Balance40` double NOT NULL default '0',
  `Description41` char(35) NOT NULL default '',
  `Amount41` double NOT NULL default '0',
  `Balance41` double NOT NULL default '0',
  `Description42` char(35) NOT NULL default '',
  `Amount42` double NOT NULL default '0',
  `Balance42` double NOT NULL default '0',
  `Description43` char(35) NOT NULL default '',
  `Amount43` double NOT NULL default '0',
  `Balance43` double NOT NULL default '0',
  `Description44` char(35) NOT NULL default '',
  `Amount44` double NOT NULL default '0',
  `Balance44` double NOT NULL default '0',
  `Description45` char(35) NOT NULL default '',
  `Amount45` double NOT NULL default '0',
  `Balance45` double NOT NULL default '0',
  `Description46` char(35) NOT NULL default '',
  `Amount46` double NOT NULL default '0',
  `Balance46` double NOT NULL default '0',
  `Description47` char(35) NOT NULL default '',
  `Amount47` double NOT NULL default '0',
  `Balance47` double NOT NULL default '0',
  `Description48` char(35) NOT NULL default '',
  `Amount48` double NOT NULL default '0',
  `Balance48` double NOT NULL default '0',
  `Description49` char(35) NOT NULL default '',
  `Amount49` double NOT NULL default '0',
  `Balance49` double NOT NULL default '0',
  `Description50` char(35) NOT NULL default '',
  `Amount50` double NOT NULL default '0',
  `Balance50` double NOT NULL default '0',
  `Description51` char(35) NOT NULL default '',
  `Amount51` double NOT NULL default '0',
  `Balance51` double NOT NULL default '0',
  `Description52` char(35) NOT NULL default '',
  `Amount52` double NOT NULL default '0',
  `Balance52` double NOT NULL default '0',
  `Description53` char(35) NOT NULL default '',
  `Amount53` double NOT NULL default '0',
  `Balance53` double NOT NULL default '0',
  `Description54` char(35) NOT NULL default '',
  `Amount54` double NOT NULL default '0',
  `Balance54` double NOT NULL default '0',
  `Description55` char(35) NOT NULL default '',
  `Amount55` double NOT NULL default '0',
  `Balance55` double NOT NULL default '0',
  `Description56` char(35) NOT NULL default '',
  `Amount56` double NOT NULL default '0',
  `Balance56` double NOT NULL default '0',
  `Description57` char(35) NOT NULL default '',
  `Amount57` double NOT NULL default '0',
  `Balance57` double NOT NULL default '0',
  `Description58` char(35) NOT NULL default '',
  `Amount58` double NOT NULL default '0',
  `Balance58` double NOT NULL default '0',
  `Description59` char(35) NOT NULL default '',
  `Amount59` double NOT NULL default '0',
  `Balance59` double NOT NULL default '0',
  `Description60` char(35) NOT NULL default '',
  `Amount60` double NOT NULL default '0',
  `Balance60` double NOT NULL default '0',
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `Designation` char(10) NOT NULL default '',
  `NSSFNo` char(13) NOT NULL default '',
  `NHIFNO` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `BirthDate` date NOT NULL default '0000-00-00',
  `EmpDate` date default '0000-00-00',
  `JobGroup` char(10) NOT NULL default '',
  `IncrementDate` date default '0000-00-00',
  `revTaxableAmt` double NOT NULL default '0',
  `MPR_Original` double NOT NULL default '0',
  `MPR_Revised` double NOT NULL default '0',
  `BankName` char(25) NOT NULL default '',
  `BankAddr` char(60) NOT NULL default '',
  `AccountNo` char(20) NOT NULL default '',
  `User` char(15) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tmpps_00`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tmpps_01`
-- 

DROP TABLE IF EXISTS `tmpps_01`;
CREATE TABLE IF NOT EXISTS `tmpps_01` (
  `MemberNo` char(10) NOT NULL default '',
  `LastName` char(15) NOT NULL default '',
  `OtherNames` char(30) NOT NULL default '',
  `Licencee` char(100) NOT NULL default '',
  `Station` char(10) NOT NULL default '',
  `Dept` char(10) NOT NULL default '',
  `Period` char(15) NOT NULL default '',
  `Description1` char(35) NOT NULL default '',
  `Amount1` double NOT NULL default '0',
  `Balance1` double NOT NULL default '0',
  `Description2` char(35) NOT NULL default '',
  `Amount2` double NOT NULL default '0',
  `Balance2` double NOT NULL default '0',
  `Description3` char(35) NOT NULL default '',
  `Amount3` double NOT NULL default '0',
  `Balance3` double NOT NULL default '0',
  `Description4` char(35) NOT NULL default '',
  `Amount4` double NOT NULL default '0',
  `Balance4` double NOT NULL default '0',
  `Description5` char(35) NOT NULL default '',
  `Amount5` double NOT NULL default '0',
  `Balance5` double NOT NULL default '0',
  `Description6` char(35) NOT NULL default '',
  `Amount6` double NOT NULL default '0',
  `Balance6` double NOT NULL default '0',
  `Description7` char(35) NOT NULL default '',
  `Amount7` double NOT NULL default '0',
  `Balance7` double NOT NULL default '0',
  `Description8` char(35) NOT NULL default '',
  `Amount8` double NOT NULL default '0',
  `Balance8` double NOT NULL default '0',
  `Description9` char(35) NOT NULL default '',
  `Amount9` double NOT NULL default '0',
  `Balance9` double NOT NULL default '0',
  `Description10` char(35) NOT NULL default '',
  `Amount10` double NOT NULL default '0',
  `Balance10` double NOT NULL default '0',
  `Description11` char(35) NOT NULL default '',
  `Amount11` double NOT NULL default '0',
  `Balance11` double NOT NULL default '0',
  `Description12` char(35) NOT NULL default '',
  `Amount12` double NOT NULL default '0',
  `Balance12` double NOT NULL default '0',
  `Description13` char(35) NOT NULL default '',
  `Amount13` double NOT NULL default '0',
  `Balance13` double NOT NULL default '0',
  `Description14` char(35) NOT NULL default '',
  `Amount14` double NOT NULL default '0',
  `Balance14` double NOT NULL default '0',
  `Description15` char(35) NOT NULL default '',
  `Amount15` double NOT NULL default '0',
  `Balance15` double NOT NULL default '0',
  `Description16` char(35) NOT NULL default '',
  `Amount16` double NOT NULL default '0',
  `Balance16` double NOT NULL default '0',
  `Description17` char(35) NOT NULL default '',
  `Amount17` double NOT NULL default '0',
  `Balance17` double NOT NULL default '0',
  `Description18` char(35) NOT NULL default '',
  `Amount18` double NOT NULL default '0',
  `Balance18` double NOT NULL default '0',
  `Description19` char(35) NOT NULL default '',
  `Amount19` double NOT NULL default '0',
  `Balance19` double NOT NULL default '0',
  `Description20` char(35) NOT NULL default '',
  `Amount20` double NOT NULL default '0',
  `Balance20` double NOT NULL default '0',
  `Description21` char(35) NOT NULL default '',
  `Amount21` double NOT NULL default '0',
  `Balance21` double NOT NULL default '0',
  `Description22` char(35) NOT NULL default '',
  `Amount22` double NOT NULL default '0',
  `Balance22` double NOT NULL default '0',
  `Description23` char(35) NOT NULL default '',
  `Amount23` double NOT NULL default '0',
  `Balance23` double NOT NULL default '0',
  `Description24` char(35) NOT NULL default '',
  `Amount24` double NOT NULL default '0',
  `Balance24` double NOT NULL default '0',
  `Description25` char(35) NOT NULL default '',
  `Amount25` double NOT NULL default '0',
  `Balance25` double NOT NULL default '0',
  `Description26` char(35) NOT NULL default '',
  `Amount26` double NOT NULL default '0',
  `Balance26` double NOT NULL default '0',
  `Description27` char(35) NOT NULL default '',
  `Amount27` double NOT NULL default '0',
  `Balance27` double NOT NULL default '0',
  `Description28` char(35) NOT NULL default '',
  `Amount28` double NOT NULL default '0',
  `Balance28` double NOT NULL default '0',
  `Description29` char(35) NOT NULL default '',
  `Amount29` double NOT NULL default '0',
  `Balance29` double NOT NULL default '0',
  `Description30` char(35) NOT NULL default '',
  `Amount30` double NOT NULL default '0',
  `Balance30` double NOT NULL default '0',
  `Description31` char(35) NOT NULL default '',
  `Amount31` double NOT NULL default '0',
  `Balance31` double NOT NULL default '0',
  `Description32` char(35) NOT NULL default '',
  `Amount32` double NOT NULL default '0',
  `Balance32` double NOT NULL default '0',
  `Description33` char(35) NOT NULL default '',
  `Amount33` double NOT NULL default '0',
  `Balance33` double NOT NULL default '0',
  `Description34` char(35) NOT NULL default '',
  `Amount34` double NOT NULL default '0',
  `Balance34` double NOT NULL default '0',
  `Description35` char(35) NOT NULL default '',
  `Amount35` double NOT NULL default '0',
  `Balance35` double NOT NULL default '0',
  `Description36` char(35) NOT NULL default '',
  `Amount36` double NOT NULL default '0',
  `Balance36` double NOT NULL default '0',
  `Description37` char(35) NOT NULL default '',
  `Amount37` double NOT NULL default '0',
  `Balance37` double NOT NULL default '0',
  `Description38` char(35) NOT NULL default '',
  `Amount38` double NOT NULL default '0',
  `Balance38` double NOT NULL default '0',
  `Description39` char(35) NOT NULL default '',
  `Amount39` double NOT NULL default '0',
  `Balance39` double NOT NULL default '0',
  `Description40` char(35) NOT NULL default '',
  `Amount40` double NOT NULL default '0',
  `Balance40` double NOT NULL default '0',
  `Description41` char(35) NOT NULL default '',
  `Amount41` double NOT NULL default '0',
  `Balance41` double NOT NULL default '0',
  `Description42` char(35) NOT NULL default '',
  `Amount42` double NOT NULL default '0',
  `Balance42` double NOT NULL default '0',
  `Description43` char(35) NOT NULL default '',
  `Amount43` double NOT NULL default '0',
  `Balance43` double NOT NULL default '0',
  `Description44` char(35) NOT NULL default '',
  `Amount44` double NOT NULL default '0',
  `Balance44` double NOT NULL default '0',
  `Description45` char(35) NOT NULL default '',
  `Amount45` double NOT NULL default '0',
  `Balance45` double NOT NULL default '0',
  `Description46` char(35) NOT NULL default '',
  `Amount46` double NOT NULL default '0',
  `Balance46` double NOT NULL default '0',
  `Description47` char(35) NOT NULL default '',
  `Amount47` double NOT NULL default '0',
  `Balance47` double NOT NULL default '0',
  `Description48` char(35) NOT NULL default '',
  `Amount48` double NOT NULL default '0',
  `Balance48` double NOT NULL default '0',
  `Description49` char(35) NOT NULL default '',
  `Amount49` double NOT NULL default '0',
  `Balance49` double NOT NULL default '0',
  `Description50` char(35) NOT NULL default '',
  `Amount50` double NOT NULL default '0',
  `Balance50` double NOT NULL default '0',
  `Description51` char(35) NOT NULL default '',
  `Amount51` double NOT NULL default '0',
  `Balance51` double NOT NULL default '0',
  `Description52` char(35) NOT NULL default '',
  `Amount52` double NOT NULL default '0',
  `Balance52` double NOT NULL default '0',
  `Description53` char(35) NOT NULL default '',
  `Amount53` double NOT NULL default '0',
  `Balance53` double NOT NULL default '0',
  `Description54` char(35) NOT NULL default '',
  `Amount54` double NOT NULL default '0',
  `Balance54` double NOT NULL default '0',
  `Description55` char(35) NOT NULL default '',
  `Amount55` double NOT NULL default '0',
  `Balance55` double NOT NULL default '0',
  `Description56` char(35) NOT NULL default '',
  `Amount56` double NOT NULL default '0',
  `Balance56` double NOT NULL default '0',
  `Description57` char(35) NOT NULL default '',
  `Amount57` double NOT NULL default '0',
  `Balance57` double NOT NULL default '0',
  `Description58` char(35) NOT NULL default '',
  `Amount58` double NOT NULL default '0',
  `Balance58` double NOT NULL default '0',
  `Description59` char(35) NOT NULL default '',
  `Amount59` double NOT NULL default '0',
  `Balance59` double NOT NULL default '0',
  `Description60` char(35) NOT NULL default '',
  `Amount60` double NOT NULL default '0',
  `Balance60` double NOT NULL default '0',
  `GrossPay` double NOT NULL default '0',
  `Deductions` double NOT NULL default '0',
  `Designation` char(10) NOT NULL default '',
  `NSSFNo` char(13) NOT NULL default '',
  `NHIFNO` char(13) NOT NULL default '',
  `IDNumber` char(13) NOT NULL default '',
  `PINNumber` char(13) NOT NULL default '',
  `BirthDate` date NOT NULL default '0000-00-00',
  `EmpDate` date default '0000-00-00',
  `JobGroup` char(10) NOT NULL default '',
  `IncrementDate` date default '0000-00-00',
  `revTaxableAmt` double NOT NULL default '0',
  `MPR_Original` double NOT NULL default '0',
  `MPR_Revised` double NOT NULL default '0',
  `BankName` char(25) NOT NULL default '',
  `BankAddr` char(60) NOT NULL default '',
  `AccountNo` char(20) NOT NULL default '',
  `User` char(15) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tmpps_01`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `transactions`
-- 

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `MemberNo` varchar(10) NOT NULL default '',
  `TransCode` varchar(15) NOT NULL default '',
  `Category` char(1) NOT NULL default '',
  `Period` varchar(15) NOT NULL default '',
  `LedgerCode` varchar(13) NOT NULL default '',
  `TransType` varchar(10) NOT NULL default '',
  `Grp` varchar(5) NOT NULL default '',
  `Description` varchar(25) NOT NULL default '',
  `Units` float NOT NULL default '0',
  `Amount` double NOT NULL default '0',
  `Balance` double NOT NULL default '0',
  `Taxed` tinyint(4) NOT NULL default '0',
  `BaseOnAmt` double NOT NULL default '0',
  `ContribAmt` double NOT NULL default '0',
  `TransDate` datetime default NULL,
  `Reference` varchar(15) NOT NULL default '',
  `User` varchar(15) NOT NULL default '',
  `TimeStamp` varchar(15) NOT NULL default '',
  `Posted` tinyint(4) NOT NULL default '0',
  `PensionDed` char(1) NOT NULL default '',
  PRIMARY KEY  (`MemberNo`,`TransCode`,`Category`,`Period`),
  KEY `MemberNo` (`MemberNo`),
  KEY `Period` (`Period`),
  KEY `LedgerCode` (`LedgerCode`),
  KEY `TransCode` (`TransCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `transactions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `useraudit`
-- 

DROP TABLE IF EXISTS `useraudit`;
CREATE TABLE IF NOT EXISTS `useraudit` (
  `UserName` varchar(15) NOT NULL default '',
  `Function` varchar(50) NOT NULL default '',
  `TMStamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `AccNo` varchar(15) NOT NULL default '',
  `ItemCode` varchar(15) NOT NULL default '',
  `OrigValue` varchar(225) NOT NULL default '',
  `NewValue` varchar(225) NOT NULL default '',
  `UserDate` datetime default '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `useraudit`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserName` varchar(15) NOT NULL default '',
  `PassWord` varchar(10) NOT NULL default '',
  `FullName` varchar(50) NOT NULL default '',
  `Category` varchar(15) NOT NULL default '',
  `UserIn` tinyint(4) NOT NULL default '0',
  `TblNo` char(2) NOT NULL default '',
  `UserL` varchar(10) NOT NULL default '',
  `ANo` int(11) NOT NULL default '0',
  `menuitem` varchar(20) NOT NULL default '',
  `mnuDesc` varchar(35) NOT NULL default '',
  `AllowAccess` tinyint(4) NOT NULL default '0',
  `AllowEdit` tinyint(4) NOT NULL default '0',
  `AllowDel` tinyint(4) NOT NULL default '0',
  `mainmenuitem` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`UserName`,`PassWord`,`menuitem`),
  KEY `Category` (`Category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `users`
-- 

