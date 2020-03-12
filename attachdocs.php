<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Attach Documents</title>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
 <script type="text/javascript" src="js/formval.js"></script>
 <script type="text/javascript">
 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validatePresent(document.forms.attachdocs.file,'inf_file')) errs += 1; 
	if (!validatePresent(document.forms.attachdocs.filedesc,'inf_filedesc')) errs += 1;
 }
 </script> 
</head>

<body>
<?
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 	
  
if (isset($_REQUEST["empid"]))
  $empid=$_REQUEST["empid"];

if (isset($_POST["empid"]))
  $empid=$_POST["empid"];
    
if ((isset($_REQUEST['form_submit'])) && ('form_uploader' == $_REQUEST['form_submit']) && (!empty($_POST["empid"])))
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
  $filedesc=$_POST["filedesc"];
   
   if (!empty($filesize))
   {
     $sqlstr= "insert into tbl_documents1
     (data,filetype,filename,filesize,empid_fk,filedesc)  
	  values ('$data','$filetype','$filename','$filesize','$empid','$filedesc')";
	 
     $sqlresult=$d->query($sqlstr) or die(mysql_error());
    
     print("document Successfully uploaded. You can continue to Upload documents or <a href=javascript:window.close()>Click Here to Close the Window.</a>");
     print("</strong>");
	 echo "<meta http-equiv='refresh' content='1;url=attachdocs.php'>";
   }
 } 
  ?>
<form name="attachdocs" enctype="multipart/form-data" method="post" action="attachdocs.php">
<table width="100%"  border="1">
  <tr>
    <th colspan="2" scope="col"><span class="style1">Browse to The File You wish to Upload then Click on Save to Post. </span></th>
  </tr>
  <tr>
    <td colspan="2" scope="col">
      <input type="file" name="file"><div id="inf_file">&nbsp;</div></td>
    </tr>
  <tr>
    <td width="17%" scope="col"><div align="right"><strong>Description of File (i.e. CV,College Diploma e.t.c) </strong></div></td>
    <td width="83%" scope="col"><input name="filedesc" type="text" id="filedesc" size="30">
    <div id="inf_filedesc">&nbsp;</div></td>
  </tr>
  <tr>
    <td colspan="2" scope="col"><div align="right">
      <input type="submit" name="Submit" value="Submit">
    </div></td>
    </tr>
</table>
 <input name="form_submit" type="hidden" id="form_submit" value="form_uploader">
 
 <input type="hidden" name="imgnum" <? if (!empty($id)) echo "value=$id"?> >
  <input type="hidden" name="empid" <? if (!empty($empid)) echo "value=$empid"?> >
</form>
<p>&nbsp;</p>
<? $d->close();?>
</body>
</html>



