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

	<title>Change Password</title>
	

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
	
	  if (!validatePresent(document.forms.hrsetupfrm.cnewpass,'inf_cnewpass')) errs += 1; 
      if (!validatePresent(document.forms.hrsetupfrm.newpass,'inf_newpass')) errs += 1; 
	  if (!validatePresent(document.forms.hrsetupfrm.oldpass,'inf_oldpass')) errs += 1;  
	   
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
  include "includes/config.php";
  require_once "includes/db.php";
  
  
 
 mysql_connect($db_host, $db_user, $db_pass); 
 mysql_select_db($db);
  
  //process post;
   if (empty($_SESSION["username"]))
    die("<center><font color=red>You have not yet Logged in.<a href=../corehrmis/login.php>Please click here to log in.</a></font></center>");
   else
     echo "<b>You are logged is as </b>".$_SESSION["username"];
  $username=$_SESSION["username"];
  $upass=$_SESSION["upass"];
  
  if ($upass!=$_POST["oldpass"] && !empty($_POST["oldpass"]))
   echo "<font face=\"verdana\" size=2 color=red><center><b>The Old Password does not match your current password.<b></center></font>";
  else if  ($_POST["newpass"]!=$_POST["cnewpass"])
   echo "<font face=\"verdana\" size=2 color=red><center><b>The New Password does not match the confirmed password.<b></center></font>";
  else{	
  if (!empty($_POST["oldpass"]) && !empty($_POST["newpass"]) && !empty($_POST["cnewpass"]))
   {
     $password=$_POST["newpass"];
     $sqlstr="update hrusers set password='".md5($password) ."'where username like '$username'";
	 $query=mysql_query($sqlstr) or die(mysql_error());
	  echo "&nbsp;&nbsp;<font face=verdana size=2><b>User Pasword has been successfully changed</b></font>";
	  echo "<meta http-equiv='refresh' content='3;url=index.php'>";
   }
   }
 ?>
 <br><br>
<table width="100%" height="100%" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td id="cell_top"><div align="center"></div></td>
  </tr>

  <tr>
    <td >    &nbsp;&nbsp;<a href="javascript: window.close()" onfocus="blurLink(this);">Close Window</a></td>

  </tr>

  <tr>
    <td width="100%"  bgcolor="#FFFFFF" >
	
<form name="hrsetupfrm" method="post" action="changepass.php">

	    
<table width="100%"  border="0">
      <tr>
        <th><div align="right">Old Password </div></th>
        <th><input name="oldpass" type="password" id="oldpass">
          <div class="highlight" id="inf_oldpass">&nbsp;</div></th>
      </tr>
      <tr>
        <th><div align="right">New Password </div></th>
        <th><input name="newpass" type="password" id="newpass">
          <div class="highlight" id="inf_newpass">&nbsp;</div></th>
      </tr>
      <tr>
        <th width="2%"><div align="right">Confirm New Password </div></th>
        <th width="3%"><input name="cnewpass" type="password" id="cnewpass">
          <div class="highlight" id="inf_cnewpass">&nbsp;</div></th>
      </tr>
   
   
	  
  
   </table>
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
</body>

</html>



