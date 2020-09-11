<?php
require_once( 'header.php') ; 

?> 


 <? 
                    if(isset($_SESSION["user_type_id"])&& $_SESSION["user_type_id"]==2)   
						{
							?>
                         
                           
<header class="masthead text-center text-white d-flex" id="h">
  <div class="container my-auto">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h1 class="text-uppercase"> <strong>WELCOME  <?=$_SESSION["NAME"]?> TO LIBRARY OF KING SAUD UNIVERSITY</strong> </h1>
       
        <hr>
      </div>
      <div class="col-lg-8 mx-auto">
        <p class="text-faded mb-5">
        
<?php


?>      
        
        </p>
         </div>
    </div>
  </div>
</header>
              
                             
                            
                            
                            <?php
							
						}
						else
						{
							?>
  <header class="masthead text-center text-white d-flex"  id="h">
  <div class="container my-auto">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h1 class="text-uppercase"> <strong>WELCOME TO LIBRARY OF KING SAUD UNIVERSITY</strong> </h1>
        <hr>
      </div>
      <div class="col-lg-8 mx-auto">
        <p class="text-faded mb-5">Through our website, you have access to the libraries' diverse and constantly expanding collections of  books! know that *** A BOOK IS A DREAM YOU HOLD IN YOUR HAND***</p>
        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a> </div>
    </div>
  </div>
</header>
                            
                            <?php
							
						}
						?>
                    
        




<section class="bg-primary" id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-heading text-white">We've got what you need!</h2>
        <hr class="light my-4">
        <p class="text-faded mb-4"> We hope that you will visit us often, both personally and virtually. </p>
        <p class="text-faded mb-4"> We look forward to being of service to you. </p>
        
        
        <form  name="form1" id="form1" method="get" action="Categories.php"   > 
                            <fieldset>
                                <div class="form-group">
                                Search For  
                                    <input class="form-control"  required    name="txt_search" type="text" required autofocus>
                                </div>
                                  
                                
                                
                                <input type="submit" name="search" id="search" class="btn btn-light btn-xl js-scroll-trigger" value="Search">  
                            </fieldset>
                        </form>
        
          </div>
    </div>
  </div>
</section>



<?php
		   $sql_list = "SELECT c.* , (select count(*) from books b  where b.cat_id =c.cat_id) as CountBooks  FROM  categories c ORDER BY cat_id" ;
		   
		//  echo $sql_list ; 
		   $r_list = mysql_query($sql_list) ; 
		  
		  
?> 


<section class="p-0" id="portfolio">
  <div class="container-fluid p-0">
    <div class="row no-gutters ">
      
      <?php
	  while($q_list = mysql_fetch_array($r_list))
	  {
		  ?>
          <div class="col-lg-4 col-sm-6"> <a class="portfolio-box" href="Categories.php?cat_id=<?=$q_list[cat_id]?>"> <img class="img-fluid" src="upfiles/<?=$q_list[pic]?>"  width="100%" height="100%" alt="">
        <div class="portfolio-box-caption">
          <div class="portfolio-box-caption-content">
            <div class="project-category text-faded"> <?=$q_list[cat_name]?> </div>
            <div class="project-name"> # No Of Books <?=$q_list[CountBooks]?> </div>
          </div>
        </div>
        </a> </div>
          
          <?php
	  }
	  
	  
	  
	  ?>
      
    </div>
  </div>
</section>




<? 
                    if(!(isset($_SESSION["user_type_id"])))   
						{
							include "services.php" ; 
						}
						
//include "Category.php" ; 


 include "footer.php" ; 
 
 ?>