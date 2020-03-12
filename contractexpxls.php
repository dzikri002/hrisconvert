<?
   include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
   
   $d = new dbC();
   $d->connect($db_host, $db_user, $db_pass, $db); 
   
   $sqlstr="select * from hrsettings order by id desc";
  $result =$d->query($sqlstr);
  $row=$d->fetch_object($result);
  
  $contract=$row->contract;
   
    //$sqlstr="select id,ip,trim(name) as name,trim(mac1) as mac1,trim(mac2) as mac2,handset,serialno,software,deptname from ips left join intranet_depts on deptid=workgroup ";
	
	$sqlstr="select birthdate as DOB,empdate as `Employment Date`,effdate as `Effective Date`,sex,memberno as Payroll,designation.designation,fullname,quitdate,jobgroup,dept,station,(datediff(quitdate,now()) div 30) as `Remaining Months` from prmember 
		  left join designation on designation.id=prmember.position_fk
		  where (datediff(quitdate,now()) div 30) < $contract and (datediff(quitdate,now()) div 30) >= 0 and suspended=0 and empstatus_fk=1 order by dept,station";		  
	     
		  
	//echo $sqlstr;
	  
	$sqlresult=$d->query($sqlstr);
	//$dataset=$d->fetch_object($sqlresult)
	$fields = mysql_num_fields($sqlresult);
	
	$header="\n";
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



