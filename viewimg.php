<?
 include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  
  $d = new dbC();
   $d->connect($db_host, $db_user, $db_pass, $db); 
  
  if (!empty($_REQUEST["imgid"]))	
  {	
    $imgid=$_REQUEST["imgid"];
    $sqlstr="select * from prmember where memberno=$imgid";
 
  
  $sqlresult=$d->query($sqlstr);
  $data=$d->fetch_object($sqlresult);
  $filetype=$data->filetype;
  
 
   
  $filetype=ereg_replace(" ", "", $filetype);
  
  if (empty($filetype))
    header("content-type: image/jpg");
  else 
    Header("Content-type: $filetype");
   //resize image
   
  /* $im = imagecreatefromstring($data->img);
   $width = imagesx($im);
   $height = imagesy($im);*/


  echo $data->Photo;
  
  header("content-type: text/html\n");
  echo "<br><strong>";
  //echo $data->comments;
    //echo $width."<br>";
  //echo $height;
  echo "</strong></center>";
  print "<br> <hr>"; 
 
 }
  $d->close();
?>

