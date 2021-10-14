<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include("header.php");
	include("qr-code-in-php/index.php");
   if(!isset($_SESSION['userid']) && empty($_SESSION['userid'])){
		?>
			<script> window.location.href = 'login.php';</script>
		<?php
		exit();
    }
	
	include_once('classes/Memorialclass.php');  
	$memorial = new Memorialclass(); 

	if(isset($_POST['add_memorial'])){
		//Profile pic upload
		if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK){
			$fileTmpPath = $_FILES['profile_pic']['tmp_name'];
			$fileName = $_FILES['profile_pic']['name'];
			$fileSize = $_FILES['profile_pic']['size'];
			$fileType = $_FILES['profile_pic']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$profile_pic_name = md5(time() . $fileName) . '.' . $fileExtension;
			$allowedfileExtensions = array('jpg', 'gif', 'png', 'webp', 'jpeg');
			if (in_array($fileExtension, $allowedfileExtensions)){
			  $uploadFileDir = 'uploads/memorial/profile/';
			  $dest_path = $uploadFileDir.'/' . $profile_pic_name;
			  if(move_uploaded_file($fileTmpPath, $dest_path)) {
				$message ='File is successfully uploaded.';
			  }
			  else{
				$message = 'There was some error';
			  }
			}
			else{
			  $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
			}
		}
		//background image upload
		if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK){
			$fileTmpPath = $_FILES['background_image']['tmp_name'];
			$fileName = $_FILES['background_image']['name'];
			$fileSize = $_FILES['background_image']['size'];
			$fileType = $_FILES['background_image']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$background_image = md5(time() . $fileName) . '.' . $fileExtension;
			$allowedfileExtensions = array('jpg', 'jpeg', 'png', 'webp');
			if (in_array($fileExtension, $allowedfileExtensions)){
			  $uploadFileDir = 'uploads/memorial/profile/';
			  $dest_path = $uploadFileDir.'/' . $background_image;
			  if(move_uploaded_file($fileTmpPath, $dest_path)) {
				$message ='File is successfully uploaded.';
			  }
			  else{
				$message = 'There was some error';
			  }
			}
			else{
			  $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
			}
		}
		//Gallery images upload
		if (isset($_FILES['gallery_images'])){
			$error=array();
			$extension=array("jpeg","jpg","png","gif","webp");
			foreach($_FILES["gallery_images"]["tmp_name"] as $key=>$tmp_name) {
				$file_name=$_FILES["gallery_images"]["name"][$key];
				$file_tmp=$_FILES["gallery_images"]["tmp_name"][$key];
				$ext=pathinfo($file_name,PATHINFO_EXTENSION);

				if(in_array($ext,$extension)) {
					move_uploaded_file($file_tmp=$_FILES["gallery_images"]["tmp_name"][$key],$gallery_images[] = "uploads/memorial/gallery/".md5($file_name).".".$ext);
				}
				else {
					array_push($error,"$file_name, ");
				}
			}
		}
		//videos upload
		if (isset($_FILES['memorial_videos'])){
			$error=array();
			$extension=array("mp4","mkv","webm");
			foreach($_FILES["memorial_videos"]["tmp_name"] as $key=>$tmp_name) {
				$file_name=$_FILES["memorial_videos"]["name"][$key];
				$file_tmp=$_FILES["memorial_videos"]["tmp_name"][$key];
				$ext=pathinfo($file_name,PATHINFO_EXTENSION);

				if(in_array($ext,$extension)) {
					move_uploaded_file($file_tmp=$_FILES["memorial_videos"]["tmp_name"][$key],$memorial_videos[] = "uploads/memorial/videos/".md5($file_name).".".$ext);
				}
				else {
					array_push($error,"$file_name, ");
				}
			}
		}
		
		$data = array(
			'full_name' => !empty($_POST['full_name']) ? $_POST['full_name'] : '',
			'english_full_name' => !empty($_POST['english_full_name']) ? $_POST['english_full_name'] : '',
			'date_of_birth' => !empty($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '',
			'date_of_passing' => !empty($_POST['date_of_passing']) ? $_POST['date_of_passing'] : '',
			'h_date_of_birth' => !empty($_POST['h_date_of_passing']) ? $_POST['h_date_of_passing'] : '',
			'h_date_of_passing' => !empty($_POST['h_date_of_passing']) ? $_POST['h_date_of_passing'] : '',
			'memorial_location' => !empty($_POST['memorial_location']) ? $_POST['memorial_location'] : '',
			'place_before_death' => !empty($_POST['place_before_death']) ? $_POST['place_before_death'] : '',
			'cause_of_death' => !empty($_POST['cause_of_death']) ? $_POST['cause_of_death'] : '',
			'religion' => !empty($_POST['religion']) ? $_POST['religion'] : '',
			'height' => !empty($_POST['height']) ? $_POST['height'] : '',
			'education' => !empty($_POST['education']) ? $_POST['education'] : '' ,
			'army_service' => !empty($_POST['army_service']) ? $_POST['army_service'] : '',
			'occupation' => !empty($_POST['occupation']) ? $_POST['occupation'] : '',
			'hobbies' => !empty($_POST['hobbies']) ? $_POST['hobbies'] : '',
			'social_links' => !empty($_POST['social_links']) ? $_POST['social_links'] : '',
			'facebook' => !empty($_POST['facebook_link']) ? $_POST['facebook_link'] : '',
			'instagram' => !empty($_POST['instagram_link']) ? $_POST['instagram_link'] : '',
			'prayer' => !empty($_POST['prayer']) ? $_POST['prayer'] : '',
			'profile_pic' => !empty($profile_pic_name) ? $profile_pic_name : '',
			'background_image' => !empty($background_image) ? $background_image : '',
			'gallery_images' => !empty($gallery_images) ? $gallery_images : '',
			'memorial_videos' => !empty($memorial_videos) ? $memorial_videos : '',
			
		);

		$memorial = $memorial->add_memorial($_SESSION['userid'],$data);
		if ($memorial) { 
			$memorial_id = $memorial['id'];
			
			//Generate QR Code
			$data = $_SERVER['HTTP_HOST'].'/thecitygame-nizkor/view-memorial.php?id='.$memorial_id;
			$level='M';
			$size=20;
			$qr_pic = $_SERVER['HTTP_HOST'].'/thecitygame-nizkor/'.generate_qr_code($data,$level,$size);
			
			//update database
			$memorial = new Memorialclass(); 
			$data = array(
			'qr_photo_url' => $qr_pic,
		    );
			$memorial->update_qr_photo_url($memorial_id,$data)
			
			?>
			<script> window.location.href = 'view-memorial.php?id=<?php echo $memorial_id;?>';</script>
			<?php
		} else {  
			echo "<script>alert('Something went wrong')</script>";  
		}  
	}
