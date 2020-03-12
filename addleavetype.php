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

	<title>Add Leave Types</title>
	

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
	
	if (!validatePresent(document.forms.addbankfrm.bank,'inf_bank'))  errs += 1; 
		    
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

  
  
  if (!empty($_GET["typeid"]))
  {
    $id=$_GET["typeid"];
    $sqlstr="select * from tbl_leavetypes where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$leavetype = $row->leavetype;
	$totaldays= $row->totaldays;
	
    $id=  $row->id;
  }
  
  if (!empty($_POST["leavetype"]))
  { 
  
    $leavetype = "'".$_POST["leavetype"]."'";
	$jobgrpfrom = "'".$_POST["jobgrpfrom"]."'";
	$jobgrpto= "'".$_POST["jobgrpto"]."'";
	$totaldays =$_POST["totaldays"];
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_leavetypes set leavetype=$leavetype,totaldays=$totaldays,jobgrpfrom=$jobgrpfrom,jobgrpto=$jobgrpto  where id=$id";
   else
     $query="insert into tbl_leavetypes (leavetype,totaldays,jobgrpto,jobgrpfrom) values ($leavetype,$totaldays,$jobgrpto,$jobgrpfrom)";
   
  // echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=addleavetype.php'>";
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
	
<form name="addbankfrm" method="post" action="addleavetype.php">
<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Leave Type Description </div></th>
        <th colspan="3">          
        <input name="leavetype" type="text" id="leavetype" size="60"  <?  if (!empty($leavetype))echo "value='$leavetype'"; ?>>
          <div class="highlight" id="inf_leavetype">&nbsp;</div>
        </th></tr>
      <tr>
        <th><div align="right">Total no. of days </div></th>
        <th colspan="3"><input name="totaldays" type="text" id="totaldays" size="60"  <?  if (!empty($totaldays))echo "value='$totaldays'"; ?>></th>
      </tr>
      <tr>
        <th><div align="right">Job Group from </div></th>
        <th><select name="jobgrpfrom" id="jobgrpfrom">
          <option value="">--SELECT--</option>
          <? Loadlookup("JobGroup","JobGroup","jobgroup",$jobgroup,$d); ?>
        </select></th>
        <th><div align="right">To</div></th>
        <th><select name="jobgrpto" id="jobgrpto">
          <option value="">--SELECT--</option>
          <? Loadlookup("JobGroup","JobGroup","jobgroup",$jobgroup,$d); ?>
        </select></th>
      </tr>
      <tr>
        <th>
          <input type="hidden" name="action" <?  if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <?  if (!empty($id)) echo "value=$id"; ?>>
		  </th>
        <th colspan="3"><div align="right">
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
        <th width="2%">Description</th>
        <th width="2%">Days Allowed </th>
        <th width="2%">Job Group From </th>
        <th width="2%">Job Group To </th>
        <th width="3%">Action</th>
      </tr>
	  <?
	    	
		
	      $sqlstr="select * from tbl_leavetypes";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    
		    echo "<td>".$row->leavetype."</td>";
		    echo "<td>".$row->totaldays."</td>"; 
			echo "<td>".$row->jobgrpfrom."</td>"; 
			echo "<td>".$row->jobgrpto."</td>";  
		    echo "<td> <a href=addleavetype.php?typeid=$row->id&action=edit>Edit</a></td>";
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



