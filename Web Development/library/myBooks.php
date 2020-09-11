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


 
<section class="bg-primary" id="about">
  <div class="container">
    <div class="row">
     
      <?php
					  $s = 'SELECT *  
														FROM borrow br
														INNER JOIN members m ON m.member_id = br.member_id
														INNER JOIN books b ON b.book_id = br.book_id
														INNER JOIN categories c ON c.cat_id = b.cat_id
														WHERE br.member_id ='.$_SESSION[member_id] ; 
					  $r = mysql_query($s) ; 
					  
					   
					  ?>
         
          
          
          <div class='col-lg-12 col-md-12 col-sm-12 '>
            
            <div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                       
                      <th>Book Name</th>
                      <th>Category </th>
                      <th>Request Date </th>
                      <th> Issue Date  </th>
                      <th> Return Date  </th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
				   $i = 1 ; 
                    while($q = mysql_fetch_array($r))
					  {
						  ?>
                          <tr>
                      <td><?=$i?></td>
                       
                      <td><?=$q[book_name]?> </td>
                      <td><?=$q[cat_name]?> </td>
                      <td><?=$q[request_date]?> </td>
                      <td><?=$q[issue_date]?> </td>
                      <td><?=$q[return_date]?>  </td>
                     
                    </tr>
                          
                          <?php
						  
						  $i++ ; 
					  }
					  
					  ?> 
                                        
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        
    </div>
  </div>
</section>

 



<?php
 include "footer.php" ; 
 
 ?>