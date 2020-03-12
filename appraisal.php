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

	<title>Staff Appraisal</title>
	

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
	 dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('appdate'));
	
};
 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	

	if (!validateSelect(document.forms.disciplinaryfrm.appdate,'inf_appdate',-1))  errs += 1;
	if (!validatePresent(document.forms.disciplinaryfrm.appresult,'inf_appresult'))  errs += 1; 

	    
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
    $sqlstr="select * from prmember left join tbl_titles on tbl_titles.id=emptitle where prmember.memberno=$empid";
    $query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Add Appraisal Details for: <a href=employees.php?empid=$row->MemberNo&action=edit>" . $row->title. $row->FullName."</a>";
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->MemberNo."</b></font>";
    
  }
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  //echo $action;
  
  
  if (!empty($_GET["apprid"]))
  {
    $id=$_GET["apprid"];
    $sqlstr="select * from tbl_appraisals where id=$id";

	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	//$apprid = $row->id;
    $empid = $row->empid_fk;
   	$result=$row->result_fk;
    $appdate = dateconvert($row->appdate,2);
	$appraiser = $row->appraiser;
	$id=  $row->id;
  }
  
  if (!empty($_POST["appresult"]))
  { 
  
    $appresult = "'".$_POST["appresult"]."'";
	$appraiser = "'".urlencode($_POST["appraiser"])."'";
    $appdate = empty($_POST["appdate"]) ? 'NULL' : "'" . dateconvert($_POST["appdate"],1) . "'";
	$comments = empty($_POST["appcomments"]) ? 'NULL' : "'" . $_POST["appcomments"] . "'";
   	$empnum=  "'".$_POST["empid"]."'";
   
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_appraisals set result_fk=$appresult,empid_fk=$empnum,appdate=$appdate,appcomments=$comments,appraiser=$appraiser  where id=$id";
   else
     $query="insert into tbl_appraisals (result_fk,empid_fk,appdate,appcomments,appraiser) values ($appresult,$empnum,$appdate,$comments,$appraiser)";
   
   //echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=appraisal.php?empid=$empid'>";
	}
   }
   
   
  }
  
    //process delete
  if ($action=="delete_go")
  {
   $sqlstr="delete from tbl_appraisals where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=appraisal.php?empid=$empid'>";
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
<form name="disciplinaryfrm" method="post" action="appraisal.php">
<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Appraisal Result </div></th>
        <th colspan="2">          
              <select name="appresult" id="appresult">
             <option value="">--SELECT--</option>
             <? Loadlookup("id","appresult","tbl_appresults",$result,$d); ?>
           </select> 
            <div class="highlight" id="inf_appresult"></div>
        </th></tr>
      <tr>
        <th width="20%"><div align="right">Appraisal Date</div></th>
        <th colspan="2"><input name="appdate" type="text" id="appdate"  <? if (!empty($appdate)) echo "value=$appdate"; ?>>		
          <div class="highlight" id="inf_appdate">&nbsp;</div>
		</th>
      </tr>
      <tr>
        <th><div align="right"><strong>Appraiser</strong></div></th>
        <th><select name="appraiser" id="appraiser">
          <option value="">--SELECT--</option>
          <? Loadlookup("memberno","fullname","prmember",$appraiser,$d); ?>
        </select></th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Comments</div></th>
        <th width="15%"><textarea name="appcomments" cols="50" id="appcomments"><?  if (!empty($appcomments)) echo $appcomments?></textarea>
		 <div class="highlight" id="inf_appcomments">&nbsp;</div>
          </th>
        </tr>
      <tr>
        <th><input type="hidden" name="empid" <? if (!empty($empid)) echo "value=$empid"; ?>>
          <input type="hidden" name="action" <? if (!empty($action)) echo "value=$action"; ?>>
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
        <th width="5%">Appraisal Result </th>
		<th width="5%"><span class="style4">Appraisal Date </span></th>
        <th width="5%"><span class="style4">Appraiser </span></th>
        <th width="10%">Comments</th>
        <th width="10%">Action</th>
      </tr>
	  <?
	    	
		if (!empty($empid))
		{
	      $sqlstr=" select tbl_appraisals.*,appresult from tbl_appraisals inner join tbl_appresults on tbl_appresults.id=tbl_appraisals.result_fk where empid_fk=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->appresult."</td>";	
			echo "<td>".dateconvert($row->appdate,2)."</td>";	
			
			$fullname=fetchfullname($row->appraiser,$d);
					
		    echo "<td>".$fullname."</td>";
			echo "<td>".$row->appcomments."</td>";
					  
		    echo "<td> <a href=appraisal.php?apprid=$row->id&action=edit>Edit</a>| <a href=appraisal.php?action=delete_go&apprid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
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



