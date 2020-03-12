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
<html>
<head>
<style>
	
	p, tr, td, ul, li
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px}
	th
		{background: #DBEAF5; color: #000000;}
	.header1, h1
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 13px; margin: 0px; padding-left: 2px; height: 21px}
	.header2, h2
		{color: #003366; background: #DBEAF5; font-weight: bold; font-family: Tahoma, Verdana; font-size: 14px;}
	.intd
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px; padding-left: 15px;}
	.wcell
		{background: #FFFFFF; vertical-align: top}
	.ctrl
		{font-family: Tahoma, Verdana, sans-serif; font-size: 12px; width: 100%;}
	.btnform
		{font-family: tahoma, verdana; font-size: 12px; background-color: #DBEAF5; width: 100%; height:18px; text-align: center; cursor: hand;}
	.btn
		{background-color: #DBEAF5; padding: 0px;}
	textarea, select
		{font: 9px Verdana, arial, helvetica, sans-serif; background-color: #DBEAF5;}
		
	/* classes for validator */
	.tfvHighlight
		{font-weight: bold; color: red;}
	.tfvNormal
		{font-weight: normal;	color: black;}
.style1 {
	color: #003366;
	font-weight: bold;
	font-size: 14px;
       }
.copysmall {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 12px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copy {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymed {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copylarge {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 15px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymedred {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copyheader {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.copyheaderwhite {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.header7, h7 {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
.header9, h9
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 12px; margin: 0px; padding-left: 2px; height: 14px}
.copysmalltitle {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
.copysubtitle {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px }
.copyfooter {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #000000; font-size: 13px }
.copydownload {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px }

p {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
p.topmarg { margin-top:12px; margin-bottom:8px; }
p.nobot { margin-top:2px; margin-bottom:0px; }
p.topmargnobot { margin-top:12px; margin-bottom:0px; }
p.nav { color:#FFFFFF; text-align:center; margin-top:8px; margin-bottom:12px; margin-left:3px; margin-right:3px; }
p.foot { font-size:9px; margin-top:3px; margin-bottom:3px; margin-left:3px; margin-right:3px; }

a { color: #003366; text-decoration: none }
a:hover { text-decoration: underline }
a:visited { color: #446185; text-decoration: none }
a:visited:hover { text-decoration: underline }

.copywhite {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 12px }
.copywhiteB {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 12px; font-weight: bold }

/*More Information Link Style */
.copy11 {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px }

/* Section Headers Style */
.blueheader {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #446185; font-size: 13px; font-weight: bold }
.whiteheader {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 13px; font-weight: bold }

.topics {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #CCCCCC; font-size: 11px }
.topicsB {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 11px; font-weight: bold }
.topicsH {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 11px}

h2 { font-size:13px; color:#2778CB; margin-left:0px; margin-right:0px; margin-top:3px; margin-bottom:0px; }
.listitem {
    line-height: 15px;
    font-size: 11px;
    font-family: Verdana, Tahoma, Arial, Helvetica;
    font-weight: normal;
	color: #262626;
    margin-top:4px;
    margin-bottom:0px;
    margin-left:0px;
    margin-right:0px
}

.subtitle_body{
    background-image: url(images/subtitle_body.gif);
    background-repeat: repeat-x;
    color: #035AA4;
    font-size: 13px;
    font-weight: bold;
}

.subtitle_cap{
    height: 25px;
    width: 12px;
    background : url(images/subtitle_cap.gif);
}
.style3 {font-size: 16px}
.style5 {font-size: 11px; font-family: Verdana, Tahoma, Arial, Helvetica; color: #262626; margin-top: 4px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; line-height: 15px;}
.style6 {font-size: 14px; color: #003366;}
.style8 {
	font-size: 14px;
	color: #003366;
	font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;

}
</style>

</head>
<body>
<?
 
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 
  
   if (!empty($_REQUEST["userid"]))
   {
     $userid=$_REQUEST["userid"];
	 $sqlquery="select * from intranet_perms where userid_fk=$userid;";
	 $sqlresult=$d->query($sqlquery);
	 $row=$d->fetch_object($sqlresult);
	 $deptid=$row->deptid_fk;
   }
   
   
   if (!empty($_POST["userid"]))
   {
     
	 if (!empty($_POST["dept"])){
	    $deptid=$_POST["dept"];
		  
     $userid=$_POST["userid"];
	 $sqlquery="select email from hrusers where id=$userid";
	 $sqlresult=$d->query( $sqlquery);
	 $row=$d->fetch_object($sqlresult);
	 $useremail=$row->email;
	
	 
	 $sqlstr="select * from intranet_apps";
	 $sqlresult=$d->query($sqlstr);
	 
	 while ($row=$d->fetch_object($sqlresult))
	 {
	   if (!empty($_POST["hasrights".$row->id]))
	  {
	   		
	    $sqlstr="insert into intranet_perms (userid_fk,applicationid_fk,deptid_fk) values ($userid,$row->id,$deptid)";
		$d->query($sqlstr) or die(mysql_error());
		
		if (!empty($appname))
		  $appname=$appname.", ".$row->ApplicationName;
		else
		  $appname=$row->ApplicationName;
	  }
	 else
	  {
	    $sqlstr="delete from intranet_perms where  userid_fk=$userid and applicationid_fk=$row->id";
		$d->query($sqlstr) or die(mysql_error());
		
	  } 
	
	 }
	   print "<font face=verdana size=2><strong>User Permissions successfully Set.</strong></font>";
	  
   }else
     echo "<font face = Verdana size=2 color=red><b>Please select the user department</b></font>"; 
   }
   
    if (isset($appname))
	{
      $mailbody="This is an automated mail.Do not Reply. User permissions to access various menus on the intranet altered. You have been given permissions to access $appname on the intranet.The Intranet address is http://172.16.12.3/intranet/";
      sendemail($mailbody,$support_email,$useremail);
    }
  
   if (isset($userid))
   {
   
     $sqlstr="select * from hrusers where id = $userid";
     
	 $sqlresult = $d->query($sqlstr);
	 
	 
	
	  if (isset($sqlresult) && (!empty($sqlresult)))
	  {
	   
	     $row=$d->fetch_object($sqlresult);
		 $name=$row->username;  
		 
		 $sqlstr="select * from intranet_apps";
		 $sqlresult=$d->query($sqlstr);
		 
		 //chora meza
		  print "<form name=\"setperms\"  method=post action=setperms.php?userid=$userid>";
        
		 echo "<hr><center><font face=Verdana size=2><strong>Set Permissions for </strong><br>$name</font><br><div align=\"center\"
	  style=\"display: block;\"></div><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"80%\">
      <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
			    
                <td colspan=\"9\" class=\"header9\" >Permissions setup</td>
                  </tr>
                </tbody>
			    <tbody>
                <tr bgcolor=\"#ffffff\">
			    <td>Users Department</td>";
		     
		      echo "<td><select name=\"dept\" class=\"ctrl\" >
              <option value=\"\">-- select --";			    
				$sqlstr="select id as deptid,DeptName,deptcode from prdept order by DeptName";
				
				$data=$d->query($sqlstr);
				
				while ($row=mysql_fetch_object($data))
				{
				   if (isset($deptid))
				   {
				     if ($deptid==$row->deptid)
					   print "<option value=$row->deptid selected>".$row->deptcode; 
					 else  
					   print "<option value=$row->deptid>".$row->deptcode; 
				   }
				   else
				     print "<option value=$row->deptid>".$row->deptcode; 
				}
			  
		   print "</select><input type=hidden name=userid value=$userid>";  
		 		
		   echo "</td>
			  </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\">
                
				<td width=\"12%\" ><div align=\"right\"><b>Application Name</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Has Access</b></div></td>
				</tr></tbody>";  
		   
		    
			while ($row=$d->fetch_object($sqlresult))
		    {
			  echo "<tbody>
              <tr bgcolor=\"#ffffff\">
                <td width=\"12%\" ><div align=\"right\"> $row->ApplicationName </div></td>";
				
				$sqlstr="select * from intranet_perms where userid_fk=$userid and applicationid_fk=$row->id";
				$result=$d->query($sqlstr);
				$numrows=$d->numrows($result);
				
				if ($numrows>0)
				  print "<td width=\"12%\" ><div align=\"right\"><input type=checkbox name=hasrights".$row->id."  checked></div></td>";
				else				
	              print "<td width=\"12%\" ><div align=\"right\"><input type=checkbox name=hasrights".$row->id."></div></td>";
				
				
				print "</tr></tbody>\n";
			}
			echo "</table></table></center>";
           print "<hr><div align=\"right\"><input type=submit name=submit value=submit></div></form>";

		   
		 
		  		 
		   
	 }
      
   }
  
  
 $d->close();

?>
</body>
</html>