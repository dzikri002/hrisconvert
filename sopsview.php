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
 include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $supportdb);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Sops Upload/Download</title>
<link rel="stylesheet" href="../corehrmis/js/example.css" TYPE="text/css" MEDIA="screen">
<link rel="stylesheet" type="text/css" href="../corehrmis/css/employees.css" />
<link rel="stylesheet" type="text/css" href="../corehrmis/css/main.css"/>

<link rel="stylesheet" type="text/css" href="css/epoch_styles.css"/>
<script type="text/javascript" src="css/epoch_classes.js"></script>
<script type="text/javascript" src="js/formval.js"></script> 
<script language="JavaScript" src="js/calendar1.js"></script>
 
<script type="text/Javascript">
var dob_cal;      
window.onload = function () {
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('effective'));
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('finalpproval'));
};
</script>
</head>

<body>
<?
   define('DEST_PATH', "upload/");
   define('DEST_URL', 'http://172.16.12.3/intranet/'. DEST_DIR);

   if (empty($_SESSION["username"]))
     die("<center><font color=red>You have not yet Logged in.<a href=index.php>Please click here to log in.</a></font><center>");

    $username= $_SESSION["username"];
	
	$sql_result= $d->query("select * from support_users where username like '$username'");
	 
	 if (isset($sql_result) && (!empty($sql_result)))
	 {
	   $row =$d->fetch_object($sql_result);
	   if (!empty($row->id))
	   {
	     $userid=$row->id;
	     $isadmin=$row->admin;
		 $fullname=$row->name;
	   }
	 }

	//header
  	sopsheader();
  
   if  (!empty($_REQUEST["imgid"]))
     $imgid=$_REQUEST["imgid"];
   else
     $imgid=1;
	 
   $d->close();
  
  
  $d = new dbC();
  $d->connect($db_host, $db_user, $db_pass, $db); 		
  
  
if ((isset($_REQUEST['form_submit'])) && ('form_uploader' == $_REQUEST['form_submit']))
{

}  

 if (!empty($_POST["imgid"]))	
   $imgid= $_POST["imgid"];
 
 if (!empty($_REQUEST["imgid"]))	
   $imgid= $_REQUEST["imgid"];
 
 if (!empty($_REQUEST["action"]))
 {
   if (!empty($_REQUEST["upid"]))
   $id=$_REQUEST["upid"];
   
   $sqlstr="delete from tbl_course where id=$id";
   $sqlresult = $d->query($sqlstr) or die(mysql_error());
   echo "<meta http-equiv='refresh' content='1;url=sops.php'>";   
 }
   
?>
<center>
<form action="sopsview.php" method="post" enctype="multipart/form-data" name="form_uploader" id="form_uploader" >
<hr>
   <?
   if(isset($_POST["slsearch"])){
		$slsearch = $_POST["slsearch"];
		$search = $_POST["search"];
		$where = "and ".$slsearch." LIKE '%".$search."%'";
	}
    $sqlstr="select * from tbl_course where status='Circulation' $where";
	
	$sqlresult=$d->query($sqlstr);
	$numrows=$d->numrows($sqlresult);
	
	if ($numrows >0)
	{
	   echo "<center><font face=Verdana size=2>KWTL SOP DATABASE</font><br><div align=\"center\"
	  style=\"display: block;\"></div><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"80%\">
      <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <td colspan=\"9\" class=\"header9\" align=\"center\">Search by: <select name=\"slsearch\">
				  <option value=\"\">--select search value--</option>
				  <option value=\"sopcode\">SOP Number</option>
				  <option value=\"section\">Section</option>
				  <option value=\"title\">Keywords in Title</option>
				</select> 
				<input type=\"text\" name=\"search\"> 
				<input type=\"submit\" name=\"Submit\" value=\"Search\"></td>
              </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\">
               <td width=\"12%\" ><div align=\"right\"><b>SOP Number</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Title</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Version</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Effective Date</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>View </b></div></td>
				</tr></tbody>";  
			
	  while ($row=$d->fetch_object($sqlresult))
	  {
	   
	    $dateuploaded=substr($row->dateadded,0,10);
	    $dateuploaded=dateconvert($dateuploaded,2);
        
		$time = substr($row->dateadded,10,9);
	    $dateuploaded= $dateuploaded . " " . $time;
		
	
		
	    //<td width=\"12%\" ><div align=\"right\"> $row->addedby </div></td>
				//<td width=\"12%\" ><div align=\"right\"> $dateuploaded </div></td>
	   echo "<tbody>
              <tr bgcolor=\"#ffffff\">
                <td width=\"12%\" ><div align=\"right\">$row->sopcode</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->title</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->version</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->effective</div></td>
				<td width=\"12%\" ><div align=\"right\"><font face=Verdana size=1> <a href=readsop.php?id=$row->id target=blank>Read SOP</font></div></td>
			</tr></tbody>";
	  }
	}
	
  print "</table></table></center><br><br><br>"; ?>

<?
  $d->close();

?>
</form>
<script language="JavaScript">
  function addcomments(imgid)
  {
        var url = "imgcomments.php?imgid="+imgid;
   
        newwin = window.open(url,'View','width=350,height=400,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollBars=1,resizable=1');
        newwin.focus();
  }
</script>
</body>
</html>



