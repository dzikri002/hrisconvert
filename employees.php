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
	<link rel="stylesheet" href="../corehrmis/js/example.css" TYPE="text/css" MEDIA="screen">
	<link href="css/text.css" rel="stylesheet" type="text/css" />

	<title> Employees Data/Profile</title>
<style type="text/css">
<!--
.style2 {font-size: x-small}
.style3 {	color: #FFFFFF;
	font-weight: bold;
}
.style4 {color: #FFFFFF}
.info   { color: black; background-color: transparent; font-weight: normal; }
  .warn   { color: rgb(120,0,0); background-color: transparent; font-weight: normal; }
  .error  { color: red; background-color: transparent; font-weight: bold }
-->
</style>
 <style type="text/css">
<!--
.style7 {
	color: #FF0000;
	font-size: 9px;
	font-family: "Courier New", Courier, mono;
}
.style8 {
	background-color: transparent;
	color: red;
	font-size: 12px;
}
-->
 </style>
 <link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>
 <script type="text/javascript" src="css/epoch_classes.js"></script>
 <script language="JavaScript" src="js/calendar1.js"></script><!--  -->
 <script type="text/javascript" src="js/formval.js"></script>
 <script type="text/javascript">
/*You can also place this code in a separate file and link to it like epoch_classes.js*/
	var dp_cal,dob_cal,d_iss,d_exp,d_eff,d_act,d_qdate;
		  
    window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('empdate'));
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('dob'));
	d_iss  = new Epoch('epoch_popup','popup',document.getElementById('issuedate'));
	d_exp = new Epoch('epoch_popup','popup',document.getElementById('expdate'));
	d_eff = new Epoch('epoch_popup','popup',document.getElementById('effdate'));
	d_act = new Epoch('epoch_popup','popup',document.getElementById('actdate'));
	d_qdate= new Epoch('epoch_popup','popup',document.getElementById('qdate'));
  };
function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validatePresent(document.forms.employeefrm.expdate,'inf_expdate')) errs += 1; 
	if (!validatePresent(document.forms.employeefrm.effdate,'inf_effdate')) errs += 1; 
	if (!validateSelect(document.forms.employeefrm.stationcode,'inf_stn',-1))  errs += 1;
	
	if (!validateSelect(document.forms.employeefrm.terms,'inf_tos',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.DeptName,'inf_DeptName',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.position,'inf_position',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.empstatus,'inf_empstatus',-1))  errs += 1;
	if (!validatePresent(document.forms.employeefrm.qdate,'inf_qdate')) errs += 1; 
	if (!validateSelect(document.forms.employeefrm.unit,'inf_unit',-1))  errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.basicpay,'inf_basicpay')) errs += 1; 
	
	
	if (!validatePresent(document.forms.employeefrm.accnum,'inf_accno')) errs += 1; 
	if (!validatePresent(document.forms.employeefrm.bank,'inf_bank')) errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.empdate,'inf_empdate')) errs += 1; 
	//if (!validatePresent(document.forms.employeefrm.nssfnum,'inf_nssfnum'))  errs += 1; 
	if (!validatePresent(document.forms.employeefrm.pin,'inf_pin'))  errs += 1; 
	
	if (!validateSelect(document.forms.employeefrm.maritalstat,'inf_maritalstat',-1))  errs += 1;  
	if (!validatePresent(document.forms.employeefrm.idnum,'inf_idnum'))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.nationality,'inf_nationality',-1))  errs += 1;
	
	if (!validateCheckbox(document.forms.employeefrm.gender,'inf_gender',1))  errs += 1; 
	if (!validatePresent(document.forms.employeefrm.pbirth,'inf_pbirth'))  errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.payrollnum,'inf_payrollnum'))  errs += 1;
	if (!validatePresent(document.forms.employeefrm.jobgrp,'inf_jobgrp'))  errs += 1;
	if (!validatePresent(document.forms.employeefrm.dob,'inf_dob'))  errs += 1; 
	if (!validatePresent(document.forms.employeefrm.prefnames,'inf_pnames'))  errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.lname,'inf_lname'))  errs += 1;
	if (!validatePresent(document.forms.employeefrm.fname,'inf_fname'))  errs += 1; 
	 
	
	if (errs>1)  alert('There are fields which need correction before submitting');
    if (errs==1) alert('There is a field which needs correction before submitting');
   	
    return (errs==0);
};
</script>