?>
<section class="banner workbanner memorial-banner mobile-none">
	<div class="container">
		<div class="banner-inner-container">
			<div class="banner-content-outer">
				<div class="row">
					<div class="col-12 col-sm-12">
						<div class="banner-left-content workbanner-left-content">
							<p class="banner-desc m-0"> Creating the deceased page</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="dormant-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="dormant-innr ltr">
                        <div class="dormnt-circle">
                            <img class="profileuploadview" src="assets/images/plus-icon.svg" alt="plus-icon">
							<img class="proimg-added d-none" src="assets/images/plus-icon.svg" alt="plus-icon">
                            <p>Picture of the deceased</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="memorial-fields-section">
	<div class="container">
		<div class="field-container">
			<div class="form-heading">
				<div class="row">
					<div class="col-12">
						<div class="memorial-fields-heading">
							<h5 class="text-right fields-title">Details of the deceased</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="form-block">
				<form id="addMemory" class="memorial-form" action="create-memorial.php" method="POST" enctype= "multipart/form-data">
					<div class="row">
						<div class="col-lg-6  col-md-12  col-sm-12">
							<div class="custom-form-input">
								<div class="form-group">
									<label>Picture of the deceased</label>
									<div class="fileupd ppupd">
									<span class="trashprofile d-none"><img src="assets/images/trash.png"></span>
									<input type="file" name="profile_pic" class="form-control profile_pic ppupload" placeholder="">
									<span class="replacableprofile">Insert image</span>
									</div>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label> Background image (sideways)</label>
									<div class="fileupd backupd">
									<span class="trashbackground d-none"><img src="assets/images/trash.png"></span>
									<input type="file" name="background_image" class="form-control profile_pic background_image" placeholder="">
									<span class="replacablebackground">Insert image</span>
									</div>
									<!--<input type="text" name="background_image"class="form-control" placeholder=""> -->
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label> full name</label>
									<input type="text" name="full_name" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input fullname-english">
								<div class="form-group">
									<label>Full name in English</label>
									<input type="text" name="english_full_name" class="form-control validator" style="text-align:left;" placeholder="">
								</div>
							</div>
							<div class="custom-form-input">
								<div class="row">
									<div class="col-6">
										<div class="custom-form-block">
											<div class="form-group">
												<label>Date of birth</label>
												<div class="ui calendar" id="cal3">
													<div class="ui input left icon"
