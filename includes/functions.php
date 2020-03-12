<?php
  function sendemail($commentinfo,$support_email,$notify_owner_email)
  {
      
        $text= $commentinfo;
		$text=stripslashes($text);
		
        $emailm=$text; 
        $headers = "From: $support_email\n"; 
        $headers .= "Return-Path: <$support_email>\n"; 
        $headers .= "X-Sender: <$support_email>\n"; 
        $headers .= "X-Mailer: PHP\n"; //mailer 
        $headers .= "X-Priority: 1\n"; //1 UrgentMessage, 3 Medium 
		
        mail("$notify_owner_email","",$emailm,$headers); 
  }
  function getretirementdate($age,$d)
  {
    $query="select retage from hrsettings order by id desc";
	$res = $d->query($query) or die(mysql_error());
	$data=$d->fetch_object($res);
	
	if (!empty($data->retage))
      $retirementage= $data->retage;//hardcode for now obtain from hrsetup table later
	else
	  $retirementage=55;
	  
	$diff=$retirementage-$age;
    $query="select date_add(curdate(),interval $diff year) as retdate";
	$res=$d->query($query) or die(mysql_error());
	$data=$d->fetch_object($res);
	
	return $data->retdate;
  }
  function fetchfullname($memberno,$d)
  {
    $query="select fullname from prmember where memberno = ".$memberno;
	$sqlresult=$d->query($query);
    $data=$d->fetch_object($sqlresult);
	
	return $data->fullname;
  }
  function getperiodfromdate($date) 
  {
    list($day, $month, $year) = split('[/.-]', $date);
	
    $period="$year"." "."$month";
	 
	if ($period=='0000 00')
	  $period=""; 
	return $period;   
  }
  
  function updatedb($d)
  {
    
	$sqlstr="select * from prmember";
	
	$result=$d->query($sqlstr);
	
	if (!$result)
	 return -1;
   else
	 return 0;
	
    
  }
  //function loads look ups - provide the key field name,description,tablename, variable with value 
  //during editing as well as db connector object
  function Loadlookup($keyfield,$descfield,$tablename,$keyfieldval,$d)
  {
  	 $sqlstr="select $keyfield as id,$descfield as name from $tablename";
	
	 $data=$d->query($sqlstr);
				
	 while ($row=mysql_fetch_object($data))
	 {
	    if (isset($keyfieldval))
	    {
	      if ($keyfieldval==$row->id)
	        print "<option value=$row->id selected>".$row->name; 
		  else  
		    print "<option value=$row->id>".$row->name; 
	    }
	    else
		   print "<option value=$row->id>".$row->name; 
	 }
  } 
  
//same as Loadlookup but has option of passing a sql statement
function Lookup($fields_id='',$fields_value='',$selected,$sql,$d){
	$results=$d->query($sql);
	while ($row = $d->fetch_object($results)){
		$SelectedField=($row->$fields_id==$selected) ? " selected" : "";		
		echo "<option value=" . $row->$fields_id . $SelectedField . ">" . $row->$fields_value . "</option>";
	}
}
//look up dbs from set up database
function Lookupdbs($fields_id='',$fields_value='',$selected,$sql,$link,$setupdb){
    mysql_select_db($setupdb,$link);
	echo $sql;
	
	$results=mysql_query($sql,$link) or die(mysql_error());
	
	while ($row = mysql_fetch_object($results)){
		$SelectedField=($row->$fields_id==$selected) ? " selected" : "";		
		echo "<option value=" . $row->$fields_id . $SelectedField . ">" . $row->$fields_value . "</option>";
	}
}
 
 function dateconvert($date,$func) {
  if ($func == 1){ //insert conversion
    list($day, $month, $year) = split('[/.-]', $date);
    $date = "$year-$month-$day";
    return $date;
  }
  if ($func == 2){ //output conversion
    list($year, $month, $day) = split('[-.]', $date);
    $date = "$day/$month/$year";
    return $date;
  }
}

//DATE TIME CONVERT
function datetimeconvert($fdate,$func)
{
     if ($func == 1)//insert conversion
	 {
	   $pdate=explode(" ",$fdate);
	   $ptime=$pdate[1];
	   list($day, $month, $year) = split('[/.-]', $pdate[0]);
       $year=trim($year);
       $date = "$year-$month-$day $ptime";
	   return $date;
	 }
	 
	if ($func == 2) //Output conversion
	 {
	   $pdate=explode(" ",$fdate);
	   $ptime=$pdate[1];
	   list($year, $month, $day)= split('[/.-]', $pdate[0]);
       $date = "$day-$month-$year $ptime";
	   return $date;
	 } 
}

function hasaccess($d,$appid,$userid)
{
     $sqlstr="select * from intranet_perms where userid_fk=$userid and applicationid_fk=$appid";
	 $sqlresult=$d->query($sqlstr);
	 $numrows=0;
	 $numrows=$d->numrows($sqlresult);
	 
	if  ($numrows==0)
	  return false;
	else
	 return true;
}

function sopsheader(){
  echo "<fieldset>
	  <a href=\"labhome.php\">Home</a> | <a href=\"sopmanagement.php\">Management</a> 
	  | <a href=\"sopapproval.php\">Approval</a> | <a href=\"sopsview.php\">View Sops</a> 
	  | <a href=logout.php?reset=go> Log Out </a> 
	  </fieldset><br>";
};

?>