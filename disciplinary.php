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

	<title>Disciplinary</title>
	

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
	 dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('discipdate'));
	
};
 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validateSelect(document.forms.disciplinaryfrm.discipreasons,'inf_discipreasons',-1))  errs += 1;
	if (!validateSelect(document.forms.disciplinaryfrm.discipdate,'discipdate',-1))  errs += 1;
	if (!validatePresent(document.forms.disciplinaryfrm.discipaction,'inf_discipaction'))  errs += 1; 

	    
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
   $empid=$_POST["empid"];
    
  if (!empty($empid))
  {
    $sqlstr="select * from prmember left join tbl_titles on tbl_titles.id=emptitle where prmember.memberno=$empid";
    $query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Add Disciplinary Details for: <a href=employees.php?empid=$row->MemberNo&action=edit>" . $row->title. $row->FullName."</a>";
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->MemberNo."</b></font>";
    
  }
  
  if (!empty($_GET["daction"]))
    $daction=$_GET["daction"];

  //echo $action;
  
  
  if (!empty($_GET["discipid"]))
  {
    $id=$_GET["discipid"];
    $sqlstr="select * from tbl_disciplinary where id=$id";

	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$desigid = $row->id;
    $empid = $row->empid_fk;
   	$action=$row->action;
    $discipdate = dateconvert($row->dispdate,2);
	$discipreasons=$row->reasons;
	$months=$row->months;
 
    $id=  $row->id;
  }
  
  if (!empty($_POST["discipaction"]))
  { 
  
    $discipaction = "'".$_POST["discipaction"]."'";
    $discipdate = empty($_POST["discipdate"]) ? 'NULL' : "'" . dateconvert($_POST["discipdate"],1) . "'";
	$months = empty($_POST["months"]) ? 'NULL' : "'" . $_POST["months"] . "'";
    $discipreasons = "'".$_POST["discipreasons"]."'";
   	$empnum=  "'".$_POST["empid"]."'";
   
    $daction =$_POST["daction"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($daction) && ($daction=="edit"))
     $query="update tbl_disciplinary set dispdate=$discipdate,reasons=$discipreasons,action=$discipaction,empid_fk=$empnum,months=$months where id=$id";
   else
     $query="insert into tbl_disciplinary (dispdate,reasons,action,empid_fk,months) values ($discipdate,$discipreasons,$discipaction,$empnum,$months)";
   
   //echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=disciplinary.php?empid=$empid'>";
	}
   }
   
   
  }
  
    //process delete
  if ($daction=="delete_go")
  {
   $sqlstr="delete from tbl_disciplinary where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=disciplinary.php?empid=$empid'>";
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
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">add units</a></li>
	  </ul>        
        
    
    </div>
    <? echo "<hr noshade size=\"3\" color=\"#eb8137\"> &nbsp;&nbsp;&nbsp;&nbsp;Employee Photo"; 
	   echo "<center><img src='viewimg.php?imgid=$empid' width=150 Height=150 ></center>"; ?>
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	<? if (!empty($dispname)) echo $dispname; ?>
<form name="disciplinaryfrm" method="post" action="disciplinary.php">
<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Disciplinary Action </div></th>
        <th colspan="2">          
              <select name="discipaction" id="discipaction">
             <option value="">--SELECT--</option>
             <? Loadlookup("id","action_name","tbl_discipaction",$action,$d); ?>
           </select> 
            <div class="highlight" id="inf_discipaction"></div>
        </th></tr>
      <tr>
        <th width="20%"><div align="right">Disciplinary Date</div></th>
        <th colspan="2"><input name="discipdate" type="text" id="discipdate"  <? if (!empty($discipdate)) echo "value=$discipdate"; ?>>		
          <div class="highlight" id="inf_discipdate">&nbsp;</div>
		</th>
      </tr>
      <tr>
        <th><div align="right">Disregard After </div></th>
        <th><input name="months" type="text" id="months" <? if (!empty($months)) echo "value=$months"; ?>> 
          months</th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Disciplinary Reasons </div></th>
        <th width="15%"><textarea name="discipreasons" cols="50" id="discipreasons"><?  if (!empty($discipreasons)) echo $discipreasons?></textarea>
		 <div class="highlight" id="inf_discipreasons">&nbsp;</div>
          </th>
        </tr>
      <tr>
        <th><input type="hidden" name="empid" <? if (!empty($empid)) echo "value=$empid"; ?>>
          <input type="hidden" name="daction" <? if (!empty($daction)) echo "value=$daction"; ?>>
		  <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>>
		  </th>
        <th colspan="2"><div align="right">
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
        <th width="5%">Disciplinary Action </th>
        <th width="5%"><span class="style4">Disciplinary Date </span></th>
        <th width="5%">Disregard After(Months)</th>
		<th width="10%">Reasons</th>
        <th width="10%">Action</th>
      </tr>
	  <?
	    	
		if (!empty($empid))
		{
	      $sqlstr="select dispdate,reasons,empid_fk,action,tbl_disciplinary.id,action_name,months from tbl_disciplinary
           inner join tbl_discipaction on tbl_discipaction.id=tbl_disciplinary.action where empid_fk=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->action_name."</td>";			
		    echo "<td>".dateconvert($row->dispdate,2)."</td>";
			echo "<td>".$row->months."</td>";
			echo "<td>".$row->reasons."</td>";
					  
		    echo "<td> <a href=disciplinary.php?discipid=$row->id&daction=edit>Edit</a>| <a href=disciplinary.php?daction=delete_go&discipid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
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



