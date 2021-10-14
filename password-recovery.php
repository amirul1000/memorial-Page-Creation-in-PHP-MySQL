<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include_once('classes/Authclass.php');
    $auth = new Authclass();

    if(isset($_POST['forget_pass'])){
        $forget_pass = $auth->forget_password($_POST['email']);
        print_r($forget_pass);
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
                             <p class="banner-desc m-0">שחזור כניסה</p>
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
					<div class="paymentform-wrap reset-pass">
					  <form id="forgetPass"action="/action_page.php">
						<div class="form-group">
						  <label for="name">פרטי התחברות</label>
						  <input type="text" class="form-control" id="email" placeholder="כתובת אימייל" name="name">
						</div>								
						<button type="submit" class="submitbtn">שלח לי סיסמה חדשה <i class="fa fa-spinner d-none forgetspinner"></i></button>
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