</head>
<body bgcolor="#FFFFFF">
<? 

 if (empty($_SESSION["username"]))
    die("<center><font color=red>You have not yet Logged in.<a href=../corehrmis/login.php>Please click here to log in.</a></font></center>");
 else
   $username = $_SESSION["username"];
   
  $today=date("Y-m-d h:m:s");
  
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
   
  if (!empty($_REQUEST["empid"]))
  {
    $id=$_REQUEST["empid"];
	$action = "update_go";
    $sqlstr="select * from prmember where memberno = '$id'";
	$sqlresult=$d->query($sqlstr);
	
	
	    $row=$d->fetch_object($sqlresult);
	 
	    $emptitle = $row->emptitle;  
		$rowid = $row->rowid;
	    $fname=$row->LastName;
	    if (empty($row->OtherNames)){
		  $othernames=explode(" ",$row->FullName);
		}  
		else
		{
		  $othernames=explode(" ",$row->OtherNames);
		  $mname=$othernames[0];
		}   
		
	    $lname=$othernames[1];
	    $empnum=$row->MemberNo;
	    
	    $prefnames=$fname;
	    $dob=datetimeconvert($row->BirthDate,2);
	    $placeofbirth=$row->placeofbirth;
	   
	     if (stristr($row->Sex,'Male') || stristr($row->Sex,'M'))
		   $gender='m';
		   
		if (stristr($row->Sex,'Female') || stristr($row->Sex,'F'))
		   $gender='f';;
		     
	   // $gender=$row->Sex;
	    $marital_status=$row->MaritalStatus;
	    $pin=$row->PINNumber;
	    $nssfnum=$row->NSSFNo;
	   
		$nationality=$row->nationality;
		$nhifnum=$row->NHIFNO;
		$empdate=datetimeconvert($row->EmpDate,2);
		$national_idnum=$row->IDNumber;
		$curr_res=$row->curr_res;
		$homeres=$row->homeres;
		
		$physical=$row->physical;
		$province=$row->province;
		$currdescrip=$row->currdescrip;
		$district=$row->district;
		$street=$row->street;
		
		$division=$row->division;
		$estate=$row->estate;
		$location=$row->location;
		$town=$row->town;
	    $sublocation=$row->sublocation;
		$postaladdr=$row->postaladdr;
		$phonenum=$row->phonenum;
		$unit_fk=$row->unit_fk;
		$suspended=$row->Suspended;
		
		$dlnum=$row->dlnum;
		$empstatus_fk=$row->empstatus_fk;
		$bankcode=$row->BankCode;
		
		if (!empty($datedlissued)) 
		  $datedlissued=dateconvert($row->datedlissued,2);
				  
		$position_fk=$row->position_fk;
		$dlclasses=$row->dlclasses;
		$dept=$row->Dept;
		
		$bank=$row->bankid_fk;
		$basicpay=$row->BasicPay;
		$branch=$row->branchid_fk;
		$accnum=$row->AccountNo;
		$jobgroup=$row->JobGroup;
		$numhrs=$row->M_days_Hrs;
		$monthid=$row->IncrMonth;
		$hpayrate=$row->Hr_PayRate;
		$housed = $row->Housed;
		
		$rentpayemp=$row->HouseCost;
		$stationcode = $row->Station;
		
		if (!empty($row->QuitDate)) 
	    $expdate=datetimeconvert($row->QuitDate,2);
	    
		$termsid=$row->termsid_fk;
		
		if (!empty($row->effdate)) 
		  $effdate=datetimeconvert($row->effdate,2);
	  
	   $actpos=$row->actposition;
	   $actscale=$row->actscale;
	 
	   if (!empty($row->acteffdate)) 
	     $acteffdate=datetimeconvert($row->acteffdate,2);
	 
	
  }
  else
    $action="add";
  // variable assignment;
  
  if (!empty($_POST["fname"]))
  { 
    $emptitle = empty($_POST["emptitle"]) ? 'NULL' : "'" . $_POST["emptitle"] . "'";
    $fname = "'".$_POST["fname"]."'";
	$memberno= "'".$_POST["memberno"]."'";
     
	if (empty($_POST["mname"])){
     $fullname ="'".$_POST["fname"]." ".$_POST["lname"]."'";
	 $mname='Null';
	 }
	else{
     $mname = "'".$_POST["mname"]." ".$_POST["lname"]."'";
	 $fullname = "'".$_POST["fname"]." ".$_POST["mname"]." ".$_POST["lname"]."'";
	 }
	
 
	
    $prefnames = "'".$_POST["prefnames"]."'";
    $empnum = "'".$_POST["payrollnum"]."'";
	$rowid= $_POST["rowid"];
	$basicpay="'".$_POST["basicpay"]."'";
  
    $dob = "'".datetimeconvert($_POST["dob"],1)."'";
    $placeofbirth="'".$_POST["pbirth"]."'";
    $gender="'".$_POST["gender"]."'";
    $marital_status="'".$_POST["maritalstat"]."'";
    $pin="'".$_POST["pin"]."'";
    $nssfnum="'".$_POST["nssfnum"]."'";
    $nationality="'".$_POST["nationality"]."'";
    $nhifnum=empty($_POST["nhifnum"]) ? 'NULL' : "'" . $_POST["nhifnum"] . "'";
    $empdate="'".datetimeconvert($_POST["empdate"],1)."'";
    $national_idnum="'".$_POST["idnum"]."'";
  
    $curr_res= empty($_POST["curr_res"]) ? 'NULL' : "'" . $_POST["curr_res"] . "'";
    $homeres= empty($_POST["homeres"]) ? 'NULL' : "'" . $_POST["homeres"] . "'";
    $physical=empty($_POST["physical"]) ? 'NULL' : "'" . $_POST["physical"] . "'";
    $currdescrip= empty($_POST["currdesc"]) ? 'NULL' : "'" . $_POST["currdesc"] . "'";
  
    $province= empty($_POST["province"]) ? 'NULL' : "'" . $_POST["province"] . "'";
    $district=empty($_POST["district"]) ? 'NULL' : "'" . $_POST["district"] . "'";
    $street= empty($_POST["street"]) ? 'NULL' : "'" . $_POST["street"] . "'";
    $estate= empty($_POST["estate"]) ? 'NULL' : "'" . $_POST["estate"] . "'";
    $division= empty($_POST["division"]) ? 'NULL' : "'" . $_POST["division"] . "'";
  
    $location=empty($_POST["location"]) ? 'NULL' : "'" . $_POST["location"] . "'";
    $town=empty($_POST["town"]) ? 'NULL' : "'" . $_POST["town"] . "'";
    $sublocation=empty($_POST["sublocation"]) ? 'NULL' : "'" . $_POST["sublocation"] . "'";
    $padress=empty($_POST["padress"]) ? 'NULL' : "'" . $_POST["padress"] . "'";
    $phonenum=empty($_POST["phonenum"]) ? 'NULL' : "'" . $_POST["phonenum"] . "'";
   
    $unit = empty($_POST["unit"]) ? 'NULL' : "'" . $_POST["unit"] . "'";
    $dlnum = empty($_POST["dlnum"]) ? 'NULL' : "'" . $_POST["dlnum"] . "'";
    $empstatus = empty($_POST["empstatus"]) ? 'NULL' : "'" . $_POST["empstatus"] . "'";
    $issuedate = empty($_POST["issuedate"]) ? 'NULL' : "'" .dateconvert($_POST["issuedate"],1) . "'";
    $position = empty($_POST["position"]) ? 'NULL' : "'" . $_POST["position"] . "'"; 
  
    $class = empty($_POST["class"]) ? 'NULL' : "'" . $_POST["class"] . "'";
    $DeptName = empty($_POST["DeptName"]) ? 'NULL' : "'" . $_POST["DeptName"] . "'";
	
	$bank="'".$_POST["bank"]."'";
	
	$basicpay="'".$_POST["basicpay"]."'";
	$accnum="'".$_POST["accnum"]."'";
	$jobgroup=empty($_POST["jobgrp"]) ? 'NULL' : "'" . $_POST["jobgrp"] . "'";
	$stationcode= empty($_POST["stationcode"]) ? 'NULL' : "'" . $_POST["stationcode"] . "'";
	$numhrs= empty($_POST["numhrs"]) ? '0' : "'" . $_POST["numhrs"] . "'";
	$monthid= empty($_POST["incmonth"]) ? '0' : "'" . $_POST["incmonth"] . "'";
	$hpayrate=empty($_POST["hpayrate"]) ? '0' : "'" . $_POST["hpayrate"] . "'";
	$housed=empty($_POST["housed"]) ? '0' : "'" . $_POST["housed"] . "'";
	$rentpayemp=empty($_POST["rentpayemp"]) ? '0' : "'" . $_POST["rentpayemp"] . "'";
	
	$actscale=empty($_POST["scale"]) ? 'NULL' : "'" . $_POST["scale"] . "'";
    $acteffdate=empty($_POST["actdate"]) ? 'Null' : "'" .dateconvert($_POST["actdate"],1) . "'";
	$qdate=empty($_POST["qdate"]) ? 'Null' : "'" .dateconvert($_POST["qdate"],1) . "'";
	$actpos=empty($_POST["actpos"]) ? 'NULL' : "'" . $_POST["actpos"] . "'";
	
	$expdate=empty($_POST["expdate"]) ? 'Null' : "'" .dateconvert($_POST["expdate"],1) . "'"; 
    $endprd= getperiodfromdate($_POST["expdate"]);
	
	$effdate="'".dateconvert($_POST["effdate"],1)."'";
	$termsid="'".$_POST["terms"]."'";
	$action=$_POST["action"];
	$id=$_POST["id"];
  }
  
  
  if (!empty($_POST["fname"]))
  {
     
	 //check if suspended suspend from payroll
	 if (stristr($empstatus,'1'))
	   $suspended=0;
	 else
	   $suspended=-1;
	 //check if quit date is null
	  
	
	
    if ($action=="update_go")
    {
	  //check if suspended 
	
      $query="update prmember set 
	  emptitle=$emptitle,
	  lastname=$fname,
	  othernames=$mname,
	  fullname=$fullname,
	  birthdate=$dob,
	  placeofbirth=$placeofbirth,
	  sex=$gender,
	  maritalstatus=$marital_status,
	  PINNumber=$pin,
	  nssfno=$nssfnum,
	  nationality=$nationality,
	  NHIFNO=$nhifnum,
	  empdate=$empdate,
	  IDNumber=$national_idnum,
	  curr_res=$curr_res,
	  homeres=$homeres,
	  physical=$physical,
	  province=$province,
	  currdescrip=$currdescrip,
	  district=$district,
	  street=$street,
	  division=$division,
	  estate=$estate,
	  location=$location,
	  town=$town,
	  basicpay=$basicpay,
	  sublocation=$sublocation,
	  postaladdr=$padress,
	  phonenum=$phonenum,
	  unit_fk=$unit,
	  dlnum=$dlnum,
	  empstatus_fk=$empstatus,
	  datedlissued=$issuedate,
	  position_fk=$position,
	  dlclasses=$class,
	  dept=$DeptName,
	  bankid_fk=$bank,
	  AccountNo=$accnum,
	  bankcode=$bank,
	  quitdate=$expdate,
	  effdate=$effdate,
	  termsid_fk=$termsid,
	  Hr_PayRate=$hpayrate,
	  station=$stationcode,
	  M_days_Hrs=$numhrs,
	  IncrMonth=$monthid,
	  Housed=$housed,
	  HouseCost=$rentpayemp,
	  endprd='$endprd',
	  acteffdate=$acteffdate,
	  actscale=$actscale,
	  actposition=$actpos,
	  updatedby='$username',
	  updatedon='$today',
      memberno=$empnum,
	  jobgroup=$jobgroup
	  where rowid=$rowid";
	
	
    }
    else
   { 
     $datetoday=date('d-m-Y');
     $period=getperiodfromdate($datetoday);
	 
      $query="insert into prmember (memberno,emptitle,lastname,fullname,othernames,birthdate,placeofbirth,sex,maritalstatus,PINNumber,nssfno,nationality,
	  NHIFNO,empdate,IDNumber,curr_res,homeres,physical,province,currdescrip,district,street,division,estate,location,town,sublocation,
	  postaladdr,phonenum,unit_fk,dlnum,empstatus_fk,datedlissued,position_fk,dlclasses,dept,bankid_fk,AccountNo,bankcode,
	  effdate,termsid_fk,basicpay,jobgroup,station,M_days_Hrs,IncrMonth,Housed,HouseCost,Hr_PayRate,endprd,period,acteffdate,actscale,actposition,quitdate,suspended,addedby,addedon) values ($empnum,$emptitle,$fname,$fullname,$mname,$dob,$placeofbirth,$gender,$marital_status,$pin,$nssfnum,$nationality,$nhifnum,$empdate,$national_idnum,$curr_res,
	   $homeres,$physical,$province,$currdescrip,$district,$street,$division,$estate,$location,$town,$sublocation,$padress,$phonenum,$unit,$dlnum,
	   $empstatus,$issuedate,$position,$class,$DeptName,$bank,$accnum,$bank,$effdate,$termsid,$basicpay,$jobgroup,$stationcode,$numhrs,$monthid,$housed,$rentpayemp,$hpayrate,'$endprd','$period',$acteffdate,$actscale,$actpos,$qdate,-1,'$username','$today')";
		
  }
    
 // echo $query."<br>";	
  if (!empty($query))
  {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=index.php'>";
	}
  }
 }
 ?>

 <form action="employees.php" method="post" name="employeefrm">
