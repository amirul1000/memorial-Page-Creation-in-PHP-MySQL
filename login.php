<?php
	include_once('classes/Authclass.php');  
	$auth = new Authclass();
	if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $auth->login($email,$password); 
        print_r($user);
        die();
	}
	include("header.php");
?>
<section class="banner payment memorial-banner banner-eleven">
        <div class="container">
            <div class="banner-inner-container">
                <div class="banner-content-outer">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="banner-left-content workbanner-left-content">
                             <p class="banner-desc m-0">Login</p>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="memorial-fields-section paymentform-outer">
        <div class="container">
            <div class="row">
				<div class="col-sm-12">
					<div class="paymentform-wrap">
					  <form id="LoginForm" method="POST">
						<div class="form-group">
						  <label for="name">login details</label>
						  <input type="text" name="email" class="form-control" id="email" placeholder="מייל" name="name" required>
						</div>		
						<div class="form-group">
						  <label for="name">password</label>
						  <input type="password" name="password" class="form-control" id="password" placeholder="סיסמה" name="name" required>
						</div>							
						<button type="submit" id="Loginsubmit"class="submitbtn">Login <i class="fa fa-spinner d-none loginspinner"></i></button>
						<div class="form-group forgetwrap">
						  <a class="forgetbtn" href="password-recovery.php">unable to connect</a>
						</div>
                        <div class="result mt-2"></div>
					  </form>
					</div>
				</div>			
			</div>

        </div>
</section>
<?php
include("footer.php");
?>