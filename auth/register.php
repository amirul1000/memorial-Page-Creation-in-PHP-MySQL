<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../config.php");

$username = "";
$email    = "";
$password    = "";
$address    = "";
$errors = array(); 
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  
  $user_check_query = "SELECT * FROM users WHERE full_name='$username' OR email='$email' LIMIT 1";

  $result = mysqli_query($conn, $user_check_query);

  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['full_name'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  
  	$password = md5($password);
  	$query = "INSERT INTO users (full_name, email, password,address) 
  			  VALUES('$username', '$email', '$password','$address')";
  	mysqli_query($conn, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
}

// ...