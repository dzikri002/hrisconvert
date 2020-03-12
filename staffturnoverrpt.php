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

	<title>Annual Staff TurnOver Report </title>
	

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
  
   //fetch departments,sections
   $sqlstr="select distinct dept, station from prmember order by dept,station";
   
   if (!empty($_POST["datefrom"]) && !empty($_POST["dateto"]))
   {
      $dispmsg = "<b>Employees Employed/Terminated between ".$_POST["datefrom"]." and ".$_POST["dateto"]."</b>";
	   
      $datefrom=dateconvert($_POST["datefrom"],1);
	  $dateto=dateconvert($_POST["dateto"],1);
			 
	 
		     
	  
	}
	
	 
		  
	if (!empty($dispmsg))
	  echo "$dispmsg";	
	else
	 echo"<b>Employees Employed/Terminated during the last one year from today</b>";  
 ?>
<table width="847" cellpadding="0" cellspacing="0"  id="main">
  <tr>
    <td id="cell_top">&nbsp;
    </td>
  </tr>

  <tr>
    <td >
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;</td>

  </tr>

  <tr>
    <td width="1646"  bgcolor="#FFFFFF" >
	
<form name="totalsrepfrm" method="post" action="staffturnoverrpt.php">
<table width="100%"  border="0">
      <tr>
        <th width="20%"><div align="right">Employment Date From</div></th>
        <th width="20%">          
          <div class="highlight" id="inf_bank">&nbsp;
            <input name="datefrom" type="text" id="datefrom"  <? if (!empty($dob)) echo "value=$dob"; ?>>
          </div>
        </th>
        <th width="16%"><div align="right">Employment Date To</div></th>
        <th width="44%"><input name="dateto" type="text" id="dateto"  <? if (!empty($dob)) echo "value=$dob"; ?>></th>
      </tr>
      <tr>
        <th>
          <input type="hidden" name="action" <?  if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <?  if (!empty($id)) echo "value=$id"; ?>>
		  </th>
        <th colspan="3"><div align="right">
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
       
        <th width="2%">Department</th>
		<th width="2%">DeptCode</th>
		<th width="2%">Section Code</th>
		<th width="5%"><div align="center">No. of Staff Employed </div></th>
		<th width="5%"><div align="center">No. of Staff Who have Left </div></th>
        </tr>
	  <?
	    	
		 //count active staff for now	
		
		 
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		  
		  //total employed
		   if (!empty($datefrom) && !empty($dateto)){
		    $querystr ="select count(memberno) as totalemp,DeptCode,DeptName,StationCode,StationName from prmember left join prdept on Dept=DeptCode
             left join prstn on StationCode=Station
             where DeptCode='$row->dept' and StationCode='$row->station' and empdate >= '$datefrom' and empdate <= '$dateto' and empstatus_fk =1 group by Deptcode,deptname,StationCode,StationName ";
		   }else
		      $querystr=" select count(memberno) as totalemp,DeptCode,DeptName,StationCode,StationName from prmember  left join prdept on Dept=DeptCode
              left join prstn on StationCode=Station where DeptCode='$row->dept' and StationCode='$row->station' and empdate >=date_sub(curdate(),interval 365 day) and empdate <=curdate()
             and empstatus_fk =1 group by Deptcode,deptname,StationCode,StationName";
	      
		 
			
			$queryresult=$d->query($querystr) or die(mysql_error());
		    $data=$d->fetch_object($queryresult);
		   
		   //total quit
		 
		   if (!empty($datefrom) && !empty($dateto)){
		     $querystr= "select count(memberno) as totalquit,DeptCode,DeptName,StationCode,StationName from prmember left join prdept on Dept=DeptCode
           left join prstn on StationCode=Station where quitdate >='$datefrom' and quitdate <='$dateto'
           and empstatus_fk <>1 and DeptCode='$row->dept' and StationCode='$row->station' group by Deptcode,deptname,StationCode,StationName";
		   
		   }
		   else
		   $querystr= "select count(memberno) as totalquit,DeptCode,DeptName,StationCode,StationName from prmember left join prdept on Dept=DeptCode
           left join prstn on StationCode=Station where quitdate >=date_sub(curdate(),interval 365 day) and quitdate <=curdate()
           and empstatus_fk <>1 and DeptCode='$row->dept' and StationCode='$row->station' group by Deptcode,deptname,StationCode,StationName";
		  
		   $qresult=$d->query($querystr) or die(mysql_error());
		   $qdata=$d->fetch_object($qresult);
		 
		    echo "<tr>";
			if (!empty($data->DeptName))
			  echo "<td>".$row->dept."&nbsp;</td>";
		    else
			  echo "<td>".$row->dept."&nbsp;</td>";
			
			echo "<td>".$row->dept."&nbsp;</td>";  
			echo "<td>".$row->station."&nbsp;</td>"; 
			
			if (!empty($data->totalemp))
			  echo "<td><a href=\"staffturnoverrptdet.php?dept=$row->dept&stn=$row->station&quit=2\">".$data->totalemp."</a>&nbsp;</td>";
			else
			  echo "<td>0&nbsp;</td>";
			
			if (!empty($qdata->totalquit))   
		      echo "<td><a href=\"staffturnoverrptdet.php?dept=$row->dept&stn=$row->station&quit=1\">".$qdata->totalquit."</a>&nbsp;</td>";
		    else
			  echo "<td>0&nbsp;</td>";
			  
			$totalemp=$data->totalemp+$totalemp;
			$totalquit=$qdata->totalquit+$totalquit;
		    echo "</td></tr>";
		  
		  }
	     echo "<td> <b>Totals</b> </td><td>&nbsp;</td><td>&nbsp;</td>";
		 echo "<td> <b>$totalemp</b> </td><td> <b>$totalquit</b> </td>";
	  ?>
    </table></td>
  </tr>
</table>

<?
  $d->close();
?>
</body>

</html>