<table  id="main" cellspacing="0" cellpadding="0" width="70%">
  <tr>
    <td colspan="2" id="cell_top">
     <br>
    </td>
  </tr>

  <tr>
    <td colspan="2" >&bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;<a href="logout.php?reset=1">Log Out</a></td>
  </tr>
  <tr>
    <td width="100" nowrap id="menu"><div style="width: 150px;">
      <div style="width: 150px;">
            <hr noshade size="3" color="#eb8137">
			<?
			if (!empty($id))  
			  echo "<center><img src='viewimg.php?imgid=$id' width=150 Height=150 ></center>"; ?>
			<hr noshade size="3" color="#eb8137">
            
      </div>
      <ul>
	
	   <li><a href="employees.php" onfocus="blurLink(this);">Add Employees</a></li>
	     <li> <a href="index.php" onfocus="blurLink(this);">View Employees</a></li>
	   <li><a href="addbank.php" onfocus="blurLink(this);">Add Banks</a></li>
	   
	   <li><a href="adddepartments.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="adddesignations.php" onfocus="blurLink(this);">Add Designations</a></li>
	   <li><a href="adddesignations.php" onfocus="blurLink(this);">Add Nationalities </a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Units</a></li></ul>
	   <? if (!empty($id)){ echo "<hr noshade size=\"3\" color=\"#eb8137\"><ul><li> <a href=\"nextofkin.php?empid=$id\" onfocus=\"blurLink(this)\">Next of Kin</a></li>"; 
      echo "<li> <a href=\"dependants.php?empid=$id\" onfocus=\"blurLink(this)\">Dependants</a></li>
	   <li><a href=\"qualifications.php?empid=$id\" onfocus=\"blurLink(this)\">Qualifications</a></li>
      <li><a href=\"promotions.php?empid=$id\" onfocus=\"blurLink(this)\">Promotions</a></li>"; }
	  
      if (!empty($id)) 
	  {
	   echo "<li><a href=\"javascript:attachdocs($id)\">Attach Documents</a></li>
	  <li><a href=\"viewattacheddocs.php?empid=$id\">View Attachments</a></li>
	   <li><a href=\"applyleave.php?empid=$id\">Leave Applications</a></li>
	  <li><a href=\"publications.php?empid=$id\" onfocus=\"blurLink(this)\">Publications</a></li>
      <li><a href=\"appointments.php?empid=$id\" onfocus=\"blurLink(this)\">Appointments</a></li>";
	   echo "<li><a href=\"../corehrmis/soptraining.php?empid=$id\" onfocus=\"blurLink(this);\">Training</a></li>";
	   echo "<a href=\"disciplinary.php?empid=$id\" onfocus=\"blurLink(this)\"><li>Disciplinary</li></a>";
	   echo "<a href=\"appraisal.php?empid=$id\" onfocus=\"blurLink(this)\"><li>Staff Appraisal</li></a>";
	   
	    } ?>
     
      <? if (!empty($id)) echo "<li><a href=\"javascript:showmore($id)\">Upload Picture </a></li>";  ?>
      </ul>        
          
          <p>&nbsp;</p>
    </div>

    </td>
    <td width="80%" rowspan="2" bgcolor="#FFFFFF" ><table width="30%"  border="0">
        <tr>
          <th width="100" scope="col"><span class="style4">Personal Details </span></th>
          <th colspan="2" class="style7" scope="col">Fields Marked (*) are Required            </th>
          <th class="style7" scope="col"><div align="right" class="style8"></div></th>
          <th class="style7" scope="col"><div class="highlight" id="inf_memberno">&nbsp;</div></th>
        </tr>
        <tr>
          <td><div align="right"><strong>Names</strong>*:</div></td>
          <td width="100"><select name="emptitle"> <option value="">--SELECT--</option> <?php Loadlookup("id","title","tbl_titles",$emptitle,$d) ?>
            </select>
          <td><input name="fname" type="text" id="fname" <? if (!empty($fname)) echo "value=$fname"; ?>><div class="highlight" id="inf_fname">&nbsp;</div></td>
          <td width="100"><input name="mname" type="text" id="mname" <? if (!empty($mname)) echo "value=$mname"; ?>>&nbsp;
          <td width="100"><input name="lname" type="text" id="lname" <?  if (!empty($lname)) echo "value=$lname"; ?>><div class="highlight" id="inf_lname">&nbsp;</div></td>
        </tr>
        <tr>
          <td nowrap><div align="right"><strong>Preferred Names*: </strong></div></td>
          <td colspan="2"><input name="prefnames" type="text" id="prefnames" <? if (!empty($prefnames))  echo "value=$prefnames"; ?>><div class="highlight" id="inf_pnames">&nbsp;</div></td>
          <td><div align="right"><strong>Date of Birth: *</strong></div>
          <td><input name="dob" type="text" id="dob"  <? if (!empty($dob)) echo "value=$dob"; ?>>  <div class="highlight" id="inf_dob">&nbsp;</div></td>        </tr>
        <tr>
          <td nowrap><div align="right"><strong>Payroll No: </strong></div></td>
          <td colspan="2"><input name="payrollnum" type="text" id="payrollnum" <? if (!empty($empnum)) echo "value=$empnum"; ?>><div class="highlight" id="inf_payrollnum">&nbsp;</div></td>
          <td><div align="right"><strong>Place of Birth:</strong> </div>
          <td><input name="pbirth" type="text" id="pbirth" <? if (!empty($placeofbirth)) echo "value=$placeofbirth"; ?>><div class="highlight" id="inf_pbirth" >&nbsp;</div></td>
        </tr>
        <tr>
          <td><div align="right"><strong>Gender:</strong></div></td>
          <td colspan="2" nowrap><span class="style2">male</span>
              <input name="gender" type="radio" value="m"  <? if (!empty($gender) && ($gender=='m')) echo "checked";?>>
              <img src="images/male.gif" width="25" height="15"> <span class="style2">female</span>
              <input name="gender" type="radio" value="f" <? if (!empty($gender) && ($gender=='f')) echo "checked";?>>
              <img src="images/female.gif" width="25" height="15"><div class="highlight" id="inf_gender">&nbsp;</div>
            <td><div align="right"><strong>Nationality:</strong> </div>
          <td><select name="nationality" id="nationality"> 
            <option value="">--SELECT--</option>
		  <? Loadlookup("id","countryname","tbl_countries1",$nationality,$d); ?>
            </select><div class="highlight" id="inf_nationality">&nbsp;</div></td>
        </tr>
        <tr>
          <td><div align="right"><strong>ID No:/Pass No:</strong></div></td>
          <td colspan="2"><input name="idnum" type="text" id="idnum" <? if (!empty($national_idnum)) echo "value=$national_idnum" ?>><div class="highlight" id="inf_idnum">&nbsp;</div></td>
          <td><div align="right"><strong>Marital Status: </strong></div>
          <td><select name="maritalstat"><option value="">--SELECT--</option>
		  <? Loadlookup("id","description","tbl_maritalstatus",$marital_status,$d); ?>
            </select><div class="highlight" id="inf_maritalstat">&nbsp;</div>
			
        </tr>
        <tr>
          <td><div align="right"><strong>PIN:</strong></div></td>
          <td colspan="2"><input name="pin" type="text" id="pin" <? if (!empty($pin)) echo "value=$pin" ?>><div class="highlight" id="inf_pin">&nbsp;</div>
            <td><div align="right"><strong>NSSF NO: </strong> </div>
          <td><input name="nssfnum" type="text" id="nssfnum" <? if (!empty($nssfnum)) echo "value=$nssfnum" ?>><div class="highlight" id="inf_nssfnum">&nbsp;</div>
        </tr>
        <tr>
          <td><div align="right"><strong>NHIF NO:</strong></div></td>
          <td colspan="2"><input name="nhifnum" type="text" id="nhifnum" <? if (!empty($nhifnum)) echo "value=$nhifnum" ?>>              <td><div align="right"><strong>Employment Date: </strong> </div>
          <td><input name="empdate" type="text" id="empdate" <? if (!empty($empdate)) echo "value=$empdate" ?>><div class="highlight" id="inf_empdate">&nbsp;</div> </td></tr>
        <tr>
          <td><div align="right"><strong>Bank Code </strong></div></td>
          <td colspan="2">
