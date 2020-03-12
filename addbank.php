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

	<title>Add Banks</title>
	

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
 

 function validateOnSubmit() {
	var elem;
    var errs=0;
	// execute all element validations in reverse order, so focus gets
    // set to the first one in error.
	
	if (!validatePresent(document.forms.addbankfrm.bankaddr1,'inf_bankaddr1'))  errs += 1; 
	if (!validatePresent(document.forms.addbankfrm.bank,'inf_bank'))  errs += 1; 
    if (!validatePresent(document.forms.addbankfrm.bankcode,'inf_bankcode'))  errs += 1; 
	    
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
  
  
  
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  
  
  if (!empty($_GET["bankid"]))
  {
    $id=$_GET["bankid"];
    $sqlstr="select bankname,bankcode,bankaddr1,bankaddr2 from prbank where bankcode=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$bank = $row->bankname;
	$bankcode=$row->bankcode;
	$bankaddr1=$row->bankaddr1;
	$bankaddr2=$row->bankaddr2;
	
    
  }
  
  if (!empty($_POST["bank"]))
  { 
  
    $bank = "'".$_POST["bank"]."'";
	$bankaddr1 =  empty($_POST["bankaddr1"]) ? 'NULL' : "'" . $_POST["bankaddr1"] . "'"; 
	$bankaddr2 = empty($_POST["bankaddr2"]) ? 'NULL' : "'" . $_POST["bankaddr2"] . "'";  
    $action =$_POST["action"];
	$id=$_POST["id"];
	$bankcode= "'".$_POST["bankcode"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update prbank set bankname=$bank,bankcode=$bankcode,bankaddr1=$bankaddr1,bankaddr2=$bankaddr2 where bankcode='$id'";
   else
     $query="insert into prbank (bankname,bankcode,bankaddr1,bankaddr2) values ($bank,$bankcode,$bankaddr1,$bankaddr2)";
   
  // echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=addbank.php'>";
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
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Nationalities</a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Units</a></li>
	  </ul>        
        
    
    </div>
    
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	
<form name="addbankfrm" method="post" action="addbank.php">
<table width="100%"  border="0">
      <tr>
        <th><div align="right">Bank Code </div></th>
        <th><input name="bankcode" type="text" id="bankcode" size="15"  <?  if (!empty($bankcode))echo "value='$bankcode'"; ?>></th>
         <div class="highlight" id="inf_bankcode">&nbsp;</div>
	  </tr>
      <tr>
        <th width="20%"><div align="right">Bank Name </div></th>
        <th>          
        <input name="bank" type="text" id="bank" size="60"  <?  if (!empty($bank))echo "value='$bank'"; ?>>
          <div class="highlight" id="inf_bank">&nbsp;</div>
        </th></tr>
      <tr>
        <th><div align="right">Bank Address 1 </div></th>
        <th><input name="bankaddr1" type="text" id="bankaddr1" size="60"  <?  if (!empty($bankaddr1))echo "value='$bankaddr1'"; ?>>  
		<div class="highlight" id="inf_bankaddr1">&nbsp;</div> </th>
        </tr>
      <tr>
        <th><div align="right">Bank Address2 </div></th>
        <th><input name="bankaddr2" type="text" id="bankaddr2" size="60"  <?  if (!empty($bank))echo "value='$bankaddr2'"; ?>></th>
      </tr>
      <tr>
        <th>
          <input type="hidden" name="action" <?  if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <?  if (!empty($bankcode)) echo "value=$bankcode"; ?>>
		  </th>
        <th><div align="right">
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
        <th width="2%">Bank Name </th>
		<th width="2%">Bank Address1 </th>
		<th width="2%">Bank address2 </th>
        <th width="3%">Action</th>
      </tr>
	  <?
	    	
		
	      $sqlstr="select bankname,bankcode,bankaddr1,bankaddr2 from prbank";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->bankcode."</td>";
		    echo "<td>".$row->bankname."</td>";
		    echo "<td>".$row->bankaddr1."</td>";
			echo "<td>".$row->bankaddr2."</td>";
			  
		    echo "<td> <a href=addbank.php?bankid=$row->bankcode&action=edit>Edit</a></td>";
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
</body>

</html>



