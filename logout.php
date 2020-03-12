<?php 
  include "includes/functions.php";
  include "includes/config.php";
  require_once "includes/db.php";
  
 if(!empty($_REQUEST["reset"]))
 {
   $d = new dbC();
   $d->connect($db_host, $db_user, $db_pass, $db);  	
  
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
   
   if (isset($_SESSION["username"]))
   {
     $username=$_SESSION["username"];
	 $login=$_SESSION["username"];
     $today=date('Y/m/d h:i:s');
     $query="update hrusers set loggedoff=1,loggedofftime='$today' where loggedoff is null and username ='$username'";
     $d->query($query) or die(mysql_error());
   }
   
   $d->close();
   if (session_destroy()) 
	 header("Location: index.php?action=again");
   
 }
 ?>