<select name="bank" id="bank" onBlur="show(this.value,'inf_bank')">
  <option value="">--SELECT--</option>
  <? Lookup("bankcode","bankcode",$bankcode,"select distinct bankcode from prbank",$d); ?>
</select><div class="highlight" id="inf_bank">&nbsp;</div>         
            <td><div align="right"><strong>Bank Account No.         </strong></div>
          <td><input name="accnum" type="text" id="accnum" <? if (!empty($accnum)) echo "value=$accnum" ?>>
          <div class="highlight" id="inf_accno">&nbsp;</div> </td>
        </tr>
        <tr>
          <td><div align="right"><strong>Job Group </strong></div>  </td>
          <td colspan="2">  <select name="jobgrp" id="jobgrp" >
            <option value="">--SELECT--</option>
            <? Lookup("jobgroup","jobgroup",$jobgroup,"select  jobgroup from jobgroup ",$d); ?>
          </select>
		  <div class="highlight" id="inf_jobgrp">&nbsp;</div>
            <td><div align="right">Basic pay         </div>
          <td><input name="basicpay" type="text" id="basicpay" <? if (!empty($basicpay)) echo "value=$basicpay" ?>>
		  <div class="highlight" id="inf_basicpay">&nbsp;</div>  
		  </td>
        </tr>
        <tr>
          <th colspan="3" ><div align="center"><span class="style3">Current Residential Status </span></div></th>
          <th colspan="2"> <div align="center" class="style4">Permanent Address </div></th>
        </tr>
        <tr>
          <td><div align="right"><strong>Current Res: </strong></div></td>
          <td colspan="2"><input name="curr_res" type="text" id="curr_res" <? if (!empty($curr_res)) echo "value=$curr_res" ?>>                        <td><div align="right"><strong>Home Res: </strong></div>
          <td><input name="homeres" type="text" id="homeres" <? if (!empty($homeres)) echo "value=$homeres" ?> >
        </tr>
        <tr>
          <td><div align="right"><strong>Physical:</strong></div></td>
          <td colspan="2"><input name="physical" type="text" id="physical" <? if (!empty($physical)) echo "value=$physical" ?> >                        <td><div align="right"><strong>Province: </strong> </div>
          <td><input name="province" type="text" id="province"  <? if (!empty($province)) echo "value=$province" ?>>
        </tr>
        <tr>
          <td><div align="right"><strong>Description:</strong></div></td>
          <td colspan="2"><input name="currdesc" type="text" id="currdesc" <? if (!empty($currdesc)) echo "value=$currdesc" ?>>                        <td><div align="right"><strong>District: </strong> </div>
          <td><input name="district" type="text" id="district" <? if (!empty($district)) echo "value=$district" ?>>
        </tr>
        <tr>
          <td><div align="right"><strong>Street:</strong></div></td>
          <td colspan="2"><input name="street" type="text" id="street" <?  if (!empty($street)) echo "value=$street" ?>>                        <td><div align="right"><strong>Division:</strong></div>
          <td><input name="division" type="text" id="division" <?  if (!empty($division)) echo "value=$division" ?>>
        </tr>
        <tr>
          <td><div align="right"><strong>Estate:</strong></div></td>
          <td colspan="2"><input name="estate" type="text" id="estate" <? if (!empty($estate)) echo "value=$estate" ?>>                        <td><div align="right"><strong> </strong> <strong>Location: </strong> </div>
          <td><input name="location" type="text" id="location" <? if (!empty($location)) echo "value=$location" ?>>
        </tr>
        <tr>
          <td><div align="right"><strong>Town:</strong></div></td>
          <td colspan="2"><input name="town" type="text" id="town" <? if (!empty($town)) echo "value=$town" ?>>                        <td><div align="right"><strong>SubLocation: </strong> </div>
          <td><input name="sublocation" type="text" id="sublocation" <? if (!empty($sublocation)) echo "value=$sublocation" ?>>
        </tr>
        <tr>
          <td><div align="right"><strong>Postal Address:</strong></div></td>
          <td colspan="2"><input name="padress" type="text" id="padress" <? if (!empty($padress)) echo "value=$padress" ?>>                        <td><div align="right"><strong>Phone No: </strong></div></td>
          <td><input name="phonenum" type="text" id="phonenum" <?  if (!empty($phonenum)) echo "value=$phonenum" ?>>            </tr>
        <tr>
          <th><span class="style3">Other Details</span></th>
          <td colspan="2">      
          <td>      
          <td>      
        </tr>
        <tr>
          <td><div align="right"><strong>Unit/Branch:</strong></div></td>
          <td colspan="2"><select name="unit" id="unit">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","unit_name","tbl_units",$unit_fk,$d); ?>
          </select><div class="highlight" id="inf_unit">&nbsp;</div>          
            <td><div align="right"><strong>Employment Status:</strong></div>
          <td><div class="highlight" id="inf_empstatus"><select name="empstatus" id="empstatus" onChange="Checkquitdate(this.value)">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","status","tbl_empstatus",$empstatus_fk,$d); ?>
          </select>        </div> </td>   </tr>
        <tr>
          <td nowrap><div align="right"><strong>Designation:</strong></div></td>
          <td colspan="2"><div class="highlight" id="inf_position">
            <select name="position" id="position">
              <option value="">--SELECT--</option>
              <? Loadlookup("id","designation","designation",$position_fk,$d); ?>
            </select>
          </div>      
            <div align="right">
            </div>            <div class="highlight" id="inf_qdate">&nbsp;</div>
          <td><div align="right"><strong>Quit Date</strong></div>
          <td><input name="qdate" type="text" id="qdate" <? if (!empty($expdate)) echo "value=$expdate" ?>></td></tr>
        <tr>
          <td><div align="right"><strong>Acting Position</strong></div></td>
          <td colspan="2">
            <select name="actpos" id="actpos" onChange="Checkacteffdate(this.value)">
              <option value="">--SELECT--</option>
              <? Loadlookup("id","designation","designation",$actpos,$d); ?>
            </select>
                 
            <td><div align="right"><strong>Scale</strong></div>
          <td nowrap><select name="scale" id="scale" >
            <option value="">--SELECT--</option>
            <? Lookup("jobgroup","jobgroup",$actscale,"select  jobgroup from jobgroup ",$d); ?>
          </select>            </tr>
        <tr>
          <td><div align="right"><strong>Acting From</strong></div></td>
          <td colspan="2"><input name="actdate" type="text" id="actdate" <? if (!empty($acteffdate)) echo "value=$acteffdate" ?>>            <div align="right"></div>
          <td><div align="right"><strong>Terms of Service</strong></div>
          <td><select name="terms" id="terms" onChange="Checkexpdate(this.value)">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","terms","tbl_terms",$termsid,$d); ?>
          </select>      <div class="highlight" id="inf_tos">&nbsp;</div>  </td>     </tr>
        <tr>
          <td><div align="right"><strong>Department:</strong></div></td>
          <td colspan="2"><select name="DeptName" id="DeptName">
            <option value="">--SELECT--</option>
		   <? Loadlookup("deptcode","Deptcode","prdept",$dept,$d); ?>
            </select><div class="highlight" id="inf_DeptName">&nbsp;</div> 
          <td>
              <div align="right">
                <input name="action" type="hidden" id="action" <? if (!empty($action)) echo "value=$action"?>>              
                <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>> 
                 <input type="hidden" name="rowid" <? if (!empty($rowid)) echo "value=$rowid"; ?>>  
				  <strong>Station</strong> </div>
          <td>
              <div align="left">              </div>
             
                <select name="stationcode" id="stationcode">
                  <option value="">--SELECT--</option>
                  <? Loadlookup("stationcode","stationcode","prstn",$stationcode,$d); ?>
                </select>
 <div class="highlight" id="inf_stn">&nbsp;</div>
        </tr>
        <tr>
          <td><div align="right"><strong>Effective From </strong></div></td>
          <td colspan="2">
            <input name="effdate" type="text" id="effdate" <? if (!empty($effdate)) echo "value=$effdate" ?>>
			<div class="highlight" id="inf_effdate">&nbsp;
			</div>  
            <td><div align="right"><strong>Contract Expiry</strong>:</div>
		  <td><input name="expdate" type="text" id="expdate" <? if (!empty($expdate)) echo "value=$expdate" ?>>   
		  <div class="highlight" id="inf_expdate">&nbsp;
			</div>       
        </tr>
        <tr>
          <td><strong>No. of hrs to work in month [Day = 8 hrs] </strong></td>
          <td colspan="2"><input name="numhrs" type="text" id="numhrs" <? if (!empty($numhrs))  echo "value=$numhrs" ?> OnBlur="Checkvalue(this.value,'numhrs')" >        
          <td><div align="right"><strong>Hourly Pay Rate </strong>
          </div>
          <td><input name="hpayrate" type="text" id="hpayrate" <? if (!empty($hpayrate))  echo "value=$hpayrate" ?> OnBlur="Checkvalue(this.value,'hpayrate')" readonly="true">            </tr>
        <tr>
          <td><div align="right"><strong>Housed</strong></div></td>
          <td colspan="2"><input name="housed" type="radio" value="-1" <? if (!empty($housed) && $housed==-1) echo "checked"?> readonly="true">
