<!DOCTYPE html
	PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



	<link rel="stylesheet" type="text/css" href="css/employees.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css"/>

	<title>View Employees</title>
	<meta name="generator" content="TYPO3 3.8 CMS" />
	

	

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
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
   

	  
  if (!empty($_GET["empid"]))
  {
	 $sqlstr="select tbl_employees.*,title,designation,DeptName,gender,countryname from tbl_employees
	      inner join tbl_countries1 on tbl_countries1.id=tbl_employees.nationality
		  inner join designation on designation.id=tbl_employees.position_fk
		  inner join tbl_titles on tbl_titles.id=tbl_employees.emptitle
		  inner join prdept on prdept.deptcode=tbl_employees.dept where tbl_employees.id=".$_GET["empid"];
		  
	  $result=$d->query($sqlstr) or die(mysql_error());
	  $row=$d->fetch_object($result);
	  $id=$row->id;
	 
  }
		    
		
				
		
		
	  
	

 ?>
 
<table  id="main" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" id="cell_top">
      <br>
    </td>
  </tr>

  <tr>
    <td >
    &bull;&nbsp;<a href="index.php" onfocus="blurLink(this);">Home</a>&nbsp;&bull;&nbsp;&nbsp;<a href="logout.php?reset=1">Log Out</a></td>

  </tr>
  <tr>
    <td  bgcolor="#FFFFFF" ><table width="100%"  border="0">
      <tr>
        <th colspan="3">&nbsp;                        </th>
        </tr>
      <tr>
        <td width="13%"><? if (!empty($id))  echo "<center><img src='viewimg.php?imgid=$id' width=150 Height=150 ></center>"; ?>&nbsp;</td>
        <td width="70%"><? if (!empty($row->fname)) echo "<b>Full Name : </b>".$row->title." ".$row->fname." ".$row->mname." ".$row->lname; 
		 
		 if (!empty($row->prefnames)) echo "<br><b>Preferred Names :</b>".$row->prefnames; 
		 
		 
		 ?>
		</td>
        <td width="17%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
	 
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



