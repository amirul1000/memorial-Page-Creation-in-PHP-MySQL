<?php
require('./config.php');
$db = dbconnect();
function get_user_by_user_id($user_id){
    global $db;
    $user_check_query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        return $user;
    }
    else{
        return false;
    }
}
function get_user_by_email($email){
    global $db;
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if($user){
        return $user;
    }
    else{
        return false;
    }
}
function get_memorial_by_id($id){
    global $db;
    $memorial_query = "SELECT * FROM memorial_details WHERE id='$id' LIMIT 1";
    $result = mysqli_query($db, $memorial_query);
    $memorial = mysqli_fetch_assoc($result);
    if($memorial){
        return $memorial;
    }
    else{
        return false;
    }
}

//Check required fields are empty
function nizkor_validate_fields($required_fields,$data){
    foreach($required_fields as $field) {
        if (empty($data[$field])) {
            return 'dhedh';
            $error = $data[$field].' can not be empty';            
        }
        else{
            $error = false;
        }        
    }
    return $error;
}
//Generate randon string
function generate_random_string() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
