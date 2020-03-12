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
$s_id=session_id();
header("Pragma: no-cache");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Online Leave Application</title>
<style>
	a, A:link, a:visited, a:active
		{color: #0000aa; text-decoration: none; font-family: Tahoma, Verdana; font-size: 12px}
	A:hover
		{color: #ff0000; text-decoration: none; font-family: Tahoma, Verdana; font-size: 12px}
	p, tr, td, ul, li
		{color: #000000; font-family: Tahoma, Verdana; font-size: 10px}
	th
		{background: #DBEAF5; color: #000000;}
	.header1, h1
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 13px; margin: 0px; padding-left: 2px; height: 21px}
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
	font-family: Verdana;
	font-weight: bold;
}
</style>
 <link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>
 <script type="text/javascript" src="css/epoch_classes.js"></script>
<script language="JavaScript" src="calendar1.js"></script><!--  -->
<script language="JavaScript" src="validator.js"></script>
 <script type="text/javascript">
var dp_cal,dob_cal     
     window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));
	}
</script>
	
</head>
<body>
<?php //include "headerlogo.php";
    include "includes/functions.php";
    include "includes/config.php";
    require_once "includes/db.php";
    
	 $d = new dbC();
	 $d->connect($db_host, $db_user, $db_pass, $supportdb); 
  
	// $d->connect($db_host, $db_username, $db_password, $db); 				  
?>
 <fieldset><?php 
 //put cookies/session variables to check for admin
 
 if (!empty($_SESSION["username"]))
 {
   $username=$_SESSION["username"];

   
   $sqlstr="select * from support_users where username='".$username."'";
   $action="add";
   $data=$d->query($sqlstr);
   $row=$d->fetch_object($data);
   $fullname="'".$row->name."'"; 
   $userid=$row->id;
   $user=$_SESSION["username"];
   $isadmin=$row->admin;
   
   
/*   $sqlstr="select approver,authoriser from intranet_depts where userid_fk=$userid";
   $sqlresult=$d->query($sqlstr);
   $row=$d->fetch_object($sqlresult);
  
   $numrows = $d->numrows($sqlresult);
  
   if ($numrows==0)
     usermenu();
	
   if (isset($row->approver) && isset($row->authoriser))
   {	 
   if (($row->approver==0) && ($row->authoriser==0))
     usermenu(); 
	 
   if (($row->approver==1) && ($row->authoriser==1))
     authorisermenu();
   
   if (($row->approver==1) && ($row->authoriser==0))
     approvermenu();
   
   if (($row->approver==0) && ($row->authoriser==1))
     authorisermenu();
   }*/
   echo "<a href=\"index.php\">Home</a>";
   echo "</fieldset>";
   
   $d->close();
   $d->connect($db_host, $db_user, $db_pass, $db);    
   
   if (!isset($_REQUEST["action"]))
   {
     $sqlstr="select * from intranet_leave where addedby='$user' and approved is null";
     $data=$d->query($sqlstr);
     if ($d->numrows($data) >= 1)
     {
     echo "<p>You have unapproved leave applications. Please confirm by clicking on <a href=leaveidv.php> leave requests </a>to avoid duplicate Requests.</p> ";
     }
	 
   }
   else
   {
     $action=$_REQUEST["action"];
	 
     $sqlstr="Select intranet_leave.id,intranet_leave.dateto,intranet_leave.numdays,intranet_leave.pnumber,intranet_leave.confirmed,
     intranet_leave.addedby,intranet_leave.dateadded,intranet_leave.sessid,intranet_leave.datefrom,intranet_leave.approved,intranet_desig.DESIGNAME,
     intranet_depts.deptname,desigid_fk,deptid_fk,intranet_leave.leaveaddress from intranet_leave inner Join intranet_desig on intranet_desig.desigid=desigid_fk
     Inner Join intranet_depts on intranet_depts.deptid=deptid_fk where id=$_REQUEST[id]";
	 
	 $data=$d->query($sqlstr);
	 
	 if ($data)
	 {
	   $row=$d->fetch_object($data);
	   $leaveid=$row->id;
	   $pnum=$row->pnumber;
	   $deptid=$row->deptid_fk;
	   $desigid=$row->desigid_fk;
	   $numdays=$row->numdays;
	   $datefrom=substr($row->datefrom,0,10);
	   $dateto=substr($row->dateto,0,10);
	
       $datefrom=str_replace("/","-",dateconvert($datefrom,2));
	   $dateto=str_replace("/","-",dateconvert($dateto,2));
	   
	   $leaveaddress=$row->leaveaddress;
	 }
   }
 } 
 else
     die("<center><font color=red>You have not yet Logged in.<a href=index.php>Please click here to log in.</a></font><center>");
 
 
   //$d->close();
