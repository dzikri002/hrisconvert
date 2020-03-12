<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title>Qualifications</title>
	

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
	
	if (!validateSelect(document.forms.qualificationsfrm.yearto,'inf_yearto',-1))  errs += 1;
	if (!validateSelect(document.forms.qualificationsfrm.yearfrom,'inf_yearfrom',-1))  errs += 1;
	if (!validatePresent(document.forms.qualificationsfrm.institute,'inf_institute'))  errs += 1; 
	if (!validatePresent(document.forms.qualificationsfrm.qname,'inf_qname'))  errs += 1; 
	if (!validateSelect(document.forms.qualificationsfrm.qlevel,'inf_qlevel',-1))  errs += 1;
	
	    
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
    $sqlstr="select * from tbl_employees inner join tbl_titles on tbl_titles.id=emptitle where tbl_employees.id=$empid";
	$query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Add Qualifications For: " . $row->title. $row->fname." ".$row->mname." ".$row->lname;
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->empnum."</b></font>";
    
  }
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["qualid"]))
  {
    $id=$_GET["qualid"];
    $sqlstr="select * from tbl_qualifications where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$qualname = $row->qualname;
    $empid = $row->empid_fk;
    $yearfrom = $row->yearfrom;
	$institution=$row->institution;
    $yearto = $row->yearto;
 
    $id=  $row->id;
  }
  
  if (!empty($_POST["qname"]))
  { 
  
    $qualname = "'".$_POST["qname"]."'";
    $institution = empty($_POST["institute"]) ? 'NULL' : "'" . $_POST["institute"] . "'";
    $yearfrom = "'".$_POST["yearfrom"]."'";
    $yearto = "'".$_POST["yearto"]."'";
	$empnum=  "'".$_POST["empid"]."'";
	$qlevel=$_POST["qlevel"];
   
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_qualifications set qualname=$qualname,institution=$institution,yearfrom=$yearfrom,yearto=$yearto,empid_fk=$empid,qlevel=$qlevel where id=$id";
   else
     $query="insert into tbl_qualifications(qualname,institution,yearfrom,yearto,empid_fk,qlevel) values ($qualname,$institution,$yearfrom,$yearto,$empid,$qlevel)";
   
  //echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=qualifications.php?empid=$empid'>";
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
	<? if (!empty($dispname)) echo $dispname; ?>
	<form name="qualificationsfrm" method="post" action="qualifications.php">
	<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Level</div></th>
        <th colspan="4">        <div class="highlight" id="inf_qlevel">&nbsp;
          <select name="qlevel" id="qlevel">
            <option value="">--SELECT--</option>
            <? Loadlookup("id","qlevel","tbl_qlevels",$yearfrom,$d); ?>
          </select>
        </div>
        </th>
        </tr>
      <tr>
        <th><div align="right">Subject</div></th>
        <th colspan="4"><input name="qname" type="text" id="qname" size="50" <? if (!empty($qualname)) echo "value='$qualname'";?>><div class="highlight" id="inf_qname">&nbsp;</div></th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Institution</div></th>
        <th colspan="4"><input name="institute" type="text" id="institute" size="50" <? if (!empty($institution)) echo "value='$institution'";?>>
		<div class="highlight" id="inf_institute">&nbsp;</div>
		</th>
      </tr>
      <tr>
        <th width="12%"><div align="right">Year from </div></th>
        <th width="15%"><select name="yearfrom"><option value="">--SELECT--</option>
		<? Loadlookup("yearlabel","yearlabel","tbl_years",$yearfrom,$d); ?>
        </select><div class="highlight" id="inf_yearfrom">&nbsp;</div></th>
        <th width="11%"><div align="right">Year To </div></th>
        <th width="20%"><select name="yearto"><option value="">--SELECT--</option>
		<? Loadlookup("yearlabel","yearlabel","tbl_years",$yearto,$d); ?>
        </select> <div class="highlight" id="inf_yearto">&nbsp;</div></th>
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
        <th width="5%"><span class="style4">Qualification</span></th>
        <th width="10%">Institution
        <th width="5%"><span class="style4">Year From </span>
        <th width="5%">Year To        
        <th width="5%">Action        
      </tr>
	  <?
	    	
		if (!empty($empid))
		{
	      $sqlstr="select * from tbl_qualifications where empid_fk=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());;
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->qualname."</td>";
		    echo "<td>".$row->institution."</td>";
			 
		    echo "<td>".$row->yearfrom."</td>";
		    echo "<td>".$row->yearto."</td>";
		  
		    echo "<td> <a href=qualifications.php?qualid=$row->id&action=edit>Edit</a></td>";
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



