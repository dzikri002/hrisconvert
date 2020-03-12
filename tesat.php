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
  
   $sqlstr="select * from tbl_employees";
   $result=$d->query($sqlstr);
   echo $d->numrows($result);
  
  echo "<table>";  
  /*while ($row=$d->fetch_object($result));
		{
		 echo "<td> $row->id</td>";
		  echo "<tr><td>";
		  echo "<td> $row->id</td>";
		  echo "<td>$row->empnum</td>";
		  echo "<td>$row->fname." ".$row->mname." ".$row->fname.</td>";
		  echo "<td>$row->dob</td>";
		  echo "<td>$row->gender</td>";
		  
		  echo "<td>$row->national_idnum</td>";
		  echo "<td>$row->nationality</td>";
		  echo "</tr></td>";
		}*/
   $d->close();
   echo "</table>"; 

 ?>

</body>
</html>



