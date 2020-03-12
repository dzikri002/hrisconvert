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

	<title>View Next of Kin</title>
	


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
	if (!validatePresent(document.forms.nokfrm.relationship,'inf_relationship'))  errs += 1;
	if (!validatePresent(document.forms.nokfrm.address,'inf_address'))  errs += 1; 
	if (!validatePresent(document.forms.nokfrm.lname,'inf_lname'))  errs += 1; 
	
	if (!validatePresent(document.forms.nokfrm.fname,'inf_fname'))  errs += 1; 
	
	
	
	
	
    
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
	
  if (!empty($_GET["action"]))
    $action=$_GET["action"];

  //employee details for display only
  if (!empty($empid))
  {
    $sqlstr="select * from prmember left join tbl_titles on tbl_titles.id=emptitle where prmember.memberno=$empid";
	$query=$d->query($sqlstr);
	$row = $d->fetch_object($query);
	
	$dispname="<font face = Verdana size=2><b>Add Next of Kin Details for: <a href=employees.php?empid=$row->MemberNo&action=edit>" . $row->title. $row->FullName."</a>";
	$dispname = $dispname."&nbsp;&nbsp;&nbsp;Payroll Number : ".$row->MemberNo."</b></font>";
    
  }
  
  if (!empty($_GET["nokid"]))
  {
    $id=$_GET["nokid"];
    $sqlstr="select * from tbl_nextofkin where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$relationship = $row->relationship;
    $fname = $row->fname;
    $mname = $row->mname;
    $lname = $row->lname;
    $address = $row->address;
    $empid = $row->empid_fk;
    $id=  $row->id;
  }
  
  if (!empty($_POST["fname"]))
  { 
   
	
    $relationship = empty($_POST["relationship"]) ? 'NULL' : "'" . $_POST["relationship"] . "'";
    $fname = "'".$_POST["fname"]."'";
    $mname = empty($_POST["mname"]) ? 'NULL' : "'" . $_POST["mname"] . "'";
	$mphone = empty($_POST["mphone"]) ? 'NULL' : "'" . $_POST["mphone"] . "'";
	$email = empty($_POST["email"]) ? 'NULL' : "'" . $_POST["email"] . "'";
	
    $lname = "'".$_POST["lname"]."'";
    $address = "'".$_POST["address"]."'";
    $empnum = "'".$_POST["empid"]."'";;
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
	
	//echo $action;

    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_nextofkin set fname=$fname,lname=$lname,mname=$mname,address=$address,empid_fk=$empnum,relationship=$relationship,mphone=$mphone,email=$email where id=$id";
   else
     $query="insert into tbl_nextofkin (fname,lname,mname,address,empid_fk,relationship,mphone,email) values ($fname,$lname,$mname,$address,$empnum,$relationship,$mphone,$email)";
   
   //process delete
  if ($action=="delete_go")
  {
   $sqlstr="delete from tbl_nextofkin where id=$id";
   $d->query($sqlstr);
   echo "<meta http-equiv='refresh' content='1;url=nextofkin.php?empid=$empid'>";
  }
  
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=nextofkin.php?empid=$empid'>";
	}
   }
   
   
  }

 ?>
 
<table  id="main" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" id="cell_top">&nbsp;
     
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
      <ul>
        <li><a href="index.php" onfocus="blurLink(this);">View Employees</a></li>
	    <li><a href="" onfocus="blurLink(this);">Next of Kin</a></li>
	   <? if (!empty($empid)) echo "<a href=\"dependants.php?empid=$empid\"><li>Dependants</li></a>"; ?>
	  <li>Add Qualifications</li>
	  <li>Add Promotions</li>
	  <li>Attach Documents </li>
	  <li>Add Publications</li>
	  <li>Add Appointments</li>
      </ul>        
        
    
    </div>
     <? echo "<hr noshade size=\"3\" color=\"#eb8137\"> &nbsp;&nbsp;&nbsp;&nbsp;Employee Photo"; 
	   echo "<center><img src='viewimg.php?imgid=$empid' width=150 Height=150 ></center>"; ?>
    </td>
    <td width="100%"  bgcolor="#FFFFFF" >
	<? if (!empty($dispname)) echo $dispname; ?>
	<form name="nokfrm" method="post" action="nextofkin.php">
	<table width="100%"  border="0">
      <tr>
        <th width="15%">Name(s)</th>
        <th width="22%"><input name="fname" type="text" id="fname" <?   if (!empty($fname)) echo "value=$fname";?>><div class="highlight" id="inf_fname">&nbsp;</div>
        </th>
        <th width="7%"><input name="mname" type="text" id="mname" <? if (!empty($mname)) echo "value=$mname";?>><div class="highlight" id="inf_mname">&nbsp;</div></th>
        <th width="8%"><input name="lname" type="text" id="lname" <? if(!empty($lname)) echo "value=$lname";?>><div class="highlight" id="inf_lname">&nbsp;</div></th>
        </tr>
      <tr>
        <th>Address</th>
        <th><input name="address" type="text" id="address" size="30" <? if(!empty($address))echo "value=$address";?>>
        <div class="highlight" id="inf_address">&nbsp;</div></th>
        <th><div align="right">Relationship</div></th>
        <th><input name="relationship" type="text" id="relationship" <? if(!empty($relationship)) echo "value=$relationship";?>><div class="highlight" id="inf_relationship">&nbsp;</div></th>
      </tr>
      <tr>
        <th>Mobile Phone # </th>
        <th><input name="mphone" type="text" id="mphone" <? if(!empty($mphone))echo "value=$mphone";?>></th>
        <th><div align="right">Email</div></th>
        <th><input name="email" type="text" id="email" <? if(!empty($email))echo "value=$email";?>></th>
      </tr>
      <tr>
        <th><input type="hidden" name="empid" <?  if(!empty($empid)) echo "value=$empid"; ?>>
          <input type="hidden" name="action" <? if (!empty($action)) echo "value=$action"; ?>>
		  <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>></th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th><input type="submit" name="Submit" value="Submit" onclick="return validateOnSubmit()"></th>
      </tr>
    </table> 
	</form>    
      </td>
  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" ><table width="100%"  border="0">
      <tr>
        <th width="5%">No.</th>
        <th width="5%"><span class="style4">Name</span></th>
        <th width="10%"><span class="style4">Address</span>        
        <th width="10%"><span class="style4">Relation Ship</span>        
        <th width="5%">Mobile        
        <th width="5%">Email
        <th width="5%">Action              
      </tr>
	  <?
	    
		
		
	   	
		if (!empty($empid))
		{
	      $sqlstr="select * from tbl_nextofkin where empid_fk=$empid";
		  $result=$d->query($sqlstr) or die(mysql_error());;
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->fname." ".$row->mname." ".$row->lname."</td>";
		 
		    echo "<td>".$row->address."</td>";
		    echo "<td>".$row->relationship."</td>";
		    
			echo "<td>".$row->mphone."</td>";
			echo "<td>".$row->email."</td>";
		    echo "<td> <a href=nextofkin.php?nokid=$row->id&action=edit>Edit</a> | <a href=nextofkin.php?action=delete_go&nokid=$row->id onClick=\"Javascript:return confirm('Are you sure you want to delete this record?','Confirm Delete')\"> Delete</a></td>";
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



