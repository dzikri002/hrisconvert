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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DeptNames Setup </title>
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
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 14px; margin: 0px; padding-left: 2px; height: 21px}
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
.copysmall {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 12px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copy {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 13px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymed {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copylarge {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #3B3B3B; font-size: 15px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copymedred {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FF0000; font-size: 14px; margin-top:3px; margin-bottom:11px; margin-left:0px; margin-right:0px }
.copyheader {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.copyheaderwhite {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-size: 14px; margin-top:3px; margin-bottom:0px; margin-left:0px; margin-right:0px }
.header7, h7 {  font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; color: #2778CB; font-size: 15px; font-weight: bold }
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
.style6 {font-size: 12px}
</style>
</head>

<body>
<?php include "headerlogo.php";
      include "config.php";
	  include "functions.php";   
	  
  echo "<fieldset>";
  adminmenu();
  echo "</fieldset><br>";
  
if (!empty($_REQUEST["action"]))
   $action=$_REQUEST["action"];

if (!empty($_GET["action"]))
   $action=$_GET["action"];
   
else if (empty($_GET["action"]) && empty($_REQUEST["action"]))
   $action="add";
   
  require_once 'db.php';
  $d = new dbC();
  $d->connect($db_host, $db_username, $db_password, $db); 			
  
 
if ($action=="editdept")
{
  $deptid=$_REQUEST["deptid"];
  
  if (!empty($deptid) && (!isset($_GET["submit"])))
  {
    $select="select * from intranet_depts  inner join support_users on support_users.id=
    intranet_depts.userid_fk where deptid=".$deptid;
      
  $data=$d->query($select);
  $dataset=mysql_fetch_object($data);
  
  $deptname=$dataset->deptname;
  $userid_fk=$dataset->userid_fk;
  $headid=$userid_fk;
  $heademail=$dataset->heademail;
   
  $approver=$dataset->approver;
  $authoriser=$dataset->authoriser;
  $issuesitems=$dataset->issuesitems;
  $forwarded=$dataset->isforwardeditems;
  }
  else
  {
     $deptid=$_GET["deptid"];
	 $deptname="'".trim($_GET["Deptname"])."'"; 
     $emailaddress="'".trim($_GET["emailaddress"])."'";
     $userid_fk=$_GET["userid_fk"];
     $headid=$userid_fk;
  }
}
else
{
  $deptname="";
  $userid_fk="";
  $heademail="";
  $approver="";
  $authoriser="";
  $othname="";
  $issuesitems="";
   $forwarded="";
}  
  
if (!empty($_REQUEST["headid"]))
{
  $headid=$_REQUEST["headid"];
  $sqlstr="select email from support_users where id=$headid";
  $result=$d->query($sqlstr);
  $dataset=$d->fetch_object($result);
  $heademail=$dataset->email;
  
}
 
   
?>
<script language="JavaScript" src="validator.js"></script>


<form action="dept.php" method="get" name="deptreg" onsubmit="return v.exec()">
<table cellpadding="0" cellspacing="0" border="0" width="600" align="center">
<tr>
	<td bgcolor="#4682B4" width="10"><img src="img/pixel.gif" width="10" height="1" border="0"></td>
	<td class="header1" nowrap>Leave  Setup<img src="img/pixel.gif" width="10" height="8" border="0"></td>
	<td><img src="img/formtab_r.gif" width="10" height="21" border="0"></td>
	<td background="img/line_t.gif" width="100%">&nbsp;</td>
	<td background="img/line_t.gif"><img src="img/pixel.gif" width="10" height="1" border="0"></td>
</tr>
<tr>
	<td background="img/line_l.gif"><img src="img/pixel.gif" border="0"></td>
	<td colspan="3">
	<img src="img/pixel.gif" width="1" height="10" border="0"><br>
	<div align="center"
	 id="Error_DeptNames" style="display: block;"></div>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" bordercolor='#111111'><tr><td bgcolor="#DBEAF5">
		<table cellspacing="1" cellpadding="3" border="0" width="100%">
          <tr bgcolor="#ffffff">
            <td colspan="2" nowrap="nowrap" id="t_dname"><div align="right">Staff Name </div></td>
            <td width="42%" ><select name="userid_fk" class="ctrl" id="userid_fk" <? print "onchange=\"loademail(this.value,$action,$deptid)\""; ?>>
              <option value="">-- select -
              <?php
			    
				$sqlstr="select id,name from support_users order by name";
				$data=$d->query($sqlstr);
				
				while ($row=mysql_fetch_object($data))
				{
				   if (isset($headid))
				   {
				     if ($headid==$row->id)
					   print "<option value=$row->id selected>".$row->name; 
					 else  
					   print "<option value=$row->id>".$row->name; 
				   }
				   else
				     print "<option value=$row->id>".$row->name; 
					 
				   //print "<option value=$row->id>".$row->name; 
				}
			  ?>
              </option>
            </select></td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" nowrap="nowrap" id="t_hname"><div align="right">Staff DeptName </div></td>
            <td valign=top>&nbsp;</td>
            <td colspan="2"><div align="right"></div></td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_eaddress"><div align="right" class="ctrl"> Email address </div></td>
            <td colspan="2" bgcolor="#ffffff">&nbsp;</td>
            <td width="31%" bgcolor="#ffffff">&nbsp;</td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_admin"><div align="right" class="ctrl">Approver</div></td>
            <td bgcolor="#ffffff">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr bgcolor="#ffffff">
            <td colspan="2" id="t_admin"><div align="right" class="ctrl">Authoriser</div></td>
            <td bgcolor="#ffffff"><input name="authoriser" type="checkbox" id="authoriser" <?php if ($authoriser==1) print "checked=checked"?> />
            <input type="hidden" name="action"   <? if (!empty($action)) print  "value=$action"; ?> />
			<input type="hidden" name="deptid"   <? if (!empty($deptid)) print  "value=$deptid"; ?> />
			</td>
            <td colspan="2">
                <div align="left">                  </div></td></tr>
        </table></td>
	</tr></table>
		<img src="img/pixel.gif" width="1" height="10" border="0"><br>
	</td>
	<td background="img/line_r.gif"><img src="img/pixel.gif" border="0"></td>
	</tr>
<tr>
	<td width="10"><img src="img/formtab_b.gif" width="10" height="20" border="0"></td>
	<td bgcolor="#4682B4" colspan="4" align="right">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="btn" width="100"><input type="reset" name="Reset" value="Reset" class="btnform"></td>
		<td width="1"><img src="img/pixel.gif" width="1" height="18" border="0"></td>
		<td class="btn" width="100"><input type="submit" name="Submit" value="Submit" class="btnform"></td>
		<td width="1"><img src="img/pixel.gif" width="1" height="18" border="0"></td>
	</tr>
	</table>
	</td>
</tr>
</table>
</form>

<?php
 
 if ($action=="editdept")
 {
   if (!empty($_GET["userid_fk"]))
   {
   
     if (!empty($_GET["authoriser"]))
      $authoriser=1;
	else
	  $authoriser=0;
	 
	if (!empty($_GET["approver"]))
      $approver=1;
	else
	  $approver=0;
	  
	if (!empty($_GET["issuesitems"]))
	  $issuesitems=1;
	else
	  $issuesitems=0; 
   
   if (!empty($_GET["forwarded"]))
	  $isforwarded=1;
   else
	  $isforwarded=0; 
	     
	
	 $deptid=$_GET["deptid"];
	 $deptname="'".trim($_GET["Deptname"])."'"; 
     $emailaddress="'".trim($_GET["emailaddress"])."'";
     $userid_fk=$_GET["userid_fk"];
     $headid=$userid_fk;
	 
     $update="update intranet_depts set userid_fk=$userid_fk,deptname=$deptname,heademail=$emailaddress,
	 approver=$approver,authoriser=$authoriser where deptid = $deptid";
    

	 
     $resultset = $d->query($update) or die("Error while adding DeptName.Contact the systems administrator :->".mysql_error());
   
  
      echo "<p> <font color=red>DeptName successfully updated. To view DeptNames <a href=deptlisting.php>click here.</a></font></p>";
    }
  }
  else
  { 
     $deptid=$_GET["deptid"];
	 $deptname="'".trim($_GET["Deptname"])."'"; 
     $emailaddress="'".trim($_GET["emailaddress"])."'";
     $userid_fk=$_GET["userid_fk"];
     $headid=$userid_fk;
	 
    if (trim($emailaddress)!="")
	{
    if (!empty($_GET["authoriser"]))
      $authoriser=1;
	else
	  $authoriser=0;
	 
	if (!empty($_GET["approver"]))
      $approver=1;
	else
	  $approver=0;
   
    if (!empty($_GET["issuesitems"]))
	  $issuesitems=1;
	else
	  $issuesitems=0; 
     
       $insert="replace into intranet_depts(userid_fk,deptname,heademail,approver,authoriser) values ($userid_fk,$deptname,$emailaddress, $approver,$authoriser)";
       

   
   $resultset = $d->query($insert) or die("Error while adding DeptName.Contact the systems administrator :->".mysql_error());
   
   if ($resultset)  
     echo "<p><font color=red>DeptName successfully added. Click </font><a href=deptlisting.php>Here to view DeptNames</a></p>"; 
  }
  }   

 $d->close();
 
 echo"<br><br><fieldset>";
 include "./footer.php"; 
 echo"</fieldset>";
 
?>
<script>
var a_fields = {
	'Deptname': {
		'l': 'DeptName Name',  // label
		'r': true,    // required
		'f': 'alphanum',  // format (see below)
		't': 't_dname',// id of the element to highlight if input not validated
		
		'm': null,     // must match specified form field
		'mn': 2,       // minimum length
		'mx': 50       // maximum length
	},
	'userid_fk':{'l':'Head of DeptName','r':true,'t':'t_hname'},
	'emailaddress':{'l':'Email address','r':true,'f':'email','t':'t_eaddress'}
},

o_config = {
	'to_disable' : ['Submit', 'Reset'],
	'alert' : 1
}

// validator constructor call
var v = new validator('deptreg', a_fields, o_config);

</script>
<script language="JavaScript">
 function loademail(idx,action,deptid)
 {
   window.location='dept.php?headid='+idx+'&action='+action+'&deptid='+deptid;
 }
 </script>
</body>
</html>



