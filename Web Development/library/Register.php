<? require_once( 'header.php') ; 

//print_r($_POST) ; 

if(isset($_POST[Register]))
 {
	extract($_POST) ; 
	
	$sql_check = "select count(*) as userCount from users where username = '".$username."'" ;
		$r_check = mysql_query($sql_check) ; 
		$q_check = mysql_fetch_array($r_check) ;  
		if($q_check[userCount] > 0 )
		{
			echo "<script>alert('This username is not available because it is already used ') ;</script>" ;
			extract($_POST) ; 
		}
		else
		{
	
	$sql1 = "INSERT INTO `members` (`member_id`, `member_name`, `mobile`, `email`, `adrs`) VALUES (NULL, '$member_name', '$mobile', '$email', '$adrs');" ;
	if(mysql_query($sql1))
	{
		$password = $password ; 
		
		$Qcustomer = mysql_fetch_array(mysql_query("select max(member_id) from members")) ; 
		$member_id = $Qcustomer[0] ; 
		
		
		
			$sql2 = "INSERT INTO `users` (`user_id`, `username`, `password`, `user_type_id`, `member_id`, `isActive`) 
			VALUES
										(NULL, '$username', '$password', '2', $member_id , '1') ; " ; 
		 
		if(mysql_query($sql2))
			{
				echo "<script>alert('Successfully Registered') ;</script>" ;
				
				$s = "SELECT * 
							FROM users u
							
							inner join members c on c.member_id = u.member_id
							
							 WHERE  u.member_id = $member_id
							 
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
						$_SESSION["mobile"] 				= $query_data[mobile];
						$_SESSION["adrs"] 				= $query_data[adrs];
						$_SESSION["member_id"] 				= $query_data[member_id];				
						echo "<META HTTP-EQUIV='Refresh' Content='1;URL=index.php'>";
						exit() ;
					
					
					
										
				}
				
				 
			}		
			
		 
		
		
											
	}
 }
	
 }



?>

<script type="text/javascript">

function validate()
{
	
	
	if($('#password').val()!=$('#repassword').val())
	{
		alert("password & confirmed passwor don't match") ; 
		return false ; 
	}
	
	 
	
	 
	else
	return true ; 
	
}
</script>


<section >
  <div class="container">
    <div class="row">
    <div class="col-lg-3 text-center"></div>
      <div class="col-lg-12 text-center">
         
         <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register for  LIBRARY OF KING SAUD UNIVERSITY</h3>
                    </div>
                    <div class="panel-body">
                    
                        <form  name="form1" id="form1" method="post" action="Register.php" onSubmit="return validate();" > 
                            <fieldset>
                                <div class="form-group">
                                Username 
                                    <input class="form-control"  required  placeholder="username" <?=$username?> name="username" type="text" required autofocus>
                                </div>
                                <div class="form-group">
                                Password
                                    <input class="form-control" required placeholder="password" id="password" <?=$password?> name="password" type="password" value="">
                                </div>
                                
                                <div class="form-group">
                               Confirm Password
                                    <input class="form-control" required placeholder=" Confirm password" <?=$repassword?> id="repassword" name="repassword" type="password" value="">
                                </div>
                                
                                 <div class="form-group">
                                Name 
                                    <input class="form-control" placeholder="Name" name="member_name" <?=$member_name?> id="member_name" type="text" required >
                                </div>
                                
                                 <div class="form-group">
                                Mobile 
                                    <input class="form-control" placeholder="mobile" name="mobile" <?=$mobile?> id="mobile" type="tel" required >
                                </div>
                                
                                <div class="form-group">
                                E-mail 
                                    <input class="form-control" placeholder="email" <?=$email?> name="email" id="email" type="email" required >
                                </div>
                                
                                <div class="form-group">
                                Address 
                                    <textarea class="form-control" placeholder="Address" name="adrs" id="adrs" required ><?=$adrs?></textarea>
                                </div>
                                
                                
                                
                                <input type="submit" name="Register" id="Register" class="btn btn-lg btn-success btn-block" value="Register">  
                            </fieldset>
                        </form>
                    </div>
                </div>
         
        <hr class="my-4">
      </div>
       <div class="col-lg-3 text-center"></div>
    </div>
  </div>
  
</section>




            <div class="col-md-9">

                <?php  //  include "banner.php" ; ?>  

                <div class="row">

  
                
                </div>

            </div>

       <?php include "footer.php" ; ?>