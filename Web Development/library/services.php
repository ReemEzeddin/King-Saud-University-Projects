<section id="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">At Your Service</h2>
        <hr class="my-4">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 text-center">
        <div class="service-box mt-5 mx-auto"> <i class="fa fa-4x fa-user-o text-primary mb-3 sr-icons"></i>
        
        <form  name="form1" id="form1" method="post" action="Register.php" onSubmit="return validate();" > 
                            <fieldset>
                                <div class="form-group">
                                Username 
                                    <input class="form-control"  required  placeholder="username" <?=$username?> name="username" type="text" required autofocus>
                                </div>
                                <div class="form-group">
                                Password
                                    <input class="form-control" required placeholder="password" id="password" <?=$password?> name="password" type="password" value="">
                                </div>
                                
                                <div class="form-group">
                               Confirm Password
                                    <input class="form-control" required placeholder=" Confirm password" <?=$repassword?> id="repassword" name="repassword" type="password" value="">
                                </div>
                                
                                 <div class="form-group">
                                Name 
                                    <input class="form-control" placeholder="Name" name="member_name" <?=$member_name?> id="member_name" type="text" required >
                                </div>
                                
                                 <div class="form-group">
                                Mobile 
                                    <input class="form-control" placeholder="mobile" name="mobile" <?=$mobile?> id="mobile" type="tel" required >
                                </div>
                                
                                <div class="form-group">
                                E-mail 
                                    <input class="form-control" placeholder="email" <?=$email?> name="email" id="email" type="email" required >
                                </div>
                                
                                <div class="form-group">
                                Address 
                                    <textarea class="form-control" placeholder="Address" name="adrs" id="adrs" required ><?=$adrs?></textarea>
                                </div>
                                
                                
                                
                                <input type="submit" name="Register" id="Register" class="btn btn-lg btn-success btn-block" value="Register">  
                            </fieldset>
                        </form>
        
        
         </div>
      </div>
      <div class="col-lg-6 col-md-6 text-center">
        <div class="service-box mt-5 mx-auto">
          <div id="login-form">
             <form role="form" method="post" action="redirectUser.php?action=login"> 
                            <fieldset>
                                <div class="form-group">
                                Username 
                                    <input class="form-control" placeholder="username" name="username" type="text" required autofocus>
                                </div>
                                <div class="form-group">
                                Password
                                    <input class="form-control" placeholder="password" name="password" type="password" value="">
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="login" id="login" class="btn btn-lg btn-success btn-block" value="Login">  
                            </fieldset>
             </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>