//$d->connect($db_host, $db_user, $db_pass, $db); 

  ?> 

	<table cellpadding="3" cellspacing="1" border="0" width="100%">
	<tr>
		<td class="intd"><br>
<!-- Form -->
<form action="leaveconf.php" method="POST" name="registration" onsubmit="return v.exec()">
<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
<tr>
	<td bgcolor="#4682B4" width="10"><img src="img/pixel.gif" width="10" height="8" border="0"></td>
	<td class="header9" nowrap>Leave Application<img src="img/pixel.gif" width="10" height="1" border="0"></td>
	<td><img src="img/formtab_r.gif" width="10" height="21" border="0"></td>
	<td background="img/line_t.gif" width="100%">&nbsp;</td>
	<td background="img/line_t.gif"><img src="img/pixel.gif" width="10" height="8" border="0"></td>
</tr>
<tr>
	<td background="img/line_l.gif"><img src="img/pixel.gif" border="0"></td>
	<td colspan="3">
	<img src="img/pixel.gif" width="1" height="10" border="0"><br>
	<div align="center"
	 id="error_registration" style="display: block;"></div>
	<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td bgcolor="#DBEAF5">
		<table cellspacing="1" cellpadding="3" border="0" width="100%">
          <tr bgcolor="#ffffff">
            <td id="t_title" width="1%">&nbsp;</td>
            <td width="14%" id="t_name"><div align="right">Full Name(s):</div></td>
            <td  width="18%"><input type="text" name="Name" size="10" class="ctrl" <?php if (isset($fullname)) print "value=$fullname"; ?> ></td>
            <td colspan="2" id="t_pno"><div align="right">P/NO:</div></td>
            <td colspan="4"><input type="text" name="pno" size="10" class="ctrl" <?php if (isset($pnum)) print "value=$pnum"; ?>></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_center">&nbsp;
              <div align="right">Center/DeptName:</div></td>
            <td valign=top><select name="dept" class="ctrl" >
              <option value="">-- select --
			  <?php
			    
				$sqlstr="select id as deptid,DeptName  as deptname from prdept";
				$data=$d->query($sqlstr);
				
				while ($row=mysql_fetch_object($data))
				{
				   if (isset($deptid))
				   {
				     if ($deptid==$row->deptid)
					   print "<option value=$row->deptid selected>".$row->deptname; 
					 else  
					   print "<option value=$row->deptid>".$row->deptname; 
				   }
				   else
				     print "<option value=$row->deptid>".$row->deptname; 
				}
			  ?>
			  </select></td>
            <td colspan="2" id="t_designation"><div align="right">Designation:</div></td>
            <td colspan="4"><select name="Desig" class="ctrl">
              <option value="">-- select --
			  <?php
			    
				$sqlstr="select id as  desigid,designation as designame from  designation";
				$data=mysql_query($sqlstr) or die(mysql_error());
				
				while ($row=mysql_fetch_object($data))
				{
				    if (isset($desigid))
				   {
				     if ($desigid==$row->desigid)
					 {
					   print "<option value=$row->desigid selected>".$row->designame; 
					 }
					 else
					   print "<option value=$row->desigid>".$row->designame;    
				   }
				   else
				   print "<option value=$row->desigid>".$row->designame; 
				}
			  ?>
                  </select></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_daysreq"><div align="right">Number of Days Requested:  </div></td>
            <td bgcolor="#ffffff"><input name="daysreq" type="text" class="ctrl" size="3" maxlength="3" <?php if (isset($numdays)) print "value=$numdays"; ?> ></td>
            <td colspan="2" bgcolor="#ffffff">&nbsp;</td>
            <td colspan="4" bgcolor="#ffffff">&nbsp;</td>
			<td width="1%" bgcolor="#ffffff">&nbsp;</td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_date1"><div align="right">With Effect from:</div></td>
            <td bgcolor="#ffffff"><input name="date1" type="Text" class="ctrl" onchange=Onclick="javascript:getdays(this.value,document.forms[registration].elements[daysreq].value)" <?php if (isset($datefrom)) print "value=$datefrom"; ?> id="date1"></td>
            <td width="3%"><div align="right"></div></td>
            <td width="9%" id="t_date2"><div align="right">To</div></td>
            <td width="5%">&nbsp;</td>
            <td width="38%"><input name="date2" type="Text" class="ctrl" <?php if (isset($dateto)) print "value=$dateto"; ?> id="date2"></td>
            <td width="3%">&nbsp;</td>
            <td width="8%">&nbsp;</td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2"  nowrap>&nbsp;</td>
            <td colspan="7"><span class="style1">Exclusive of Saturdays, Sundays and Public Holidays</span></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" > <div align="right">Date:</div></td>
            <td>&nbsp;<? 
			   $today = getdate(); 
               $month = $today['month']; 
               $mday = $today['mday']; 
               $year = $today['year']; 
               echo "$month/$mday/$year";
			   ?></td>
            <td colspan="6" id="t_post_code"><input type="hidden" name="username" <? if (isset($user)) print "value=$user" ?>> <input type="hidden" name="sessionid" <? print "value=$s_id" ?>></td>
            <input type="hidden" name="action" <? if (isset($action)) print "value=$action" ?>>
			<input type="hidden" name="leaveid" <? if (isset($leaveid)) print "value=$leaveid" ?>>
			</tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_geninfor">My Leave address will be (Include your mobile No as well). 
              </td>
            <td bgcolor="#ffffff" colspan="7"><textarea name="leaveadress" rows="5" cols="32" class="ctrl" ><? if (isset($leaveaddress)) print "$leaveaddress" ?></textarea></td>
          </tr>
        </table></td>
	</tr></table>
		<img src="img/pixel.gif" width="1" height="10" border="0"><br>
	</td>
	<td background="img/line_r.gif"><img src="img/pixel.gif" border="0"></td>
	</tr>
