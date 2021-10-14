<?php
	include_once('classes/Memorialclass.php');
	$memorial = new Memorialclass();
	$memorial_id = isset($_GET['id']) ? $_GET['id'] : '';
	//add image by visitor
	if(isset($_POST['visitor_media_add'])){
		if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK){
			$fileTmpPath = $_FILES['background_image']['tmp_name'];
			$fileName = $_FILES['background_image']['name'];
			$fileSize = $_FILES['background_image']['size'];
			$fileType = $_FILES['background_image']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$background_image = md5(time() . $fileName) . '.' . $fileExtension;
			$allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg', 'webp');
			if (in_array($fileExtension, $allowedfileExtensions)){
			  $uploadFileDir = 'uploads/memorial/visitors/';
			  $dest_path = $uploadFileDir.'/' . $background_image;
			  if(move_uploaded_file($fileTmpPath, $dest_path)) {
				$message ='File is successfully uploaded.';
			  }
			  else{
				$message = 'There was some error';
			  }
			}
			else{
			  $message = 'העלאה נכשלה. סוגי קובץ מותרים: ' . implode(',', $allowedfileExtensions);
			}
		}
		$visit_media = $memorial->add_media_by_visitor($memorial_id,$dest_path);
	}
	//Add memory
	if(isset($_POST['addmemory'])){
        $memory = $_POST['memory'];
        $memorial_id = $_POST['memorial_id'];
        $addmemory = $memorial->add_memory($memorial_id,$memory); 
        print_r($addmemory);
        die();
	}
	$memorial_details = $memorial->get_detail_by_memorial_id($memorial_id);
	$photos = !empty($memorial_details['images']) ? $memorial_details['images'] : '';
	$videos = !empty($memorial_details['videos']) ? $memorial_details['videos'] : '';
	$memories = !empty($memorial_details['memories']) ? $memorial_details['memories'] : '';
	$all_visitors = !empty($memorial_details['all_visitors']) ? $memorial_details['all_visitors'] : '';
	$all_visitor_media = !empty($memorial_details['all_visitor_media']) ? $memorial_details['all_visitor_media'] : '';
	$memorial_details = !empty($memorial_details['details']) ? $memorial_details['details'] : '' ;
	
	if(isset($_POST['visitor_add'])){
		$add_visit = $memorial->add_visit_log($_POST['mid'],$_POST['visitor_name']);
		print_r($add_visit);
		die();
	} 
	include("header.php");
	if(isset($memorial_details['background_image']) && !empty($memorial_details['background_image'])){?>
		<style>
			section.banner.workbanner.memorial-banner.banner-eleven {
    			background: transparent url("uploads/memorial/profile/<?php echo $memorial_details['background_image'];?>") no-repeat center / cover;
			}
		</style>
	<?php 
	}
