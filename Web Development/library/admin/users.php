<?php include "header.php" ;
 

 
 if(isset($_POST[btn_save]))
 {
	extract($_POST) ; 
	
	
 	
	if($_POST[hf_member_id] != '' && $_POST[hf_member_id]>0 )
	{
		$SQL = "UPDATE  `members` SET  	`member_name` =  '$_POST[member_name]' ,
											`email` =  '$_POST[email]' , 
											`mobile` =  '$_POST[mobile]' ,
											`adrs` =  '$_POST[adrs]'  
						WHERE member_id =  '$_POST[hf_member_id]' ;" ; 
		if(mysql_query($SQL))
		{ 
			echo "<script>alert('Successfully Updated') ;</script>" ; 
		}
		
	 
 	}
 
	 else 
	 {
		 
		
		$SQL = "INSERT INTO `members` (`member_id`, `member_name`, `email`, `mobile`, `adrs`) 
			VALUES
										(NULL, '$member_name', '$email', '$mobile', '$adrs')" ; 
		
		if(mysql_query($SQL))
			{
				echo "<script>alert('Successfully added') ;</script>" ; 
			}
		 
	 }
 
 }
 
 ?>


  <script type="text/javascript">



function del(member_id)
{
	 
	 var YES_NO=confirm("Do you really want to delete! If yes, it will delete all its products ??!" )
	if (YES_NO==true)
	{
		 
		var url= 'ajax_actions.php?delete_brand=1&member_id='+member_id ; 
		$.ajax({url: url, success: function(result){
			if(result==1)
			{
				alert('Successfully deleted') ;
				location.reload();
				
			}
		}});
	}
	
}

</script> 
  
  <!--============================================ Start Page contents ==================================================-->
  
   <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> LIBRARY OF KING SAUD UNIVERSITY <small>Control Panel</small> </h1>
          <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard"></i> Members </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
      
      <div class="row">
    
      

     
    
        <?php 
		if(isset($_GET[act]) && $_GET[act]=='edit')
		{
			 $sql_item = "SELECT * FROM  members where member_id = ".$_GET[id] ;
			 $r_item = mysql_query($sql_item) ; 
			 $q_item = mysql_fetch_array($r_item) ; 
			 extract($q_item) ; 
			 
			
			
		}
		
		?>
        <form action="members.php" method="post" name="addForm" id="addForm" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name="hf_member_id" id="hf_member_id"  value="<?=$member_id?>">
          <div class="row">
           &nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-default " data-toggle="Add New" title="Add New" data-placement="top" id="swich-1" onclick="reloadPage('Members.php');"> Add New <span class="glyphicon glyphicon-plus"></span></button>
            </div>
            
             <div class="row">
         
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <label>Member Name </label>
              <input type="text" class="form-control" required    id="member_name" name="member_name" value="<?=$member_name?>">
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
          </div>
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <label>E-mail </label>
              <input type="email" class="form-control" required    id="email" name="email" value="<?=$email?>">
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
          </div>
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <label>Phone </label>
              <input type="tel" class="form-control" required    id="mobile" name="mobile" value="<?=$mobile?>">
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
          </div>
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <label>Address </label>
              <textarea class="form-control" required    id="adrs" name="adrs"><?=trim($adrs)?>
</textarea>
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
          </div>
         
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-default">Save</button>
              <button type="reset" class="btn btn-default">Reset </button>
            </div>
          </div>
        </form>
        <hr>
        <?php 
		  $sql_list = "SELECT * FROM  members ORDER BY member_id" ;
		 // echo $sql_list ; 
		  $r_list = mysql_query($sql_list) ; 
		  if(mysql_num_rows($r_list) >  0 )
		  { 
		  	
		  ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3> Members List </h3>
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover"  >
                  <thead>
                    <tr class="info">
                      <th>#</th>
                      <th>Member Name</th>
                      <th>Number Of Books</th>
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
                      <td></td>
                      <td><a href="?act=edit&id=<?=$q_list[member_id]?>"  title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="#" onclick="del(<?=$q_list[member_id]?>);" title="Delete" ><span class="glyphicon glyphicon-trash"></span></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                            
                     <a href="#" ><i class="fa fa-comment-o" aria-hidden="true"></i> </a>
                      
                      </td>
                    </tr>
                    <?php 
								 $i++ ; 
								 }  ?>
                  </tbody>
                </table>
                <!-- /.table-responsive --> 
                
              </div>
              <!-- /.panel-body --> 
            </div>
            <!-- /.panel --> 
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        <?php } ?>
      </div>
   
  
  <!--============================================ end Page contents ==================================================--> 
  
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
