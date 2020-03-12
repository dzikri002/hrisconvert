<?
   include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
   
   $d = new dbC();
   $d->connect($db_host, $db_user, $db_pass, $db); 
   
 
		
   
    //$sqlstr="select id,ip,trim(name) as name,trim(mac1) as mac1,trim(mac2) as mac2,handset,serialno,software,deptname from ips left join intranet_depts on deptid=workgroup ";
	
	$sqlstr="select prmember.memberno,concat_ws(' ',lastname,othernames) as fullname,designation.designation,DeptName,sex as gender,idnumber as national_idnum,nationality,countryname from prmember
		  left join tbl_countries1 on tbl_countries1.id=prmember.nationality
		  left join designation on designation.id=prmember.position_fk
		  left join prdept on prdept.deptcode=prmember.dept order by dept";
		  
		  
		  
	$sqlresult=$d->query($sqlstr);
	//$dataset=$d->fetch_object($sqlresult)
	$fields = mysql_num_fields($sqlresult);
	
	$header="Employee Listing\n";
	for ($i = 0; $i < $fields; $i++) 
	{
      $header .= mysql_field_name($sqlresult, $i) . "\t"; 
	}
	
	while($row = mysql_fetch_row($sqlresult))
	{
    $line = '';
    foreach($row as $value)
	{                                            
        if ((!isset($value)) OR ($value == ""))
	    {
            $value = "\t";
        } else
		{
            $value = str_replace('"', '""', $value);
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line)."\n";
   } 
    $data = str_replace("\r","",$data); 

if ($data == "") 
{
    $data = "\n(0) Records Found!\n";                        
}
else
{
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=extraction.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  print "$header\n$data"; 
}


?>



