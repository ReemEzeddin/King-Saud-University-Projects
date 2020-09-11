<?php include "header.php" ; 

if(isset($_GET[act]) && $_GET[act]=='del' & $_GET[id]>0)
{
	 $sql_del = "DELETE FROM  books where book_id = ".$_GET[id] ;
	 $r_del = mysql_query($sql_del) ; 
	if($r_del)
	{
		?><script>alert(' Deleted ');</script><?php
	}
	 
	
	
}
		
if(isset($_POST[btn_save]))
 {
	
	if (!empty($_FILES['pic']['name'])) 
		$the_pic = upload_img("../upfiles",$pic) ; 
	else
		$the_pic = "" ;  
 	
	if($_POST[hf_book_id] != '' && $_POST[hf_book_id]>0 )
	{
		if(mysql_query("UPDATE  `books` SET  `book_name` =  '$_POST[book_name]'
											 , `cat_id` =  '$_POST[cat_id]'
											 , `author` =  '$_POST[author]'
											 , `no_of_copy` =  '$_POST[no_of_copy]'
											  , `ispn` =  '$_POST[ispn]'
											WHERE book_id =  '$_POST[hf_book_id]' ;"))
		{
			
			
			if($the_pic !='')
			mysql_query("UPDATE  `books` SET  `pic` =  '$the_pic' WHERE book_id =  '$_POST[hf_book_id]' ;") ; 
			echo "<script>alert('Successfully Updated') ;</script>" ; 
		}
		
	 
 	}
 
	 else 
	 {
		 
		if(mysql_query("INSERT INTO `books` (`book_id`, `book_name`,`cat_id`, `author`,  `no_of_copy`, `ispn`,  `pic`) VALUES (NULL, '$_POST[book_name]', '$_POST[cat_id]', '$_POST[author]', '$_POST[no_of_copy]', '$_POST[ispn]',  '$the_pic') ;"))
			{
				echo "<script>alert('Successfully added') ;</script>" ; 
			}
		 
	 }
 
 }
 
if(isset($_GET[act]) && $_GET[act]=='edit')
		{
			 $sql_item = "SELECT * FROM  books where book_id = ".$_GET[id] ;
			 $r_item = mysql_query($sql_item) ; 
			 $q_item = mysql_fetch_array($r_item) ; 
			 extract($q_item) ; 
			 
			
			
		}



?>
      
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> LIBRARY OF KING SAUD UNIVERSITY <small>Control Panel</small> </h1>
          <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard"></i> Books </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      
      <div class="row">
        <div class="col-lg-6">
        
        <form action="Books.php" method="post" name="addForm" id="addForm" enctype="multipart/form-data" class="form-horizontal">
             <input type="hidden" name="hf_book_id" id="hf_book_id"  value="<?=$book_id?>">
             <div class="row">
           &nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-default " data-toggle="Add New" title="Add New" data-placement="top" id="swich-1" onclick="reloadPage('Books.php');"> Add New <span class="glyphicon glyphicon-plus"></span></button>
            </div>
            
            
             <?php 
		if(isset($_GET[act]) && $_GET[act]=='edit' && $q_item[pic]!='')
		{
             ?>
              <div class="form-group ">
              <div class='col-lg-2 col-md-2 col-sm-2 '></div>
               
                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12'>
                   <img src="../upfiles/<?=$q_item[pic]?>" width="150" height="150"  >
                </div>
                 <div class='col-lg-2 col-md-2 col-sm-2 '></div>
                
             </div>
             <?php 	
		}
		?> 
            
            
        
        
          <div class='form-group'>
            <label class="alignleft">ISPN:</label>
            <div>
              <input type="text" class="small form-control pull-left" id="ispn" name="ispn" value="<?=$ispn?>"   >
            </div>
          </div>
          <div class='form-group'>
          
            <label class="alignleft">Book Name:</label>
            <div>
              <input type="text" class="small form-control pull-left" id="book_name" name="book_name" value="<?=$book_name?>"   >
            </div>
          </div>
          
           <div class='form-group'>
            <label class="alignleft">Category :</label>
            <div>
              
               <?php  myselect ('cat_id','cat_name','categories','cat_id' , $cat_id) ;  ?>
            </div>
          </div>
          
           <div class='form-group'>
            <label class="alignleft">Author:</label>
            <div>
              <input type="text" class="small form-control pull-left" id="author" name="author" value="<?=$author?>"   >
            </div>
          </div>
          
           <div class='form-group'>
            <label class="alignleft">Number of copy:</label>
            <div>
              <input type="text" class="small form-control pull-left" id="no_of_copy" name="no_of_copy" value="<?=$no_of_copy?>"   >
            </div>
          </div>
          
           <div class='form-group'>
            <label class="alignleft">Image:</label>
            <div>
              <input type="file" name="pic" id="pic" value="" class="form-control"  />
            </div>
          </div>
          
          <div class="row text-center" >
            <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary">Save</button>
            <input type="reset" class="btn btn-default" value="Reset">
          </div>
         </form>
        </div>
        
        <div class="col-lg-6">
        
         <div class='col-lg-12 col-md-12 col-sm-12 '>
            <label class="alignleft">Books List:</label>
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
                      <td><a href="?act=del&id=<?=$q_list[book_id]?>"  title="Delete" ><i class="fa fa-trash" aria-hidden="true"></i></a> &nbsp;&nbsp;&nbsp; <a href="?act=edit&id=<?=$q_list[book_id]?>"  title="Edit" > <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
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
