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

	<title>Leave Application</title>
	

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
  <script type="text/javascript">
/*You can also place this code in a separate file and link to it like epoch_classes.js*/
	var dp_cal,dob_cal;      
     window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('dateto'));
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('datefrom'));
	
};
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
  
  $username = $_SESSION["username"];
  $sqlstr="select * from support_users where username like '%".$username."%'";
  $data=$d->query($sqlstr);
  $row=$d->fetch_object($data);
  $fullname=$row->name; 
  $userid=$row->id;
 
  if (!empty($_GET["empid"]))
    $empid=$_GET["empid"];
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

 
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["leaveid"]))
  {
    $id=$_GET["leaveid"];
    $sqlstr="select * from tbl_leaveapplic where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$datefrom = dateconvert($row->datefrom,2);
	$leaveaddress = $row->leaveaddress;
	$totaldays = $row->numdays;
	$dateto= dateconvert($row->dateto,2);
	$leaveid=$row->leavetype;
    $leavebal=  $row->leavebal;
	$empid=$row->empid_fk;
  }
   if (!empty($empid))
  {
    $sqlstr="select * from prmember inner join tbl_titles on tbl_titles.id=emptitle where prmember.memberno=$empid";
	$query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Leave Application Details For: <a href=employees.php?empid=$row->MemberNo&action=edit>" . $row->title. $row->FullName."</a>";
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->MemberNo."</b></font>";
    
  }
  
  if (!empty($_POST["leavetype"]))
  { 
  
    $leavetype = $_POST["leavetype"];
	$totaldays =$_POST["totaldays"];
	$leavebal=$_POST["leavebal"];
	$datefrom=dateconvert($_POST["datefrom"],1);
	$dateto=dateconvert($_POST["dateto"],1);
	$leaveaddress=$_POST["leaveaddress"];
	$empid=$_POST["empid"];
	
	$today=date('Y/m/d h:i:s');
	
    $action =$_POST["action"];
	
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_leaveapplic set leavetype=$leavetype,datefrom='$datefrom',dateto='$dateto',leaveaddress='$leaveaddress',numdays=$totaldays,lastupdated='$today',empid_fk=$empid,leavebal=$leavebal  where id=$id";
   else
     $query="insert into tbl_leaveapplic (leavetype,datefrom,dateto,leaveaddress,numdays,dateadded,empid_fk,addedby,leavebal) values ($leavetype,'$datefrom','$dateto','$leaveaddress',$totaldays,'$today',$empid,'$fullname','$leavebal')";
   
  // echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
    }
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=applyleave.php'>";
	}
   
   
   
  }
  if ($action=="delete_go")
 {
   $sqlstr="delete from tbl_leaveapplic where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=applyleave.php?empid=$empid'>";
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
	
<form name="addbankfrm" method="post" action="applyleave.php">
<? echo $dispname;?>
<table width="100%"  border="0">
      <tr>
        <th width="19%"><div align="right">Leave Type </div></th>
        <th width="81%" colspan="3">          
          <div class="highlight" id="inf_leavetype">
            <select name="leavetype" id="leavetype">
              <option value="">--SELECT--</option>
              <? Loadlookup("id","leavetype","tbl_leavetypes",$leaveid,$d); ?>
            </select>
</div>
        </th></tr>
      <tr>
        <th><div align="right">Days Applied</div></th>
        <th><input name="totaldays" type="text" id="totaldays"  <?  if (!empty($totaldays))echo "value='$totaldays'"; ?>></th>
        <th>Leave Balance </th>
        <th><input name="leavebal" type="text" id="leavebal"  <?  if (!empty($leavebal))echo "value='$leavebal'"; ?>></th>
      </tr>
      <tr>
        <th><div align="right">From</div></th>
        <th><input name="datefrom" type="text" id="datefrom"  <?  if (!empty($datefrom))echo "value='$datefrom'"; ?>></th>
        <th>To</th>
        <th><input name="dateto" type="text" id="dateto"  <?  if (!empty($dateto))echo "value='$dateto'"; ?>></th>
      </tr>
      <tr>
        <th><div align="right">Alert Automatically </div></th>
        <th colspan="3"><input name="autoalert" type="text" id="autoalert"  <?  if (!empty($dateto))echo "value='$dateto'"; ?>> 
          days to due Date </th>
      </tr>
      <tr>
        <th>Address during Leave[Include Mobile No as well]</th>
        <th colspan="3"><textarea name="leaveaddress" cols="50" id="leaveaddress"><? if (!empty($leaveaddress)) echo "$leaveaddress"; ?></textarea></th>
      </tr>
      <tr>
        <th>
		  <input type="hidden" name="empid" <?  if(!empty($empid)) echo "value=$empid"; ?>>
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
        <th width="2%">Leave Type </th>
        <th width="2%">Days Applied</th>
         <th width="2%">Leave Balance </th>
	    <th width="2%">Date From </th>
        <th width="2%">Date To </th>
        <th width="3%">Action</th>
      </tr>
	  <?
	    	
		
	      $sqlstr="select tbl_leaveapplic.*,tbl_leavetypes.leavetype as leavename from tbl_leaveapplic inner join tbl_leavetypes on tbl_leavetypes.id=tbl_leaveapplic.leavetype where empid_fk=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    
		    echo "<td>".$row->leavename."</td>";
		    echo "<td>".$row->numdays."</td>";
			 echo "<td>".$row->leavebal."</td>";  
			echo "<td>".dateconvert($row->datefrom,2)."</td>"; 
			echo "<td>".dateconvert($row->dateto,2)."</td>"; 
		    echo "<td> <a href=applyleave.php?leaveid=$row->id&action=edit>Edit</a> | <a href=applyleave.php?action=delete_go&leaveid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
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



