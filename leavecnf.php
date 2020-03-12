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
	    $sqlstr="update intranet_leave set fullname='$_SESSION[name]'";
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

<table cellpadding="3" cellspacing="1" border="0" width="100%">
  <tr>
    <td class="intd"><p><span class="ctrl">Please confirm the details below if OK PLEASE CLICK ON SUBMIT TO FORWARD THEM FOR APPROVAL.
        Incase of Wrong Information click on BACK TO AMEND. </span><br>
        <!-- Form -->
      </p>
	  <?php 
	     $Error=0;
		 if ($date1>$date2)
		 { 
		  
		   print "<b><u>The following errors will prevent the form from being submitted</u></b><br><br>";
		   print "<font color=red> <i>Date To Should be greater that Date from </i></span></font><br><br>";
		   $Error=1; 
		 }
		

	 ?>
	
     <?php
	   
	      echo "<form action=leaveconf.php method=Post name=cnfleave>
          <table cellpadding=0 cellspacing=0 border=0 width=100% align=center>
            <tr>
              <td bgcolor=#4682B4 width=10><img src=img/pixel.gif width=10 height=1 border=0></td>
              <td nowrap class=header1 style2>Leave Application confirmation </td>
              <td><img src=img/formtab_r.gif width=10 height=21 border=0></td>
              <td background=img/line_t.gif width=100%> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td background=img/line_t.gif><img src=img/pixel.gif width=10 height=1 border=0></td>
            </tr>
            <tr>";
            echo "<td background=img/line_l.gif><img src=img/pixel.gif border=0></td>
              <td colspan=3><img src=img/pixel.gif width=1 height=10 border=0><br>
                  <div align=center id=error_registration style=display: block;></div>
                  <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <tr>
                      <td bgcolor=#DBEAF5><table cellspacing=1 cellpadding=3 border=0 width=100%>
                          <tr bgcolor=#ffffff>
                            <td id=t_title width=1%>&nbsp;</td>
                            <td width=14% id=t_name><div align=right>Name:</div></td>
                            <td  width=31%> $_SESSION[name] &nbsp;</td>
                            <td colspan=2 id=t_pno><div align=right>P/NO:</div></td>
                            <td colspan=2> $_SESSION[pno] &nbsp;</td>
                          </tr>
                          <tr bgcolor=#ffffff>";
                            echo "<td colspan=2 id=t_center>&nbsp;
                                <div align=right>Center/DeptName:</div></td>
                            <td valign=top>&nbsp; $_SESSION[dept] </td>
                            <td colspan=2 id=t_designation><div align=right>Designation:</div></td>
                            <td colspan=2>&nbsp; $_SESSION[Desig] </td>
                          </tr>
                          <tr bgcolor=#ffffff>
                            <td colspan=2 id=t_daysreq><div align=right>Number of Days Requested: </div></td>
                            <td bgcolor=#ffffff>&nbsp; $_SESSION[daysreq] </td>
                            <td colspan=2 bgcolor=#ffffff>&nbsp;</td>
                            <td colspan=2 bgcolor=#ffffff>&nbsp;</td>
                            <td width=1% bgcolor=#ffffff>&nbsp;</td>
                          </tr>
                          <tr bgcolor=#ffffff>";
						  
						    if ($_SESSION["date1"]>$_SESSION["date2"])
							  echo "<td colspan=2 id=t_date1><div align=right><font color=red>With Effect from:</font></div></td>";
							else
                              echo "<td colspan=2 id=t_date1><div align=right>With Effect from:</div></td>";
							
							
							
                            print "<td bgcolor=#ffffff>&nbsp;";
							print $_SESSION["date1"]."</td>";
                            echo "<td width=3%><div align=right></div></td>";
							
                            
						    if ($date1 > $date2)
							  echo "<td width=9% id=t_date1><div align=right><font color=red>To:</font></div></td>";
							else
                              echo "<td width=9% id=t_date1><div align=right>To:</div></td>";
							
							
							
                            echo "<td width=36%>&nbsp;&nbsp;  $_SESSION[date2] </td>
                            <td width=5%>&nbsp;</td>
                          </tr>
                          <tr bgcolor=#ffffff>
                            <td colspan=2  nowrap>&nbsp;</td>
                            <td colspan=5><span class=style1>Exclusive of Saturdays, Sundays and Public Holidays</span></td>
                          </tr>
                          <tr bgcolor=#ffffff>
                            <td colspan=2 ><div align=right>Date:</div></td>
                            <td>&nbsp;";
							
                               $today = getdate(); 
               $month = $today["month"]; 
               $mday = $today["mday"]; 
               $year = $today["year"]; 
			   
               echo "$month/$mday/$year</td>";
               echo"<td colspan=4 id=t_post_code>&nbsp;</td>
                          </tr>
                          <tr bgcolor=#ffffff>
                            <td colspan=2 id=t_geninfor>My Leave address will be (Include your mobile No as well). </td>
                            <td bgcolor=#ffffff colspan=5>&nbsp;";
							 print "$_SESSION[leaveadress] </td>";
                        echo "</tr>
                      </table></td>
                    </tr>
                  </table>
                  <img src=img/pixel.gif width=1 height=10 border=0><br>
              </td>
              <td background=img/line_r.gif><img src=img/pixel.gif border=0></td>
            </tr>
            <tr>
              <td width=10><img src=img/formtab_b.gif width=10 height=20 border=0></td>
              <td bgcolor=#4682B4 colspan=4 align=right><table cellpadding=0 cellspacing=0 border=0>
                  <tr>";
                  echo"<td class=btn width=100>";
				  echo "<span class=btnform > <div align=center><input type=reset name=Back value=Back class=btnform onclick=location.replace(leave.php)></div></span>";
				  echo "</td>
                    <td width=1><img src=img/pixel.gif width=1 height=18 border=0></td>
                    <td class=btn width=100><input type=submit name=Submit value=Submit class=btnform onclick=return redirect()></td>
                    <td width=1><img src=img/pixel.gif width=1 height=18 border=0></td>
                  </tr>
              </table></td>
            </tr>
          </table>
      </form>
</table>";

?>
<?php 
 
  
  echo "<fieldset>"; 
  echo "</fieldset><BR><BR><BR>";

 ?>
<script>
   function redirect()
   {
    document.location.href = "leaveconf.php";
   }; 
   function redirectleave()
   {
    document.location.href = "leave.php";
   }; 
 </script> 
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>

</html>