?>
<section class="banner workbanner memorial-banner banner-eleven">
        <div class="container">
            <div class="banner-inner-container">
                <div class="banner-content-outer">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="banner-left-content workbanner-left-content">
                             <!--   <p class="banner-desc m-0"> חונמה דומע תריצי</p> -->
							 <?php  
							 	if(isset($memorial_details['profile_pic']) && !empty($memorial_details['profile_pic'])){?>
								<img class="memorialview-profile" src="uploads/memorial/profile/<?php echo $memorial_details['profile_pic'];?>" alt="img">
								<?php } else { ?>
								<img src="assets/images/profile-img.png" alt="img">
							 <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="memorial-fields-section desktop-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-8">
				<div class="right-content align-right">
					<a href="#visitorarea"><button id="openVisit" type="button" class="rightorange"><img src="assets/images/box.png" alt="img"> יומן ביקורים</button></a>
					<ul class="social-icons">
					<li><?php echo $memorial_details['full_name']; ?></li>
					<li><?php echo $memorial_details['english_full_name'];?></li>
						<li><a href="<?php echo $memorial_details['facebook'];?>" target="_blank"><img src="assets/images/fb.png" alt="img"></a></li>
						<li><a href="<?php echo $memorial_details['instagram'];?>" target="_blank"><img src="assets/images/instagram.png" alt="img"></a></li>
					</ul>
					<p><?php echo $memorial_details['date_of_birth']; ?> - <?php echo $memorial_details['date_of_passing']; ?> <img src="assets/images/calendar.png" alt="img"></p>
					<p><?php echo $memorial_details['h_date_of_birth']; ?> - <?php echo $memorial_details['h_date_of_passing']; ?> </p>
					<p> <?php echo $memorial_details['memorial_location'];?> <img src="assets/images/location-small.png" alt="img"></p>
					<p>v: <?php echo $memorial_details['place_before_death'];?> </p>
					<p>cause_of_death: <?php echo $memorial_details['cause_of_death'];?> </p>
					<p>height: <?php echo $memorial_details['height'];?></p>
					<p>religion: <?php echo $memorial_details['religion'];?></p>
					<p>education: <?php echo $memorial_details['education'];?></p>
					<p>army_service: <?php echo $memorial_details['army_service'];?> </p>
					<p>occupation: <?php echo $memorial_details['occupation'];?></p>
					<phobbies: <?php echo  $memorial_details['hobbies'];?></p>
				</div>
			</div>			
			<div class="col-sm-6 col-4">
				<div class="share-icons">
					<ul>
						<li><a href="#"><img src="assets/images/location.png" alt="img"></a></li>
						<li><a href="#"><img src="assets/images/share.png" alt="img"></a></li>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<div class="tabing_outer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbing_outer">
						<ul class="nav nav-pills">
						<li><a data-toggle="pill" href="#menu1"><svg width="50" height="46" viewBox="0 0 50 46" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M13.875 0.375V12.1875H17.25V3.75H20.625V5.4375H24V3.75H39.1875V5.4375H42.5625V3.75H45.9375V24H42.5625V22.3125H39.1875V27.375H49.3125V0.375H13.875ZM20.625 8.8125V12.1875H24V8.8125H20.625ZM39.1875 8.8125V12.1875H42.5625V8.8125H39.1875ZM0.375 15.5625V45.9375H35.8125V15.5625H0.375ZM39.1875 15.5625V18.9375H42.5625V15.5625H39.1875ZM3.75 18.9375H32.4375V35.4434L28.0605 31.0664L26.8477 29.9062L22.1016 34.6523L14.877 27.375L13.7168 26.1621L3.75 36.1289V18.9375ZM23.1562 22.3125C21.7573 22.3125 20.625 23.4448 20.625 24.8438C20.625 26.2427 21.7573 27.375 23.1562 27.375C24.5552 27.375 25.6875 26.2427 25.6875 24.8438C25.6875 23.4448 24.5552 22.3125 23.1562 22.3125ZM13.7135 30.9609L22.151 39.3984L23.3145 38.1855L26.8477 34.6523L32.4375 40.2422V42.5625H3.75V40.9277L13.7135 30.9609Z" fill="#1E1E1F"/>
							</svg> <p>תמונות</p></a></li>
						<li><a data-toggle="pill" href="#menu2"><svg width="40" height="32" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M3.33333 0C2.44928 0 1.60143 0.337142 0.976311 0.937258C0.351189 1.53737 0 2.35131 0 3.2C0 4.04869 0.351189 4.86262 0.976311 5.46274C1.60143 6.06286 2.44928 6.4 3.33333 6.4C4.21739 6.4 5.06523 6.06286 5.69036 5.46274C6.31548 4.86262 6.66667 4.04869 6.66667 3.2C6.66667 2.35131 6.31548 1.53737 5.69036 0.937258C5.06523 0.337142 4.21739 0 3.33333 0ZM15 0L11.6667 3.2L15 6.4H31.6667C32.5867 6.4 33.3333 5.6832 33.3333 4.8V1.6C33.3333 0.7168 32.5867 0 31.6667 0H15ZM3.33333 12.8C2.44928 12.8 1.60143 13.1371 0.976311 13.7373C0.351189 14.3374 0 15.1513 0 16C0 16.8487 0.351189 17.6626 0.976311 18.2627C1.60143 18.8629 2.44928 19.2 3.33333 19.2C4.21739 19.2 5.06523 18.8629 5.69036 18.2627C6.31548 17.6626 6.66667 16.8487 6.66667 16C6.66667 15.1513 6.31548 14.3374 5.69036 13.7373C5.06523 13.1371 4.21739 12.8 3.33333 12.8ZM15 12.8L11.6667 16L15 19.2H38.3333C39.2533 19.2 40 18.4832 40 17.6V14.4C40 13.5168 39.2533 12.8 38.3333 12.8H15ZM3.33333 25.6C2.44928 25.6 1.60143 25.9371 0.976311 26.5373C0.351189 27.1374 0 27.9513 0 28.8C0 29.6487 0.351189 30.4626 0.976311 31.0627C1.60143 31.6629 2.44928 32 3.33333 32C4.21739 32 5.06523 31.6629 5.69036 31.0627C6.31548 30.4626 6.66667 29.6487 6.66667 28.8C6.66667 27.9513 6.31548 27.1374 5.69036 26.5373C5.06523 25.9371 4.21739 25.6 3.33333 25.6ZM15 25.6L11.6667 28.8L15 32H25C25.92 32 26.6667 31.2832 26.6667 30.4V27.2C26.6667 26.3168 25.92 25.6 25 25.6H15Z" fill="#0C1E2F"/>
							</svg>
								<p>ציר זמן</p></a></li>
						<li><a data-toggle="pill" href="#menu3">
						<svg width="34" height="44" viewBox="0 0 34 44" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.30724 0C3.74835 0 0.845703 3.04087 0.845703 6.76923V37.2308C0.845703 40.9591 3.74835 44 7.30724 44H26.6919C30.2507 44 33.1534 40.9591 33.1534 37.2308V13.5385C33.1534 11.7404 31.5822 10.0349 28.7616 7.13942C28.3703 6.73618 27.9476 6.28666 27.55 5.87019C27.1525 5.45373 26.7234 5.0637 26.3385 4.65385C23.5747 1.69892 21.9467 0 20.2303 0H7.30724ZM7.30724 3.38462H19.0693C20.2366 3.69531 20.2303 5.16286 20.2303 6.66346V11.8462C20.2303 12.7782 20.956 13.5385 21.8457 13.5385H26.6919C28.3009 13.5385 29.9226 13.5451 29.9226 15.2308V37.2308C29.9226 39.1016 28.4776 40.6154 26.6919 40.6154H7.30724C5.52148 40.6154 4.07647 39.1016 4.07647 37.2308V6.76923C4.07647 4.89844 5.52148 3.38462 7.30724 3.38462ZM8.92263 8.46154C8.0329 8.46154 7.30724 9.22176 7.30724 10.1538V11.8462C7.30724 12.7782 8.0329 13.5385 8.92263 13.5385H17.4539C17.1762 13.0361 16.9995 12.4675 16.9995 11.8462V8.46154H8.92263ZM7.30724 18.6154V22H10.538V18.6154H7.30724ZM13.7688 18.6154V22H26.6919V18.6154H13.7688ZM7.30724 25.3846V28.7692H10.538V25.3846H7.30724ZM13.7688 25.3846V28.7692H26.6919V25.3846H13.7688ZM7.30724 32.1538V35.5385H10.538V32.1538H7.30724ZM13.7688 32.1538V35.5385H26.6919V32.1538H13.7688Z" fill="#1E1E1F"/>
							</svg>

						<p>תפילה לזכרו</p></a></li>
						<li class="active memorytab"><a class="memorytab active" data-toggle="pill" href="#home">
							<svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M16.1386 0.866699C15.2542 0.888699 14.4718 1.43755 14.1477 2.25889L3.11334 30.2H2.33131C2.13695 30.1973 1.944 30.2332 1.76364 30.3057C1.58329 30.3781 1.41914 30.4857 1.28073 30.6222C1.14232 30.7587 1.03241 30.9213 0.957397 31.1006C0.882381 31.2799 0.84375 31.4723 0.84375 31.6667C0.84375 31.8611 0.882381 32.0535 0.957397 32.2328C1.03241 32.4121 1.14232 32.5747 1.28073 32.7112C1.41914 32.8477 1.58329 32.9553 1.76364 33.0277C1.944 33.1002 2.13695 33.1361 2.33131 33.1334H8.19797C8.39232 33.1361 8.58528 33.1002 8.76563 33.0277C8.94599 32.9553 9.11014 32.8477 9.24855 32.7112C9.38696 32.5747 9.49686 32.4121 9.57188 32.2328C9.6469 32.0535 9.68553 31.8611 9.68553 31.6667C9.68553 31.4723 9.6469 31.2799 9.57188 31.1006C9.49686 30.9213 9.38696 30.7587 9.24855 30.6222C9.11014 30.4857 8.94599 30.3781 8.76563 30.3057C8.58528 30.2332 8.39232 30.1973 8.19797 30.2H7.84276L10.1774 24.2904C10.2507 24.3021 10.3188 24.3334 10.398 24.3334H16.299C16.6686 23.2906 17.1514 22.3035 17.7571 21.4H11.3175L16.3277 8.71566L20.656 18.3091C21.8147 17.4101 23.1236 16.6989 24.5433 16.2237L18.1982 2.16149C17.833 1.35482 17.0215 0.868166 16.1386 0.866699ZM28.7313 18.4667C23.0612 18.4667 18.4646 23.0632 18.4646 28.7334C18.4646 34.4035 23.0612 39 28.7313 39C34.4014 39 38.998 34.4035 38.998 28.7334C38.998 23.0632 34.4014 18.4667 28.7313 18.4667ZM28.7313 22.8667C29.5409 22.8667 30.198 23.5223 30.198 24.3334V27.2667H33.1313C33.9409 27.2667 34.598 27.9223 34.598 28.7334C34.598 29.5444 33.9409 30.2 33.1313 30.2H30.198V33.1334C30.198 33.9444 29.5409 34.6 28.7313 34.6C27.9217 34.6 27.2646 33.9444 27.2646 33.1334V30.2H24.3313C23.5217 30.2 22.8646 29.5444 22.8646 28.7334C22.8646 27.9223 23.5217 27.2667 24.3313 27.2667H27.2646V24.3334C27.2646 23.5223 27.9217 22.8667 28.7313 22.8667Z" fill="#1E1E1F"/>
								</svg>
							<p>כתבו עלי</p></a></li>

						</ul>
					</div>
					<div class="tab_content_wrap">
						<div class="tab-content">
						<div id="home" class="tab-pane fade in active show">
							
							<div class="row">
								<div class="col-sm-6 align-right">
									<input id="memoryinputtoadd" type="text" class="form-control addbox addbox-input addmemory" placeholder="+  הוסף זיכרון">
									<input id="memorialIdtoInput" type="hidden" value="<?php echo $memorial_id;?>">
									 <div class="memory-result mt-2"></div>
								</div>							
								<div class="col-sm-6"></div>
								
							</div>	
							<div id="visitorarea" class="locationdate">
								<h4>יומן ביקורים</h4>
								<form id="visitorAdd" class="visitoradd-form" method="POST" action="view-memorial.php">
									<div class="addinput">
										<input type="text" class="form-control" id="addvisit" placeholder=" הוסף שם מלא +">
										<input type="hidden" class="form-control" id="vi" value="<?php echo $memorial_id;?>">
										<button type="submit" class="addbtn">העלה <i class="fa fa-spinner d-none visspinner"></i></button>
									</div>	
									<div class="result mt-2"></div>								
								</form>
								<div id="vtable">
									<?php if(!empty($all_visitors)){
										$count = 0;
										foreach($all_visitors as $visit){?>
										<div class="<?php echo ($count%2 == 0) ? "lightcolor" : "darkcolor";?>">
											<div class="row">
												<div class="col-xs-6 col-6 align-right">
													<p><?php echo $visit['visitor_name'];?><img src="assets/images/location.png" alt="location icon"></p>
												</div>
												<div class="col-xs-6 col-6 align-left">
													<p><?php echo date("d/m/Y", strtotime($visit['created_at']));?></p>
												</div>										
											</div>
										</div>
									<?php $count++; } } ?>
								</div>								
							</div>								
							<div id="MemoryonArea" class="row memoriesShow">
								<?php if(!empty($memories)){
									foreach($memories as $mem){?>
										<div class="col-sm-6">
											<div class="box_wrap">
												<ul>
													<li><b><?php echo $mem['user_name'];?></b></li>
													<li><?php echo date("d/m/Y", strtotime($mem['created_at']));?></li>
												</ul>
												<p><?php echo $mem['memory'];?></p>
											</div>																		
										</div>
								<?php } }?>									
							</div>								
						</div>
						<div id="menu1" class="tab-pane fade">
							<div class="row">
								<div class="col-sm-6 align-right">
									<form id="visitormediaadd" class="visitmedia-form" method="POST" action="view-memorial.php?id=<?php echo $memorial_id;?>" enctype= "multipart/form-data">
									<div class="addinput">
										<input type="file" name="background_image" class="form-control" id="addvisit" placeholder=" הוסף שם מלא +">
										<button type="submit" name="visitor_media_add" value="true" class="addbtn">העלה <i class="fa fa-spinner d-none visspinner"></i></button>
									</div>								
								</form>
								</div>							
							<div class="row">
								<?php if(!empty($photos)){
									$images = unserialize($photos);
										foreach ($images as $im) {
										?>
										<div class="col-4">
											<div class="imgfull">
												<img src="<?php echo $im;?>" alt="img">
											</div>
										</div>
									<?php
									}
								}
								?>
								<?php if(!empty($videos)){
									$videos = unserialize($videos);
										foreach ($videos as $mvd) {
										?>
										<div class="col-4">
											<div class="imgfull">
												<video width="320" height="240" controls>
												  <source src="<?php echo $mvd;?>" type="video/mp4">
												</video>
											</div>
										</div>
									<?php
									}
								}
								?>
								<?php if(!empty($all_visitor_media)){
										foreach ($all_visitor_media as $vm) {
										?>
										<div class="col-4">
											<div class="imgfull">
												<img src="<?php echo $vm['media_url'];?>" alt="img">
											</div>
										</div>
									<?php
									}
								}
								?>								
							</div>						
						</div>
						</div>
						<div id="menu2" class="tab-pane fade">
							<div class="ritz-wrap">
								<div class="profile-content">
									<div class="titlebar">
										<div class="row">
											<div class="col-sm-3">
												<div class="profile-bartitle">
													<h2>יומן ביקורים</h2>
												
												</div>
											</div>									
											<div class="col-sm-9">
												<div class="profile-inner">
													<h2>ציר זמן</h2>
												</div>
											</div>	
										</div>	
									</div>	
								<div class="row">
									<div class="col-sm-2">
										<div class="profile-bar">
										
										</div>
									</div>									
									<div class="col-sm-10">
										<div class="profile-inner">
											<button type="button" class="addbox"> +  הוסף לציר הזמן</button>
											<?php if(!empty($memories)){?>
												<div class="box_wrap">
													<ul>
														<li><b><?php echo $memories[0]['user_name'];?></b></li>
														<li><?php echo $memories[0]['created_at'];?></li>
													</ul>
													<p> <?php echo $memories[0]['memory'];?></p>
												</div>
											<?php } ?>	
											<div class="box_wrap imgwrp">
												<ul>
													<li><b>פלוני אלמוני</b></li>
													<li>12/03/2021</li>
												</ul>
												<div class="row">
													<div class="col-sm-4">
														<div class="imgfull">
															<img src="assets/images/img1.png" alt="img">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="imgfull">
															<img src="assets/images/img2.png" alt="img">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="imgfull">
															<img src="assets/images/img1.png" alt="img">
														</div>
													</div>														
												
												</div>
												<div class="row">
													<div class="col-sm-4">
														<div class="imgfull">
															<img src="assets/images/img2.png" alt="img">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="imgfull">
															<img src="assets/images/img1.png" alt="img">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="imgfull">
															<img src="assets/images/img1.png" alt="img">
														</div>
													</div>														
												
												</div>													
											</div>										
											<div class="box_wrap imgwrp">
												<ul>
													<li><b>פלוני אלמוני</b></li>
													<li>12/03/2021</li>
												</ul>
												<div class="row">
													<div class="col-sm-12">
														<div class="imgfull">
															<img src="assets/images/imgvideo2.jpg" alt="img">
														</div>
													</div>
												</div>												
											</div>
											<div class="box_wrap">
												<ul>
													<li><b>פלוני אלמוני</b></li>
													<li>12/03/2021</li>
												</ul>
												<div class="row">
													<div class="col-sm-12">
														<div class="imgfull">
															<img src="assets/images/txtimg.png" alt="img">
														</div>
													</div>
												</div>	
											</div>												
										</div>
									</div>

								</div>
								</div>
							</div>
						</div>
						<div id="menu3" class="filewrap tab-pane fade">
							<h3>שיר השירים</h3>
							<p><?php echo $memorial_details['prayer'];?></p>
						</div>
						</div>					
					
					
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
 
include("footer.php");
?>