<tr>
	<td width="10"><img src="img/formtab_b.gif" width="10" height="20" border="0"></td>
	<td bgcolor="#4682B4" colspan="4" align="right">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="btn" width="100"><input type="reset" name="Reset" value="Reset" class="btnform"></td>
		<td width="1"><img src="img/pixel.gif" width="1" height="18" border="0"></td>
		<td class="btn" width="100"><input type="submit" name="Submit" value="Submit" class="btnform"></td>
		<td width="1"><img src="img/pixel.gif" width="1" height="18" border="0"></td>
	</tr>
	</table>
	</td>
</tr>
</table>
</form>

<script language="JavaScript">
<!-- 
var cal1 = new calendar1(document.forms['registration'].elements['date1']);
 cal1.year_scroll = true;
 cal1.time_comp = false;
 var cal2 = new calendar1(document.forms['registration'].elements['date2']);
 cal2.year_scroll = true;
 cal2.time_comp = false;
 //-->
</script>

<script>
var a_fields = {
	'Name': {
		'l': 'Name',  // label
		'r': true,    // required
		't': 't_name',// id of the element to highlight if input not validated
		
		'm': null,     // must match specified form field
		'mn': 2,       // minimum length
		'mx': 50       // maximum length
	},
	'pno':{'l':'PNO','r':true,'f':'alphanum','t':'t_pno'},
	'dept':{'l':'Center/DeptName','r':true,'t':'t_center'},
	'Desig':{'l':'Designation','r':true,'t':'t_designation'},
	'daysreq':{'l':'Number of Days Requested','r':true,'f':'integer','t':'t_daysreq'},
	'date1':{'l':'With Effect from','r':true,'f':'date','t':'t_date1'},
	'date2':{'l':'To','r':true,'f':'date','t':'t_date2'},
	'leaveadress':{'l':'Leave Address','r':true,'t':'t_geninfor'}
	
},

o_config = {
	'to_disable' : ['Submit', 'Reset'],
	'alert' : 1
}

// validator constructor call
var v = new validator('registration', a_fields, o_config);

</script>
<script>
function getdays(date1,numdays)
{
 return alert("fish"); 
}
</script>
<br><br><br><br>
<fieldset>
</fieldset>
</body>
</html>



