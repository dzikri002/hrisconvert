<?
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
  if (!empty($_REQUEST["id"])){	
    $imgid=$_REQUEST["id"];
	$sqlstr="select * from tbl_course where id=$id";

  $sqlresult=$d->query($sqlstr);
  $data=$d->fetch_object($sqlresult);
 
  $filename=$data->filename;
  $filesize=$data->filesize;
  $data=$data->data;
  $filetype=ereg_replace(" ", "", $filetype);
  $filetype=$data->filetype;
  header("Content-type: $filetype");
  header("Cache-Control: private");
  header("Content-Disposition: attachment; filename=$filename");
  header("Content-Description: PHP Generated Data");
  echo base64_decode($data);
									
  header("content-type: text/html");
  echo "</center>";
  print "<br>"; 
  $d->close();
 } 
?>