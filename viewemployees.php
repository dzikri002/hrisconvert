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
    <meta name="keywords" content="Human Resource Information System,ehris,e-hris,electronic human resource information system,Personnel management system">
    <meta name="description" content="Electronic Human Resource Information Management System">


    <link rel="stylesheet" href="js/example.css" TYPE="text/css" MEDIA="screen">
	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link href="css/text.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="js/example.css" TYPE="text/css" MEDIA="screen">
	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link href="css/text.css" rel="stylesheet" type="text/css" />
	<title>E-HRIS View Employees</title>
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

 <link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>

 <script type="text/javascript" src="css/epoch_classes.js"></script>
 <script type="text/javascript" src="js/formval.js"></script> 
 <script language="JavaScript" src="js/calendar1.js"></script>
<script type="text/javascript" src="js/tabber.js">
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
    die("<center><font color=red>You have not yet Logged in.<a href=login.php>Please click here to log in.</a></font></center>");
  
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
  $username = $_SESSION["username"];
  $sqlstr="select * from hrusers  where username like '%".$username."%'";
  $data=$d->query($sqlstr);
  $row=$d->fetch_object($data);
  $fullname=$row->name; 
  $userid=$row->id;
  $isadmin=$row->isadmin;
 
  //check for contract expiry,leave due,retirement and alert.
  $sqlstr="select * from hrsettings order by id desc";
  $result =$d->query($sqlstr);
  $row=$d->fetch_object($result);
  
  $contract=$row->contract;
  $leave=$row->leave;
  $retirement=$row->retirement;
  $retage=$row->retage;
  
  if (!empty($contract))
  {
    $sqlstr="select count(memberno) as totalexp from prmember where (datediff(quitdate,now()) div 30) < $contract and (datediff(quitdate,now()) div 30) >= 0 and suspended=0 and empstatus_fk=1";
    
	$result=$d->query($sqlstr);
	$row=$d->fetch_object($result);
	
	if ($row->totalexp > 1)
	  $contexpmsg = "<b>There are $row->totalexp employees whose contracts are due to expire in $contract months time. <a href=\"contractexprpt.php\">Please click Here to view the list.</a></b>";
    else if ($row->totalexp == 1)
	  $contexpmsg = "<b>There is $row->totalexp employee whose contract is due to expire in $contract months time. <a href=\"contractexprpt.php\">Please click Here to view the record.</a></b>";
  }

  //retirement 
  if (!empty($retirement))
  {
    //get retirement age - retirement notification difference
	if (!empty($retage))
	  $agediff=$retage-$retirement;
	else
	  $agediff=55-$retirement;
	  
	//sql count  
	 $sqlstr="select count(memberno) as totalret from prmember where (datediff(now(),BirthDate) div 365) >= $agediff and suspended=0 and empstatus_fk=1";
	 $result=$d->query($sqlstr);
	 $row=$d->fetch_object($result);
  
     if ($row->totalret > 1)
	   $retmsg = "<b>There are $row->totalret employees who are due to retire in $retirement years time. <a href=\"retirerpt.php\">Please click Here to view the list.</a></b>";
	 else if ($row->totalret==1)
	   $retmsg = "<b>There is $row->totalret employee who is due to retire in $retirement years time. <a href=\"retirerpt.php\">Please click Here to view the list.</a></b>";
  } 
 

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
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;<a href="javascript:ChangePass()">Change Password</a>&nbsp;&bull;&nbsp;&nbsp;<a href="logout.php?reset=1">Log Out</a></td>

  </tr>

  <tr>
    <td width="172" rowspan="3" nowrap id="menu">
      <div style="width: 150px;">
      </div>
      <ul>
	  <?
       
		 if (!empty($isadmin) && ($isadmin=='y'))
		    echo "<li><a href=\"permissions.php\" onfocus=\"blurLink(this);\">Set User Permissions</a></li>";
		 
		 if (hasaccess($d,35,$userid)) echo "<li><a href=\"addsettings.php\" onfocus=\"blurLink(this);\">HR Settings</a></li>"; 
		  
		 if (hasaccess($d,1,$userid)) {
		   $hasaccess=1;
		   echo "<li><a href=\"employees.php\" onfocus=\"blurLink(this);\">Add Employees</a></li>"; 
		 }
		 if (hasaccess($d,2,$userid))  echo "<li><a href=\"addbank.php\" onfocus=\"blurLink(this);\">Add Banks</a></li>";
	     
	      
		 if (hasaccess($d,4,$userid))  echo "<li><a href=\"adddepartments.php\" onfocus=\"blurLink(this);\">Add Departments</a></li>";
	     if (hasaccess($d,5,$userid))  echo "<li><a href=\"adddesignations.php\" onfocus=\"blurLink(this);\">Add Designations</a></li>";
	     if (hasaccess($d,10,$userid)) echo "<li><a href=\"addnationalities.php\" onfocus=\"blurLink(this);\">Add Nationalities </a></li>";
      	 if (hasaccess($d,6,$userid))  echo "<li><a href=\"addquals.php\" onfocus=\"blurLink(this);\">Add Qualifications</a></li>";
	     if (hasaccess($d,36,$userid))  echo "<li><a href=\"addjobgrps.php\" onfocus=\"blurLink(this);\">Add Job Groups</a></li>";
		  
		 if (hasaccess($d,11,$userid))  echo "<li><a href=\"addunits.php\" onfocus=\"blurLink(this);\">Add Units</a></li>";
		 if (hasaccess($d,12,$userid)) echo "<li><a href=\"addleavetype.php\" onfocus=\"blurLink(this);\">Add Leave Type</a></li>";
		   
		 if (hasaccess($d,13,$userid)) echo "<li><a href=\"viewemployees.php\" onfocus=\"blurLink(this);\">View Amended Records</a></li>";
		 
		 echo "<hr noshade size=\"3\" color=\"#eb8137\">";
		 if (hasaccess($d,32,$userid))  echo "<li><a href=\"totalsrepstn.php\" onfocus=\"blurLink(this);\">Totals By Stations</a></li>";
		 
		 
		 if (hasaccess($d,14,$userid)) echo "<li><a href=\"totalsrep.php\" onfocus=\"blurLink(this);\">Totals By Departments</a></li>";
		 if (hasaccess($d,15,$userid)) echo "<li><a href=\"qlevelsrep.php\" onfocus=\"blurLink(this);\">Totals By Qualifications</a></li>";
		 if (hasaccess($d,16,$userid)) echo "<li><a href=\"totalstatus.php\" onfocus=\"blurLink(this);\">Totals By Status</a></li>";
		 if (hasaccess($d,17,$userid)) echo "<li><a href=\"totalservice.php\" onfocus=\"blurLink(this);\">Totals By Service Type</a></li>";
		 if (hasaccess($d,18,$userid)) echo "<li><a href=\"leaveapplications.php\" onfocus=\"blurLink(this);\">Totals By Leave Types</a></li>";
		 if (hasaccess($d,19,$userid)) echo "<li><a href=\"totalsdesigrep.php\" onfocus=\"blurLink(this);\">Totals By Designations</a></li>";
		 if (hasaccess($d,20,$userid)) echo "<li><a href=\"disciplinaryrep.php\" onfocus=\"blurLink(this);\">Total Disciplinary Cases</a></li>";
		 if (hasaccess($d,21,$userid)) echo "<li><a href=\"totalsjobgrprep.php\" onfocus=\"blurLink(this);\">Total By Job groups</a></li>";

		 if (hasaccess($d,22,$userid)) echo "<li><a href=\"employeexls.php\" onfocus=\"blurLink(this);\">Convert Employees List To Excel</a></li>";
	     if (hasaccess($d,23,$userid)) echo "<li><a href=\"dependantsrpt.php\" onfocus=\"blurLink(this);\">Dependants Report</a></li>";
		 if (hasaccess($d,24,$userid)) echo "<li><a href=\"nokrpt.php\" onfocus=\"blurLink(this);\">Next of Kin Report</a></li>";
		 if (hasaccess($d,25,$userid)) echo "<li><a href=\"trainingrpt.php\" onfocus=\"blurLink(this);\">Staff Training Report</a></li>";
		 if (hasaccess($d,26,$userid)) echo "<li><a href=\"appraisalrpt.php\" onfocus=\"blurLink(this);\">Staff Appraisals Report</a></li>";
		 if (hasaccess($d,29,$userid)) echo "<li><a href=\"totalsrepgen.php\" onfocus=\"blurLink(this);\">Totals by Gender Report</a></li>";
		 if (hasaccess($d,28,$userid)) echo "<li><a href=\"staffturnoverrpt.php\" onfocus=\"blurLink(this);\">Staff TurnOver Report</a></li>";
		 if (hasaccess($d,27,$userid)) echo "<li><a href=\"retirementrpt.php\" onfocus=\"blurLink(this);\">Staff Retirement Report</a></li>";
		 if (hasaccess($d,30,$userid)) echo "<li><a href=\"attachdocsrpt.php\" onfocus=\"blurLink(this);\">Attached Documents Report</a></li>";
		 if (hasaccess($d,33,$userid)) echo "<li><a href=\"newemployeesrpt.php\" onfocus=\"blurLink(this);\">New Employees Report</a></li>";
		 if (hasaccess($d,34,$userid)) echo "<li><a href=\"suspendedemprpt.php\" onfocus=\"blurLink(this);\">Suspended Employees Report</a></li>";
		echo "</ul>";
		echo "</ul>";
       
	   	$d->close();
	    $d->connect($db_host, $db_user, $db_pass, $db); 
	   ?>
      <p>&nbsp;</p>
    

    </td>
    <td width="100%"  bgcolor="#FFFFFF" ><form name="form1" method="post" action="viewemployees.php">
	<table width="100%"  border="0">
      <tr>
        <th width="15%">Search By:
          <div class="highlight" id="inf_lname">&nbsp;</div></th>
        <th width="22%">
          <select name="searchcrit" id="searchcrit">
            <option value="fname">Full Name</option>
            <option value="lname">Last Name</option>
            <option value="pnumber">Payroll Number</option>
           
            <option value="desig">designation</option>
            <option value="depart">Department</option>
            <option value="status">Status</option>
            
          </select>
        </th>
        <th width="15%">Search Value </th>
        <th width="24%"><input type="text" name="searchval"></th>
        <th width="24%"><input name="Search" type="submit" id="Search" <?  if (!empty($_POST["searchval"])) echo "value=\"Show All\""; else echo "value=\"Search\""; ?>></th>
      </tr>
    </table> 
	</form> 
	<?
	  if (!empty($contexpmsg))
	    echo $contexpmsg."<br>";
	  
	  if (!empty($retmsg))
	    echo $retmsg."<br>";
	  
	?>     
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
   			   $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
               inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
               inner join designation on designation.id=position_fk
			   left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
               inner join prdept on prdept.deptcode=prmember.dept where fullname like '%".$_POST["searchval"]."%'";
			   break;
			case "lname":
			    $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
                inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
                inner join designation on designation.id=position_fk
				left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
                inner join prdept on prdept.deptcode=prmember.dept where lastname like '%".$_POST["searchval"]."%'";
			   break;
			case "pnumber":
			    $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
                inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
                inner join designation on designation.id=position_fk
				left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
                inner join prdept on prdept.deptcode=prmember.dept where memberno like '%".$_POST["searchval"]."%'";
			   break;
			case "idnum":
			   $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
               inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
               inner join designation on designation.id=position_fk
			   left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
               inner join prdept on prdept.deptcode=prmember.dept where idnumber like '%".$_POST["searchval"]."%'";
			   break;
		    case "desig":
			   $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
               inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
               inner join designation on designation.id=position_fk
			   left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
               inner join prdept on prdept.deptcode=prmember.dept where designation like '%".$_POST["searchval"]."%'";
			   break;
			 case "depart":
			   $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
                inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
                inner join designation on designation.id=position_fk
				left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
                inner join prdept on prdept.deptcode=prmember.dept where Dept like '%".$_POST["searchval"]."%'";
			   break;
			  case "status":
			   $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
               inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
               inner join designation on designation.id=position_fk
			   left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
               inner join prdept on prdept.deptcode=prmember.dept  
			   where status like '%".$_POST["searchval"]."%' ";
			   break;
             }    
		 }
		else
	      $sqlstr="select prmember.memberno,status,fullname,prmember.suspended,othernames,station,designation.designation,Dept,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
         inner join tbl_countries1 on tbl_countries1.id=prmember.nationality
         inner join designation on designation.id=position_fk
		 left join tbl_empstatus on empstatus_fk=tbl_empstatus.id
         inner join prdept on prdept.deptcode=prmember.dept order by memberno";
		
		
		$result=$d->query($sqlstr) or die(mysql_error());
		$numrows=$d->numrows($result);
		
		 if (!empty($_POST["searchval"]))
		   echo "Search  Returned $numrows Records";
		 else
		   echo "Total No. of Amended Records : $numrows";
		//header
		//<th  width=\"10\"><div class=\"highlight style4\" id=\"inf_lname\">ID/PassPort Number</div></th>
		 echo "<tr>
          <td  bgcolor=\"#FFFFFF\" ><table width=\"100%\"  border=\"0\">
          <tr>
          <th width=\"10%\"><span class=\"style4\">No.</span></th>
          <th width=\"10%\"><span class=\"style4\">Employee</span>        
        <th width=\"10%\"><span class=\"highlight style4\">&nbsp;Gender</span>
        <th width=\"10%\">Dept</th>
		<th width=\"10%\">Station</th>
        <th width=\"20%\">Designation        
        
        <th  width=\"11\">Nationality </th>
		 <th  width=\"11\">Status </th>
		 <th  width=\"11\">Suspended </th>
        <th  width=\"25\">Action</th>
      </tr>";
		while ($row=$d->fetch_object($result))
		{
		
		  
		  echo "<tr>";
		  echo "<td>".$row->memberno."</td>";
		  echo "<td>".$row->fullname."</td>";
		  echo "<td>".$row->gender."</td>";
		  echo "<td>".$row->Dept."</td>";
		   echo "<td>".$row->station."</td>";
		  
		  echo "<td>".$row->designation."</td>";
		 // echo "<td>".$row->national_idnum."</td>";
		  echo "<td>".$row->countryname."</td>";
		  echo "<td>".$row->status."</td>";
		  
		  if ($row->suspended==-1)
		    echo "<td>Yes</td>";
		  else
		    echo "<td>No</td>";
		  if ($hasaccess==1) 
		    echo "<td> <a href=employees.php?empid=$row->memberno&action=edit>Edit</a> | <a href=\"javascript:viewemp($row->memberno)\">View</a> </td>";
		  else
		    echo "<td> <a href=\"javascript:viewemp($row->memberno)\">View</a></td>";
			 
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
 <span class="copydownload style5">Welcome to the Foresight HR database system.
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
	 
  function ChangePass()
	 {
        var url = "changepass.php";
   
        newwin = window.open(url,'View','width=500,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollbars=3');
        newwin.focus();
     }

</script>
</body>

</html>



