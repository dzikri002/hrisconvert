 <?  include "config.php"; 
     require_once 'db.php';
     $d = new dbC();
     $d->connect($db_host, $db_username, $db_password, $db); 
 ?>
 <html>
<head>
<style>
p, tr, td, ul, li
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px;}
.header1, h1
		{color: #ffffff; background: #DBEAF5; font-weight: bold; font-family: Tahoma, Verdana; font-size: 13px; margin: 0px; padding: 2px;}
.header2, h2
		{color: #000000; background: #DBEAF5; font-weight: normal; font-family: Tahoma, Verdana; font-size: 10px;}
.btnform
		{border: 200px; font-family: tahoma, verdana; font-size: 12px; background-color: #D3DCE3; width: 10%; height:18px; text-align: center; cursor: hand;}
.btn
		{background-color: #DBEAF5; padding: 0px;}
/* classes for validator */
.tfvHighlight
    {font-weight: bold; color: red;}
.tfvNormal
    {font-weight: normal;color: black;}

.ctrl {font-family: Tahoma, Verdana, sans-serif; font-size: 12px; width: 100%;}
</style>
<script language="JavaScript" src="calendar1.js"></script><!--  -->
<script language="JavaScript" src="validator.js"></script>
</head>
<body>
<?php
//$today= date('d-m-Y');
$today= date("d")."-".date("m")."-". (date("Y")+1);
$lastwk = date("d")."-".date("m")."-". (date("Y")-1);

?>

<table cellpadding="1" cellspacing="1" border="0" width="100%">
<tr>
<td align="center">
<img src="img/pixel.gif" width="1" height="40" border="0"><br>
<table cellpadding="0" cellspacing="0" width="760" border="0"><tr><td bgcolor="#4682B4">
<table cellpadding="5" cellspacing="1" width="100%" border="0">
<tr >
  <th colspan="3" class=header2>To view Leave requested for a period select date from and date to then Click on Go<BR>
    To view all, ignore the dates and just click on GO
<tr>
<td width="44%" bgcolor="#ffffff" class=p>Pick Date from (dd-mm-yyyy)</td>
<td colspan="2" bgcolor="#ffffff">Pick Date to (dd-mm-yyyy)</td>
</tr>
<form  action="leaveauth.php"  method="GET" name="leaveauthfrm" onsubmit="return v.exec()" >
<tr>
<td id="t_date1" bgcolor="#ffffff" valign="top">
Start From&nbsp;&nbsp;<input type="Text" name="date1"  <? if (isset($lastwk )) print  "value=\"$lastwk  \""; ?>>
<a href="javascript:cal1.popup();"><img src="img/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a><br>
</td>
<td width="31%" valign="top" bgcolor="#ffffff" id="t_date2">
To&nbsp;&nbsp;<input type="Text" name="date2" <? if (isset($today)) print  "value=\"$today \""; ?> >
<a href="javascript:cal2.popup();"><img src="img/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date"></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="9%" valign="top" bgcolor="#ffffff" id="t_date2"><input type="submit" name="GO" value="GO" ></td>
<script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
 // note: you can have as many calendar objects as you need for your application
 var cal1 = new calendar1(document.forms['leaveauthfrm'].elements['date1']);
 cal1.year_scroll = true;
 cal1.time_comp = false;
 var cal2 = new calendar1(document.forms['leaveauthfrm'].elements['date2']);
 cal2.year_scroll = true;
 cal2.time_comp = false;
 //-->
</script>
<tr><td colspan="3" bgcolor="#DBEAF5">&nbsp;</td> </tr>
</form>
</table>
</table>
<script language="JavaScript" src="validator.js">
var a_fields = {
	'date1':{'l':'Start From','r':true,'f':'date','t':'t_date1'},
	'date2':{'l':'To','r':true,'f':'date','t':'t_date2'}
},

o_config = {
	'to_disable' : ['Go'],
	'alert' : 1
}

// validator constructor call
var v = new validator('leaveauthfrm', a_fields, o_config);

</script>

</body>
</html>



