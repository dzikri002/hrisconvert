<? session_start()

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Upload Pic</title>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<?
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 	
  
if (isset($_REQUEST["empid"]))
  $id=$_REQUEST["empid"];
    
if ((isset($_REQUEST['form_submit'])) && ('form_uploader' == $_REQUEST['form_submit']) && (!empty($_POST["imgnum"])))
{
  if  (is_uploaded_file($_FILES['file']['tmp_name']))
  {
    $filename = $_FILES['file']['name'];
    $filetype=$_FILES['file']['type'];
    $file_temp=$_FILES['file']['tmp_name'];	
  } 
  
 
   
  $fd = fopen($file_temp, "rb");
  $filesize=filesize($file_temp);
  $data=addslashes(fread($fd,$filesize));
  

 
  fclose($fd);
  $id=$_POST["imgnum"];
  
   
   if (!empty($id))
   {
     echo $filesize;
	 echo $id;
	 
     $sqlstr= "update prmember
     set
	 photo='$data',
	 filetype='$filetype'
	 where memberno=$id";
	 
     $sqlresult=$d->query($sqlstr) or die(mysql_error());
    
     print("Photo Successfully uploaded.<a href=javascript:window.close()>Click Here to Close the Window.</a>");
     print("</strong>");
   }
 } 
  ?>
<form name="uploadpicfrm" enctype="multipart/form-data" method="post" action="uploadpic.php">
<table width="100%"  border="1">
  <tr>
    <th scope="col"><span class="style1">Browse to The Picture You wish to Upload then Click on Save to Post. </span></th>
  </tr>
  <tr>
    <td scope="col">
      <input type="file" name="file"></td>
    </tr>
  <tr>
    <td scope="col"><div align="right">
      <input type="submit" name="Submit" value="Submit">
    </div></td>
    </tr>
</table>
 <input name="form_submit" type="hidden" id="form_submit" value="form_uploader">
 <input type="hidden" name="imgnum" <? echo "value=$id"?> >
</form>
<p>&nbsp;</p>
<? $d->close();?>
</body>
</html>



