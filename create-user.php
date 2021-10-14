<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include_once('classes/Authclass.php');  
	$auth = new Authclass();

	if(isset($_POST['register'])){
		$data = array(
			 'email' => $_POST['email'],
			 'full_name' => $_POST['full_name'],
			 'phone_number' => $_POST['phone_number'],
			 'city' => $_POST['city'],
			 'house_no' => $_POST['house_no'],
			 'street' => $_POST['street'],
			 'apartment' => $_POST['apartment'],
		);

		$user = $auth->register($data); 
		print_r($user);
		die();
	}
	include("header.php");
?>
<section class="banner workbanner memorial-banner">
	 <div class="container">
		<div class="banner-inner-container">
		   <div class="banner-content-outer">
			  <div class="row">
				 <div class="col-12 col-sm-12">
					<div class="banner-left-content workbanner-left-content">
					   <p class="banner-desc m-0"> Create a new user</p>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
	 </div>
</section>
<section class="memorial-fields-section user-section">
	 <div class="container">
		<div class="field-container">
		   <div class="form-block">
			  <form id="UserRegistration" class="registration-form" method="POST" action="create-user.php">
				 <div class="row justify-content-center">
					<div class="col-lg-6">
					   <div class="custom-form-input">
						  <div class="form-group">
							 <label>full name</label>
							 <input id="fullname" type="text" name="full_name" class="form-control" placeholder="fullname" required>
						  </div>
					   </div>
					   <div class="custom-form-input">
						  <div class="form-group">
							 <label> Phone Number</label>
							 <input id="phone" type="text" name="phone_number" class="form-control" placeholder="phone">
						  </div>
					   </div>
					   <div class="custom-form-input">
						  <div class="form-group">
							 <label>mail adress</label>
							 <input id="email" type="text" name="email" class="form-control" placeholder="email">
						  </div>
					   </div>
					   <div class="custom-form-input">
						  <div class="form-group">
							 <label>Address for sending code QR</label> 
							 <input id="city" type="text" name="city" class="form-control" placeholder="city">
						  </div>
					   </div>
					   <div class="custom-form-input">
						  <div class="form-group">
							 <input id="street" type="text" name="street" class="form-control" placeholder="street">
						  </div>
					   </div>
					   <div class="custom-form-input">
						  <div class="row">
							 <div class="col-lg-6">
								<div class="custom-form-block">
								   <div class="form-group">
									  <input id="housenumber" type="text" name="house_no" class="form-control" placeholder="housenumber">
								   </div>
								</div>
							 </div>
							 <div class="col-lg-6">
								<div class="custom-form-block">
								   <div class="form-group">
									  <input id="apartment" type="text" name="apartment" class="form-control" placeholder="apartment">
								   </div>
								</div>
							 </div>
						  </div>
					   </div>
					   <div class="custom-form-input">
						  <button type="submit" id="submitregister" value="ךשמה" name="register" class="btn btn-block btn-sm"> Continued <i class="fa fa-spinner d-none regspinner"></i></button>
					   </div>
					   <div class="result mt-2"></div>
					</div>
				 </div>
			  </form>
		   </div>
		</div>
	 </div>
</section>
<?php
	include("footer.php");
?>