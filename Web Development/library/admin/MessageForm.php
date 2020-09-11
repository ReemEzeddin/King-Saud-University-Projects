<form action="Members.php" method="post" name="addForm" id="addForm" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name="hf_member_id" id="hf_member_id"  value="<?=$_GET[member_id]?>">
           
            
             <div class="row">
         
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <label>Subject: </label>
              <input type="text" class="form-control" required    id="subject" name="subject" >
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
          </div>
          
          
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <label>Message: </label>
              <textarea class="form-control" required    id="message" name="message"> 
</textarea>
            </div>
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
          </div>
         
          <div class="form-group ">
            <div class='col-lg-2 col-md-2 col-sm-2 '></div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
              <button type="submit" name="btn_send" id="btn_send" class="btn btn-default">Send</button>
              <button type="reset" class="btn btn-default">Reset </button>
            </div>
          </div>
        </form>