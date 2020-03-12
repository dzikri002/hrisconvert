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

	<title>Apply Leave</title>
	
	

	

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
 <script type="text/javascript" src="ewp.js"></script>
 <script language="JavaScript" src="js/calendar1.js"></script><!--  -->
 <script type="text/javascript">
/*You can also place this code in a separate file and link to it like epoch_classes.js*/
	var dp_cal,dob_cal,d_iss;      
     window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('empdate'));
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('dob'));
	d_iss  = new Epoch('epoch_popup','popup',document.getElementById('issuedate'));
};

</script>
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
 
<table  id="main" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" id="cell_top">
      <br>
    </td>
  </tr>

  <tr>
    <td colspan="2" >
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;<a href="logout.php?reset=1">Log Out</a></td>

  </tr>

  <tr>
    <td width="172" rowspan="3" nowrap id="menu"><div style="width: 150px;">
      <div style="width: 150px;">
      </div>
     <?
	    //if (hasaccess($d,26,$userid)) WILL B OUT FOR ACCESS CONTROL
		//{
		  $hasaccess=1;
		  echo "<li><a href=\"../corehrmis/employees.php\" onfocus=\"blurLink(this);\">Add Employees</a></li>
		   <li><a href=\"../corehrmis/addbank.php\" onfocus=\"blurLink(this);\">Add Banks</a></li>
	       <li><a href=\"../corehrmis/addbranches.php\" onfocus=\"blurLink(this);\"></a></li>
	      <li><a href=\"../corehrmis/Add Departments\" onfocus=\"blurLink(this);\">Add Departments</a></li>
	      <li><a href=\"../corehrmis/adddesignations.php\" onfocus=\"blurLink(this);\">Add Designations</a></li>
	      <li><a href=\"../corehrmis/addnationalities.php\" onfocus=\"blurLink(this);\">Add Nationalities </a></li>
		   <li><a href=\"../corehrmis/addquals.php\" onfocus=\"blurLink(this);\">Add Qualifications</a></li>
	       <li><a href=\"../corehrmis/addunits.php\" onfocus=\"blurLink(this);\">Add Units</a></li>
		   <li><a href=\"../corehrmis/index.php\" onfocus=\"blurLink(this);\">View All Employees</a></li>
		<li><a href=\"../corehrmis/appliedleavelist.php\" onfocus=\"blurLink(this);\">Leave Applications</a></li>
	    </ul>";
      //  } 
		//else
		//  $hasaccess=0;
		  
		 $d->close();
	     $d->connect($db_host, $db_user, $db_pass, $db); 
	 ?> 
        
      <p>&nbsp;</p>
    </div>

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
            <option value="idnum">Id/Passport Number</option>
            <option value="desig">designation</option>
            <option value="depart">DeptName</option>
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
  <tr>
    <td  bgcolor="#FFFFFF" ><table width="100%"  border="0">
      <tr>
        <th width="79"><span class="style4">Employee</span>        
        <th width="92">DeptName        
        <th width="100">Leave Type         
        <th width="71">Date From </th>
        <th width="101">Date To        
        <th  width="120">No. of Days </th>
        <th  width="118">Balance</th>
      </tr>
	  <?
	    //<th  width="10"><div class="highlight style4" id="inf_lname">ID/PassPort Number</div></th>
	    if (!empty($_POST["searchcrit"]))
		{
		  switch ($_POST["searchcrit"]) {
			case "fname":
   			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				inner join designation on designation.id=tbl_employees.position_fk
				inner join prdept on prdept.deptcode=tbl_employees.Dept where fname like '%".$_POST["searchval"]."%'";
			   break;
			case "lname":
			    $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				inner join designation on designation.id=tbl_employees.position_fk
				inner join prdept on prdept.deptcode=tbl_employees.Dept where lname like '%".$_POST["searchval"]."%'";
			   break;
			case "pnumber":
			    $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				inner join designation on designation.id=tbl_employees.position_fk
				inner join prdept on prdept.deptcode=tbl_employees.Dept where empnum like '%".$_POST["searchval"]."%'";
			   break;
			case "idnum":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				inner join designation on designation.id=tbl_employees.position_fk
				inner join prdept on prdept.deptcode=tbl_employees.Dept where national_idnum like '%".$_POST["searchval"]."%'";
			   break;
		    case "desig":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				inner join designation on designation.id=tbl_employees.position_fk
				inner join prdept on prdept.deptcode=tbl_employees.Dept where designation like '%".$_POST["searchval"]."%'";
			   break;
            case "depart":
			   $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
				inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
				inner join designation on designation.id=tbl_employees.position_fk
				inner join prdept on prdept.deptcode=tbl_employees.Dept where DeptName like '%".$_POST["searchval"]."%'";
			    break;
		
		     }    
		
		 }
		else
	    $sqlstr="select tbl_employees.id,empnum,fname,mname,lname,designation,DeptName,gender,national_idnum,nationality,countryname from tbl_employees
		inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
		inner join designation on designation.id=tbl_employees.position_fk
		inner join prdept on prdept.deptcode=tbl_employees.Dept order by Dept";
		
		
		$result=$d->query($sqlstr) or die(mysql_error());;
		$numrows=$d->numrows($result);
		
		 if (!empty($_POST["searchval"]))
		   echo "Search  Returned $numrows Records";
		   
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
		    echo "<td> <a href=employees.php?empid=$row->id&action=edit>Edit</a> | <a href=\"javascript:viewemp($row->id)\">View</a> </td>";
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



