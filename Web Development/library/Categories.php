<?php
require_once( 'header2.php') ; 

?>
 <script>
 function Request_it(book_id)
{ 
	 var YES_NO=confirm("Do you really want to Request this Book ! " )
	if (YES_NO==true)
	{
		 
		var url= 'ajax_actions.php?Request_it=1&book_id='+book_id ; 
		$.ajax({url: url, success: function(result){
			 
				alert(result) ;
			 
		}});
	}
	
}

</script>


<?php
		$sql_list = " select * from books b where 1 = 1 " ;
		   
		if($_GET[cat_id]>0)
		$sql_list.= " and  b.cat_id =  ".$_GET[cat_id] ; 
		
		if($_GET[txt_search]!='')
		
		$sql_list.= " and ( book_name like '%". $_GET[txt_search] ."%' or  author like '%". $_GET[txt_search] ."%' ) " ; 
		
		$r_list = mysql_query($sql_list) ; 
		  
		  
?> 
<section class="bg-primary" id="about">
  <div class="container">
    <div class="row">
     
     <?php
	  while($q_list = mysql_fetch_array($r_list))
	  {
		  ?>
      <div class="col-lg-3 mx-auto text-center">
        <img class="img-fluid" src="upfiles/<?=$q_list[pic]?>"  width="100%" height="100%" alt="">
        <br>
        
        <p class="text-faded mb-4">(<?=$q_list[ispn]?>)  <br> <?=$q_list[book_name]?>. </p>
        <p class="text-faded mb-4"><?=$q_list[author]?>. </p>
        
        
        <?php if(isset($_SESSION["user_type_id"])&& $_SESSION["user_type_id"]==2)   
		{
		?>  <a class="btn btn-light btn-xl js-scroll-trigger" href="#" onClick="Request_it(<?=$q_list[book_id]?>)">Get It!</a>  <?php	
	    }
        else
		{
		?> <a class="btn btn-light btn-xl js-scroll-trigger" href="index.php#services">Login to Get it </a>   <?php 	
		}
        ?>
       
        </div>
        
        <?php } ?> 
        
    </div>
  </div>
</section>

 



<?php
 include "footer.php" ; 
 
 ?>