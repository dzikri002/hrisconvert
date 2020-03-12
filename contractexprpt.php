<? session_start();
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

	<title>Contract Expiry Report </title>
	

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
	var dp1_cal,dp2_cal
     window.onload = function () {
	
	dp1_cal  = new Epoch('epoch_popup','popup',document.getElementById('datefrom'));
	dp2_cal = new Epoch('epoch_popup','popup',document.getElementById('dateto'));
};

 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validatePresent(document.forms.addbankfrm.bank,'inf_bank'))  errs += 1; 
		    
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
  
  
  $sqlstr="select * from hrsettings order by id desc";
  $result =$d->query($sqlstr);
  $row=$d->fetch_object($result);
  
  $contract=$row->contract;

  
    
 ?>
<table width="847" cellpadding="0" cellspacing="0"  id="main">
  <tr>
    <td id="cell_top">&nbsp;
    </td>
  </tr>

  <tr>
    <td >
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;<a href="contractexpxls.php" onfocus="blurLink(this);">Convert To Excel</a>&nbsp;&bull;&nbsp;</td>

  </tr>

  <tr>
    <td width="1646"  bgcolor="#FFFFFF" >
	
<form name="totalsrepfrm" method="post" action="contractexprpt.php">
<table width="100%"  border="0">
      <tr>
        <th><div align="right">Date From </div></th>
        <th><input name="datefrom" type="text" id="datefrom"></th>
        <th> <div align="right">Date To </div></th>
        <th><input name="dateto" type="text" id="dateto"></th>
        <th><input type="submit" name="Submit" value="Submit"></th>
        </tr>
    </table> 
	</form>    
    </td>
  </tr>
  <tr>
  <? 
    if (!empty($_POST["datefrom"]) && (!empty($_POST["dateto"])))
     echo "<b>Contracts expiring between ". $_POST["datefrom"]." and ".$_POST[dateto]."</b>";
  ?>
    <td  bgcolor="#FFFFFF" ><table width="100%"  border="0">
      <tr>
        <th width="2%">Members No </th>
        <th width="2%">Employee </th>
		<th width="5%"><div align="center">Designation </div></th>
		<th width="5%"><div align="center">Gender </div></th>
		<th width="5%"><div align="center">Department</div></th>
		 <th width="5%"><div align="center">Station</div></th>
		 <th width="5%"><div align="center">Employment Date</div></th>
		 <th width="5%"><div align="center">Expiry Date</div></th>
		 <th width="5%"><div align="center">Months Remaining</div></th>
		</tr>
	  <?
	    	
		 //count active staff for now	
		if (!empty($contract)) 
          
		  $sqlstr="select birthdate,empdate,effdate,sex,memberno,designation.designation,fullname,quitdate,jobgroup,dept,station,(datediff(quitdate,now()) div 30) as monthsrem from prmember 
		  left join designation on designation.id=prmember.position_fk
		  where (datediff(quitdate,now()) div 30) < $contract and (datediff(quitdate,now()) div 30) >= 0 and suspended=0 and empstatus_fk=1 order by dept,station";		  
	   
		if (!empty($_POST["datefrom"]) && (!empty($_POST["dateto"]))){
		
		  $datefrom=dateconvert($_POST["datefrom"],2);
		  $dateto=dateconvert($_POST["dateto"],2);
		  
		  $sqlstr="select birthdate,empdate,effdate,sex,memberno,designation.designation,fullname,quitdate,jobgroup,dept,station,(datediff(quitdate,now()) div 30) as monthsrem from prmember 
		  left join designation on designation.id=prmember.position_fk
		  where quitdate >= '$datefrom' and quitdate <='$dateto' and suspended=0 and empstatus_fk=1 order by dept,station";	
		} 
		 
		  $result=$d->query($sqlstr) or die(mysql_error());
		  $numrows=$d->numrows($result);
		  
		  if ($numrows>0)		
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
			echo "<td>".$row->memberno."</td>";
			echo "<td>".$row->fullname."</td>";
			echo "<td>".$row->designation."</td>";
			echo "<td>".$row->sex."</td>";
		    echo "<td>".$row->dept."</td>";
		    echo "<td>".$row->station."</td>";
			echo "<td>".datetimeconvert($row->empdate,2)."</td>";
			echo "<td>".datetimeconvert($row->quitdate,2)."</td>";
			
			echo "<td>".$row->monthsrem."</td>";
		    echo "</td></tr>";
		  }
		
	    
	  ?>
    </table></td>
  </tr>
</table>

<?
  $d->close();
?>
</body>

</html>



