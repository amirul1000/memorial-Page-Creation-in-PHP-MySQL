<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once('classes/Memorialclass.php');  
    $memorial = new Memorialclass(); 

    if(isset($_POST['add_memorial'])){
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK){
            $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
            $fileName = $_FILES['profile_pic']['name'];
            $fileSize = $_FILES['profile_pic']['size'];
            $fileType = $_FILES['profile_pic']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $profile_pic_name = md5(time() . $fileName) . '.' . $fileExtension;
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
            if (in_array($fileExtension, $allowedfileExtensions)){
              $uploadFileDir = 'uploads/memorial/profile';
              $dest_path = $uploadFileDir . $profile_pic_name;
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
        if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK){
            $fileTmpPath = $_FILES['background_image']['tmp_name'];
            $fileName = $_FILES['background_image']['name'];
            $fileSize = $_FILES['background_image']['size'];
            $fileType = $_FILES['background_image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $background_image = md5(time() . $fileName) . '.' . $fileExtension;
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
            if (in_array($fileExtension, $allowedfileExtensions)){
              $uploadFileDir = 'uploads/memorial/profile';
              $dest_path = $uploadFileDir . $background_image;
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
        if (isset($_FILES['gallery_images']) && $_FILES['gallery_images']['error'] === UPLOAD_ERR_OK){
            foreach ($_FILES['gallery_images']['tmp_name'] as $key => $value) {                    
                $file_tmpname = $_FILES['gallery_images']['tmp_name'][$key];
                $file_name = $_FILES['gallery_images']['name'][$key];
                $file_size = $_FILES['gallery_images']['size'][$key];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_types = array('jpg','png','jpeg');
                // Set upload file path
                $filepath = 'uploads/memorial/'.$file_name;
                $gallery_images[] = $filepath;
                if(in_array(strtolower($file_ext), $allowed_types)) {
                        
                    if(file_exists($filepath)) {
                        $filepath = 'uploads/memorial/'.time().$file_name;
                        if( move_uploaded_file($file_tmpname, $filepath)) {
                            echo "successfully uploaded <br />";
                        }
                        else {                    
                            echo "Error uploading<br />";
                        }
                    }
                    else {
                        if( move_uploaded_file($file_tmpname, $filepath)) {
                            echo "successfully uploaded <br />";
                        }
                        else {                    
                            echo "Error uploading<br />";
                        }
                    }
                }
                else {
                    echo "Error uploading {$file_name} ";
                    echo "({$file_ext} file type is not allowed)<br / >";
                }
            }
        }
        //videos upload
        if (isset($_FILES['memorial_videos']) && $_FILES['memorial_videos']['error'] === UPLOAD_ERR_OK){
            foreach ($_FILES['memorial_videos']['tmp_name'] as $key => $value) {                    
                $file_tmpname = $_FILES['memorial_videos']['tmp_name'][$key];
                $file_name = $_FILES['memorial_videos']['name'][$key];
                $file_size = $_FILES['memorial_videos']['size'][$key];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_types = array('jpg','png','jpeg');
                // Set upload file path
                $filepath = 'uploads/memorial/videos'.$file_name;
                $memorial_videos[] = $filepath;
                if(in_array(strtolower($file_ext), $allowed_types)) {                        
                    if(file_exists($filepath)) {
                        $filepath = 'uploads/memorial/videos'.time().$file_name;
                        if( move_uploaded_file($file_tmpname, $filepath)) {
                            echo "successfully uploaded <br />";
                        }
                        else {                    
                            echo "Error uploading<br />";
                        }
                    }
                    else {
                        if( move_uploaded_file($file_tmpname, $filepath)) {
                            echo "successfully uploaded <br />";
                        }
                        else {                    
                            echo "Error uploading<br />";
                        }
                    }
                }
                else {
                    echo "Error uploading {$file_name} ";
                    echo "({$file_ext} file type is not allowed)<br / >";
                }
            }
        }

       $data = array(
        'full_name' => $_POST['full_name'],
        'date_of_birth' => $_POST['date_of_birth'],
        'date_of_passing' => $_POST['date_of_passing'],
        'h_date_of_birth' => $_POST['h_date_of_passing'],
        'h_date_of_passing' => $_POST['h_date_of_passing'],
        'memorial_location' => $_POST['memorial_location'],
        'place_before_death' => $_POST['place_before_death'],
        'cause_of_death' => $_POST['cause_of_death'],
        'religion' => $_POST['religion'],
        'height' => $_POST['height'],
        'education' => $_POST['education'],
        'army_service' => $_POST['full_name'],
        'occupation' => $_POST['occupation'],
        'hobbies' => $_POST['hobbies'],
        'social_links' => $_POST['social_links'],
        'prayer' => $_POST['prayer'],
        'profile_pic' => !empty($profile_pic_name) ? $profile_pic_name : '',
        'background_image' => !empty($background_image) ? $background_image : '',
        'gallery_images' => !empty($gallery_images) ? $gallery_images : '',
        'memorial_videos' => !empty($memorial_videos) ? $memorial_videos : '',
       );
       
        $memorial = $memorial->add_memorial(3,$data);
        print_r($memorial);
        die();
        if ($memorial) {  
            echo "<script>alert('Added successfully')</script>"; 
        } else {  
            echo "<script>alert('Something went wrong')</script>";  
        }  
    }  
?>  
<!DOCTYPE html>  
 <html lang="en" class="no-js">  
 <head>  
        <meta charset="UTF-8" />  
        <title>Add Memorial</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />  
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />  
        <meta name="author" content="Codrops" />  
        <link rel="shortcut icon" href="../favicon.ico">   
        <link rel="stylesheet" type="text/css" href="css/demo.css" />  
        <link rel="stylesheet" type="text/css" href="css/style2.css" />  
        <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />  
    </head>  
    <body>  
        <div class="container">  
            <header>  
                <h1>Login and Registration Form  </h1>  
            </header>  
            <section>               
                <div id="container_demo" >                      
                    <div id="wrapper">  
                        <div id="login" class="animate form">  
                           <form name="login" method="post" action="" enctype="multipart/form-data">  
                                <h1>Log in</h1> 

                                <label for="gallery_images" class="youmail" data-icon="e" >Gallery images</label>  
                                <input type="file" name="gallery_images[]" multiple> 

                                <label for="gallery_images" class="youmail" data-icon="e" >videos</label>  
                                <input type="file" name="memorial_videos[]" multiple> 


                                <label for="emailsignup" class="youmail" data-icon="e" >Profile pic</label>  
                                <input type="file" name="profile_pic" placeholder="Profile Pic"> 
                                <label for="emailsignup" class="youmail" data-icon="e" >Background image</label>  
                                <input type="file" name="background_image" placeholder="Background image"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Full name</label>  
                                <input type="text" name="full_name"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Date of birth</label>  
                                <input type="text" name="date_of_birth"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Date of Passing</label>  
                                <input type="text" name="date_of_passing"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Hebrew Date of birth</label>  
                                <input type="text" name="h_date_of_birth"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Hebrew Date of Passing</label>  
                                <input type="text" name="h_date_of_passing"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Burial place</label>  
                                <input type="text" name="memorial_location"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Residance</label>  
                                <input type="text" name="place_before_death"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Cause of death</label>  
                                <input type="text" name="cause_of_death"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Religion</label>  
                                <input type="text" name="religion"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Height</label>  
                                <input type="text" name="height"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Education</label>  
                                <input type="text" name="education"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >militry Service</label>  
                                <input type="text" name="army_service"><br>
                                
                                <label for="emailsignup" class="youmail" data-icon="e" >Profession</label>  
                                <input type="text" name="occupation"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Hobbies</label>  
                                <input type="text" name="hobbies"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Social Links</label>  
                                <input type="text" name="social_links"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Prayer</label>  
                                <input type="text" name="prayer"><br>
                                <p class="login button">   
                                    <input type="submit" name="add_memorial" value="Add" />   
                                </p>  
                            </form>  
                        </div>  
                          
                    </div>  
                </div>    
            </section>  
        </div>  
    </body>  
</html>  