<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<?
   include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
    for ($i=1950;$i<2016;$i++)
	{
	  $query="insert into tbl_years(yearlabel) values ($i)";
	  $result=$d->query($query) or die(mysql_error());
	}
   $d->close();
?>
</body>
</html>



