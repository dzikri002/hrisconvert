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
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('finalpproval'));
	dob_cal  = new Epoch('epoch_popup','popup',document.getElementById('qa'));
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
  if  (is_uploaded_file($_FILES['file']['tmp_name']))
  {
    $filename = $_FILES['file']['name'];
    $filetype=$_FILES['file']['type'];
    $file_temp=$_FILES['file']['tmp_name'];	
  } 
  

  $filesize=filesize($file_temp);
  $data=base64_encode(fread(fopen($file_temp, "rb"),$filesize));

 // fclose($fd);
 // $data=base64_encode(fread($fd,$filesize));
	
	/*$today=date('Y-m-d h:m:s');	
  	if (!empty($_POST["desc"])) $desc=$_POST["desc"];
  	if (!empty($_POST["version"])) $version=$_POST["version"]; 
  	if (!empty($_POST["sopcode"])) $sopcode=$_POST["sopcode"];
	if (!empty($_POST["effective"])) $effective=dateconvert($_POST["effective"],1);
	if (!empty($_POST["finalpproval"])) $finalpproval=dateconvert($_POST["finalpproval"],1);
	if (!empty($_POST["author"])) $author=$_POST["author"];
	if (!empty($_POST["status"])) $status=$_POST["status"];*/			

	$sopcode = empty($_POST["sopcode"]) ? 'NULL' : "'" . $_POST["sopcode"] . "'";
	$title = empty($_POST["title"]) ? 'NULL' : "'" . $_POST["title"] . "'";
	$version = empty($_POST["version"]) ? 'NULL' : "'" . $_POST["version"] . "'";
	$section = empty($_POST["section"]) ? 'NULL' : "'" . $_POST["section"] . "'";
	$author = empty($_POST["author"]) ? 'NULL' : "'" . $_POST["author"] . "'";
	$reviewer = empty($_POST["reviewer"]) ? 'NULL' : "'" . $_POST["reviewer"] . "'";
	$qa = empty($_POST["qa"]) ? 'NULL' : "'" . dateconvert($_POST["qa"],1) . "'";
	$finalpproval = empty($_POST["finalpproval"]) ? 'NULL' : "'" . dateconvert($_POST["finalpproval"],1) . "'";

  $sqlstr= "insert into tbl_course (sopcode,title,version,section,author,reviewer,qa,finalpproval,dateadded)
   values ($sopcode,$title,$version,$section,$author,$reviewer,$qa,$finalpproval,now())";
	 
 
  $sqlresult=$d->query($sqlstr);
	 
 $insertid=$d->insert_id();

  print("File Successfully uploaded. The file number is $insertid");
  print("</strong>");
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
   echo "<meta http-equiv='refresh' content='1;url=sopmanagement.php'>";   
 }
   
