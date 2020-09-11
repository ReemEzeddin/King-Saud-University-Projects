<?php
session_start() ; 
				
if(!(isset($_SESSION["CurrentUserId"]) || $_SESSION["CurrentUserId"]!=''||isset($_SESSION["username"]) || $_SESSION["username"]!=''))
{
	  echo "<META HTTP-EQUIV='Refresh' Content='1;URL=login.html'>";
	  exit() ;
}


?>

<p></p>

<p>
	<h1>Welcome <?php echo $_SESSION["NAME"] ; ?> </h1>
    
</p>

 



 
  
