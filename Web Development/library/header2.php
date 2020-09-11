<? 
session_start() ;
error_reporting(0);
 
require_once("admin/myfun.php") ;?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>LIBRARY OF KING SAUD UNIVERSITY</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<!-- Plugin CSS -->
<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/creative.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background:#474545">
  <div class="container" style="background:#474545"> <a class="navbar-brand js-scroll-trigger" href="#page-top">LIBRARY OF KING SAUD UNIVERSITY</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="index.php#h>Home</a> </li>
        <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="index.php#about">About</a> </li>
        
         <? 
                    if(isset($_SESSION["user_type_id"])&& $_SESSION["user_type_id"]==2)   
						{
							
					$sql_n = 'SELECT count(*) as new_message FROM `notifications` where  is_readed = 0 and  member_id ='.$_SESSION["member_id"]; 
					$r_n= mysql_query($sql_n) ; 
					 $q_new_m = mysql_fetch_array($r_n) ; 		
					
					$new_m = $q_new_m[new_message] ;  
					
					$sql_all = 'SELECT * FROM `notifications` where member_id ='.$_SESSION["member_id"]; 
					$r_all= mysql_query($sql_all) ; 
					 

							
							?>
     
     <li class="dropdown messages-menu open">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?=$new_m?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"><font size="2"> You have <?=$new_m?> new messages </font></li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                    
                    <ul class="menu" style="overflow: hidden; width: 100%; height: auto;">
                      
                      <?php
					  while($qm=mysql_fetch_array($r_all))
					  {
						 ?> 
						  <li> 
                        <a href="notifications.php?n_id=<?=$qm[n_id]?>">
                         <font size="2"> <?=$qm[subject]?> </font>
                        </a>
                       
                      </li> 
						  <?php
					  }
					  
					  ?>
                      
                      
                     
                     
                    </ul>
                    
                    
                    
                    </div>
                  </li>
                  <li class="footer"><a href="notifications.php"><font size="2">See All Messages</font></a></li>
                </ul>
              </li>
     
    
                          <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="myBooks.php"> My Books</a> </li>
                          <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="redirectUser.php?action=logout">Logout</a> </li>
                                                 
                            
                            <?php
							
						}
						else
						{
							?>
                             <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="index.php#services">Login / Register</a> </li>
                             <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="admin/login.html">Librarian Login</a> </li>
                             
                            
                            
                            
                            <?php
							
						}
						?>
                    
        
        
       
        <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="index.php#portfolio">Categories</a> </li>
        <li class="nav-item"> <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a> </li>
      </ul>
    </div>
  </div>
</nav>

<br><br><br>
            