?>
<center>
  <form action="sopmanagement.php" method="post" enctype="multipart/form-data" name="form_uploader" id="form_uploader" >
   
   <?   
	 // if (hasaccess($d,16,$userid)) 
	 // {
	   echo  "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"80%\">
                  <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <th colspan=\"4\" class=\"header9\" id=\"t_itemsreq\">SOP MANAGEMENT</th>
              </tr>
              <tr bgcolor=\"#ffffff\">
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\"><div align=\"right\">SOP Number	</div></td>
                <td><input name=\"sopcode\" type=\"text\" id=\"version\"></td>
                <td id=\"t_qty\"></td>
                <td id=\"t_qty\"></td>
				<input name=\"imgid\" type=\"hidden\" value=\"";
				if (!empty($imgid)) print $imgid;
				 echo "\">";
				 
                echo "<input name=MAX_FILE_SIZE type=hidden value=MAX_ALLOWED_FILE_SIZE> 
                <input name=form_submit type=hidden id=form_submit value=form_uploader>
              </tr>
				<tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\">SOP Title</td>
                <td colspan=\"3\" ><textarea name=\"desc\" cols=\"50\" rows=\"5\" id=\"desc\"></textarea></td>
              </tr>
              <tr bgcolor=\"#ffffff\">
                <td id=\"t_qty\">Section</td>
                <td id=\"t_qty\"><select name=\"DeptName\" id=\"DeptName\">
            <option value=\"\">--SELECT--</option>";
				Lookup("id","DeptName",$dept,"SELECT id,DeptName FROM prdept WHERE depcat = 'LAB'"); 

          echo "</select></td>
                <td id=\"t_itemscat\">Version</td>
                <td><input name=\"version\" type=\"text\" id=\"version\"></td>
              </tr>			  
              <tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\">Reviewer</td>
                <td><input name=\"reviewer\" type=\"text\" id=\"reviewer\"></td>
                <td id=\"t_itemscat\">Author</td>
                <td><input name=\"author\" type=\"text\" id=\"author\"></td>
              </tr>
  			  <tr bgcolor=\"#ffffff\">
				<td id=\"t_qty\">QA</td>
                <td id=\"t_qty\"><input name=\"qa\" type=\"text\" id=\"qa\"></td>			  	
				<td class=\"listitem\"  id=\"t_itemsreq\">Final</td>
                 <td id=\"t_itemsreq\"><input name=\"finalpproval\" type=\"text\" id=\"finalpproval\"></td>
                 </span></td>
               </tr>	  
			  <tr bgcolor=\"#ffffff\">
			  <td class=\"listitem\"  id=\"t_itemsreq\"></td>
                 <td id=\"t_itemsreq\"></td>
                 <td id=\"t_itemsreq\"><div align=\"right\" class=\"listitem\"><input name=\"Save\" type=\"submit\" id=\"Save\" value=\"Save\" /></td>
                 <td id=\"t_itemsreq\"><span class=\"header9\">
                  <input name=\"Save\" type=\"submit\" id=\"Save\" value=\"Verify\" />
                 </span></td>
               </tr>
			   
            </tbody>
        </table></td>
      </tr>
    </table>";

   //}
  
  ?>
  </form><hr>
   <? 
    $sqlstr="select * from tbl_course";
	
	$sqlresult=$d->query($sqlstr);
	$numrows=$d->numrows($sqlresult);
	
	if ($numrows >0)
	{
	   echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"80%\">
      <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <th colspan=\"9\" class=\"header9\">This list contains SOP Information for Uploads.</th>
              </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\">
               <td><div align=\"right\"><b>SOP Number</b></div></td>
				<td><div align=\"right\"><b>Title</b></div></td>
				<td><div align=\"right\"><b>Version</b></div></td>
				<td><div align=\"right\"><b>Section</b></div></td>
               <td><div align=\"right\"><b>Author</b></div></td>
				<td><div align=\"right\"><b>Reviewer</b></div></td>
				<td><div align=\"right\"><b>QA</b></div></td>
				<td><div align=\"right\"><b>Final Approval</b></div></td>
				<td><div align=\"right\"><b>Action </b></div></td>
				</tr></tbody>";  
			
	  while ($row=$d->fetch_object($sqlresult))
	  {
	    $dateuploaded=substr($row->dateadded,0,10);
	    $dateuploaded=dateconvert($dateuploaded,2);
        
		$time = substr($row->dateadded,10,9);
	    $dateuploaded= $dateuploaded . " " . $time;
		
	   echo "<tbody>
              <tr bgcolor=\"#ffffff\">
                <td><div align=\"right\">$row->sopcode</div></td>
				<td><div align=\"right\">$row->title</div></td>
				<td><div align=\"right\">$row->version</div></td>
				<td><div align=\"right\">$row->section</div></td>
                <td><div align=\"right\">$row->author</div></td>
				<td><div align=\"right\">$row->reviewer</div></td>
				<td><div align=\"right\">$row->qa</div></td>
				<td><div align=\"right\">".dateconvert($row->finalpproval,1)."</div></td>";

				if (!strcasecmp($fullname,$row->addedby))
				 echo "<td><div align=\"right\"><a href=sopmanagement.php?action=delete&upid=$row->id onClick=\"Javascript:return confirm('Are you sure you want Delete this Record?','Confirm Delete')\">Delete</a></font></div></td>";
				echo "</tr></tbody>";
	  }
	}
  print "</table></table></center><br><br><br>"; ?>
</center>
<?

  $d->close();

?>
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



