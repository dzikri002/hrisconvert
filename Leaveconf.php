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
 if (isset($_SESSION["username"]))
   $user=$_SESSION["username"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Leave confirmation</title>
<style>
	a, A:link, a:visited, a:active
		{color: #0000aa; text-decoration: none; font-family: Tahoma, Verdana; font-size: 12px}
	A:hover
		{color: #ff0000; text-decoration: none; font-family: Tahoma, Verdana; font-size: 12px}
	p, tr, td, ul, li
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px}
	th
		{background: #DBEAF5; color: #000000;}
	.header1, h1
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 14px; margin: 0px; padding-left: 2px; height: 21px}
	.header2, h2
		{color: #000000; background: #DBEAF5; font-weight: bold; font-family: Tahoma, Verdana; font-size: 12px;}
	.intd
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px; padding-left: 15px;}
	.wcell
		{background: #FFFFFF; vertical-align: top}
	.ctrl
		{font-family: Tahoma, Verdana, sans-serif; font-size: 12px; width: 100%;}
	.btnform
		{border: 0px; font-family: tahoma, verdana; font-size: 12px; background-color: #DBEAF5; width: 100%; height:18px; text-align: center; cursor: hand;}
	.btn
		{background-color: #DBEAF5; padding: 0px;}
	textarea, select,input
		{font: 9px Verdana, arial, helvetica, sans-serif; background-color: #DBEAF5;}
		
	/* classes for validator */
	.tfvHighlight
		{font-weight: bold; color: red;}
	.tfvNormal
		{font-weight: normal;	color: black;}
	.style1 {
	color: #003366;
	font-weight: bold;
	font-size: 14px;
       }
.copysmall {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 12px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copy {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymed {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copylarge {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 15px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymedred {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copyheader {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.copyheaderwhite {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.header7, h7 {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
.copysmalltitle {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
.copysubtitle {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px }
.copyfooter {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #000000; font-size: 13px }
.copydownload {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px }

p {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
p.topmarg { margin-top:12px; margin-bottom:8px; }
p.nobot { margin-top:2px; margin-bottom:0px; }
p.topmargnobot { margin-top:12px; margin-bottom:0px; }
p.nav { color:#FFFFFF; text-align:center; margin-top:8px; margin-bottom:12px; margin-left:3px; margin-right:3px; }
p.foot { font-size:9px; margin-top:3px; margin-bottom:3px; margin-left:3px; margin-right:3px; }

a { color: #003366; text-decoration: none }
a:hover { text-decoration: underline }
a:visited { color: #446185; text-decoration: none }
a:visited:hover { text-decoration: underline }

.copywhite {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 12px }
.copywhiteB {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 12px; font-weight: bold }

/*More Information Link Style */
.copy11 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px }

/* Section Headers Style */
.blueheader {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #446185; font-size: 13px; font-weight: bold }
.whiteheader {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 13px; font-weight: bold }

.topics {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #CCCCCC; font-size: 11px }
.topicsB {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 11px; font-weight: bold }
.topicsH {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 11px}

h2 { font-size:13px; color:#2778CB; margin-left:0px; margin-right:0px; margin-top:3px; margin-bottom:0px; }
.listitem {
    line-height: 15px;
    font-size: 11px;
    font-family: Verdana, Tahoma, Arial, Helvetica;
    font-weight: normal;
	color: #262626;
    margin-top:4px;
    margin-bottom:0px;
    margin-left:0px;
    margin-right:0px
}

.subtitle_body{
    background-image: url(http://172.16.12.3/intranet/images/subtitle_body.gif);
    background-repeat: repeat-x;
    color: #035AA4;
    font-size: 13px;
    font-weight: bold;
}

.subtitle_cap{
    height: 25px;
    width: 12px;
    background : url(http://172.16.12.3/intranet/images/subtitle_cap.gif);
}
.style3 {font-size: 16px}
.style5 {font-size: 11px; font-family: Verdana, Tahoma, Arial, Helvetica; color: #262626; margin-top: 4px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; line-height: 15px;}

</style>
</head>
<body>
<?php
 
  
  //use root for now
  include "includes/functions.php";
    include "includes/config.php";
    require_once "includes/db.php";
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
	 
   
    
   if (!empty($_REQUEST["Name"]))
   {
    	 
	 $_SESSION["name"]=$_REQUEST["Name"];
     $_SESSION["pno"]=$_REQUEST["pno"];
	 $username="'".$_REQUEST["username"]."'";
     
	// $sqlstr="select admin,id from users where username = ".$username;
	// $data=$d->query($sqlstr) or die(mysql_error());
	// $row=mysql_fetch_object($data);
	// $userid=$row->id;
	  
	 echo "<fieldset>";
	 
	 
   /*$sqlstr="select approver,authoriser from intranet_depts where userid_fk=$userid";
   $sqlresult=$d->query($sqlstr);
   $row=$d->fetch_object($sqlresult);
   
   if (empty($sqlresult))
     usermenu();
	 
   if (($row->approver==0) && ($row->authoriser==0))
     usermenu(); 
	 
   if (($row->approver==1) && ($row->authoriser==1))
     authorisermenu();
   
   if (($row->approver==1) && ($row->authoriser==0))
     approvermenu();
   
   if (($row->approver==0) && ($row->authoriser==1))
     authorisermenu();*/
   
   echo "</fieldset>";	   
	 
	 $deptid=$_REQUEST["dept"];
	 $sqlstr="select deptname,heademail from intranet_depts where deptid=$deptid";
	 $data=$d->query($sqlstr) or die(mysql_error());
	 $row=mysql_fetch_object($data);
	 $dept=$row->deptname;
	 $heademail=$row->heademail;
	 
	 $_SESSION["dept"]=$dept;
	 
     $Desigid=$_REQUEST["Desig"];
	
	 $sqlstr="select designame from intranet_desig where desigid=$Desigid";
	 $data=$d->query($sqlstr) or die(mysql_error());
	 $row=mysql_fetch_object($data);
	 $Desig=$row->designame;
	 $_SESSION["Desig"]=$Desig; 
	 
	
	  
	 $_SESSION["daysreq"]=$_REQUEST["daysreq"];
	 $_SESSION["date1"]=$_REQUEST["date1"];
	 $_SESSION["date2"]=$_REQUEST["date2"];
	 
	 $date1=dateconvert($_REQUEST["date1"],1);
	 $date2=dateconvert($_REQUEST["date2"],1);
	 
	 $_SESSION["leaveadress"]=$_REQUEST["leaveadress"];	 
	 
	 $action=$_REQUEST["action"];
	 $leaveid=$_REQUEST["leaveid"];
	 
	 $today=date('Y/m/d h:i:s');
	 $mailbody="This is an automated mail.Do not Reply. Please approve leave application for ". $_SESSION["name"].". You can access http://172.16.12.3/intranet/leaveapprovals.php to Approve";
	 
	 
     if ($action=='add')
	 {
	 if (!isset($insertid))
	 {
	   $sessionid=$_REQUEST["sessionid"];

	   $sqlstr="select * from intranet_leave where sessid='".$sessionid."' and addedby=$username";
	  
	   $data=$d->query($sqlstr);
	   $numrows=$d->numrows($data);
	   
	   
       if ($numrows==0)
	   {
  	     $sqlstr="insert into intranet_leave(fullname,datefrom,dateto,numdays,leaveaddress,pnumber,deptid_fk,desigid_fk,dateapplied,confirmed,addedby,sessid)
         values('$_SESSION[name]','$date1','$date2',$_SESSION[daysreq],'$_SESSION[leaveadress]','$_SESSION[pno]',$deptid,$Desigid,'$today',0,$username,'$sessionid')";
	     $d->query($sqlstr) or die(mysql_error());
	     $insertid=$d->insert_id();
		 
		    // Turn off all error reporting
         error_reporting(0); 
		 sendemail("Leave Application approval from $_SESSION[name]. ".$mailbody,$support_email,$heademail);
	   }
     }
	 }
	else
	{
	  
	   $sqlstr=" update intranet_leave set fullname='$_SESSION[name]',datefrom='$date1',dateto='$date2',numdays=$_SESSION[daysreq],leaveaddress='$_SESSION[leaveadress]',pnumber='$_SESSION[pno]',deptid_fk=$deptid,desigid_fk=$Desigid,confirmed=1,addedby=$username where id=$leaveid ";
	   $d->query($sqlstr) or die(mysql_error());
	   // Turn off all error reporting
       error_reporting(0); 
	   sendemail("Amended Leave Application approval from $_SESSION[name]. ".$mailbody,$support_email,$heademail);
	}
   }
   else
     die("<center><font color=red>You have not yet Logged in.<a href=index.php>Please click here to log in.</a></font><center>");
 


?>

 </p>
<span class="copymed">Your leave details have been submitted for approval.An email has been sent to the Head of DeptName for approval.You will receive an email confirmation when the leave has been approved. Click <a href="http://172.16.12.3/intranet/main.php"> Here </a> to Go back to the Home page
</span>
<? // Report simple running errors
  $_SESSION["username"]=$user; //Bug fix very bad code
  error_reporting(E_ERROR | E_WARNING | E_PARSE); 
  echo "<br><br><br><br><br><br><br><br><br><br><fieldset>";
  include "footer.php";
  echo "</fieldset>";
  ?>
</body>
 
</html>



