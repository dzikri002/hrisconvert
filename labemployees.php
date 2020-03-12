<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title> Employees Data</title>
	

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
 <link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>
 <script type="text/javascript" src="css/epoch_classes.js"></script>
 <script type="text/javascript" src="js/formval.js"></script> 
 <script language="JavaScript" src="js/calendar1.js"></script><!--  -->
 <script type="text/javascript">
/*You can also place this code in a separate file and link to it like epoch_classes.js*/
	var dp_cal,d_iss,d_exp,d_eff;      
     window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('empdate'));
	d_iss  = new Epoch('epoch_popup','popup',document.getElementById('issuedate'));
	d_exp = new Epoch('epoch_popup','popup',document.getElementById('expdate'));
	d_eff = new Epoch('epoch_popup','popup',document.getElementById('effdate'));
};

function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validatePresent(document.forms.employeefrm.expdate,'inf_expdate')) errs += 1; 
	if (!validatePresent(document.forms.employeefrm.effdate,'inf_effdate')) errs += 1; 
	
	if (!validateSelect(document.forms.employeefrm.terms,'inf_tos',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.DeptName,'inf_DeptName',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.position,'inf_position',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.empstatus,'inf_empstatus',-1))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.unit,'inf_unit',-1))  errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.empdate,'inf_empdate')) errs += 1; 

	if (!validatePresent(document.forms.employeefrm.idnum,'inf_idnum'))  errs += 1;
	if (!validateSelect(document.forms.employeefrm.nationality,'inf_nationality',-1))  errs += 1;
	
	if (!validateCheckbox(document.forms.employeefrm.gender,'inf_gender',1))  errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.payrollnum,'inf_payrollnum'))  errs += 1; 
	if (!validatePresent(document.forms.employeefrm.prefnames,'inf_pnames'))  errs += 1; 
	
	if (!validatePresent(document.forms.employeefrm.lname,'inf_lname'))  errs += 1;
	if (!validatePresent(document.forms.employeefrm.fname,'inf_fname'))  errs += 1; 
	
	if (errs>1)  alert('There are fields which need correction before submitting');
    if (errs==1) alert('There is a field which needs correction before submitting');
   	
    return (errs==0);
};
</script>
 <style type="text/css">
