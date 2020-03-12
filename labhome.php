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


    <link rel="stylesheet" href="../corehrmis/js/example.css" TYPE="text/css" MEDIA="screen">
	<link rel="stylesheet" type="text/css" href="../corehrmis/css/employees.css" />
	<link rel="stylesheet" type="text/css" href="../corehrmis/css/main.css"/>

	<title>View Employees</title>
<style type="text/css">
<!--
.copysmall {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 12px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copy {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymed {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copylarge {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 15px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymedred {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copyheader {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.copyheaderwhite {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.header7, h7 {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
.copysmalltitle {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
.copysubtitle {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px }
.copyfooter {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #000000; font-size: 13px }
.copydownload {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px }
.info   { color: black; background-color: transparent; font-weight: normal; }
  .warn   { color: rgb(120,0,0); background-color: transparent; font-weight: normal; }
  .error  { color: red; background-color: transparent; font-weight: bold }
-->
</style>

 <link rel="stylesheet" type="text/css" href="../corehrmis/css/epoch_styles.css"/>

 <script type="text/javascript" src="../corehrmis/css/epoch_classes.js"></script>
 <script type="text/javascript" src="../corehrmis/js/formval.js"></script> 
 <script language="JavaScript" src="../corehrmis/js/calendar1.js"></script>
<script type="text/javascript" src="../corehrmis/js/tabber.js">
</script>
<style type="text/css">
<!--
.style5 {font-size: 14px}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<? 
  if (empty($_SESSION["username"]))
    die("<center><font color=red>You have not yet Logged in.<a href=../index.php>Please click here to log in.</a></font></center>");
	
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $supportdb); 
  
  $username = $_SESSION["username"];
  $sqlstr="select * from support_users where username like '%".$username."%'";
  $data=$d->query($sqlstr);
  $row=$d->fetch_object($data);
  $fullname=$row->name; 
  $userid=$row->id;


 ?>
 <div class="tabber" id="tab1">

 <div class="tabbertab" title="Employees List">
<table  id="main" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" id="cell_top">
      <br>
    </td>
  </tr>

  <tr>
    <td colspan="2" >
    &bull;&nbsp;<a href="/intranet/main.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;</td>

  </tr>

  <tr>
    <td width="172" rowspan="3" nowrap id="menu">
      <div style="width: 150px;">
      </div>
      <ul>
	  <?
        if (hasaccess($d,43,$userid))
		{
		  $hasaccess=1;
		  echo "<li><a href=\"../corehrmis/labemployees.php\" onfocus=\"blurLink(this);\">Add Employees</a></li>
	      <li><a href=\"../corehrmis/labDeptNames.php\" onfocus=\"blurLink(this);\">Add Sections</a></li>
	      <li><a href=\"../corehrmis/labdesignations.php\" onfocus=\"blurLink(this);\">Add Designations</a></li>
	      <li><a href=\"../corehrmis/addnationalities.php\" onfocus=\"blurLink(this);\">Add Nationalities </a></li>
		   <li><a href=\"../corehrmis/addquals.php\" onfocus=\"blurLink(this);\">Add Qualifications</a></li>
		   <li><a href=\"../corehrmis/sopmanagement.php\" onfocus=\"blurLink(this);\">SOPS Management</a></li>
		   <li><a href=\"../corehrmis/labhome.php\" onfocus=\"blurLink(this);\">View Amended Records</a></li>
	    </ul>";
        } 
		else
		  $hasaccess=0;
		      
        
		
		$d->close();
	    $d->connect($db_host, $db_user, $db_pass, $db); 
	   ?>
      <p>&nbsp;</p>
    

    </td>
    <td width="100%"  bgcolor="#FFFFFF" >
	<form name="form1" method="post" action="">
	<table width="100%"  border="0">
      <tr>
        <th width="15%">Search By:
          <div class="highlight" id="inf_lname">&nbsp;</div></th>
        <th width="22%">
          <select name="searchcrit" id="searchcrit">
            <option value="fname">First Name</option>
            <option value="lname">Last Name</option>
            <option value="pnumber">Payroll Number</option>
           
            <option value="desig">designation</option>
            <option value="depart">section</option>
            <option value="status">Status</option>
          </select>
        </th>
        <th width="15%">Search Value </th>
        <th width="24%"><input type="text" name="searchval"></th>
        <th width="24%"><input name="Search" type="submit" id="Search" <?  if (!empty($_POST["searchval"])) echo "value=\"Show All\""; else echo "value=\"Search\""; ?>></th>
      </tr>
    </table> 
	</form>    
      <h1>&nbsp;</h1>
   </td>
  </tr>
 
	  <?
	    //check for expiry dates of contracts,dls,leave applications e.t.c
		// <option value="idnum">Id/Passport Number</option>
		
		
	    if (!empty($_POST["searchcrit"]))
		{
		  switch ($_POST["searchcrit"]) {
			case "fname":
   			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join prdept on prdept.deptcode=tbl_employees.dept
				 where fname like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
			case "lname":
			    $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join prdept on prdept.deptcode=tbl_employees.dept
				 where lname like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
			case "pnumber":
			    $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join prdept on prdept.deptcode=tbl_employees.dept where
				 empnum like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
			case "idnum":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join prdept on prdept.deptcode=tbl_employees.dept
				 where national_idnum like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
		    case "desig":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join prdept on prdept.deptcode=tbl_employees.dept
				 where designation like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
			 case "depart":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join prdept on prdept.deptcode=tbl_employees.dept
				 where DeptName like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
			  case "status":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				left join designation on designation.id=tbl_employees.position_fk
				left join tbl_empstatus on tbl_empstatus.id = tbl_employees.empstatus_fk
				left join prdept on prdept.deptcode=tbl_employees.dept
				 where status like '%".$_POST["searchval"]."%' and prdept.depcat='LAB'";
			   break;
             }    
		 }
		else
	      /*$sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
		  left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
		  left join designation on designation.id=tbl_employees.position_fk
		  left join prdept on prdept.deptcode=4";*/
		$sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
		  left join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
		  left join designation on designation.id=tbl_employees.position_fk
		  left join prdept on prdept.deptcode=tbl_employees.dept where prdept.depcat='LAB'
		  order by tbl_employees.fname";
		
		//echo $sqlstr;
		
		$result=$d->query($sqlstr) or die(mysql_error());;
		$numrows=$d->numrows($result);
		
		 if (!empty($_POST["searchval"]))
		   echo "Search  Returned $numrows Records";
		 else
		   echo "Total No. of Records : $numrows";
		//header
		//<th  width=\"10\"><div class=\"highlight style4\" id=\"inf_lname\">ID/PassPort Number</div></th>
		 echo "<tr>
          <td  bgcolor=\"#FFFFFF\" ><table width=\"100%\"  border=\"0\">
          <tr>
          <th width=\"10%\"><span class=\"style4\">No.</span></th>
          <th width=\"10%\"><span class=\"style4\">Employee</span>        
        <th width=\"10%\"><span class=\"highlight style4\">&nbsp;Gender</span>
        <th width=\"10%\">DeptName</th>
        <th width=\"20%\">Designation        
        
        <th  width=\"11\">Nationality </th>
        <th  width=\"25\">Action</th>
      </tr>";
		while ($row=$d->fetch_object($result))
		{
		  echo "<tr>";
		  echo "<td>".$row->id."</td>";
		  echo "<td>".$row->fname." ".$row->mname." ".$row->lname."</td>";
		  echo "<td>".$row->gender."</td>";
		  echo "<td>".$row->DeptName."</td>";		  
		  echo "<td>".$row->designation."</td>";
		 // echo "<td>".$row->national_idnum."</td>";
		  echo "<td>".$row->countryname."</td>";
		 
		  if ($hasaccess==1) 
		    echo "<td> <a href=labemployees.php?empid=$row->id&action=edit>Edit</a> | <a href=\"javascript:viewemp($row->id)\">View</a> </td>";
		  else
		    echo "<td> <a href=\"javascript:viewemp($row->id)\">View</a></td>";
			 
		  echo "</tr></td>";
		}
		
	  
	  ?>
    </table></td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" >&nbsp;</td>
  </tr>
</table>
</div>
 <div class="tabbertab" title="Description"> 
 <span class="copydownload style5">Welcome to the HR database system for CGMRC-KEMRI/Wellcome Trust Kilifi. The ability to view reports, amend the records and make any changes has
 been restricted to HR personnel only. The list has been made available publicly so that we can be able to view and know our colleagues from
 other DeptNames. To view the employees listing Click on the Link labelled Employees List. Incase there are columns that are blanks, they are in the
 process of being updated by the HR DeptName.
 </span> 
 <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p>
 </div>
</div>
<?
  $d->close();
?>
<script language="javascript">
  function viewemp(empid)
	 {
        var url = "viewemp.php?empid="+empid;
   
        newwin = window.open(url,'View','width=300,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollbars=3');
        newwin.focus();
     }
</script>
</body>

</html>



