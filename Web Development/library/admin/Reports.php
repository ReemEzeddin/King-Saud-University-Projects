<?php include "header.php" ; ?>
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> LIBRARY OF KING SAUD UNIVERSITY <small>General Report</small> </h1>
          <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard"></i> Reports </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      
      <div class="row">
        <div class="col-lg-6">
          
          <div class='col-lg-12 col-md-12 col-sm-12 '>
            <label class="alignleft">Category List:</label>
            <div>
              <div class="table-responsive">
                 <?php
		   $sql_list = "SELECT * FROM  categories ORDER BY cat_id" ;
		 // echo $sql_list ; 
		  $r_list = mysql_query($sql_list) ; 
		  
		  
		  
		  ?> 
          <div class='col-lg-12 col-md-12 col-sm-12 '>
            
            <div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category Name</th>
                      <th>Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                  
				 <?php
					$i=1 ; 
					while($q_list = mysql_fetch_array($r_list))
					{
		  ?>
          <tr>
                      <td><?=$i?></td>
                      <td><?=$q_list[cat_name]?> </td>
                      <td><a href="Categories.php?act=edit&id=<?=$q_list[cat_id]?>"  title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
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
          </div>
        </div>
        
        
           <div class="col-lg-6">
         
          
          
          <div class='col-lg-12 col-md-12 col-sm-12 '>
            <label class="alignleft"> Books :</label>
            <div>
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ISPN</th>
                      <th>Book Name</th>
                       <th>Available Number</th>
                      
                      <th>Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php 
		  $sql_list = "SELECT * ,  no_of_copy - ( SELECT COUNT( * ) 
														FROM borrow
														WHERE book_id = b.book_id
														AND issue_date IS NOT NULL 
														AND return_date IS NULL ) AS Available FROM  books b   ORDER BY book_id " ;
		  // echo $sql_list ; 
		  $r_list = mysql_query($sql_list) ; 
		  $i=1 ; 
			while($q_list = mysql_fetch_array($r_list))
			{
				?>
		  	<tr>
                      <td><?=$i?></td>
                       <td><?=$q_list[ispn]?> </td>
                      <td><?=$q_list[book_name]?> </td>
                      <td><?=$q_list[Available]?>   </td>
                      <td>  <a href="Books.php?act=edit&id=<?=$q_list[book_id]?>"  title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
                    </tr>
		 
                  
                  <?php
			}
			?>
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="row">
           <div class='col-lg-12 col-md-12 col-sm-12 '>
            <label class="alignleft">Members List :</label>
            
             <?php 
		  $sql_list = "SELECT * FROM  members ORDER BY member_id" ;
		 // echo $sql_list ; 
		  $r_list = mysql_query($sql_list) ; 
		
		  	
		  ?>
            <div>
              <div class="table-responsive">
                <table width="100%" class="table table-striped table-bordered table-hover"  >
                  <thead>
                    <tr class="info">
                      <th>#</th>
                      <th>Member Name</th>
                      <th>Requested Books</th>
                      <th>Issued Books</th>
                      <th>Current Books</th>
                      <th>Operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
								$i=1 ; 
								while($q_list = mysql_fetch_array($r_list))
								{
									?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$q_list[member_name]?></td>
                      
                       <td>
                      <?php
					  $s = ' 
					  SELECT book_name FROM books
										WHERE book_id
										IN (
										SELECT book_id
										FROM borrow
										WHERE issue_date IS NULL 
										AND member_id ='.$q_list[member_id].'
										)' ; 
					  $r = mysql_query($s) ; 
					  while($q = mysql_fetch_array($r))
					  {
						  echo $q[book_name].'<br>'  ;
					  }
					   
					  ?>
                      
                      </td>
                      
                      
                      <td>
                      <?php
					  $s = 'select count(*) as total_books from borrow where issue_date IS NOT NULL  and  member_id = '.$q_list[member_id] ; 
					  $r = mysql_query($s) ; 
					  $q = mysql_fetch_array($r) ; 
					  echo $q[total_books]  ; 
					  
					   
					  
					  ?>
                      
                      </td>
                      
                      <td>
                      <?php
					  $s = ' 
					  SELECT book_name FROM books
										WHERE book_id
										IN (
										SELECT book_id
										FROM borrow
										WHERE issue_date IS NOT NULL 
										AND return_date IS NULL 
										AND member_id ='.$q_list[member_id].'
										)' ; 
					  $r = mysql_query($s) ; 
					  while($q = mysql_fetch_array($r))
					  {
						  echo $q[book_name].'<br>'  ;
					  }
					   
					  ?>
                      
                      </td>
                      
                      
                      <td><a href="Members.php?act=edit&id=<?=$q_list[member_id]?>"  title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a> 
                      
                      </td>
                    </tr>
                    <?php 
								 $i++ ; 
								 }  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      
      </div>
      
      
      
      
      
      
       <div class="row">
        <div class="col-lg-12">
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
            <label class="alignleft">Requests Books :</label>
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
            <label class="alignleft">Requests Books :</label>
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
     
      
      
      
      
      
      
      
      <!-- /.row --> 
      
      <!-- /.row --> 
      
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
