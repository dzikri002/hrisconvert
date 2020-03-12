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

	<title>Add Staff Training</title>
	

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
	var dob_cal,train_cal;      
     window.onload = function () {
	 dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('trainingdate'));
	 train_cal  = new Epoch('epoch_popup','popup',document.getElementById('trainingsdate'));
	
};
 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
		
	//if (!validateSelect(document.forms.qualificationsfrm.qlevel,'inf_qlevel',-1))  errs += 1;
	if (!validateSelect(document.forms.qualificationsfrm.compechieved,'inf_compechieved',-1))  errs += 1;
	if (!validateSelect(document.forms.qualificationsfrm.trainingsdate,'inf_trainingsdate',-1))  errs += 1;
	if (!validateSelect(document.forms.qualificationsfrm.trainingdate,'inf_trainingdate',-1))  errs += 1;
	if (!validatePresent(document.forms.qualificationsfrm.trainerid,'inf_trainerid'))  errs += 1;
	if (!validatePresent(document.forms.qualificationsfrm.course,'inf_course'))  errs += 1; 
	    
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
  
  if (!empty($_GET["id"]))
    $id=$_GET["id"];
	
 	
  if (!empty($_POST["id"]))
   $id=$_POST["id"];
    
 if (!empty($_GET["empid"]))
    $empid=$_GET["empid"];
		
  if (!empty($_POST["empid"]))
   $empid=$_POST["empid"];
    
  if (!empty($empid))
  {
    $sqlstr="select * from prmember left join tbl_titles on tbl_titles.id=emptitle where prmember.memberno=$empid";
    $query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Add Training Details for: <a href=employees.php?empid=$row->MemberNo&action=edit>" . $row->title. $row->FullName."</a>";
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->MemberNo."</b></font>";
    
  }
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["qualid"]) && $action="edit")
  {
    $id=$_GET["qualid"];
    $sqlstr="select * from tbl_training where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$course = $row->course;
    $empid = $row->employeeid;
    $trainingdate = dateconvert($row->trainingdate,2);
    $trainingsdate = dateconvert($row->trainingsdate,2);
	$institution=$row->institution;
    $compechieved = $row->compechieved;
	$comments = $row->comments;
	$trainer = $row->trainer;
	$trainerid = $row->trainerid;
	
 
    $id=  $row->id;
  }
  
  if (!empty($_POST["course"]))
  { 

    $course = "'".$_POST["course"]."'";
    $trainer = empty($_POST["trainer"]) ? 'NULL' : "'" . $_POST["trainer"] . "'";
   
    $trainingdate = "'".dateconvert($_POST["trainingdate"],1) ."'";
	$trainingsdate = "'".dateconvert($_POST["trainingsdate"],1) ."'";
    //$trainenddate = empty($_POST["trainenddate"]) ? 'NULL' : "'" . dateconvert($_POST["trainenddate"],1) . "'";
    $compechieved = empty($_POST["compachieved"]) ? 'NULL' : "'" .  $_POST["compachieved"]. "'";
	$empid =  $_POST["empid"];
	//$qlevel = empty($_POST["qlevel"]) ? 'NULL' : "'" . $_POST["qlevel"] . "'";
	$comments = empty($_POST["comments"]) ? 'NULL' : "'" . $_POST["comments"] . "'";
   
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_training set course=$course,trainingdate=$trainingdate,compechieved=$compechieved,
	 employeeid=$empid,comments=$comments,trainer=$trainer,trainingsdate=$trainingsdate where id=$id";
   else
      $query="insert into tbl_training(course,trainingdate,compechieved,employeeid,comments,trainer,trainingsdate)
	  values ($course,$trainingdate,$compechieved,$empid,$comments,$trainer,$trainingsdate)";
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=soptraining.php?empid=$empid'>";
	}
   }
   
   
  }
    //process delete
  if ($action=="delete_go")
  {
   $sqlstr="delete from tbl_training where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=soptraining.php?empid=$empid'>";
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
    <? echo "<hr noshade size=\"3\" color=\"#eb8137\"> &nbsp;&nbsp;&nbsp;&nbsp;Employee Photo"; 
	   echo "<center><img src='viewimg.php?imgid=$empid' width=150 Height=150 ></center>"; ?>
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	    <? if (!empty($dispname)) echo $dispname; ?>
	</h2></center>
	<form name="qualificationsfrm" method="post" action="soptraining.php">
	<table width="100%"  border="0">
      <tr>
        <th><div align="right">Course Trained </div></th>
        <th colspan="4"><span class="highlight">
          </span>        
            <input name="course" type="text" id="course" size="50" <? if (!empty($course)) echo "value='$course'";?>>
			<div class="highlight" id="inf_course">&nbsp;</div>
          </th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Trainer</div></th>
        <th colspan="2"><span class="highlight">
        </span>
          <input name="trainer" type="text" id="trainer" size="50" <? if (!empty($trainer)) echo "value='$trainer'";?>>
          <span class="highlight">          </span>          <div class="highlight" id="inf_trainerid">&nbsp;</div>
		</th>
        <th>Training Start date </th>
        <th><span class="highlight">
          <input name="trainingsdate" type="text" id="trainingsdate" <? if (!empty($trainingsdate)) echo "value=$trainingsdate" ?>>
		   <div class="highlight" id="inf_trainingsdate">&nbsp;</div></th>
        </span></th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Training End Date </div></th>
        <th width="15%"><span class="highlight">
          <input name="trainingdate" type="text" id="trainingdate" <? if (!empty($trainingdate)) echo "value=$trainingdate" ?>>
          </span>
          <div class="highlight" id="inf_trainingdate">&nbsp;</div></th>
        <th width="11%"><div align="right">Competency Achieved </div></th>
        <th width="20%"><span class="highlight">
        <select name="compachieved" id="compachieved">
          <option value="">--SELECT--</option>
          <? Loadlookup("id","qlevel","tbl_qlevels",$compechieved,$d); ?>
        </select>
</span>
          <div class="highlight" id="inf_compechieved">&nbsp;</div></th>
      </tr>
      <tr>
        <th><div align="right">Comments</div></th>
        <th colspan="4"><textarea name="comments" cols="65"><?php echo $comments; ?></textarea></th>
      </tr>
      <tr>
        <th><input type="hidden" name="courseid" <? if (!empty($courseid)) echo "value=$courseid"; ?>>
		<input type="hidden" name="empid" <? if (!empty($empid)) echo "value=$empid"; ?>>
          <input type="hidden" name="action" <? if (!empty($action))  echo "value=$action"; ?>>
		  <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>></th>
        <th colspan="4"><div align="right">
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
        <th width="5%"><span class="style4">Training course </span></th>
        <th width="10%">Trainer</th>
		 <th width="5%"><span class="style4">Training Start Date </span></th>
        <th width="5%"><span class="style4">Training End Date </span></th>
        <th width="5%">Competency Achieved</th>
        <th width="5%">Action</th>  
      </tr>
	  <?	    	
		if (!empty($empid)){
	      //$sqlstr="select * from tbl_training where employeeid=$empid";
		 $sqlstr="select tbl_training.id,tbl_training.employeeid,tbl_training.course,tbl_training.trainerid,tbl_training.trainer,trainingsdate,tbl_training.trainingdate,tbl_training.compechieved,
         tbl_training.comments,tbl_qlevels.qlevel from tbl_training left join tbl_qlevels on tbl_training.compechieved = tbl_qlevels.id where employeeid=$empid";
		 // echo $sqlstr;
		  $result=$d->query($sqlstr) or die(mysql_error());;
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->course."</td>";
		    echo "<td>".$row->trainer."</td>";
			echo "<td>".dateconvert($row->trainingsdate,2)."</td>";
		    echo "<td>".dateconvert($row->trainingdate,2)."</td>";
		    echo "<td>".$row->qlevel."</td>";
		  
		    echo "<td> <a href=soptraining.php?qualid=$row->id&action=edit>Edit</a> | <a href=soptraining.php?action=delete_go&qualid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
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



