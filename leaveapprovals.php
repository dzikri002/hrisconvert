<?php
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
  header("Pragma: no-cache");
 ?>
<head> 
<script language="javascript">
</script>
</head>
<body>
 <?
  include "headerlogo.php";
  include "config.php";
  include "functions.php";
  require_once "db.php";
  $d = new dbC();
  $d->connect($db_host, $db_username, $db_password, $db); 	
	   
   if (!empty($_SESSION["username"]))
   {
     $sqlstr="select * from support_users where username='".$_SESSION["username"]."'";
   
     $data=$d->query($sqlstr);
     $row=$d->fetch_object($data);
     $fullname="'".$row->name."'"; 
     $user=$_SESSION["username"];
	 $userid=$row->id;
     $isadmin=$row->admin;
     echo "<fieldset>";
    
	$sqlstr="select approver,authoriser,issuesitems from intranet_depts where userid_fk=$userid";
    $sqlresult=$d->query($sqlstr);
    $row=$d->fetch_object($sqlresult);
   
   if (empty($sqlresult))
     usermenu();
	 
   if (($row->approver==0) && ($row->authoriser==0))
     usermenu(); 
	 
   if (($row->approver==1) && ($row->authoriser==1))
     authorisermenu();
   
   if (($row->approver==1) && ($row->authoriser==0))
     approvermenu();
   
   if (($row->approver==0) && ($row->authoriser==1))
     authorisermenu();
   
   echo "</fieldset>";

	 
   
   }
   else
    die("<center><font color=red>You have not yet Logged in.<a href=index.php>Please click here to log in.</a></font><center>");

    if (!empty($_REQUEST["deptid"]))
	  $deptid=$_REQUEST["deptid"];
	else
	{
	  if (!empty($_POST["deptid"]))
	    $deptid=$_POST["deptid"];
	  else
	    $deptid=0; 
	}
	
	echo "<br><font face=verdana size=2>To approve Click on the check box in the Approve Column. To Reject Click on the check box in the Reject Column. You have to do this for each employee
	Then Click on Submit To Forward the results.</font><br>";
    echo "<br><center>";
    echo"<table border=1 cellpadding=2 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100%> <tr>";
    echo "<center><div align=\"center\"
	  style=\"display: block;\"></div><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">
      <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Employee Name</b> </div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Designation</b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>No of Days </b></div>
				
				
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Date From</b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Date To </b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Added By </b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Approve </b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Reject </b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b> Comment </b></div></td>
               
			  </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\"></tr></tbody>";  
 if (!empty($deptid)) 
 $sqlstr="Select
  intranet_leave.id,
  intranet_leave.fullname,
  intranet_leave.dateto,
  intranet_leave.numdays,
  intranet_leave.pnumber,
  intranet_leave.confirmed,
  intranet_leave.addedby,
  intranet_leave.dateadded,
  intranet_leave.sessid,
  intranet_leave.datefrom,
  intranet_leave.approved,
  intranet_desig.DESIGNAME,
  intranet_depts.deptname
  From
  intranet_leave
  Inner Join intranet_desig on 
  intranet_desig.desigid=desigid_fk
  Inner Join intranet_depts on
  intranet_depts.deptid=deptid_fk
  where deptid=$deptid and (approved is null)";
  else
  $sqlstr="Select
  intranet_leave.id,
  intranet_leave.fullname,
  intranet_leave.dateto,
  intranet_leave.numdays,
  intranet_leave.pnumber,
  intranet_leave.confirmed,
  intranet_leave.addedby,
  intranet_leave.dateadded,
  intranet_leave.sessid,
  intranet_leave.datefrom,
  intranet_leave.approved,
  intranet_leave.approvedby,
  intranet_desig.DESIGNAME,
  intranet_depts.deptname
  From
  intranet_leave
  Inner Join intranet_desig on 
  intranet_desig.desigid=desigid_fk
  Inner Join intranet_depts on
  intranet_depts.deptid=deptid_fk";
  
 $data = $d->query($sqlstr);
 
 print "<form name=\"approvefrm\"  method=post action=leaveapprovals.php?deptid=$deptid>";
 print "<input type=hidden name=deptid value=$deptid>";  
 
 while ($row=mysql_fetch_object($data))
 {
    $date1=substr($row->datefrom,0,10);
	$date2=substr($row->dateto,0,10);
	
    $date1=dateconvert($date1,2);
	$date2=dateconvert($date2,2);
		
	echo "<tbody>
              <tr bgcolor=\"#ffffff\">
                <td width=\"12%\" ><div align=\"right\"> $row->fullname </div></td>
				<td width=\"12%\" ><div align=\"right\">$row->DESIGNAME</div></td>
				<td width=\"12%\" ><div align=\"right\"> $row->numdays </div>
				<td width=\"12%\" ><div align=\"right\"> $date1 </div></td>
				<td width=\"12%\" ><div align=\"right\"> $date2 </div></td>
				<td width=\"12%\" ><div align=\"right\"> $row->addedby</div></td>";
	
	
	    print "<td width=\"12%\" ><div align=\"right\"><input type=checkbox name=Approve".$row->id." value=this.checked  onClick=\"if (this.checked) Reject$row->id.checked=false \"></td>";
	    print "<td width=\"12%\" ><div align=\"right\"><input type=checkbox name=Reject".$row->id." value=this.checked onClick=\"if (this.checked) Approve$row->id.checked=false \" > </td>";
		
	 print "<td width=\"12%\" > <font face=verdana size=1><div align=\"right\"> <a href=javascript:comments($row->id,'lea',$userid,$row->id)>Add </a>/<a href=javascript:viewcomments($row->id,'lea')>View</a> </div></font></td>";
	 print "</tr></tbody>\n";
 }

