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
ob_start();
?>
<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
   ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>E-HRIS</title>
<link href="css/text.css" rel="stylesheet" type="text/css" />

<style>
.black_overlay{

            display: none;

            position: absolute;

           top: 0%;

            left: 0%;

            width: 100%;

            height: 100%;

            background-color: black;

            z-index:1001;

            -moz-opacity: 0.8;

            opacity:.80;

            filter: alpha(opacity=80);

        }

        .white_content {

            display: none;

            position: absolute;

            top: 25%;

            left: 25%;

           width: 50%;

            height: 50%;

            padding: 16px;

            border: 16px solid orange;

            background-color: white;

            z-index:1002;

            overflow: auto;

        }

    </style>
    <script type="text/javascript" src="ewp.js"></script>
		<script type="text/javascript">
		<!--
		function EW_checkMyForm(EW_this) {
			if (!EW_hasValue(EW_this.username, "TEXT" )) {
				if  (!EW_onError(EW_this, EW_this.username, "TEXT", "Please enter user ID"))
					return false;
			}
			if (!EW_hasValue(EW_this.password, "PASSWORD" )) {
				if (!EW_onError(EW_this, EW_this.password, "PASSWORD", "Please enter password"))
					return false;
			}
			return true;
		}
		
		//-->
		</script>
    </head>

    <body onLoad="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">

      
        <div id="light" class="white_content"> 
		
		<span class="KEMRI_SCD">E-HRIS</span>
		<span class="msg">
		Is an open source human resource information management system developed to meet the human resource
		needs of any organization from small-enterprises to large scale organizations. The system is aleady in use in 3 large private and government organizations long the Kenyan 
		Coast. Most notably the Municipal Council of Mombasa. </span>
       
		<br><br><div class="msg">username=demo Password=demo</div><br> 
<form action="logintest.php" method="post" enctype="multipart/form-data" name="loginfrm">
		  <div class="txt" align="center">Username:<input type="text" name="username"><br><br>
		    &nbsp;Password:<input name="password" type="password"><br><br></div>
			<div align="center" class="btn"><input name="Login" type="button" value="Login"></div>
			
		</form>
		
		</div>

        <div id="fade" class="black_overlay"></div>

  <?
 if (!empty($_POST["username"]))
    $username=$_POST["username"];
  else
    $username="";
	  
  if (!empty($_POST["password"]))
    $upasswd=$_POST["password"];
  else
    $upasswd="";
	
  if (!empty($_POST["dbname"]))
    $dbname=$_POST["dbname"]; 
  else
    $dbname=$db;
	
  //get hostip from db
  /*mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error()); 
  mysql_select_db($setupdb) or die(mysql_error());
  $sqlstr="select hostip from  fsdb where dbname like '$dbname'";
  $result=mysql_query($sqlstr);
  $row=mysql_fetch_object($result);
  
  if (!empty($row->hostip)) 
    $db_host=$row->hostip;
  
  mysql_close();*/
  
  
  //if (!$link)  
  $link=mysql_connect($db_host,$db_user,$db_pass);
  
  if (!empty($username) && !empty($upasswd))
  {
    //connect to db
	
	mysql_select_db($dbname);
	
    $sqlstr = "select * from hrusers where username like '$username' and password like '". md5($upasswd)."'";
	$sqlresult = mysql_query($sqlstr) or die(mysql_error());
	$numrows = mysql_num_rows($sqlresult);
	
	if ($numrows>0)
	{
	   $_SESSION["username"] = $username; 
	   $_SESSION["upass"] = $upasswd;
	   print "<center><font face=verdana color=#003366 size=2 >Successfully Logged in</font></center>";
       echo "<meta http-equiv='refresh' content='1;url=viewemployees.php'>";
	}
	else
	{
	  echo "<div align=\"center\"><font face=verdana color=red>Wrong Password or Username!!</font></div>";
	}
    
  }
?>

</body>
</html>
