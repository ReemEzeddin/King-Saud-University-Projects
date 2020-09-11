 <?php
		   $sql_list = "SELECT c.* , (select count(*) from books b  where b.cat_id =c.cat_id) as CountBooks  FROM  categories c ORDER BY cat_id" ;
		   $r_list = mysql_query($sql_list) ; 
		  
		  
?> 


<section class="p-0" id="portfolio">
  <div class="container-fluid p-0">
    <div class="row no-gutters popup-gallery">
      
      <?php
	  while($q_list = mysql_fetch_array($r_list))
	  {
		  ?>
          <div class="col-lg-4 col-sm-6"> <a class="portfolio-box" href="Categories.php?cat_id=<?=$q_list[cat_id]?>"> <img class="img-fluid" src="upfiles/<?=$q_item[pic]?>" alt="">
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
