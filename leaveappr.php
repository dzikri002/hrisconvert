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
    
	$sqlstr="select approver,authoriser from intranet_depts where userid_fk=$userid";
    $sqlresult=$d->query($sqlstr);
    $row=$d->fetch_object($sqlresult);
    $numrows = $d->numrows($sqlresult);
  
   if ($numrows==0)
     usermenu();
	
   if (isset($row->approver) && isset($row->authoriser))
   {
	 
   if (($row->approver==0) && ($row->authoriser==0))
     usermenu(); 
	 
   if (($row->approver==1) && ($row->authoriser==1))
     authorisermenu();
   
   if (($row->approver==1) && ($row->authoriser==0))
     approvermenu();
   
   if (($row->approver==0) && ($row->authoriser==1))
     authorisermenu();
   }
   echo "</fieldset>";
	 
    
   }
  
  include "leaveapprparams.php";
	
  if (!empty($_GET["date2"]))
  {

    $today=$_GET["date2"];
	$dispdate1=$today;
	$today=dateconvert($today,1);
	
	$lastwk=$_GET["date1"];
	$dispdate2=$lastwk;
	$lastwk=dateconvert($lastwk,1);
	
    $sqlstr="Select  intranet_leave.id,intranet_leave.dateto, intranet_leave.numdays, intranet_leave.pnumber,
    intranet_leave.confirmed, intranet_leave.addedby, intranet_leave.dateadded, intranet_leave.sessid,
    intranet_leave.datefrom, intranet_leave.approved, intranet_leave.dateapproved, intranet_leave.approvedby,
    intranet_desig.DESIGNAME, intranet_depts.deptname
    From intranet_leave inner Join intranet_desig on 
    intranet_desig.desigid=desigid_fk
    Inner Join intranet_depts on
    intranet_depts.deptid=deptid_fk
    where addedby='$user' and (approved=1) and (dateapplied >= '$lastwk' and dateapplied <= '$today')";
  }
  else
  {
     $today= date("d")."-".date("m")."-". (date("Y")+1);
	 $dispdate1=date('d-m-Y');
	 $today=dateconvert($today,1);
	 
     $lastwk = date("d")."-".date("m")."-". (date("Y")-1);
	 $dispdate2=$lastwk;
	 $lastwk=dateconvert($lastwk,1);
	
	 $sqlstr="Select  intranet_leave.id,intranet_leave.dateto, intranet_leave.numdays, intranet_leave.pnumber,
    intranet_leave.confirmed, intranet_leave.addedby, intranet_leave.dateadded, intranet_leave.sessid,
    intranet_leave.datefrom, intranet_leave.approved, intranet_leave.dateapproved, intranet_leave.approvedby,
    intranet_desig.DESIGNAME, intranet_depts.deptname
    From intranet_leave inner Join intranet_desig on 
    intranet_desig.desigid=desigid_fk
    Inner Join intranet_depts on
    intranet_depts.deptid=deptid_fk
    where addedby='$user' and (approved=1) and (dateapplied >= '$lastwk' and dateapplied <= '$today')";
	
  }
	
    echo "<hr><br>";
	echo "<center><div align=\"center\"
	  style=\"display: block;\"></div><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">
      <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <td width=\"12%\" class=\"header9\"><div align=\"right\"><b>P Number</b> </div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>DeptName</b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Designation </b></div>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>No of days </b></div></td>
				
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Date From</b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Date To </b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Approved By </b></div></td>
				<td width=\"12%\" class=\"header9\"><div align=\"right\"><b>Date Approved </b></div></td>
               
			  </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\"></tr></tbody>";  
			   
 
  
  $data = $d->query($sqlstr);
 
 while ($row=mysql_fetch_object($data))
 {
    $date1=substr($row->datefrom,0,10);
	$date2=substr($row->dateto,0,10);
	
    $date1=dateconvert($date1,2);
	$date2=dateconvert($date2,2);	
	echo "<tbody>
              <tr bgcolor=\"#ffffff\">
                <td width=\"12%\" ><div align=\"right\"> $row->pnumber </div></td>
				<td width=\"12%\" ><div align=\"right\">$row->deptname</div></td>
				<td width=\"12%\" ><div align=\"right\"> $row->DESIGNAME</div>
				<td width=\"12%\" ><div align=\"right\">$row->numdays </div></td>
				
				<td width=\"12%\" ><div align=\"right\"> $date1 </div></td>
				<td width=\"12%\" ><div align=\"right\"> $date2 </div></td>
				
				<td width=\"12%\" ><div align=\"right\">$row->approvedby </div></td>
				<td width=\"12%\" ><div align=\"right\">$row->dateapproved </div></td>";
   print "</tr></tbody>\n";
 }
 echo "</table></table>  </center>";
 
echo "<BR><BR><BR><BR><BR><span><fieldset>";
include "./footer.php"; 
echo "</fieldset> </span>";

?>



