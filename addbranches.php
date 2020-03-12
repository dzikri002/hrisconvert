<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title></title>
	

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
	
	if (!validateSelect(document.forms.addbranchesfrm.bank,'inf_bank',-1))  errs += 1; 
    if (!validatePresent(document.forms.addbranchesfrm.branch,'inf_branch')) errs += 1; 
	   
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

  
  
  if (!empty($_GET["branchid"]))
  {
    $id=$_GET["branchid"];
    $sqlstr="select * from tbl_branches1 where id=$id";
	$sqlresult=$d->query($sqlstr);
	$row=$d->fetch_object($sqlresult);
	
	$bank = $row->bankid_fk;
	$branch = $row->branchname;
    $id=  $row->id;
  }
  
  if (!empty($_POST["branch"]))
  { 
  
    $bank = "'".$_POST["bank"]."'";
	$branch = "'".$_POST["branch"]."'";
    $action =$_POST["action"];
	$id= "'".$_POST["id"]."'";
    
   if (!empty($action) && ($action=="edit"))
     $query="update tbl_branches1 set branchname=$branch,bankid_fk=$bank  where id=$id";
   else
     $query="insert into tbl_branches1 (branchname,bankid_fk) values ($branch,$bank)";
   
  // echo $query;
   
   if (!empty($query))
   {
    $result = $d->query($query);

	if (!$result) 
     	die('Invalid query - Record Not Saved: ' . mysql_error());
	else
	{
	   echo "<font face = Tahoma size=1><b>Record Successfully Saved </b></font>";
	   echo "<meta http-equiv='refresh' content='1;url=addbranches.php'>";
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
	   <li><a href="addnationalities.php" onfocus="blurLink(this);">Add Departments</a></li>
	   <li><a href="addunits.php" onfocus="blurLink(this);">Add Units</a></li>
	  </ul>        
        
    
    </div>
    
		
    </td>
    <td width="1646"  bgcolor="#FFFFFF" >
	
<form name="addbranchesfrm" method="post" action="addbranches.php">
<table width="100%"  border="0">
      <tr>
        <th><div align="right">Bank Name </div></th>
        <th><select name="bank" id="bank">
          <option value="">--SELECT--</option>
          <? Loadlookup("id","bankname","tbl_banks1",$bank,$d); ?>
        </select><div class="highlight" id="inf_bank">&nbsp;</div></th>
      </tr>
      <tr>
        <th width="20%"><div align="right">Branch Name </div></th>
        <th>          
        <input name="branch" type="text" id="branch" size="60"  <? if (!empty($branch)) echo "value='$branch'"; ?>>
          <div class="highlight" id="inf_branch">&nbsp;</div>
        </th></tr>
      <tr>
        <th>
          <input type="hidden" name="action" <? if (!empty($action))  echo "value=$action"; ?>>
		  <input type="hidden" name="id" <? if (!empty($id)) echo "value=$id"; ?>>
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
        <th width="1%">Bank Name </th>
        <th width="1%">Branch</th>
        <th width="3%">Action</th>
      </tr>
	  <?
	    	
		
	      $sqlstr="select tbl_branches1.*,tbl_banks1.bankname from tbl_branches1 inner join tbl_banks1 on bankid_fk=tbl_banks1.id";
		  $result=$d->query($sqlstr) or die(mysql_error());
				
		  while ($row=$d->fetch_object($result))
		  {
		    echo "<tr>";
		    echo "<td>".$row->id."</td>";
		    echo "<td>".$row->bankname."</td>";
		    echo "<td>".$row->branchname."</td>";					  
		    echo "<td> <a href=addbranches.php?branchid=$row->id&action=edit>Edit</a></td>";
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



