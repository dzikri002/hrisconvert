<?
 
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php"
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
  if (!empty($_REQUEST["imgid"]))	
  {	
    $imgid=$_REQUEST["imgid"];
    $sqlstr="select * from employees  where id=$imgid";
	
    $sqlresult=$d->query($sqlstr);
    $data=$d->fetch_object($sqlresult);
 
    $filetype=$data->filetype;
    $filesize=$data->filesize;
    $img=$data->img;
    $filetype=ereg_replace(" ", "", $filetype);
  
    Header("Content-type: $filetype");
    header("Cache-Control: private");

    echo $img;
									
    header("content-type: text/html");
    echo "</center>";
    print "<br>"; 
 
 }

  $d->close();
  
?>


