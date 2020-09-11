<?php 
session_start(); 
require_once('myfun.php');

$action =  $_GET[action] ;
if ($action=="login"){
		//session_destroy();
						
						
		if(isset($_POST[login])&& $_POST[login] != "")	
			{
				
				$password = $_POST[password] ; 
				
				
				$s = "SELECT * 
							FROM users u
							
							 WHERE  username='$_POST[username]' and password='$password' and isActive =  1 
							 
					 " ; 
				
				
				 
				
				$r_user = mysql_query($s) or die(mysql_error());
				
				if(mysql_num_rows($r_user)>0)
				{
					$q_user = mysql_fetch_array($r_user);
					
					
					$sql = "SELECT adminName as NAME ,  email FROM `admins` where admin_id = " . $q_user[admin_id]  ; 
					
					if($r_data = mysql_query($sql))
					{
						$query_data = mysql_fetch_array($r_data) ; 
						
						$_SESSION["CurrentUserId"] 		= $q_user[user_id];
						$_SESSION['username'] 			= $q_user[username];
						$_SESSION["user_type_id"] 		= $q_user[user_type_id];
						$_SESSION["NAME"] 				= $query_data[NAME];
						$_SESSION["email"] 				= $query_data[email];
						$_SESSION["Current_admin_id"] 	= $q_user[admin_id];
						
						
						
											
						echo "<META HTTP-EQUIV='Refresh' Content='1;URL=index.php'>";
						exit() ;
					
					}
					else
					{
						?><script>alert('The username or password you have entered is invalid.  '); history.go(-1)</script><?
						exit() ;
					}
										
				}
                else
                {
                    ?><script>alert('The username or password you have entered is invalid.  '); history.go(-1)</script><?
					exit() ;
                    
                }
			}
   
    
	 

}



else if ($action=="logout")
{
	
		session_destroy();
		echo "<META HTTP-EQUIV='Refresh' Content='1;URL=../index.php'>";	
		exit() ;
}


	
?>