Yes
  <input name="housed" type="radio" value="0" <? if (!empty($housed) && $housed==0) echo "checked"?> OnBlur="Checkrent(this.value)" readonly="true">
No        
          <td><strong>If Yes Rent paid By Employer </strong>        
          <td><input name="rentpayemp" type="text" id="rentpayemp" <? if (!empty($rentpayemp))  echo "value=$rentpayemp" ?> readonly="true">        
        </tr>
        <tr>
          <td><strong>Driving Licence No:</strong></td>
          <td colspan="2"><input name="dlnum" type="text" id="dlnum" <? if (!empty($dlnum))  echo "value=$dlnum" ?>>        
          <td><div align="right"><strong>Date of Issue:</strong>        
          </div>
          <td><input name="issuedate" type="text" id="issuedate" <? if (!empty($datedlissued))  echo "value=$datedlissued" ?>>        
        </tr>
        <tr>
          <td><div align="right"><strong>Driving Class(es) </strong> </div></td>
          <td colspan="2"><input name="class" type="text" id="class" <? if (!empty($dlclasses)) echo "value=$dlclasses"?>>
          
          <td><div align="right"><strong>Incremental Month</strong>        
          </div>
          <td><select name="incmonth" id="incmonth" readonly="true">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","monthname","tbl_months",$monthid,$d); ?>
          </select>        
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">          
          <td>        
          <td><div align="right">
              <input type="reset" name="Reset" value="Reset">
              <input type="submit" name="Submit" value="Submit" onclick="return validateOnSubmit()">        
            </div>
        </tr>
      </table>
	 
      <h1>&nbsp;</h1>
   <img src="clear.gif" width="1" height="5" border="0" class="spacer-gif" alt="" title="" /><br />
   <img src="clear.gif" width="1" height="10" border="0" class="spacer-gif" alt="" title="" /></td>
  </tr>

  <tr>
    <td height="154" id="sponsored">&nbsp;</td>
  </tr>
