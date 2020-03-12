<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Confirm Leave Details</title>
<style>
	a, A:link, a:visited, a:active
		{color: #0000aa; text-decoration: none; font-family: Tahoma, Verdana; font-size: 12px}
	A:hover
		{color: #ff0000; text-decoration: none; font-family: Tahoma, Verdana; font-size: 12px}
	p, tr, td, ul, li
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px}
	th
		{background: #DBEAF5; color: #000000;}
	.header1, h1
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 13px; margin: 0px; padding-left: 2px; height: 21px}
	.header2, h2
		{color: #000000; background: #DBEAF5; font-weight: bold; font-family: Tahoma, Verdana; font-size: 12px;}
	.intd
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px; padding-left: 15px;}
	.wcell
		{background: #FFFFFF; vertical-align: top}
	.ctrl
		{font-family: Tahoma, Verdana, sans-serif; font-size: 12px; width: 100%;}
	.btnform
		{border: 0px; font-family: tahoma, verdana; font-size: 12px; background-color: #DBEAF5; width: 100%; height:18px; text-align: center; cursor: hand;}
	.btn
		{background-color: #DBEAF5; padding: 0px;}
	textarea, select,input
		{font: 9px Verdana, arial, helvetica, sans-serif; background-color: #DBEAF5;}
		
	/* classes for validator */
	.tfvHighlight
		{font-weight: bold; color: red;}
	.tfvNormal
		{font-weight: normal;	color: black;}
.style1 {
	font-family: Verdana;
	font-weight: bold;
}
.style2 {font-size: 10px}
.style6 {font-size: 10px; width: 100%; color: #003399; font-family: Tahoma, Verdana, sans-serif;}
.style7 {font-family: Tahoma, Verdana; padding-left: 15px; color: #000000;}
</style>

</head>
<script language="JavaScript" ></script>
<body>

<?php

  //use root for now
  include "headerlogo.php";
  include "config.php";
  include "functions.php";
  require_once 'db.php';
  $d = new dbC();
  $d->connect($db_host, $db_username, $db_password, $db); 
	 
   echo "<fieldset>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=index.php> Home |<a href=leave.php> Leave Application </a>  | <a href=http://172.16.12.3/helpdesk> Helpdesk </a>  |</a>"; 
   echo "</fieldset><BR>"; 
    
   if (!empty($_REQUEST["Name"]))
   {
    
	 $_SESSION["name"]=$_REQUEST["Name"];
     $_SESSION["pno"]=$_REQUEST["pno"];
	 $username="'".$_REQUEST["username"]."'";
     
	 $deptid=$_REQUEST["dept"];
	 $sqlstr="select deptname from intranet_depts where deptid=$deptid";
	 $data=$d->query($sqlstr) or die(mysql_error());
	 $row=mysql_fetch_object($data);
	 $dept=$row->deptname;
	 $_SESSION["dept"]=$dept;
	 
     $Desigid=$_REQUEST["Desig"];
	
	 $sqlstr="select designame from intranet_desig where desigid=$Desigid";
	 $data=$d->query($sqlstr) or die(mysql_error());
	 $row=mysql_fetch_object($data);
	 $Desig=$row->designame;
	 $_SESSION["Desig"]=$Desig; 
	  
	 $_SESSION["daysreq"]=$_REQUEST["daysreq"];
	  $_SESSION["date1"]=$_REQUEST["date1"];
	 $_SESSION["date2"]=$_REQUEST["date2"];
	 $date1=dateconvert($_REQUEST["date1"],1);
	 $date2=dateconvert($_REQUEST["date2"],1);
	 $_SESSION["leaveadress"]=$_REQUEST["leaveadress"];	 
	 
	 $today=date('Y/m/d h:i:s');
	 
	 
	  if (isset($insertid))
	  {  
	    $sqlstr="update intranet_leave set fullname='$_SESSION[name]',";
		print sqlstr;
	  }
	  else
	    $sqlstr="insert into intranet_leave(fullname,datefrom,dateto,numdays,leaveaddress,pnumber,deptid_fk,desigid_fk,dateapplied,confirmed,addedby)
	    values('$_SESSION[name]','$date1','$date2',$_SESSION[daysreq],'$_SESSION[leaveadress]','$_SESSION[pno]',$deptid,$Desigid,'$today',0,$username)";
	  
	 
	   $d->query($sqlstr) or die(mysql_error());
	   $insertid=$d->insert_id();
	
   }
   else
   {
     $_SESSION["name"]="";
     $_SESSION["pno"]="";
	 $_SESSION["dept"]="";
	 $_SESSION["Desig"]="";
     $_SESSION["daysreq"]="";
	 $_SESSION["date1"]="";
	 $_SESSION["date2"]="";
	 $_SESSION["leaveadress"]="";	
	 $date1="";
	 $date2=""; 
	 $insertid=0;
	 
   };
   
	 
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
</body>

</html>