>
													  <input type="text" name="date_of_passing" placeholder="" class="form-control validator" required>
													</div>
												  </div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="custom-form-block">
											<div class="form-group">
												<label>Date of death</label>
												<div class="ui calendar" id="cal4">
													<div class="ui input left icon">
													  <input type="text" name="date_of_birth" placeholder="" class="form-control validator" required>
													</div>
												  </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="row">
									<div class="col-6">
										<div class="custom-form-block">
											<div class="form-group">
												<label> Hebrew date of birth</label>
											<div class="ui calendar" id="cal1">
												<div class="ui input left icon">
												  <input type="text" name="h_date_of_passing" placeholder="" class="form-control validator" required>
												</div>
											  </div>
											  </div>
											
										</div>
									</div>
									<div class="col-6">
										<div class="custom-form-block">
											<div class="form-group">
												<label> Hebrew date of death</label>
												<div class="ui calendar" id="cal2">
													<div class="ui input left icon">
													  <input type="text" name="h_date_of_birth" placeholder="" class="form-control validator" required>
													</div>
												  </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>Location of burial</label>
									<input type="text" name="memorial_location" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>Residence</label>
									<input type="text" name="place_before_death" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>Cause of death</label>
									<input type="text" name="cause_of_death" class="form-control validator" placeholder="" required>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 form-pd">
							<div class="custom-form-input">
								<div class="form-group">
									<label>height</label>
									<input type="text" name="height" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>religion</label>
									<input type="text" name="religion" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>education</label>
									<input type="text" name="education" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>Military Service</label>
									<input type="text" name="army_service" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>profession</label>
									<input type="text" name="occupation" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>Hobbies</label>
									<input type="text" name="hobbies" class="form-control validator" placeholder="" required>
								</div>
							</div>
							<div class="custom-form-input">
								<h5 class="text-right fields-title">Social Networks</h5>
								<div class="form-group">
									<label>Facebook</label>
									<input type="text" name="facebook_link" class="form-control validator" placeholder="">
								</div>
							</div>
							<div class="custom-form-input">
								<div class="form-group">
									<label>Instagram</label>
									<input type="text" name="instagram_link"class="form-control validator" placeholder="">
								</div>
							</div>
							<div class="custom-form-input non-bg-input">
								<div class="form-group">
									<input type="text" class="form-control bg-transparent border-0 validator"
										placeholder="הוסף עוד">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="custom-form-input custom-textarea mb-lg-4">
								<div class="form-group">
									<label> Photos</label>
									<div class="image-container form-control">
									   
										<div class="imgUp">
										<label>
											  <span>Insert pictures</span> <img src="assets/images/plus-icon.svg" alt="img">  <input type="file" id="uploadFile" name="gallery_images[]" class="uploadFile img" style="width: 0px;height: 0px;overflow: hidden;" multiple>
										   </label>
											<div class="imagePreview"></div>
										
										  </div>
									</div>								
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="custom-form-input custom-textarea">
								<div class="form-group">
									<label>Videos</label>
									<div class="image-container video-conatiner form-control">
										<label><span>Insert videos</span> <img src="assets/images/plus-icon.svg" alt="img">  
                                        <input id="file-input" type="file" name="memorial_videos[]" class="d-none uploadvideo" accept="video/*" multiple></label>								   
										<div class="videopreview"></div>									  								  
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="custom-form-input custom-textarea text-custom">
								<div class="form-group">
									<label>  A prayer in his memory</label>
									<textarea class="form-control" name="prayer" id="exampleFormControlTextarea1" rows="3" placeholder=" Enter a prayer" required></textarea>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="custom-form-btn">
								<input type="submit" name="add_memorial" id="submit-memory" value="Save" class="btn custom-btn ltr btn-lg">
							</div>
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