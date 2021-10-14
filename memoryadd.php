<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include_once('classes/Memoryclass.php');  
    $memory = new Memoryclass(); 

    if(isset($_POST['add_memory'])){
       //Add memory by user
       $data = array(
            'user_name' => $_POST['user_name'],
            'memory' => $_POST['memory']
        );

        $memory_add = $memory->add_memory(3 ,$data);
        print_r($memory_add);
        die();
        if ($memory_add) {  
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
        <title>Add Memory</title>  
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
                <h1>Add Memory Form</h1>  
            </header>  
            <section>               
                <div id="container_demo" >                      
                    <div id="wrapper">  
                        <div id="login" class="animate form">  
                           <form name="login" method="post" action="" enctype="multipart/form-data">                                  
                                <label for="user_name" class="youmail" data-icon="e" >Name</label>  
                                <input type="text" name="user_name"><br>

                                <label for="emailsignup" class="youmail" data-icon="e" >Memory</label>  
                                
                                <textarea id="memory" name="memory" rows="4" cols="50">
                                </textarea>
                                <p class="login button">   
                                    <input type="submit" name="add_memory" value="Add" />   
                                </p>  
                            </form>  
                        </div>  
                          
                    </div>  
                </div>    
            </section>  
        </div>  
    </body>  
</html>  