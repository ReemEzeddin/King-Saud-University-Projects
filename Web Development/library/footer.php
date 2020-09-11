<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-heading">Let's Get In Touch!</h2>
        <hr class="my-4">
        <p class="mb-5"> KING SAUD UNIVERSITY <br>
          COLLEGE OF COMPUTER AND INFORMATION SCIENCES <br>
          DEPARTMENT OF SOFTWARE ENGINEERING <br>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 ml-auto text-center"> <i class="fa fa-user-circle-o fa-3x mb-3 sr-contact"></i>
        <p>Reem Mohamad khir Ezaldeen - 435204441</p>
        <p><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:Lama_ezzidin@hotmail.com"> Reem_ezzidin@hotmail.com</a></p>
      </div>
      <div class="col-lg-4 ml-auto text-center"> <i class="fa fa-user-circle-o fa-3x mb-3 sr-contact"></i>
        <p>Rahaf sultan Khazma - 435204422</p>
        <p><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:rahafsultan8@gmail.com"> rahafsultan8@gmail.com</a></p>
      </div>
      <div class="col-lg-4 ml-auto text-center"> <i class="fa fa-user-circle-o fa-3x mb-3 sr-contact"></i>
        <p>Mashael Mohammed AlSaadan - 436202365</p>
        <p><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:Mashael420@gmail.com"> Mashael420@gmail.com</a></p>
      </div>
    </div>
  </div>
</section>
<section id="footer">
  <div class="container">
    <div class="row">
      <?php
		   $sql_list = "SELECT c.*    FROM  categories c ORDER BY cat_id" ;
		   $r_list = mysql_query($sql_list) ; 
		   
		   while($q_list = mysql_fetch_array($r_list))
	  {
		  ?>
      <div class="col-lg-2 col-sm-2"> <a href="Categories.php?cat_id=<?=$q_list[cat_id]?>" > <img width="75" height="75" src="upfiles/<?=$q_item[pic]?>" alt=""> <br>
        <?=$q_list[cat_name]?>
        </a>
      </div>
      
      <?php
	  }
		  
		  
?>
    </div>
  </div>
  </div>
</section>

<!-- Bootstrap core JavaScript --> 
<script src="vendor/jquery/jquery.min.js"></script> 
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

<!-- Plugin JavaScript --> 
<script src="vendor/jquery-easing/jquery.easing.min.js"></script> 
<script src="vendor/scrollreveal/scrollreveal.min.js"></script> 
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script> 

<!-- Custom scripts for this template --> 
<script src="js/creative.min.js"></script>
</body></html>