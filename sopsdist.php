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
  echo "<fieldset>";
  echo "<a href=\"labhome.php\">Home</a> | <a href=logout.php?reset=go> Log Out </a>"; 
  echo "</fieldset><br>";
  
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
	
	$today=date('Y-m-d h:m:s');	
  	if (!empty($_POST["desc"])) $desc=$_POST["desc"];
  	if (!empty($_POST["version"])) $version=$_POST["version"]; 
  	if (!empty($_POST["sopcode"])) $sopcode=$_POST["sopcode"];
	if (!empty($_POST["effective"])) $effective=dateconvert($_POST["effective"],1);
	if (!empty($_POST["finalpproval"])) $finalpproval=dateconvert($_POST["finalpproval"],1);
	if (!empty($_POST["author"])) $author=$_POST["author"];
	if (!empty($_POST["status"])) $status=$_POST["status"];			

  $sqlstr= "insert into tbl_course (data,filesize,filetype,filename,title,version,addedby,dateadded,sopcode,effective,finalpproval,author,status)
   values ('$data', '$filesize','$filetype','$filename','$desc','$version','$fullname','$today','$sopcode','$effective','$finalpproval','$author','$status')";
	 
 
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
   echo "<meta http-equiv='refresh' content='1;url=sops.php'>";   
 }
   
?>
<center>
  <form action="sops.php" method="post" enctype="multipart/form-data" name="form_uploader" id="form_uploader" >
   
   <?   
	 // if (hasaccess($d,16,$userid)) 
	 // {
	   echo  "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"80%\">
                  <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <td colspan=\"4\" class=\"header9\" id=\"t_itemsreq\">&nbsp;</td>
              </tr>
              <tr bgcolor=\"#ffffff\">
             
              <tr bgcolor=\"#ffffff\">
                <td  id=\"t_itemsreq\">&nbsp;</td>
                <td colspan=\"3\"  id=\"t_itemsreq\">&nbsp;
				</td>
              </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\">";
                
				 
			  echo "<td class=\"listitem\"  id=\"t_itemsreq\">Browse the File that you wish to Upload </td>
                 <td id=\"t_itemsreq\"><input type=\"file\" name=\"file\"/></td>
                 <td id=\"t_itemsreq\"><div align=\"right\" class=\"listitem\">Click on Save to Upload </div></td>
                 <td id=\"t_itemsreq\"><span class=\"header9\">
                  <input name=\"Save\" type=\"submit\" id=\"Save\" value=\"Save\" />
                 </span></td>
               </tr>";
			   
			   echo "<tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\">SOP Title</td>
                <td colspan=\"3\" ><textarea name=\"desc\" cols=\"50\" rows=\"5\" id=\"desc\"></textarea></td>
              </tr>

              <tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\">Author</td>
                <td><input name=\"author\" type=\"text\" id=\"author\"></td>
                <td id=\"t_qty\">Status</td>
                <td id=\"t_qty\"><select name=\"status\">
					  <option value=\"\">--select status--</option>
					  <option value=\"Approval\">Approval</option>
					  <option value=\"Circulation\">Circulation</option>
					  <option value=\"draft\">Draft</option>
					  <option value=\"Formating\">Formating</option>
					  <option value=\"QA\">QA</option>
					  <option value=\"review\">Review</option>
					  <option value=\"Training\">Training</option>
					  <option value=\"Unknown\">Unknown</option>
					</select></td>
              </tr>
			  
              <tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\">Version</td>
                <td><input name=\"version\" type=\"text\" id=\"version\"></td>
                <td id=\"t_qty\">Approved date</td>
                <td id=\"t_qty\"><input name=\"finalpproval\" type=\"text\" id=\"finalpproval\"></td>
              </tr>";
			
			 echo "            
              <tr bgcolor=\"#ffffff\">
                <td id=\"t_itemscat\"><div align=\"right\">SOP Number	</div></td>
                <td><input name=\"sopcode\" type=\"text\" id=\"version\"></td>
                <td id=\"t_qty\">Effective date</td>
                <td id=\"t_qty\"><input name=\"effective\" type=\"text\" id=\"effective\"></td>
				<input name=\"imgid\" type=\"hidden\" value=\"";
				if (!empty($imgid)) print $imgid;
				 echo "\">";
				 
                echo "<input name=MAX_FILE_SIZE type=hidden value=MAX_ALLOWED_FILE_SIZE> 
                <input name=form_submit type=hidden id=form_submit value=form_uploader>
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
	   echo "<center><font face=Verdana size=2>This list contains SOP Files that have been uploaded.</font><br><div align=\"center\"
	  style=\"display: block;\"></div><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"80%\">
      <tr>
        <td bgcolor=\"#DBEAF5\"><table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"100%\">
            <tbody>
              <tr bgcolor=\"#ffffff\">
                <td colspan=\"9\" class=\"header9\" >Uploaded SOPS</td>
              </tr>
            </tbody>
            <tbody>
              <tr bgcolor=\"#ffffff\">
               <td width=\"12%\" ><div align=\"right\"><b>SOP Number</b></div></td>
               <td width=\"12%\" ><div align=\"right\"><b>Author</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Description of Sop</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Version</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Status</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Final Approval</b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Effective</b></div></td>								
				<td width=\"12%\" ><div align=\"right\"><b>View </b></div></td>
				<td width=\"12%\" ><div align=\"right\"><b>Action </b></div></td>
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
                <td width=\"12%\" ><div align=\"right\">$row->author</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->title</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->version</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->status</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->finalpproval</div></td>
				<td width=\"12%\" ><div align=\"right\">$row->effective</div></td>
				<td width=\"12%\" ><div align=\"right\"><font face=Verdana size=1> <a href=readsop.php?id=$row->id target=blank>Read SOP</font></div></td>";
				
				
				if (!strcasecmp($fullname,$row->addedby))
				 echo "<td width=\"12%\" ><div align=\"right\"><a href=sops.php?action=delete&upid=$row->id onClick=\"Javascript:return confirm('Are you sure you want Delete this Record?','Confirm Delete')\">Delete</a></font></div></td>";
				
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



