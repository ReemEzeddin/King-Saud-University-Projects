<?php
session_start() ; 
require_once("admin/myfun.php") ;

 
if(isset($_GET[Request_it])&&$_GET[Request_it]==1)
{ 
	
	if(isset($_GET[book_id])&& $_GET[book_id]>0 && $_SESSION[member_id]>0)
	{$r1 = mysql_query("INSERT INTO   `borrow` (
											`borrow_id` ,
											`member_id` ,
											`book_id` ,
											`request_date`
											)
											VALUES (
											NULL ,  '$_SESSION[member_id]',  '$_GET[book_id]', CURDATE( ) 
											)") ; 
	
	if($r1)
		echo 'Successfully Added To Your Requested Books' ; 
		else
		echo 'Error' ; 
	}
	else
	{
		echo 'You Must Select Book' ; 	
	}

exit ; 
}



?>
