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

	<title>HR Settings</title>
	

<style type="text/css">
<!--
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
	
	
    if (!validatePresent(document.forms.adddesignationssfrm.designation,'inf_designation')) errs += 1; 
	   
	if (errs>1)  alert('There are fields which need correction before submitting');
    if (errs==1) alert('There is a field which needs correction before submitting');
	
  return (errs==0);
 }
 
 </script>
 
 
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

  
  
  if (!empty($_GET["settingid"]))
  {
    $id=$_GET["settingid"];
    $sqlstr="select * from hrsettings where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$retirement= $row->retirement;
	$leave = $row->leave;
	$contract = $row->contract;
	$retage=$row->retage;
    $id=  $row->id;
  }
  
  if (!empty($_POST["retirement"]))
  { 
	$retirement = "'".$_POST["retirement"]."'";
	$leave = "'".$_POST["leave"]."'";
	$contract = "'".$_POST["contract"]."'";
    $retage = empty($_POST["retage"]) ? 'NULL' : "'" . $_POST["retage"] . "'";
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update hrsettings set `leave`=$leave, retirement=$retirement, contract=$contract, retage=$retage where id=$id";
   else
     $query="insert into hrsettings (retirement,`leave`,contract,retage) values ($retirement,$leave,$contract,$retage)";
   
   //echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=addsettings.php'>";
	}
   }
   
   
  }
 if ($action=="delete_go")
  {
   $sqlstr="delete from hrsettings where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=addsettings.php'>";
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
	
<form name="adddesignationsfrm" method="post" action="addsettings.php">
<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Notify Retirement </div></th>
        <th>          
        <input name="retirement" type="text" id="retirement"  <? if (!empty($retirement)) echo "value='$retirement'"; ?>>
 year(s) before        
 <div class="highlight" id="inf_designation">&nbsp;</div>
        </th></tr>
      <tr>
        <th><div align="right">Retirement Age </div></th>
        <th><input name="retage" type="text" id="retage"  <? if (!empty($retage)) echo "value='$retage'"; ?>></th>
      </tr>
      <tr>
        <th><div align="right"><strong>Notify Leave </strong></div></th>
        <th><input name="leave" type="text" id="leave"  <? if (!empty($leave)) echo "value='$leave'"; ?>> 
        Days Before </th>
      </tr>
      <tr>
        <th><div align="right">Notify Contract</div></th>
        <th><input name="contract" type="text" id="contract"  <? if (!empty($contract)) echo "value='$contract'"; ?>>
          Months Before </th>
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
        <th width="1%">Retirement</th>
		 <th width="1%">Retirement Age</th>
		<th width="1%">Leave</th>
		<th width="1%">Contract Expiry</th>
        <th width="3%">Action</th>
      </tr>
	  <?
	    	
		
	      $sqlstr="select * from hrsettings";
		  $result=$d->query($sqlstr) or die(mysql_error());
		  $numrows=$d->numrows($result);
		  if ($numrows>0)
		    $action="edit";
		  
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->retirement."</td>";
			echo "<td>".$row->retage."</td>";
		    echo "<td>".$row->leave."</td>";	
			echo "<td>".$row->contract."</td>";	  
		    echo "<td> <a href=addsettings.php?settingid=$row->id&action=edit>Edit</a> | <a href=addsettings.php?action=delete_go&settingid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
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



