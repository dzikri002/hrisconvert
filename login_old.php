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


<link href="css/text.css" rel="stylesheet" type="text/css" />
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

<? echo '<table align=center width=600 cellspacing=0 cellpadding=0 border=0 class=bordercolor><tr><td>
<table width=100% cellspacing=1 cellpadding=5 border=0>


	<tr><td class=header> E-HRIS  is a low cost source human resource system designed for managing employee records mainly in low resource countries.
	it has already been implemented and is in use in 2 leading organizations at the Kenyan Coast.</td></tr>
	
	
	</td></tr></table>
</td></tr></table>';

?>
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
<?
echo '<table align=center width=600 cellspacing=0 cellpadding=0 border=0 class=g><tr><td>
<table width=100% cellspacing=1 cellpadding=5 border=0>


	<tr><td><span class="KEMRI_SCD" style="color: Red;"> </td></tr>
	
	
	</td></tr></table>
</td></tr></table>';
?>

<?
	
?>
<form action="login.php" method="post" onSubmit="">

<table align=center width=600 cellspacing=0 cellpadding=0 border=0 class=bordercolor><tr><td>

	<table width=100% cellspacing=1 cellpadding=5 border=0>


	<tr><td class=oben>Login page</td></tr>
	<tr><td class=g>

	<table width=500 cellspacing=0 cellpadding=5 border=0>
	
	<tr><td class=g width=70>Username:</td>
	<td class=g width=430><INPUT TYPE="TEXT" class="txt" NAME="username" SIZE="20" MAXLENGTH="20" value="<? echo $_SESSION["username"]; ?>"></td></tr>
	<tr><td class=g>Password:</td>
	<td class=g><INPUT TYPE="password" class="txt" NAME="password" SIZE="20" MAXLENGTH="20"></td></tr>
	<tr>
            <?
			   
				/*  //select userdbs
				  mysql_select_db($setupdb);
				  $sqlstr="select dbname,application from fsdb where otherapp='HR'";
                  $result=mysql_query($sqlstr) or die(mysql_error());
				  
                  //$numrows=mysql_num_rows($result);
				  while ($row=mysql_fetch_object($result))
				  {
				     if (isset($row->dbname))
						{
						  if ($row->dbname==$db)
							print "<option value=$row->dbname selected>".$row->application; 
						  else  
							print "<option value=$row->dbname>".$row->application; 
						}
						else
						   print "<option value=$row->dbname>".$row->application; 
				  }*/
				
			?>
         </td>
	<tr>
		<td  class=g>&nbsp;</td>
		<td class=g>
		<? if (@$_COOKIE[ewCookieAutoLogin] == "autologin") { ?>
		<input type="radio" name="rememberme" value="a" checked>Auto login until I logout explicitly<br><input type="radio" name="rememberme" value="u">Save my user name<br><input type="radio" name="rememberme" value="n">Always ask for my user name and password
		<? } elseif (@$_COOKIE[ewCookieAutoLogin] == "rememberusername") { ?>
		<input type="radio" name="rememberme" value="a">Auto login until I logout explicitly<br><input type="radio" name="rememberme" value="u" checked>Save my user name<br><input type="radio" name="rememberme" value="n">Always ask for my user name and password
		<? } else { ?>
		<input type="radio" name="rememberme" value="a">Auto login until I logout explicitly<br><input type="radio" name="rememberme" value="u">Save my user name<br><input type="radio" name="rememberme" value="n" checked>Always ask for my user name and password
		<? } ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" class=g><input type="submit" class="btn"  name="submit" value="Login"></td>
	</tr>
	</td></tr></table>
	</td></tr></table>
</td></tr></table>


</form>
<?
 echo '<table align=center width=600 cellspacing=0 cellpadding=0 border=0 class=bordercolor><tr><td>
<table width=100% cellspacing=1 cellpadding=5 border=0>


	<tr><td class=g><a href="forgetpwd.php">Forget Password</a>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
	
	
	</td></tr></table>
</td></tr></table>';
?>



