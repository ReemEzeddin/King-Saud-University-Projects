<?php
session_start() ; 

				
if(!(isset($_SESSION["CurrentUserId"]) || $_SESSION["CurrentUserId"]!=''||isset($_SESSION["username"]) || $_SESSION["username"]!=''))
{
	  echo "<META HTTP-EQUIV='Refresh' Content='1;URL=login.html'>";
	  exit() ;
}


 
 include_once("header.php") ;
 
 
 
 if(isset($_POST[btn_save]))
 {
	
	if (!empty($_FILES['pic']['name'])) 
		$the_pic = upload_img("../upfiles",$pic) ; 
	else
		$the_pic = "" ;  
 	
	if($_POST[hf_brand_id] != '' && $_POST[hf_brand_id]>0 )
	{
		if(mysql_query("UPDATE  `brands` SET  `brandName` =  '$_POST[brandName]' WHERE brand_id =  '$_POST[hf_brand_id]' ;"))
		{
			
			
			if($the_pic !='')
			mysql_query("UPDATE  `brands` SET  `logo` =  '$the_pic' WHERE brand_id =  '$_POST[hf_brand_id]' ;") ; 
			echo "<script>alert('Successfully Updated') ;</script>" ; 
		}
		
	 
 	}
 
	 else 
	 {
		 
		
		
		
		if(mysql_query("INSERT INTO `brands` (`brand_id`, `brandName`, `logo`) VALUES (NULL, '$_POST[brandName]', '$the_pic') ;"))
			{
				echo "<script>alert('Successfully added') ;</script>" ; 
			}
		 
	 }
 
 }
 
 ?>

<div id="page-wrapper"> 


<script type="text/javascript">

function del(brand_id)
{
	 
	 var YES_NO=confirm("Do you really want to delete! If yes, it will delete all its products ??!" )
	if (YES_NO==true)
	{
		 
		var url= 'ajax_actions.php?delete_brand=1&brand_id='+brand_id ; 
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
  
  <div class="row">
    
      <h1 class="page-header">Brands</h1>
     
      <div class="panel panel-default">
        <div class="panel-body">
        <?php 
		if(isset($_GET[act]) && $_GET[act]=='edit')
		{
			 $sql_item = "SELECT * FROM  brands where brand_id = ".$_GET[id] ;
			 $r_item = mysql_query($sql_item) ; 
			 $q_item = mysql_fetch_array($r_item) ; 
			 extract($q_item) ; 
			 
			
			
		}
		
		?> 
           
            <form action="brands.php" method="post" name="addForm" id="addForm" enctype="multipart/form-data" class="form-horizontal">
             <input type="hidden" name="hf_brand_id" id="hf_brand_id"  value="<?=$brand_id?>">
             <div class="row">
           &nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-default " data-toggle="Add New" title="Add New" data-placement="top" id="swich-1" onclick="reloadPage('brands.php');"> Add New <span class="glyphicon glyphicon-plus"></span></button>
            </div>
            
             <div class="row">
            
            <?php 
		if(isset($_GET[act]) && $_GET[act]=='edit' && $q_item[logo]!='')
		{
             ?>
              <div class="form-group ">
              <div class='col-lg-2 col-md-2 col-sm-2 '></div>
               
                <div class='col-lg-8 col-md-8 col-sm-8 col-xs-12'>
                   <img src="../upfiles/<?=$q_item[logo]?>"  >
                </div>
                 <div class='col-lg-2 col-md-2 col-sm-2 '></div>
                
             </div>
             <?php 	
		}
		?> 
            
            
             <div class="form-group ">
             <div class='col-lg-2 col-md-2 col-sm-2 '></div>
               
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                  <label>Brand Name </label>
                  <input type="text" class="form-control" required    id="brandName" name="brandName" value="<?=$brandName?>">
                </div>
                 <div class='col-lg-2 col-md-2 col-sm-2 '></div>
                
             </div>
             <div class="form-group ">
              <div class='col-lg-2 col-md-2 col-sm-2'></div>
               
                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
                <label>LOGO </label>
               
                 <input type="file" name="pic" value=""  class="form-control"     id="pic" />
                </div>
                
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
		  $sql_list = "SELECT * FROM  brands ORDER BY brand_id" ;
		 // echo $sql_list ; 
		  $r_list = mysql_query($sql_list) ; 
		  if(mysql_num_rows($r_list) >  0 )
		  { 
		  	
		  ?>
          
          <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3> Brands List </h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover"  >
                                <thead>
                                    <tr class="info">
                                    <th>#</th>
                                        <th>Brand Name</th>
                                        <th>Logo</th>
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
                                        <td><?=$q_list[brandName]?></td>
                                        <td><img src="../upfiles/<?=$q_list[logo]?>" style="max-height:50px; max-height:50px"></td>
                                        <td>
                                       
                                        
                                        
                                        <a href="?act=edit&id=<?=$q_list[brand_id]?>"  title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                              
                                         <a href="#" onclick="del(<?=$q_list[brand_id]?>);" title="Delete" ><span class="glyphicon glyphicon-trash"></span></a>
                                        
                                        
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
      </div>
    
  </div>
  
  <!--============================================ end Page contents ==================================================--> 
  
</div>
<?php include_once("footer.php") ;?>