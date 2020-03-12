<? 
session_start();
ob_start();
?>
<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<? include ("config.php") ?>
<? include ("db.php") ?>
<? include ("functions.php") ?>

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


	<tr><td class=header>Welcome to the Pingilikani Data Management System</td></tr>
	
	
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
  
  if (!empty($username) && !empty($upasswd))
  {
    //connect to db
	$link=mysql_connect($db_host,$db_user,$db_pass);
	mysql_select_db($db);
	
    $sqlstr = "select * from users where username like '$username' and password like '". md5($upasswd)."'";
	$sqlresult = mysql_query($sqlstr) or die(mysql_error());
	$numrows = mysql_num_rows($sqlresult);
	
	if ($numrows>0)
	{
	  $_SESSION["username"] = $username; 
	   print "<center><font face=verdana color=#003366 size=2 >Successfully Logged in</font></center>";
       echo "<meta http-equiv='refresh' content='1;url=pingilist1.php'>";
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


	<tr><td><span class="KEMRI_SCD" style="color: Red;"> ' . $_SESSION[ewSessionMessage] . '</td></tr>
	
	
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



