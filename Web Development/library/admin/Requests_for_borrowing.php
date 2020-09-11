<?php include "header.php" ; ?>
      
      
       <?php 
		if(isset($_GET[act]) && $_GET[act]=='issue')
		{
			 $sql = "UPDATE   `borrow` SET  `issue_date` = NOW( ) WHERE   `borrow_id` =".$_GET[borrow_id] ;
			   
			if(mysql_query($sql))
			{
			?>
            <script> alert(' Issued Book is done !');</script>
            <?php
				
			}
			
		}
		if(isset($_GET[act]) && $_GET[act]=='return')
		{
			 $sql = "UPDATE   `borrow` SET  `return_date` = NOW( ) WHERE   `borrow_id` =".$_GET[borrow_id] ;
			   
			if(mysql_query($sql))
			{
			?>
            <script> alert(' Returned Book is done !');</script>
            <?php
				
			}
			
		}
		
		
		
		if(isset($_GET[act]) && $_GET[act]=='delete')
		{
			 $sql = "delete from    `borrow`  WHERE   `borrow_id` =".$_GET[borrow_id] ;
			   
			if(mysql_query($sql))
			{
			?>
            <script> alert(' The request has been canceled !');</script>
            <?php
				
			}
			
		}
		
		?>
      
      
      
      
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> LIBRARY OF KING SAUD UNIVERSITY <small>Control Panel</small> </h1>
          <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard"></i> Requests for borrowing </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      
      <div class="row">
        
        
            <?php
					  $s = 'SELECT * , no_of_copy - ( SELECT COUNT( * ) 
														FROM borrow
														WHERE book_id = b.book_id
														AND issue_date IS NOT NULL 
														AND return_date IS NULL ) AS Available
														FROM borrow br
														INNER JOIN members m ON m.member_id = br.member_id
														INNER JOIN books b ON b.book_id = br.book_id
														INNER JOIN categories c ON c.cat_id = b.cat_id
														WHERE issue_date IS NULL' ; 
					  $r = mysql_query($s) ; 
					  
					   
					  ?>
         
          
          
          <div class='col-lg-12 col-md-12 col-sm-12 '>
            
            <div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Member</th>
                      <th>Book Name</th>
                      <th>Category </th>
                      <th>Request Date </th>
                      <th> Available Number  </th>
                      <th> Operations  </th>
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
                      <td><?=$q[member_name]?> </td>
                      <td><?=$q[book_name]?> </td>
                      <td><?=$q[cat_name]?> </td>
                      <td><?=$q[request_date]?> </td>
                      <td><?=$q[Available]?>  </td>
                      <td><a href="?act=issue&borrow_id=<?=$q[borrow_id]?>" ><i class="fa fa-check" aria-hidden="true"></i> </a>   
                      
                       &nbsp;&nbsp;
                     <a href="?act=delete&borrow_id=<?=$q[borrow_id]?>" ><i class="fa fa-times" aria-hidden="true"></i> </a>
                      
                      </td>
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
      
     
     
     
      <div class="row">
        <div class="col-lg-12">
         
          <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard"></i>  Borrowed Books </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      
      <div class="row">
        
        
            <?php
					  $s = 'SELECT * , no_of_copy - ( SELECT COUNT( * ) 
														FROM borrow
														WHERE book_id = b.book_id
														AND issue_date IS NOT NULL 
														AND return_date IS NULL ) AS Available
														FROM borrow br
														INNER JOIN members m ON m.member_id = br.member_id
														INNER JOIN books b ON b.book_id = br.book_id
														INNER JOIN categories c ON c.cat_id = b.cat_id
														WHERE issue_date IS not NULL  and  return_date IS NULL ' ; 
					  $r = mysql_query($s) ; 
					  
					   
					  ?>
         
          
          
          <div class='col-lg-12 col-md-12 col-sm-12 '>
             
            <div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Member</th>
                      <th>Book Name</th>
                      <th>Category </th>
                      <th>Request Date </th>
                       <th>Issue  Date </th>
                      <th> Available Number  </th>
                      <th> Return It  </th>
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
                      <td><?=$q[member_name]?> </td>
                      <td><?=$q[book_name]?> </td>
                      <td><?=$q[cat_name]?> </td>
                      <td><?=$q[request_date]?> </td>
                      <td><?=$q[issue_date]?> </td>
                      <td><?=$q[Available]?>  </td>
                      <td><a href="?act=return&borrow_id=<?=$q[borrow_id]?>" ><i class="fa fa-check-circle-o" aria-hidden="true"></i> </a>   
                      
                       &nbsp;&nbsp;
                     
                      
                      </td>
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
    <!-- /.container-fluid --> 
    
  </div>
  <!-- /#page-wrapper --> 
  
</div>
<!-- /#wrapper --> 

<!-- jQuery --> 
<script src="js/jquery.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="js/bootstrap.min.js"></script> 

<!-- Morris Charts JavaScript --> 
<script src="js/plugins/morris/raphael.min.js"></script> 
<script src="js/plugins/morris/morris.min.js"></script> 
<script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
