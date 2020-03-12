<?
class dbC {
function connect($db_host, $db_username, $db_password, $db) 
{
	mysql_connect($db_host, $db_username, $db_password);
	mysql_select_db("$db") or die(mysql_error());
}

	function query($query) 
	{
		$query = mysql_query($query) or die(mysql_error());
		return $query;
	}
    
		function fetch_array($query)
		{
			$query = mysql_fetch_array($query);
			return $query;
		}
         function fetch_assoc($query)
		 {
		   $query=mysql_fetch_assoc($query);
		   return $query;
		 }
			function fetch_row($query)
			{
				$query = mysql_fetch_row($query);
				return $query;
			}
            
			function fetch_object($query)
			{
			  $query=mysql_fetch_object($query);
			  return $query;
			}
				function numrows($query)
				{
					$rows = mysql_numrows($query);
					return $rows;
				}
					function result($query,$count,$item)	
					{
						$result=mysql_result($query,$count,$item);	
						return $result;
					}
						function insert_id()
						{
							$result=mysql_insert_id();
							return $result;
						}
	function close()
	{
		mysql_close();
	}
};
?>