</table></form>

<?
  $d->close();
?>
</body>
<script language=Javascript>
  function showmore(empid)
	 {
        var url = "uploadpic.php?empid="+empid;
   
        newwin = window.open(url,'Add','width=300,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollbars=3');
        newwin.focus();
     }
  
   function attachdocs(empid)
	 {
        var url = "attachdocs.php?empid="+empid;
   
        newwin = window.open(url,'Add','width=400,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollbars=3');
        newwin.focus();
     }
   function Checkvalue(val,ctrl)
   {
     if (val >0 && ctrl=='numhrs')
       document.employeefrm.hpayrate.value=0;
	 if (val >0 && ctrl=='hpayrate')
       document.employeefrm.numhrs.value=0;  
   }
   function Checkrent(val)
   {
     if (val==0)
       document.employeefrm.rentpayemp.value=0;
	 
   }
   function Checkexpdate(val)
   { 
     if (val!=1){
	   document.employeefrm.expdate.value="00-00-0000";
	   document.employeefrm.effdate.value="00-00-0000";
	 }
   }
   
   function Checkquitdate(val)
   { 
     if (val==1)
	   document.employeefrm.qdate.value="00-00-0000";
	 else
	  document.employeefrm.qdate.value=""; 
   }
   
   function Checkacteffdate(val)
   { 
     if (val!=1)
	   document.employeefrm.actdate.value="00-00-0000";
	 else
	  document.employeefrm.actdate.value=""; 
   }
</script>
</html>



