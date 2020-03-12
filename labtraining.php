<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title>Trainings</title>
	

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
	 dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('trainingdate'));
	 dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('compechieved'));
	
};
 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	//if (!validateSelect(document.forms.qualificationsfrm.compechieved,'inf_compechieved',-1))  errs += 1;
	if (!validateSelect(document.forms.qualificationsfrm.trainingdate,'inf_trainingdate',-1))  errs += 1;
	//if (!validatePresent(document.forms.qualificationsfrm.trainerid,'inf_trainerid'))  errs += 1; 
	if (!validatePresent(document.forms.qualificationsfrm.course,'inf_course'))  errs += 1; 
	if (!validateSelect(document.forms.qualificationsfrm.qlevel,'inf_qlevel',-1))  errs += 1;
	
	    
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
  
  if (!empty($_GET["empid"]))
    $empid=$_GET["empid"];
		
  if (!empty($_POST["empid"]))
   $empid=$_POST["empid"];
    
  if (!empty($empid))
  {
    $sqlstr="select * from tbl_employees inner join tbl_titles on tbl_titles.id=emptitle where tbl_employees.id=$empid";
	$query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dept = $row->dept;
	$dispname="<font face = Verdana size=2><b>For: " . $row->title." ".$row->fname." ".$row->mname." ".$row->lname;
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->empnum."</b></font>";
    
  }
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["qualid"]))
  {
    $id=$_GET["qualid"];
    $sqlstr="select * from tbl_training where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$course = $row->course;
    $empid = $row->employeeid;
    $trainingdate = dateconvert($row->trainingdate,2);
    $trainenddate = dateconvert($row->trainenddate,2);
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
    $trainerid = empty($_POST["trainerid"]) ? 'NULL' : $_POST["trainerid"];
    $trainer = empty($_POST["trainer"]) ? 'NULL' : "'" . $_POST["trainer"] . "'";
    $institution = empty($_POST["institution"]) ? 'NULL' : "'" . $_POST["institution"] . "'";	
    $trainingdate = "'".dateconvert($_POST["trainingdate"],1) ."'";
    $trainenddate = empty($_POST["trainenddate"]) ? 'NULL' : "'" . dateconvert($_POST["trainenddate"],1) . "'";
    $compechieved = empty($_POST["compechieved"]) ? 'NULL' : "'" .  dateconvert($_POST["compechieved"],1) . "'";
	$empid =  $_POST["empid"];
	$qlevel = empty($_POST["qlevel"]) ? 'NULL' : "'" . $_POST["qlevel"] . "'";
	$comments = empty($_POST["comments"]) ? 'NULL' : "'" . $_POST["comments"] . "'";
   
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_training set course=$course,institution=$institution,trainingdate=$trainingdate,compechieved=$compechieved,
	 employeeid=$empid,qlevel=$qlevel,comments=$comments,trainer=$trainer,trainerid=$trainerid where id=$id";
   else
     echo $query="insert into tbl_training(course,institution,trainingdate,trainenddate,compechieved,employeeid,qlevel,comments,trainer,trainerid)
	  values ($course,$institution,$trainingdate,$trainenddate,$compechieved,$empid,$qlevel,$comments,$trainer,$trainerid)";
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=labtraining.php?empid=$empid'>";
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
    &bull;&nbsp;<a href="labhome.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;</td>

  </tr>

  <tr>
    <td width="173" rowspan="3" nowrap id="menu"><div style="width: 150px;">
      <div style="width: 150px;">
      </div>
      <ul>
      <li><a href="labhome.php" onfocus="blurLink(this);">View Employees</a></li>
	   <li><a href="labDeptNames.php" onfocus="blurLink(this);">Add Sections</a></li>
	   <li><a href="labdesignations.php" onfocus="blurLink(this);">Add Designations</a></li>
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Kemri Units</a></li>
	  </ul>        
        
    
    </div>
    <? echo "<hr noshade size=\"3\" color=\"#eb8137\"> &nbsp;&nbsp;&nbsp;&nbsp;Employee Photo"; 
	   echo "<center><img src='viewimg.php?imgid=$empid' width=150 Height=150 ></center>"; ?>
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	<center><h2>GENERAL LABORATORY STAFF TRAINING CHECKLIST</h2></center><BR>
	<? if (!empty($dispname)) echo $dispname; ?>
	<form name="qualificationsfrm" method="post" action="labtraining.php">
	<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Section</div></th>
        <th colspan="4"><div class="highlight" id="inf_qlevel">
            <select name="DeptName" id="DeptName">
            <option value="">--SELECT--</option>
			<?php
				Lookup("id","DeptName",$dept,"SELECT id,DeptName FROM prdept WHERE depcat = 'LAB'"); 
			?>
          </select>
        </div>
        </th>
        </tr>
      <tr>
        <th><div align="right">Training Topic/SOP</div></th>
        <th colspan="4"><span class="highlight">
          <select name="course" id="course">
            <option value="">--SELECT--</option>
            <?php
				Lookup("id","title",$course,"SELECT id,title FROM tbl_course"); 
			?>
          </select>
          </span>        <div class="highlight" id="inf_course">&nbsp;</div></th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Trainer</div></th>
        <th colspan="4"><span class="highlight">
          <select name="trainerid" id="trainerid">
            <option value="">--SELECT--</option>
            <?php
				Lookup("id","trainer",$trainerid,"SELECT id,concat_ws(' ',fname,mname,lname) as trainer FROM tbl_employees WHERE trainer=1"); 
			?>
          </select>
        </span>
          <input name="trainer" type="text" id="trainer" size="50" <? if (!empty($trainer)) echo "value='$trainer'";?>>
          <span class="highlight">          </span>          <div class="highlight" id="inf_trainerid">&nbsp;</div>
		</th>
      </tr>
      <tr>
        <th width="12%"><div align="right">Training Date </div></th>
        <th width="15%"><span class="highlight">
          <input name="trainingdate" type="text" id="trainingdate" <? if (!empty($trainingdate)) echo "value=$trainingdate" ?>>
          </span>
          <div class="highlight" id="inf_trainingdate">&nbsp;</div></th>
        <th width="11%"><div align="right">Date Competency Achieved </div></th>
        <th width="20%"><span class="highlight">
          <input name="compechieved" type="text" id="compechieved" <? if (!empty($compechieved)) echo "value=$compechieved" ?>>
          </span><div class="highlight" id="inf_compechieved">&nbsp;</div></th>
      </tr>
      <tr>
        <th><div align="right">Comments</div></th>
        <th colspan="4"><textarea name="comments" cols="65"><?php echo $comments; ?></textarea></th>
      </tr>
      <tr>
        <th><input type="hidden" name="empid" <? if (!empty($empid)) echo "value=$empid"; ?>>
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
        <th width="5%"><span class="style4">Training Topic/SOP </span></th>
        <th width="10%">Trainer</th>
        <th width="5%"><span class="style4">Training Date </span></th>
        <th width="5%">Competency Achieved</th>
        <th width="5%">Action</th>  
      </tr>
	  <?
	    	
		if (!empty($empid))
		{
	      //$sqlstr="select * from tbl_training where employeeid=$empid";
		  $sqlstr="SELECT tbl_training.id,tbl_training.employeeid,tbl_training.course,tbl_training.trainerid,tbl_training.trainer,
			tbl_training.trainingdate,tbl_training.trainenddate,tbl_training.compechieved,tbl_training.comments,tbl_training.institution,
			tbl_training.qlevel,tbl_course.title 
			FROM tbl_course
			left Join tbl_training ON tbl_training.course = tbl_course.id
			WHERE employeeid=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());;
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->title."</td>";
		    echo "<td>".$row->trainer."</td>";
			 
		    echo "<td>".dateconvert($row->trainingdate,2)."</td>";
		    echo "<td>".$row->compechieved."</td>";
		  
		    echo "<td> <a href=labtraining.php?qualid=$row->id&action=edit>Edit</a></td>";
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



