<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once('classes/Authclass.php');  
    $auth = new Authclass(); 

    if(isset($_POST['add_memorial'])){  
        $email = $_POST['email'];  
        $password = $_POST['password'];  
        $user = $auth->login($email, $password); 
        if ($user) {  
            echo "<script>alert('Logged in successfully')</script>"; 
        } else {  
            echo "<script>alert('Emailid / Password Not Match')</script>";  
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
                           <form name="login" method="post" action="">  
                                <h1>Log in</h1> 
                                <label for="emailsignup" class="youmail" data-icon="e" >Profile pic</label>  
                                <input type="file" name="profile_pic" placeholder="Profile Pic"> 
                                <label for="emailsignup" class="youmail" data-icon="e" >Background image</label>  
                                <input type="file" name="background_image" placeholder="Background image"> 
                                <p>    
                                   <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>  
                                    <input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>  
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />   
                                </p>  
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