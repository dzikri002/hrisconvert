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

	<title>View Dependants</title>
	

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
 
/*You can also place this code in a separate file and link to it like epoch_classes.js*/
	var dob_cal;      
     window.onload = function () {
	 dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('dob'));
	
};
 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validateCheckbox(document.forms.dependfrm.gender,'inf_gender',1))  errs += 1;
	if (!validatePresent(document.forms.dependfrm.dob,'inf_dob'))  errs += 1;
	if (!validatePresent(document.forms.dependfrm.lname,'inf_lname'))  errs += 1; 
	if (!validatePresent(document.forms.dependfrm.fname,'inf_fname'))  errs += 1; 
	    
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
  
  if (!empty($_GET["empid"]))
    $empid=$_GET["empid"];
		
  if (!empty($_POST["empid"]))
  {
    $empid=$_POST["empid"];
    
  }
  
  if (!empty($empid))
  {
    $sqlstr="select * from prmember left join tbl_titles on tbl_titles.id=emptitle where prmember.memberno=$empid";
	$query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Add Dependant Details for: <a href=employees.php?empid=$row->MemberNo&action=edit>" . $row->title. $row->FullName."</a>";
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->MemberNo."</b></font>";
    
  }
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["depid"]))
  {
    $id=$_GET["depid"];
    $sqlstr="select * from tbl_dependants1 where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$gender = $row->gender;
    $fname = $row->fname;
    $mname = $row->mname;
    $lname = $row->lname;
    $dob = dateconvert($row->dob,2);
    $empid = $row->empid_fk;
    $id=  $row->id;
  }
  
  if (!empty($_POST["fname"]))
  { 
  
    $fname = "'".$_POST["fname"]."'";
    $mname = empty($_POST["mname"]) ? 'NULL' : "'" . $_POST["mname"] . "'";
    $lname = "'".$_POST["lname"]."'";
    $gender = "'".$_POST["gender"]."'";
    $empnum = "'".$_POST["empid"]."'";
	$dob = "'".dateconvert($_POST["dob"],1)."'";;
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
	
	

    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_dependants1 set fname=$fname,lname=$lname,mname=$mname,gender=$gender,empid_fk=$empnum,dob=$dob where id=$id";
   else
     $query="insert into tbl_dependants1 (fname,lname,mname,empid_fk,gender,dob) values ($fname,$lname,$mname,$empnum,$gender,$dob)";
   
  //echo $query;
     
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=dependants.php?empid=$empid'>";
	}
   }
   
   
  }

 if ($action=="delete_go")
 {
   $sqlstr="delete from tbl_dependants1 where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=dependants.php?empid=$empid'>";
 }
 ?>
<table  id="main" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" id="cell_top">&nbsp;
    </td>
  </tr>
  
  <tr>
    <td colspan="2" >
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;</td>

  </tr>

  <tr>
    <td width="172" rowspan="3" nowrap id="menu"><div style="width: 150px;">
      <div style="width: 150px;">
      </div>
      <ul>
      <li><a href="viewemployees.php" onfocus="blurLink(this);">View Employees</a></li>
	  <li><a href="addbank.php" onfocus="blurLink(this);">Add Banks</a></li>
	   
	   <li><a href="adddepartments.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="adddesignations.php" onfocus="blurLink(this);">Add Designations</a></li>
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Kemri Units</a></li>
	  </ul>        
        
    
    </div>
    <? echo "<hr noshade size=\"3\" color=\"#eb8137\"> &nbsp;&nbsp;&nbsp;&nbsp;Employee Photo"; 
	   echo "<center><img src='viewimg.php?imgid=$empid' width=150 Height=150 ></center>"; ?>
		
    </td>
    <td width="100%"  bgcolor="#FFFFFF" >
	<? if (!empty($dispname)) echo $dispname; ?>
	<form name="dependfrm" method="post" action="dependants.php">
	<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Name(s)</div></th>
        <th width="23%"><input name="fname" type="text" id="fname" <? if (!empty($fname)) echo "value=$fname";?>><div class="highlight" id="inf_fname">&nbsp;</div>
        </th>
        <th width="22%"><input name="mname" type="text" id="mname" <? if (!empty($mname)) echo "value=$mname";?>><div class="highlight" id="inf_mname">&nbsp;</div></th>
        <th width="35%"><input name="lname" type="text" id="lname" <? if (!empty($lname))  echo "value=$lname";?>><div class="highlight" id="inf_lname">&nbsp;</div></th>
        </tr>
      <tr>
        <th><div align="right">Date of Birth </div></th>
        <th><input name="dob" type="text" id="dob" <? if (!empty($dob)) echo "value=$dob";?>>
        <div class="highlight" id="inf_dob">&nbsp;</div></th>
        <th><div align="right">Gender</div></th>
        <th><span class="style2">male</span>
            <input name="gender" type="radio" value="m"  <? if (!empty($gender) && ($gender=='m')) echo "checked";?>>
            <img src="images/male.gif" width="25" height="15"> <span class="style2">female</span>
            <input name="gender" type="radio" value="f" <? if  (!empty($gender) && ($gender=='f')) echo "checked";?>>
            <img src="images/female.gif" width="25" height="15">
            <div class="highlight" id="inf_gender">&nbsp;</div></th></tr>
      <tr>
        <th><input type="hidden" name="empid" <? if (!empty($empid)) echo "value=$empid"; ?>>
          <input type="hidden" name="action" <? if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>></th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th><input type="reset" name="Reset" value="Reset">
          <input type="submit" name="Submit" value="Submit" onClick="return validateOnSubmit()">            </th>
      </tr>
    </table> 
	</form>    
    </td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" ><table width="100%"  border="0">
      <tr>
        <th width="5%">No.</th>
        <th width="5%"><span class="style4">Name</span></th>
        <th width="10%">Date Of Birth 
        <th width="5%"><span class="style4">Gender</span>
        <th width="5%">Action              
      </tr>
	  <?
	    
		
		
	   	
		if (!empty($empid))
		{
	      $sqlstr="select * from tbl_dependants1 where empid_fk=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());;
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->fname." ".$row->mname." ".$row->lname."</td>";
		 
		    echo "<td>".dateconvert($row->dob,2)."</td>";
		    echo "<td>".$row->gender."</td>";
		  
		    echo "<td> <a href=dependants.php?depid=$row->id&action=edit>Edit</a> | <a href=dependants.php?action=delete_go&depid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
		    echo "</tr></td>";
		  }
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



