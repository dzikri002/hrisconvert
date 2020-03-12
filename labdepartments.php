<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title>Add Departments</title>
	

<style type="text/css">
<!--
.style4 {color: #FFFFFF}
.info   { color: black; background-color: transparent; font-weight: normal; }
  .warn   { color: rgb(120,0,0); background-color: transparent; font-weight: normal; }
  .error  { color: red; background-color: transparent; font-weight: bold }
-->
</style>
 <link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>
 <script type="text/javascript" src="css/epoch_classes.js"></script>
 <script type="text/javascript" src="js/formval.js"></script> 
 <script language="JavaScript" src="js/calendar1.js"></script>
 <script type="text/Javascript">
 

 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	
    if (!validatePresent(document.forms.addDeptNamesfrm.DeptName,'inf_DeptName')) errs += 1; 
	   
	if (errs>1)  alert('There are fields which need correction before submitting');
    if (errs==1) alert('There is a field which needs correction before submitting');
	
  return (errs==0);
 }
 
 </script>
 
 <style type="text/css">
<!--
.style2 {font-size: x-small}
-->
 </style>
</head>
<body bgcolor="#FFFFFF">
<? 
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
  
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["departid"]))
  {
    $id=$_GET["departid"];
    $sqlstr="select * from prdept where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$DeptName = $row->DeptName;
	$depthead = $row->depthead;
    $id=$row->id;
  }
  
  if (!empty($_POST["DeptName"]))
  { 
	$DeptName = "'".$_POST["DeptName"]."'";
	$depthead = $_POST["depthead"];	
    $action = $_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update prdept set DeptName=$DeptName, depthead=$depthead where id=$id";
   else
     $query="insert into prdept (DeptName,depcat,depthead) values ($DeptName,'LAB',$depthead)";
   
  // echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=labDeptNames.php'>";
	}
   }
   
   
  }
 
 ?>
<table width="847" cellpadding="0" cellspacing="0"  id="main">
  <tr>
    <td colspan="2" id="cell_top">&nbsp;
    </td>
  </tr>

  <tr>
    <td colspan="2" >
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;</td>

  </tr>

  <tr>
    <td width="173" rowspan="3" nowrap id="menu"><div style="width: 150px;">
      <div style="width: 150px;">
      </div>
      <ul>
      <li><a href="labhome.php" onfocus="blurLink(this);">View Employees</a></li>
	   <li><a href="labDeptNames.php" onfocus="blurLink(this);">Add Section </a></li>
	   <li><a href="labdesignations.php" onfocus="blurLink(this);">Add Designations</a></li>
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Nationality </a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Kemri Units</a></li>
	  </ul>        
        
    
    </div>
    
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	
<form name="addDeptNamesfrm" method="post" action="labDeptNames.php">
<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Section Name </div></th>
        <th>          
        <input name="DeptName" type="text" id="DeptName" size="60"  <? if (!empty($DeptName)) echo "value='$DeptName'"; ?>>
          <div class="highlight" id="inf_DeptName">&nbsp;</div>
        </th></tr>
      <tr>
        <th><div align="right">Heaf of Section </div></th>
        <th><span class="highlight">
        <select name="depthead" id="depthead">
          <option value="">--SELECT--</option>
          <?php
				Lookup("id","name",$depthead,"SELECT tbl_employees.id, CONCAT_WS(' ',fname,mname,lname) as name, prdept.DeptName
					FROM tbl_employees
					Inner Join prdept ON tbl_employees.dept = prdept.deptcode
					WHERE prdept.depcat =  'LAB'"); 
			?>
        </select>
</span></th>
      </tr>
      <tr>
        <th>
          <input type="hidden" name="action" <? if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>>
		  </th>
        <th><div align="right">
            <input type="reset" name="Reset" value="Reset">
            <input type="submit" name="Submit" value="Submit" onclick="return validateOnSubmit()">
        </div></th>
        </tr>
    </table> 
	</form>    
    </td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" ><table width="100%"  border="0">
      <tr>
        <th width="5%">No.</th>
        <th width="1%">Section</th>
		<th width="1%">HOS</th>
        <th width="3%">Action</th>
      </tr>
	  <?
	      $sqlstr="select * from prdept where depcat='LAB'";
		  $result=$d->query($sqlstr) or die(mysql_error());
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->DeptName."</td>";
		    	  
		    echo "<td> <a href=labDeptNames.php?departid=$row->id&action=edit>Edit</a></td>";
		    echo "</tr></td>";
		  }
	  ?>
    </table></td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" >&nbsp;</td>
  </tr>
</table>
<?
  $d->close();
?>
</body>
</html>



