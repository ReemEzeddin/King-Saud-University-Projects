<?php 
session_start(); 
require_once('admin/myfun.php');

$action =  $_GET[action] ;
if ($action=="login"){
// session_destroy();
  
		 
		if(isset($_POST[login])&& $_POST[login] != "")	
			{
				
				$password = $_POST[password] ; 
				
				
				$s = "SELECT * 
							FROM users u
							
							inner join members c on c.member_id = u.member_id
							
							 WHERE  username='$_POST[username]' and password='$password' and isActive =  1 
							 and user_type_id = 2 
							 
					 " ; 
				 
				
				 
				
				$r_user = mysql_query($s) or die(mysql_error());
				
				if(mysql_num_rows($r_user)>0)
				{
						$query_data = mysql_fetch_array($r_user) ; 
						
						$_SESSION["CurrentUserId"] 		= $query_data[user_id];
						$_SESSION['username'] 			= $query_data[username];
						$_SESSION["user_type_id"] 		= 2;
						$_SESSION["NAME"] 				= $query_data[member_name];
						$_SESSION["email"] 				= $query_data[email];
						$_SESSION["mobile"] 			= $query_data[mobile];
						$_SESSION["adrs"] 				= $query_data[adrs];
						$_SESSION["member_id"] 				= $query_data[member_id];
						
											
						echo "<META HTTP-EQUIV='Refresh' Content='1;URL=index.php'>";
						exit() ;		
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
		echo "<META HTTP-EQUIV='Refresh' Content='1;URL=index.php'>";	
		exit() ;
}


	
?>