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
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title>Add Job Groups</title>
	

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
 <script language="JavaScript" src="js/calendar1.js"></script><!--  -->
 <script type="text/Javascript">
 

 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validatePresent(document.forms.addjobgrpfrm.upper,'inf_upper'))  errs += 1; 
	if (!validatePresent(document.forms.addjobgrpfrm.lower,'inf_lower'))  errs += 1; 
    if (!validatePresent(document.forms.addjobgrpfrm.jobgrp,'inf_jobgrp'))  errs += 1; 
	    
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

  
  
  if (!empty($_GET["jobgrp"]))
  {
    $id=$_GET["jobgrp"];
    $sqlstr="select jobgroup,description,lower,upper from jobgroup where jobgroup=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$jobgroup = $row->jobgroup;
	$description=$row->description;
	$lower=$row->lower;
	$upper=$row->upper;
	
    
  }
  
  if (!empty($_POST["jobgrp"]))
  { 
  
    $jobgrp = "'".$_POST["jobgrp"]."'";
	$description =  empty($_POST["description"]) ? 'NULL' : "'" . $_POST["description"] . "'"; 
	$lower = empty($_POST["lower"]) ? 'NULL' : "'" . $_POST["lower"] . "'";  
    $action =$_POST["action"];
	$id=$_POST["id"];
	$upper= "'".$_POST["upper"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update jobgroup set jobgroup=$jobgrp,description=$description,lower=$lower,upper=$upper where jobgroup='$id'";
   else
     $query="insert into jobgroup (jobgroup,description,lower,upper) values ($jobgrp,$description,$lower,$upper)";
   
  // echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=addjobgrps.php'>";
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
      <li><a href="viewemployees.php" onfocus="blurLink(this);">View Employees</a></li>
	  <li><a href="addbank.php" onfocus="blurLink(this);">Add Banks</a></li>
	   
	   <li><a href="adddepartments.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="adddesignations.php" onfocus="blurLink(this);">Add Designations</a></li>
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Nationalities</a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Units</a></li>
	  </ul>        
        
    
    </div>
    
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	
<form name="addjobgrpfrm" method="post" action="addjobgrps.php">
<table width="100%"  border="0">
      <tr>
        <th><div align="right"> Job Group </div></th>
        <th><input name="jobgrp" type="text" id="jobgrp" size="15"  <?  if (!empty($jobgrp))echo "value='$jobgrp'"; ?>></th>
         <div class="highlight" id="inf_jobgrp">&nbsp;</div>
	  </tr>
      <tr>
        <th width="20%"><div align="right">Description</div></th>
        <th>          
        <input name="description" type="text" id="description" size="60"  <?  if (!empty($description))echo "value='$description'"; ?>>
          <div class="highlight" id="inf_description">&nbsp;</div>
        </th></tr>
      <tr>
        <th><div align="right">Lower</div></th>
        <th><input name="lower" type="text" id="lower" size="60"  <?  if (!empty($lower))echo "value='$lower'"; ?>>  
		<div class="highlight" id="inf_lower">&nbsp;</div> </th>
        </tr>
      <tr>
        <th><div align="right">Upper</div></th>
        <th><input name="upper" type="text" id="upper" size="60"  <?  if (!empty($upper))echo "value='$upper'"; ?>></th>
      </tr>
      <tr>
        <th>
          <input type="hidden" name="action" <?  if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <?  if (!empty($id)) echo "value=$id"; ?>>
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
        <th width="2%">Job Group</th>
		<th width="2%">Description</th>
		<th width="2%">Lower</th>
		<th width="2%">Upper</th>
        <th width="3%">Action</th>
      </tr>
	  <?
	    	
		
	      $sqlstr="select jobgroup,description,lower,upper from jobgroup";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->jobgroup."</td>";
		    echo "<td>".$row->description."</td>";
		    echo "<td>".$row->lower."</td>";
			echo "<td>".$row->upper."</td>";
			  
		    echo "<td> <a href=addjobgrps.php?jobgrp=$row->jobgroup&action=edit>Edit</a></td>";
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