<!--
.style7 {
	color: #FF0000;
	font-size: 9px;
	font-family: "Courier New", Courier, mono;
}
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
   
  if (!empty($_REQUEST["empid"]))
  {
    $id=$_REQUEST["empid"];
	$action = "update_go";
    $sqlstr="select * from tbl_employees where id = $id";
	$sqlresult=$d->query($sqlstr);
	
	    $row=$d->fetch_object($sqlresult);
	 
	    $emptitle = $row->emptitle;  
	    $fname=$row->fname;
	    $mname=$row->mname;
	    $lname=$row->lname;
	    $empnum=$row->empnum;
	   
	    $prefnames=$row->prefnames;
	   
	    $gender=$row->gender;
	    $pin=$row->pin;
	   
		$empdate=dateconvert($row->empdate,2);
		$national_idnum=$row->national_idnum;
		$nationality=$row->nationality;
		$trainer=$row->trainer;
		$hsection=$row->hsection; //heads a section
		$section_fk=$row->section_fk; //links to a section within a DeptName
		
		$unit_fk=$row->unit_fk;
		
		$kmltbno=$row->kmltbno;
		$grantid=$row->grantid;
		
		$empstatus_fk=$row->empstatus_fk;
		$position_fk=$row->position_fk;
		$dept=$row->dept;

	    $expdate=dateconvert($row->expdate,2);
	    $termsid=$row->termsid_fk;
		$effdate=dateconvert($row->effdate,2);
  }
  else
    $action="add";
  // variable assignment;
  
  if (!empty($_POST["fname"]))
  { 
    $emptitle = empty($_POST["emptitle"]) ? 'NULL' : "'" . $_POST["emptitle"] . "'";
    $fname = "'".$_POST["fname"]."'";
    $mname = empty($_POST["mname"]) ? 'NULL' : "'" . $_POST["mname"] . "'";
    $lname = "'".$_POST["lname"]."'";
    $prefnames = "'".$_POST["prefnames"]."'";
    $empnum = "'".$_POST["payrollnum"]."'";;
  
    $gender="'".$_POST["gender"]."'";
    $nationality="'".$_POST["nationality"]."'";
    $empdate="'".dateconvert($_POST["empdate"],1)."'";
    $national_idnum="'".$_POST["idnum"]."'";
	
    $kmltbno = empty($_POST["kmltbno"]) ? 'NULL' : "'" . $_POST["kmltbno"] . "'";
    $grantid = empty($_POST["grantid"]) ? 'NULL' : "'" . $_POST["grantid"] . "'";
 
    $unit = empty($_POST["unit"]) ? 'NULL' : "'" . $_POST["unit"] . "'";
    $empstatus = empty($_POST["empstatus"]) ? 'NULL' : "'" . $_POST["empstatus"] . "'";
    $issuedate = empty($_POST["issuedate"]) ? 'NULL' : "'" .dateconvert($_POST["issuedate"],1) . "'";
    $position = empty($_POST["position"]) ? 'NULL' : "'" . $_POST["position"] . "'"; 
  
    $DeptName = empty($_POST["DeptName"]) ? 'NULL' : "'" . $_POST["DeptName"] . "'";
	$hsection = empty($_POST["section"]) ? '0' : "'" . 1 . "'";
	$trainer = empty($_POST["trainer"]) ? '0' : "'" . 1 . "'";
	$section_fk = empty($_POST["section_fk"]) ? 'NULL' : $_POST["section_fk"];
	
	$expdate="'".dateconvert($_POST["expdate"],1)."'";
	$effdate="'".dateconvert($_POST["effdate"],1)."'";
	$termsid="'".$_POST["terms"]."'";
	$action=$_POST["action"];
	$id=$_POST["id"];
  }
  
  
  if (!empty($_POST["fname"]))
  {
    if ($action=="update_go")
    {
      $query="update tbl_employees set 
	  emptitle=$emptitle,
	  fname=$fname,
	  mname=$mname,
	  lname=$lname,
	  empnum=$empnum,
	  prefnames=$prefnames,
	  gender=$gender,
	  nationality=$nationality,
	  empdate=$empdate,
	  national_idnum=$national_idnum,
	  empstatus_fk=$empstatus,
	  position_fk=$position,
	  dept=$DeptName,
	  expdate=$expdate,
	  effdate=$effdate,
	  hsection=$hsection,
	  section_fk=$section_fk,
	  trainer=$trainer,
	  kmltbno=$kmltbno,
	  grantid=$grantid,
	  termsid_fk=$termsid
	  where id=$id";
	
    }
    else
   { 
		$query="insert into tbl_employees (emptitle,fname,mname,lname,empnum,prefnames,gender,kmltbno,grantid,
		nationality,empdate,empstatus_fk,position_fk,dept,expdate,effdate,termsid_fk,hsection,trainer,section_fk)
		values	($emptitle,$fname,$mname,$lname,$empnum,$prefnames,$gender,kmltbno,grantid,
		$nationality,$empdate,$empstatus,$position,$DeptName,$expdate,$effdate,$termsid,$hsection,$trainer,$section_fk)";
		
  }
    
  if (!empty($query))
  {
    $result = $d->query($query);
	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=labemployees.php'>";
	}
  }
 }
 ?>
 <form action="labemployees.php" method="post" name="employeefrm">
