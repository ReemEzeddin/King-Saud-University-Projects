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
$sn = 'SELECT * FROM `notifications` where member_id ='.$_SESSION["member_id"]; 
$rn= mysql_query($sn) ; 
?> 
 
<section class="content">
          <div class="row">
            <div class="col-md-3">
              <a href="#" class="btn btn-primary btn-block margin-bottom">notifications</a>
             
              <div class="box box-solid">
                
                <div class="box-body no-padding">
                  <?php
				   while($qn=mysql_fetch_array($rn))
				   {
					?>
                    <li><a  href="notifications.php?n_id=<?=$qn[n_id]?>"><i class="fa fa-circle-o text-red"></i> <?=$qn[subject]?></a></li> 
                    <?php   
					   
				   }
				  
				  ?> 
                     
                     
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
<?php
if($_GET[n_id]>0)
{	
mysql_query('update notifications set is_readed =1 where n_id ='.$_GET[n_id]) ; 

			  
$sn = 'SELECT * FROM `notifications` where n_id ='.$_GET[n_id]; 
$rn= mysql_query($sn) ; 
$qn=mysql_fetch_array($rn) ; 
}
?> 
                 
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3><?=$qn[subject]?></h3>
                    <h5>From: Admin <span class="mailbox-read-time pull-right"><?=$qn[n_date]?></span></h5>
                  </div><!-- /.mailbox-read-info -->
                 
                  <div class="mailbox-read-message">
                    <p>
                    <?=$qn[message]?>
                    
                    </p>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
              
             
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>

 



<?php
 include "footer.php" ; 
 
 ?>