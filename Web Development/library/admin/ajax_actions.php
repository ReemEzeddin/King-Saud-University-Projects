<? 
session_start() ; 
require_once("myfun.php") ;
 
if(isset($_GET[delete_member])&&$_GET[delete_member]==1)
{ 
	$r1 = mysql_query("delete from users where 	member_id = ".$_GET[member_id]) ; 
	$r2 = mysql_query("delete from members where  member_id = ". $_GET[member_id] ) ; 
	
	if($r2)
		echo '1' ; 
		else
		echo '0' ; 

exit ; 

exit ; 
}







?>