<table  id="main" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" id="cell_top">
      <br>
    </td>
  </tr>

  <tr>
    <td colspan="2" >&bull;&nbsp;<a href="../main.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td width="172" nowrap id="menu"><div style="width: 150px;">
      <div style="width: 150px;">
            <hr noshade size="3" color="#eb8137">
			<?
			if (!empty($id))  
			  echo "<center><img src='viewimg.php?imgid=$id' width=150 Height=150 ></center>"; ?>
			<hr noshade size="3" color="#eb8137">
            
      </div>
      <ul>
	
	   <li><a href="labemployees.php" onfocus="blurLink(this);">Add Employees</a></li>
	     <li> <a href="labhome.php" onfocus="blurLink(this);">View Employees</a></li>
	   <li><a href="labDeptNames.php" onfocus="blurLink(this);">Add Section </a></li>
	   <li><a href="labdesignations.php" onfocus="blurLink(this);">Add Designations</a></li>
	   </ul>
	   <? if (!empty($id)){ echo "<hr noshade size=\"3\" color=\"#eb8137\"><ul>"; 
      echo "<li><a href=\"labtraining.php?empid=$id\" onfocus=\"blurLink(this)\">Training</a></li>
	  <li><a href=\"labqualifications.php?empid=$id\" onfocus=\"blurLink(this)\">Qualifications</a></li>"; }
	  
      if (!empty($id)) 
	  /*{
	   echo "<li><a href=\"javascript:attachdocs($id)\">Attach Documents</a></li>
	  <li><a href=\"viewattacheddocs.php?empid=$id\">View Attachments</a></li>
	  <li><a href=\"publications.php?empid=$id\" onfocus=\"blurLink(this)\">Publications</a></li>
      <li><a href=\"appointments.php?empid=$id\" onfocus=\"blurLink(this)\">Appointments</a></li>";
	   echo "<a href=\"viewprofile.php?empid=$id\" onfocus=\"blurLink(this)\"><li>View Profile</li></a>"; }*/ ?>
      <? if (!empty($id)) echo "<li><a href=\"javascript:showmore($id)\">Upload Picture </a></li>";  ?>
      </ul>        
          <p>&nbsp;</p>
    </div>

    </td>
    <td width="100%" rowspan="2" bgcolor="#FFFFFF" >
	
      <table width="40%"  border="0">
        <tr>
          <th width="10%" scope="col"><span class="style4">Personal Details </span></th>
          <th colspan="4" class="style7" scope="col">Fields Marked (*) are Required </th>
        </tr>
        <tr>
          <td><div align="right"><strong>Names</strong>*:</div></td>
          <td width="10%"><select name="emptitle"> <option value="">--SELECT--</option> <?php Loadlookup("id","title","tbl_titles",$emptitle,$d) ?>
            </select>
          <td width="10%"><input name="fname" type="text" id="fname" <? if (!empty($fname)) echo "value=$fname"; ?>><div class="highlight" id="inf_fname">&nbsp;</div></td>
          <td width="20%"><input name="mname" type="text" id="mname" <? if (!empty($mname)) echo "value=$mname"; ?>>&nbsp;
          <td width="50"><input name="lname" type="text" id="lname" <?  if (!empty($lname)) echo "value=$lname"; ?>><div class="highlight" id="inf_lname">&nbsp;</div></td>
        </tr>
        <tr>
          <td nowrap><div align="right"><strong>Payroll No: </strong></div></td>
          <td colspan="2"><input name="payrollnum" type="text" id="payrollnum" <? if (!empty($empnum)) echo "value=$empnum"; ?>><div class="highlight" id="inf_payrollnum">&nbsp;</div></td>
          <td><div align="right"><strong>Employment Date:</strong> </div>
          <td><div class="highlight" id="inf_pbirth" >&nbsp;
              <input name="empdate" type="text" id="empdate" <? if (!empty($empdate)) echo "value=$empdate" ?>>
          </div></td>
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
          <th><span class="style3">Other Details</span></th>
          <td colspan="2"><input type="checkbox" name="trainer" value="1" <? if (!empty($trainer) && ($trainer==1)) echo "checked";?>>
            Trainer      
          <td><div align="right"><strong>KMLTB NO :</strong>      
          </div>
          <td><input name="kmltbno" type="text" id="kmltbno" <? if (!empty($kmltbno))  echo "value=$kmltbno" ?>>      
        </tr>
        <tr>
          <td nowrap><strong>Employment Status: </strong></td>
          <td colspan="2"><select name="empstatus" id="empstatus">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","status","tbl_empstatus",$empstatus_fk,$d); ?>
          </select><div class="highlight" id="inf_empstatus">&nbsp;</div>      
            <td><div align="right"><strong>Grant</strong>: </div>
          <td><select name="grantid" id="grantid">
            <option value="">--SELECT--</option>
            <?php
				Lookup("id","grantdesc",$grantid,"SELECT id,grantdesc FROM helpdesk.intranet_grants"); 
			?>
          </select></td></tr>
        <tr>
          <td><div align="right"><strong>Designation:</strong></div></td>
          <td colspan="2"><select name="position" id="position">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","designation","designation",$position_fk,$d); ?>
          </select><div class="highlight" id="inf_position">&nbsp;</div>          
            <td><div align="right"><strong>Terms of Service </strong>
                <input name="action" type="hidden" id="action" <? if (!empty($action)) echo "value=$action"?>>
                <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>>
</div>
          <td nowrap><div align="left">
            <select name="terms" id="terms">
              <option value="">--SELECT--</option>
              <? Loadlookup("id","terms","tbl_terms",$termsid,$d); ?>
            </select>
          </div>
            <div class="highlight" id="inf_tos">&nbsp; </div>            </tr>
        <tr>
          <td><div align="right"><strong>DeptName:</strong></div></td>
          <td colspan="2"><select name="DeptName" id="DeptName">
            <option value="">--SELECT--</option>
		   <? Loadlookup("id","DeptName","prdept",$dept,$d); ?>
            </select><div class="highlight" id="inf_DeptName">&nbsp;</div> 
            <td><div align="right"><strong>Section</strong>:
          </div>
          <td>
              <div align="left">
                <select name="section_fk" id="section_fk">
                  <option value="">--SELECT--</option>
                  <?php 
				  	Lookup("id","DeptName",$section_fk,"SELECT prdept.deptcode,prdept.DeptName
					FROM prdept
					WHERE prdept.depcat =  'LAB'");
				   ?>
                </select>
			</div><input name="section" type="checkbox" value="" <? if ($hsection==1) echo "checked"; ?>>Head of section
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
</script>
</html>



