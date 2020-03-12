<?
 session_start();
/*
   * e-hris (Electonic-Human Resource Information System v 1.2.0) Is an open source human resource information management system
   * developed to automate all aspects of human resource management, with the dual benefits of reducing the workload of the HR department as well as increasing the efficiency of the department by standardising
   * HR processes for any organization from small-enterprises to large scale organizations.
   * Copyright (C) 2008  David Muturi

   * This program is free software: you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation, either version 3 of the License, or
   * (at your option) any later version.

   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.

   * You should have received a copy of the GNU General Public License
   * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title>HR Settings</title>
	

<style type="text/css">
<!--
.info   { color: black; background-color: transparent; font-weight: normal; }
  .warn   { color: rgb(120,0,0); background-color: transparent; font-weight: normal; }
  .error  { color: red; background-color: transparent; font-weight: bold }
-->
</style>
 <link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>
 <script type="text/javascript" src="css/epoch_classes.js"></script>
 <script type="text/javascript" src="js/formval.js"></script> 
 <script language="JavaScript" src="js/calendar1.js"></script><!--  -->
 <script type="text/Javascript">
 

 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	
    if (!validatePresent(document.forms.adddesignationssfrm.designation,'inf_designation')) errs += 1; 
	   
	if (errs>1)  alert('There are fields which need correction before submitting');
    if (errs==1) alert('There is a field which needs correction before submitting');
	
  return (errs==0);
 }
 
 </script>
 
 
 <style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
 </style>
</head>
<body bgcolor="#FFFFFF">
<? 
  include "includes/functions.php";
  //include "includes/config.php";
  require_once "includes/db.php";
  
  $db_user="webuser"; 
  $db_pass=""; 
  $db_host="localhost";
  $supportdb="mcmpayroll";
  $setupdb="userdbs";

 // $d = new dbC();
 mysql_connect($db_host, $db_user, $db_pass); 
 mysql_select_db($setupdb);
  
  //process post;
  if (!empty($_POST["db"]) && !empty($_POST["newdb"]))
    echo "<center><font face=verdana size=2 color=red><b>Please select an existing database / Enter a new database but not both.</b></font></center>";
  else{
  if (!empty($_POST["db"])) //existing db
  {
    error_reporting(0);
	
    $db=$_POST["db"];
	//run alter + create
	 $sqlstr="USE $db;"; 
	    $sqlstr=$sqlstr." alter ignore table prmember add nationality int default 0;
		alter ignore table prmember add empstatus_fk int default 0;
		alter ignore table prmember add emptitle int default 0;
		alter ignore table prmember add placeofbirth varchar(255) default '';
		alter ignore table prmember add curr_res varchar(255) default '';
		alter ignore table prmember add homeres varchar(255) default '';
		alter ignore table prmember add physical varchar(255) default '';
		alter ignore table prmember add province varchar(255) default '';
		alter ignore table prmember add currdescrip varchar(255) default '';
		alter ignore table prmember add district varchar(255) default '';
		alter ignore table prmember add street varchar(255) default '';
		alter ignore table prmember add division varchar(255) default '';
		alter ignore table prmember add estate varchar(255) default '';
		alter ignore table prmember add location varchar(255) default '';
		alter ignore table prmember add town varchar(255) default '';
		alter ignore table prmember add sublocation varchar(255) default '';
		alter ignore table prmember add postaladdr varchar(255) default '';
		alter ignore table prmember add phonenum varchar(255) default '';
		alter ignore table prmember add unit_fk int default 0;
		alter ignore table prmember add dlnum varchar(30) default '';
		alter ignore table prmember add datedlissued date;
		alter ignore table prmember add position_fk int default 0;
		alter ignore table prmember add dlclasses varchar(30) default '';
		alter ignore table prmember add depart_fk int default 0;
		alter ignore table prmember add bankid_fk int default 0;
		alter ignore table prmember add branchid_fk int default 0;
		alter ignore table prmember add termsid_fk int default 0;
		alter ignore table prmember add effdate date default '0000-00-00';
		alter ignore table prmember add filetype varchar(10) default '';
		alter ignore table prmember add actposition int default 0;
		alter ignore table prmember add actscale varchar(10) default '';
		alter ignore table prmember add acteffdate date default '0000-00-00';
		
		alter ignore table prmember add addedon datetime default '0000-00-00 00:00:00';
		alter ignore table prmember add addedby varchar(255) default '';
		
		alter ignore table prmember add updatedon datetime default '0000-00-00 00:00:00';
		alter ignore table prmember add updatedby varchar(255) default '';
		
		alter ignore table tbl_nextofkin add email varchar(255) default '';
		alter ignore table tbl_nextofkin add mphone varchar(255) default '';
		
		alter ignore table designation add id int not null primary key auto_increment;
		alter ignore table prdept add id int not null auto_increment;";
	
	echo $sqlstr."<br>";
	mysql_query($sqlstr);
	//run create
	$sqlstr="USE `$db`;
		CREATE TABLE IF NOT EXISTS `hrsettings` (
		  `id` int(11) NOT NULL auto_increment,
		  `retirement` int(11) default NULL,
		  `leave` int(11) default NULL,
		  `contract` int(11) default NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			
			
	  CREATE TABLE IF NOT EXISTS `hrusers` (
	  `id` int(11) NOT NULL auto_increment,
	  `username` varchar(255) default NULL,
	  `password` varchar(255) default NULL,
	  `email` varchar(255) default NULL,
	  `isadmin` varchar(1) default NULL,
	  `loggedoff` char(1) default NULL,
	  `loggedofftime` datetime default NULL,
	  PRIMARY KEY  (`id`)
	 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			
	/*Data for the table `hrusers` */
    insert  into `hrusers`(`id`,`username`,`password`,`email`,`isadmin`,`loggedoff`,`loggedofftime`) values (1,'admin','5f4dcc3b5aa765d61d8327deb882cf99','admin@mcm.co.ke','y','1','2008-03-19 01:18:12'),(2,'dmuturi','7b49993fa97555a00841cc95bee6bf70','dmuturi@kilifi.kemri-wellcome.org','y','1','2008-03-19 04:50:50');
			
    CREATE TABLE IF NOT EXISTS `intranet_apps` (
  `id` bigint(20) NOT NULL auto_increment,
  `ApplicationName` varchar(255) default NULL,
    PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
			
  /*Table structure for table `intranet_apps` */
CREATE TABLE IF NOT EXISTS `intranet_apps` (
  `id` bigint(20) NOT NULL auto_increment,
  `ApplicationName` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `intranet_apps` */

insert  into `intranet_apps`(`id`,`ApplicationName`) values (1,'Add/Edit Employee'),(2,'Add/Edit Banks'),(4,'Add/Edit Departments'),(5,'Add/Edit Designations'),(6,'Add/Edit Qualifications'),(7,'Add/Edit Leave Type'),(8,'View Amended Records'),(9,'Totals by Departments'),(10,'Add/Edit Nationality'),(11,'Add/Edit WorkStations'),(12,'Add/Edit Leave Type'),(13,'View Amended Records'),(14,'Totals By Departments'),(15,'Totals By Qualifications'),(16,'Totals By Status'),(17,'Totals By Service types'),(18,'Totals By Leave Types'),(19,'Totals By Designations'),(20,'Total Disciplinary Cases'),(21,'Total by Job Groups'),(22,'Convert Employees List to Excel'),(23,'Dependants Report'),(24,'Next of Kin Report'),(25,'Staff Training Report'),(27,'Staff Retirement Report'),(28,'Staff TurnOver Report'),(29,'Totals By Gender'),(30,'Attached Documents Report'),(32,'Totals By Station'),(33,'New Employees Report'),(34,'Suspended Staff Report'),(35,'Add/Edit HR Settings');


CREATE TABLE IF NOT EXISTS `intranet_leavedays` (
  `id` int(11) NOT NULL auto_increment,
  `userid_fk` int(11) default NULL,
  `entitleddays` int(11) default NULL,
  `takendays` int(11) default NULL,
  `leavebalance` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `intranet_perms` (
  `id` bigint(20) NOT NULL auto_increment,
  `userid_fk` bigint(20) default NULL,
  `applicationid_fk` bigint(20) default NULL,
  `deptid_fk` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

/*Table structure for table `jobgroup` */



CREATE TABLE IF NOT EXISTS `jobgroup` (
  `JobGroup` varchar(20) NOT NULL default '',
  `Description` varchar(35) NOT NULL default '',
  `Lower` double NOT NULL default '0',
  `Upper` double NOT NULL default '0',
  `Increment` varchar(10) default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`JobGroup`),
  UNIQUE KEY `JobGroup` (`JobGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `prstn` (
  `StationCode` varchar(10) NOT NULL default '',
  `StationName` varchar(30) default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  `Suspended` tinyint(4) NOT NULL default '0',
  `stationhead` int(11) default NULL,
  PRIMARY KEY  (`StationCode`),
  KEY `STN_CODE` (`StationCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prstn` */

insert  into `prstn`(`StationCode`,`StationName`,`TransDate`,`Suspended`,`stationhead`) values ('001','','0000-00-00 00:00:00',0,NULL),('01','','0000-00-00 00:00:00',0,NULL),('02','','0000-00-00 00:00:00',0,NULL),('03','','0000-00-00 00:00:00',0,NULL),('04','','0000-00-00 00:00:00',0,NULL),('05','','0000-00-00 00:00:00',0,NULL),('06','','0000-00-00 00:00:00',0,NULL),('07','','0000-00-00 00:00:00',0,NULL),('08','','0000-00-00 00:00:00',0,NULL),('09','','0000-00-00 00:00:00',0,NULL),('10','','0000-00-00 00:00:00',0,NULL),('11','','0000-00-00 00:00:00',0,NULL),('12','','0000-00-00 00:00:00',0,NULL),('13','','0000-00-00 00:00:00',0,NULL),('14','','0000-00-00 00:00:00',0,NULL),('15','','0000-00-00 00:00:00',0,NULL),('16','','0000-00-00 00:00:00',0,NULL),('17','','0000-00-00 00:00:00',0,NULL),('19','','0000-00-00 00:00:00',0,NULL),('20','','0000-00-00 00:00:00',0,NULL),('21','','0000-00-00 00:00:00',0,NULL),('31','','0000-00-00 00:00:00',0,NULL),('51','','0000-00-00 00:00:00',0,NULL);

/*Table structure for table `support_users` */


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `support_users` */

/*Table structure for table `tbl_appointments1` */


CREATE TABLE IF NOT EXISTS IF NOT EXISTS `tbl_appointments1` (
  `id` int(11) NOT NULL auto_increment,
  `appointment` varchar(255) default NULL,
  `appyear` int(11) default NULL,
  `institute` varchar(255) default NULL,
  `empid_fk` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_appointments1` */

/*Table structure for table `tbl_appraisals` */



CREATE TABLE IF NOT EXISTS `tbl_appraisals` (
  `id` int(11) NOT NULL auto_increment,
  `result_fk` int(11) default NULL,
  `empid_fk` int(11) default NULL,
  `appdate` date default NULL,
  `appcomments` varchar(255) default NULL,
  `appraiser` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_appresults` (
  `id` int(11) NOT NULL auto_increment,
  `appresult` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_banks1` (
  `id` int(11) NOT NULL auto_increment,
  `bankname` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_banks1` */

/*Table structure for table `tbl_branches1` */



CREATE TABLE IF NOT EXISTS `tbl_branches1` (
  `id` int(11) NOT NULL auto_increment,
  `branchname` varchar(255) NOT NULL default '',
  `bankid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_countries1` (
  `id` int(11) NOT NULL auto_increment,
  `countryname` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_countries1` */

insert  into `tbl_countries1`(`id`,`countryname`) values (1,'Kenyan'),(2,'Tanzanian'),(3,'Ugandan'),(4,'American'),(5,'British'),(6,'German');



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
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;




CREATE TABLE IF NOT EXISTS `tbl_departments1` (
  `id` int(11) NOT NULL auto_increment,
  `department` varchar(255) default NULL,
  `depcat` varchar(255) default NULL,
  `depthead` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_departments1` */



CREATE TABLE IF NOT EXISTS `tbl_dependants1` (
  `id` int(11) NOT NULL auto_increment,
  `mname` varchar(50) default NULL,
  `fname` varchar(100) NOT NULL default '',
  `lname` varchar(100) NOT NULL default '',
  `gender` char(1) NOT NULL default '',
  `dob` date NOT NULL default '0000-00-00',
  `empid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_discipaction` (
  `id` int(11) NOT NULL auto_increment,
  `action_name` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
insert  into `tbl_discipaction`(`id`,`action_name`) values (1,'Verbal Warning'),(2,'Warning Letter'),(3,'Suspension'),(4,'Termination');


CREATE TABLE IF NOT EXISTS `tbl_disciplinary` (
  `id` int(11) NOT NULL auto_increment,
  `dispdate` date default NULL,
  `reasons` longtext,
  `empid_fk` int(11) default NULL,
  `action` int(11) default NULL,
  `months` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_documents1` (
  `id` int(11) NOT NULL auto_increment,
  `filedesc` varchar(255) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `filetype` varchar(50) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  `data` longblob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_empstatus` (
  `id` tinyint(4) NOT NULL auto_increment,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

insert  into `tbl_empstatus`(`id`,`status`) values (1,'Active'),(2,'Resigned'),(3,'Retired'),(4,'Terminated'),(5,'Transferred');


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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 1';


CREATE TABLE IF NOT EXISTS `tbl_leavetypes` (
  `id` int(11) NOT NULL auto_increment,
  `leavetype` varchar(25) default NULL,
  `totaldays` int(11) default NULL,
  `jobgrpfrom` varchar(10) default NULL,
  `jobgrpto` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `tbl_maritalstatus` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_maritalstatus` */

insert  into `tbl_maritalstatus`(`id`,`description`) values (1,'Single'),(2,'Married'),(3,'Divorced'),(4,'Widowed');			


CREATE TABLE IF NOT EXISTS `tbl_months` (
  `id` tinyint(4) NOT NULL auto_increment,
  `monthname` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_months` */

insert  into `tbl_months`(`id`,`monthname`) values (1,'Jan'),(2,'Feb'),(3,'Mar'),(4,'Apr'),(5,'May'),(6,'June'),(7,'Jul'),(8,'Aug'),(9,'Sep'),(10,'Oct'),(11,'Nov'),(12,'Dec');		


CREATE TABLE IF NOT EXISTS `tbl_nextofkin` (
  `id` tinyint(4) NOT NULL auto_increment,
  `fname` varchar(100) default NULL,
  `mname` varchar(100) default NULL,
  `lname` varchar(100) default NULL,
  `address` varchar(100) default NULL,
  `relationship` varchar(100) default NULL,
  `empid_fk` int(4) NOT NULL default '0',
  `mphone` varchar(255) default '',
  `email` varchar(255) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';


CREATE TABLE IF NOT EXISTS `tbl_positions` (
  `id` tinyint(4) NOT NULL auto_increment,
  `position_name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';


CREATE TABLE IF NOT EXISTS `tbl_promotions` (
  `id` int(11) NOT NULL auto_increment,
  `desigid_fk` int(11) NOT NULL default '0',
  `empid_fk` int(11) NOT NULL default '0',
  `scale` varchar(5) NOT NULL default '',
  `promdate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';


CREATE TABLE IF NOT EXISTS `tbl_publications` (
  `id` int(11) NOT NULL auto_increment,
  `pyear` int(11) NOT NULL default '0',
  `journal` varchar(255) NOT NULL default '',
  `ptitle` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 458752 kB; InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_qlevels` (
  `id` int(11) NOT NULL auto_increment,
  `qlevel` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_qualifications` (
  `id` int(11) NOT NULL auto_increment,
  `qualname` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  `yearfrom` int(11) NOT NULL default '0',
  `yearto` int(11) NOT NULL default '0',
  `institution` varchar(50) NOT NULL default '',
  `qlevel` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';

CREATE TABLE IF NOT EXISTS `tbl_terms` (
  `id` int(11) NOT NULL auto_increment,
  `terms` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
insert  into `tbl_terms`(`id`,`terms`) values (1,'Contract'),(2,'Permanent'),(3,'Locum'),(4,'Intern'),(5,'Temporary');
CREATE TABLE IF NOT EXISTS `tbl_titles` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';
insert  into `tbl_titles`(`id`,`title`) values (7,'Mr'),(8,'Mrs'),(9,'Miss'),(10,'Prof'),(11,'Dr.'),(12,'Hon.');



CREATE TABLE IF NOT EXISTS `tbl_training` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` int(11) default NULL,
  `course` varchar(255) default NULL,
  `trainerid` int(11) default NULL,
  `trainer` char(45) default NULL,
  `trainingdate` date default NULL,
  `trainingsdate` date default NULL,
  `compechieved` int(11) default NULL,
  `comments` text,
  `institution` char(255) default NULL,
  `qlevel` char(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `tbl_units` (
  `id` int(11) NOT NULL auto_increment,
  `unit_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_units` */

insert  into `tbl_units`(`id`,`unit_name`) values (1,'MCM-Mombasa');


CREATE TABLE IF NOT EXISTS `tbl_years` (
  `yearlabel` int(4) NOT NULL default '0',
  PRIMARY KEY  (`yearlabel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';

/*Data for the table `tbl_years` */

insert  into `tbl_years`(`yearlabel`) values (1950),(1951),(1952),(1953),(1954),(1955),(1956),(1957),(1958),(1959),(1960),(1961),(1962),(1963),(1964),(1965),(1966),(1967),(1968),(1969),(1970),(1971),(1972),(1973),(1974),(1975),(1976),(1977),(1978),(1979),(1980),(1981),(1982),(1983),(1984),(1985),(1986),(1987),(1988),(1989),(1990),(1991),(1992),(1993),(1994),(1995),(1996),(1997),(1998),(1999),(2000),(2001),(2002),(2003),(2004),(2005),(2006),(2007),(2008),(2009),(2010),(2011),(2012),(2013),(2014),(2015);";
	
	echo $sqlstr;
	
	mysql_query($sqlstr);
	
	//update fsdb
    $sqlstr="update fsdb set otherapp='HR' where dbname='$db'";
	mysql_query($sqlstr);
	echo "<meta http-equiv='refresh' content='1;url=index.php'>";
	
  }
  else if (!empty($_POST["newdb"])) //new db
  {
    $today=date('Y-m-d h:m:s');
    $newdb=$_POST["newdb"];
	$sqlstr="create database if not exists `$newdb`; 
	USE `$newdb`;
	CREATE TABLE IF NOT EXISTS `prmember` (
  `MemberNo` varchar(10) NOT NULL default '',
  `LastName` varchar(15) default NULL,
  `OtherNames` varchar(30) default NULL,
  `FullName` varchar(60) default NULL,
  `Designation` varchar(10) default NULL,
  `DesigDesc` varchar(25) default NULL,
  `JobGroup` varchar(10) default NULL,
  `Sex` varchar(7) default NULL,
  `MaritalStatus` varchar(11) default NULL,
  `NSSFNo` varchar(13) default NULL,
  `NHIFNO` varchar(13) default NULL,
  `IDNumber` varchar(13) default NULL,
  `PINNumber` varchar(13) default NULL,
  `BirthDate` datetime default '0000-00-00 00:00:00',
  `EmpDate` datetime default '0000-00-00 00:00:00',
  `Photo` longblob,
  `QuitDate` datetime default '0000-00-00 00:00:00',
  `EndPrd` varchar(10) default NULL,
  `M_days_Hrs` float NOT NULL default '0',
  `Hr_PayRate` float NOT NULL default '0',
  `PhotoPath` varchar(50) default NULL,
  `Sign` blob,
  `Reference` varchar(20) default NULL,
  `AnnIncrement` double default NULL,
  `IncrementDate` datetime default '0000-00-00 00:00:00',
  `IncrMonth` int(3) NOT NULL default '0',
  `MaxSalary` double NOT NULL default '0',
  `MPR_Original` double NOT NULL default '0',
  `MPR_Revised` double NOT NULL default '0',
  `MPR_CF` double NOT NULL default '0',
  `MPR_OrigDate` date default '0000-00-00',
  `MPR_RevDate` date default '0000-00-00',
  `Station` varchar(10) default NULL,
  `StationDesc` varchar(25) default NULL,
  `Dept` varchar(10) default NULL,
  `DeptDesc` varchar(25) default NULL,
  `BankCode` varchar(10) default NULL,
  `BankName` varchar(45) default NULL,
  `AccountNo` varchar(20) default NULL,
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
  `PrevEmpName` varchar(30) default NULL,
  `PrevEmpAddress` varchar(30) default NULL,
  `NewEmpName` varchar(30) default NULL,
  `NewEmpAddr` varchar(30) default NULL,
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
  `PayFor` varchar(20) default NULL,
  `Period` varchar(10) default NULL,
  `TimeStamp` varchar(20) default NULL,
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
  `filetype` varchar(10) default '',
  `actposition` int(11) default '0',
  `actscale` varchar(10) default '',
  `acteffdate` date default '0000-00-00',
  `addedon` datetime default '0000-00-00 00:00:00',
  `addedby` varchar(255) default '',
  `updatedon` datetime default '0000-00-00 00:00:00',
  `updatedby` varchar(255) default '',
  PRIMARY KEY  (`MemberNo`),
  KEY `Station` (`Station`),
  KEY `Designation` (`Designation`),
  KEY `ID_NO` (`IDNumber`),
  KEY `MBNO` (`MemberNo`),
  KEY `BankCode` (`BankCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 82944 kB; InnoDB free: 82944 kB; InnoDB free: 8';

	
		CREATE TABLE IF NOT EXISTS `hrsettings` (
		  `id` int(11) NOT NULL auto_increment,
		  `retirement` int(11) default NULL,
		  `leave` int(11) default NULL,
		  `contract` int(11) default NULL,
		  PRIMARY KEY  (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			
			
	  CREATE TABLE IF NOT EXISTS `hrusers` (
	  `id` int(11) NOT NULL auto_increment,
	  `username` varchar(255) default NULL,
	  `password` varchar(255) default NULL,
	  `email` varchar(255) default NULL,
	  `isadmin` varchar(1) default NULL,
	  `loggedoff` char(1) default NULL,
	  `loggedofftime` datetime default NULL,
	  PRIMARY KEY  (`id`)
	 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			
	/*Data for the table `hrusers` */
    insert  into `hrusers`(`id`,`username`,`password`,`email`,`isadmin`,`loggedoff`,`loggedofftime`) values (1,'admin','5f4dcc3b5aa765d61d8327deb882cf99','admin@mcm.co.ke','y','1','2008-03-19 01:18:12'),(2,'dmuturi','7b49993fa97555a00841cc95bee6bf70','dmuturi@kilifi.kemri-wellcome.org','y','1','2008-03-19 04:50:50');
			
    CREATE TABLE IF NOT EXISTS `intranet_apps` (
  `id` bigint(20) NOT NULL auto_increment,
  `ApplicationName` varchar(255) default NULL,
    PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
			
  /*Table structure for table `intranet_apps` */
CREATE TABLE IF NOT EXISTS `intranet_apps` (
  `id` bigint(20) NOT NULL auto_increment,
  `ApplicationName` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `intranet_apps` */

insert  into `intranet_apps`(`id`,`ApplicationName`) values (1,'Add/Edit Employee'),(2,'Add/Edit Banks'),(4,'Add/Edit Departments'),(5,'Add/Edit Designations'),(6,'Add/Edit Qualifications'),(7,'Add/Edit Leave Type'),(8,'View Amended Records'),(9,'Totals by Departments'),(10,'Add/Edit Nationality'),(11,'Add/Edit WorkStations'),(12,'Add/Edit Leave Type'),(13,'View Amended Records'),(14,'Totals By Departments'),(15,'Totals By Qualifications'),(16,'Totals By Status'),(17,'Totals By Service types'),(18,'Totals By Leave Types'),(19,'Totals By Designations'),(20,'Total Disciplinary Cases'),(21,'Total by Job Groups'),(22,'Convert Employees List to Excel'),(23,'Dependants Report'),(24,'Next of Kin Report'),(25,'Staff Training Report'),(27,'Staff Retirement Report'),(28,'Staff TurnOver Report'),(29,'Totals By Gender'),(30,'Attached Documents Report'),(32,'Totals By Station'),(33,'New Employees Report'),(34,'Suspended Staff Report'),(35,'Add/Edit HR Settings');


CREATE TABLE IF NOT EXISTS `intranet_leavedays` (
  `id` int(11) NOT NULL auto_increment,
  `userid_fk` int(11) default NULL,
  `entitleddays` int(11) default NULL,
  `takendays` int(11) default NULL,
  `leavebalance` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `intranet_perms` (
  `id` bigint(20) NOT NULL auto_increment,
  `userid_fk` bigint(20) default NULL,
  `applicationid_fk` bigint(20) default NULL,
  `deptid_fk` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

/*Table structure for table `jobgroup` */



CREATE TABLE IF NOT EXISTS `jobgroup` (
  `JobGroup` varchar(20) NOT NULL default '',
  `Description` varchar(35) NOT NULL default '',
  `Lower` double NOT NULL default '0',
  `Upper` double NOT NULL default '0',
  `Increment` varchar(10) default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`JobGroup`),
  UNIQUE KEY `JobGroup` (`JobGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `prstn` (
  `StationCode` varchar(10) NOT NULL default '',
  `StationName` varchar(30) default '',
  `TransDate` datetime default '0000-00-00 00:00:00',
  `Suspended` tinyint(4) NOT NULL default '0',
  `stationhead` int(11) default NULL,
  PRIMARY KEY  (`StationCode`),
  KEY `STN_CODE` (`StationCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prstn` */

insert  into `prstn`(`StationCode`,`StationName`,`TransDate`,`Suspended`,`stationhead`) values ('001','','0000-00-00 00:00:00',0,NULL),('01','','0000-00-00 00:00:00',0,NULL),('02','','0000-00-00 00:00:00',0,NULL),('03','','0000-00-00 00:00:00',0,NULL),('04','','0000-00-00 00:00:00',0,NULL),('05','','0000-00-00 00:00:00',0,NULL),('06','','0000-00-00 00:00:00',0,NULL),('07','','0000-00-00 00:00:00',0,NULL),('08','','0000-00-00 00:00:00',0,NULL),('09','','0000-00-00 00:00:00',0,NULL),('10','','0000-00-00 00:00:00',0,NULL),('11','','0000-00-00 00:00:00',0,NULL),('12','','0000-00-00 00:00:00',0,NULL),('13','','0000-00-00 00:00:00',0,NULL),('14','','0000-00-00 00:00:00',0,NULL),('15','','0000-00-00 00:00:00',0,NULL),('16','','0000-00-00 00:00:00',0,NULL),('17','','0000-00-00 00:00:00',0,NULL),('19','','0000-00-00 00:00:00',0,NULL),('20','','0000-00-00 00:00:00',0,NULL),('21','','0000-00-00 00:00:00',0,NULL),('31','','0000-00-00 00:00:00',0,NULL),('51','','0000-00-00 00:00:00',0,NULL);

/*Table structure for table `support_users` */


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `support_users` */

/*Table structure for table `tbl_appointments1` */


CREATE TABLE IF NOT EXISTS IF NOT EXISTS `tbl_appointments1` (
  `id` int(11) NOT NULL auto_increment,
  `appointment` varchar(255) default NULL,
  `appyear` int(11) default NULL,
  `institute` varchar(255) default NULL,
  `empid_fk` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_appointments1` */

/*Table structure for table `tbl_appraisals` */



CREATE TABLE IF NOT EXISTS `tbl_appraisals` (
  `id` int(11) NOT NULL auto_increment,
  `result_fk` int(11) default NULL,
  `empid_fk` int(11) default NULL,
  `appdate` date default NULL,
  `appcomments` varchar(255) default NULL,
  `appraiser` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_appresults` (
  `id` int(11) NOT NULL auto_increment,
  `appresult` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_banks1` (
  `id` int(11) NOT NULL auto_increment,
  `bankname` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_banks1` */

/*Table structure for table `tbl_branches1` */



CREATE TABLE IF NOT EXISTS `tbl_branches1` (
  `id` int(11) NOT NULL auto_increment,
  `branchname` varchar(255) NOT NULL default '',
  `bankid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_countries1` (
  `id` int(11) NOT NULL auto_increment,
  `countryname` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_countries1` */

insert  into `tbl_countries1`(`id`,`countryname`) values (1,'Kenyan'),(2,'Tanzanian'),(3,'Ugandan'),(4,'American'),(5,'British'),(6,'German');



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
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;




CREATE TABLE IF NOT EXISTS `tbl_departments1` (
  `id` int(11) NOT NULL auto_increment,
  `department` varchar(255) default NULL,
  `depcat` varchar(255) default NULL,
  `depthead` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_departments1` */



CREATE TABLE IF NOT EXISTS `tbl_dependants1` (
  `id` int(11) NOT NULL auto_increment,
  `mname` varchar(50) default NULL,
  `fname` varchar(100) NOT NULL default '',
  `lname` varchar(100) NOT NULL default '',
  `gender` char(1) NOT NULL default '',
  `dob` date NOT NULL default '0000-00-00',
  `empid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_discipaction` (
  `id` int(11) NOT NULL auto_increment,
  `action_name` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
insert  into `tbl_discipaction`(`id`,`action_name`) values (1,'Verbal Warning'),(2,'Warning Letter'),(3,'Suspension'),(4,'Termination');


CREATE TABLE IF NOT EXISTS `tbl_disciplinary` (
  `id` int(11) NOT NULL auto_increment,
  `dispdate` date default NULL,
  `reasons` longtext,
  `empid_fk` int(11) default NULL,
  `action` int(11) default NULL,
  `months` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_documents1` (
  `id` int(11) NOT NULL auto_increment,
  `filedesc` varchar(255) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `filetype` varchar(50) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  `data` longblob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_empstatus` (
  `id` tinyint(4) NOT NULL auto_increment,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

insert  into `tbl_empstatus`(`id`,`status`) values (1,'Active'),(2,'Resigned'),(3,'Retired'),(4,'Terminated'),(5,'Transferred');


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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 1';


CREATE TABLE IF NOT EXISTS `tbl_leavetypes` (
  `id` int(11) NOT NULL auto_increment,
  `leavetype` varchar(25) default NULL,
  `totaldays` int(11) default NULL,
  `jobgrpfrom` varchar(10) default NULL,
  `jobgrpto` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `tbl_maritalstatus` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_maritalstatus` */

insert  into `tbl_maritalstatus`(`id`,`description`) values (1,'Single'),(2,'Married'),(3,'Divorced'),(4,'Widowed');			


CREATE TABLE IF NOT EXISTS `tbl_months` (
  `id` tinyint(4) NOT NULL auto_increment,
  `monthname` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_months` */

insert  into `tbl_months`(`id`,`monthname`) values (1,'Jan'),(2,'Feb'),(3,'Mar'),(4,'Apr'),(5,'May'),(6,'June'),(7,'Jul'),(8,'Aug'),(9,'Sep'),(10,'Oct'),(11,'Nov'),(12,'Dec');		


CREATE TABLE IF NOT EXISTS `tbl_nextofkin` (
  `id` tinyint(4) NOT NULL auto_increment,
  `fname` varchar(100) default NULL,
  `mname` varchar(100) default NULL,
  `lname` varchar(100) default NULL,
  `address` varchar(100) default NULL,
  `relationship` varchar(100) default NULL,
  `empid_fk` int(4) NOT NULL default '0',
  `mphone` varchar(255) default '',
  `email` varchar(255) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';


CREATE TABLE IF NOT EXISTS `tbl_positions` (
  `id` tinyint(4) NOT NULL auto_increment,
  `position_name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';


CREATE TABLE IF NOT EXISTS `tbl_promotions` (
  `id` int(11) NOT NULL auto_increment,
  `desigid_fk` int(11) NOT NULL default '0',
  `empid_fk` int(11) NOT NULL default '0',
  `scale` varchar(5) NOT NULL default '',
  `promdate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';


CREATE TABLE IF NOT EXISTS `tbl_publications` (
  `id` int(11) NOT NULL auto_increment,
  `pyear` int(11) NOT NULL default '0',
  `journal` varchar(255) NOT NULL default '',
  `ptitle` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 458752 kB; InnoDB free: 459776 kB';



CREATE TABLE IF NOT EXISTS `tbl_qlevels` (
  `id` int(11) NOT NULL auto_increment,
  `qlevel` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tbl_qualifications` (
  `id` int(11) NOT NULL auto_increment,
  `qualname` varchar(255) NOT NULL default '',
  `empid_fk` int(11) NOT NULL default '0',
  `yearfrom` int(11) NOT NULL default '0',
  `yearto` int(11) NOT NULL default '0',
  `institution` varchar(50) NOT NULL default '',
  `qlevel` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';

CREATE TABLE IF NOT EXISTS `tbl_terms` (
  `id` int(11) NOT NULL auto_increment,
  `terms` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
insert  into `tbl_terms`(`id`,`terms`) values (1,'Contract'),(2,'Permanent'),(3,'Locum'),(4,'Intern'),(5,'Temporary');
CREATE TABLE IF NOT EXISTS `tbl_titles` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';
insert  into `tbl_titles`(`id`,`title`) values (7,'Mr'),(8,'Mrs'),(9,'Miss'),(10,'Prof'),(11,'Dr.'),(12,'Hon.');



CREATE TABLE IF NOT EXISTS `tbl_training` (
  `id` int(11) NOT NULL auto_increment,
  `employeeid` int(11) default NULL,
  `course` varchar(255) default NULL,
  `trainerid` int(11) default NULL,
  `trainer` char(45) default NULL,
  `trainingdate` date default NULL,
  `trainingsdate` date default NULL,
  `compechieved` int(11) default NULL,
  `comments` text,
  `institution` char(255) default NULL,
  `qlevel` char(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `tbl_units` (
  `id` int(11) NOT NULL auto_increment,
  `unit_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB';

/*Data for the table `tbl_units` */

insert  into `tbl_units`(`id`,`unit_name`) values (1,'MCM-Mombasa');


CREATE TABLE IF NOT EXISTS `tbl_years` (
  `yearlabel` int(4) NOT NULL default '0',
  PRIMARY KEY  (`yearlabel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 459776 kB; InnoDB free: 459776 kB';

/*Data for the table `tbl_years` */

insert  into `tbl_years`(`yearlabel`) values (1950),(1951),(1952),(1953),(1954),(1955),(1956),(1957),(1958),(1959),(1960),(1961),(1962),(1963),(1964),(1965),(1966),(1967),(1968),(1969),(1970),(1971),(1972),(1973),(1974),(1975),(1976),(1977),(1978),(1979),(1980),(1981),(1982),(1983),(1984),(1985),(1986),(1987),(1988),(1989),(1990),(1991),(1992),(1993),(1994),(1995),(1996),(1997),(1998),(1999),(2000),(2001),(2002),(2003),(2004),(2005),(2006),(2007),(2008),(2009),(2010),(2011),(2012),(2013),(2014),(2015);";
	
	echo $sqlstr;
	
	$result=mysql_query($sqlstr);
	
	if (!result)
	  echo "<b>Error during setup</b>";
    else
	{
	
	$sqlstr="insert into fsdb(dbname,application,transdate,otherapp) values('$newdb','Hrmis','$today','HR')";
	
	$result=mysql_query($sqlstr);
	//refresh
	if (!result)
	  echo "<b>Error during setup</b>";
    else
	// echo "<meta http-equiv='refresh' content='1;url=index.php'>";
   }
  }
   }
  // error_reporting(E^ALL);
 ?>
 <br><br>
<table width="50%" cellpadding="0" cellspacing="0"  id="main" align="center">
  <tr>
    <td id="cell_top"><div align="center"><span class="style1">Foresight HRMIS setup </span></div></td>
  </tr>

  <tr>
    <td >    &nbsp;&nbsp;</td>

  </tr>

  <tr>
    <td width="100%"  bgcolor="#FFFFFF" >
	
<form name="hrsetupfrm" method="post" action="hrsetup.php">
 <?
	    
		 $sqlstr="select * from fsdb";
         $sqlresult=mysql_query($sqlstr) or die(mysql_error());
         $numrows=mysql_num_rows($sqlresult);		 

 if ($numrows>0){	 
	 
  echo "<table width=\"100%\"  border=\"0\">
      <tr>
        <th width=\"2%\">Database</th>
        <th width=\"3%\">Select Database To Use</th>
      </tr>";
   
   
	  
   while ($row=mysql_fetch_object($sqlresult))
   {
     $count++;
     echo "<tr>";
	 echo "<td>$row->DbName</td>";
	
	 echo "<td><input type=\"radio\" name=\"db\" value=\"$row->DbName\" OnClick=\"Checknewdbvalue(this.value)\"></td>";
	 echo "</tr>";
	 
   }
     echo "<tr>";
	 echo "<td>Or Enter a New Database Name and Submit</td>";
	 echo "<td><input name=\"newdb\" type=\"text\"  id=\"newdb\" OnChange=\"Checkdbvalue(this.value)\" value=$newdb></td>";
	 echo "</tr>";
   echo "</table>";
}
else{
  echo "<table> <tr>";
  echo "<td>Or Enter a New Database Name and Submit</td>";
  echo "<td><input name=\"newdb\" type=\"text\"  id=\"newdb\" value=$newdb></td>";
  echo "</tr></table>";
}	 

  mysql_close();
?>
 <div align="right"><input type="submit" name="Submit" value="Submit"></div>
</form>    
    </td>
  </tr>
  <tr>
    <td  bgcolor=\"#FFFFFF\" ></td>
  </tr>
  <tr>
    <td  bgcolor=\"#FFFFFF\" >&nbsp;</td>
  </tr>
</table>
<script language="javascript">
 function Checknewdbvalue(val)
   { 
     if (val!="")
	   document.hrsetupfrm.newdb.value="";
	   
	 
   }
   function Checkdbvalue(val)
   { 
     if (val!=""){
	  
	   document.hrsetupfrm.db.value="";
	   document.hrsetupfrm.db.checked=false;
	   
	 }
	   
	 
   }
</script>
</body>

</html>