echo "</table></table> </center>";
print "<hr><div align=right><input type=submit name=submit value=submit><div></form>";

  if (!empty($_POST["submit"]))
  {  
    $sqlstr="select intranet_leave.id,email from intranet_leave
    inner join  support_users
    on username=addedby
    where approved is null and deptid_fk=$deptid";
	
    $sqlresult=$d->query($sqlstr);
	$today=date('Y/m/d h:i:s');
	
	while ($row=$d->fetch_object($sqlresult))
	{
	  $usermail=$row->email;
	  if (!empty($_POST["Approve".$row->id]))
	  {
	    $sqlstr="update intranet_leave set approved=1,approvedby='$user',dateapproved='$today' where id=$row->id";
		$d->query($sqlstr) or die(mysql_error());
		$mailbody="This is an automated mail.Do not Reply.Your leave application has been approved by $user.You can access the intranet on http://172.16.12.3/intranet to confirm.";
	  }
	  if (!empty($_POST["Reject".$row->id]))
	  {
	    $sqlstr="update intranet_leave set approved=0,approvedby='$user',dateapproved='$today' where id=".$row->id;
		$d->query($sqlstr) or die(mysql_error());
	    $mailbody="This is an automated mail.Do not Reply.Your leave application has been Rejected by $user.You can access the intranet on http://172.16.12.3/intranet to Amend/Reapply.";
	  }
	  sendemail("Leave Application Approvals. ".$mailbody,$support_email,$usermail);
	}
	
	//echo "<meta http-equiv='refresh' content='1;url=.php?deptid=$deptid><br><br><font face=verdana size=2>Leave Approval details successfully submitted.</font>";	
    echo "<meta http-equiv='refresh' content='1;url=leaveapprovals.php?deptid=$deptid'><font face=verdana size=2>Leave Approval details successfully submitted.</font>";
	 
  }

echo "<BR><BR><BR><BR><BR><span><fieldset>";
include "./footer.php"; 
echo "</fieldset> </span>";

?>
<script language="JavaScript">
   
     function comments(id,wherestr,userid,whereid)
	 {
        var url = "comments.php?id="+id+"&wherestr="+wherestr+"&userid="+userid+"&whereid="+whereid;
   
        newwin = window.open(url,'Add','width=350,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollBars=0,resizable=0');
        newwin.focus();
     }
	 
	 
     function viewcomments(whereid,wherestr)
	 {
        var url = "Viewcomments.php?whereid="+whereid+"&wherestr="+wherestr;
   
        newwin = window.open(url,'View','width=350,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollBars=1,resizable=1');
        newwin.focus();
     }
</script>
</body>


