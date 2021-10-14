<?php
require('./global.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";
class Authclass {
    private $db;
    function __construct() {
        $conn = dbconnect();
        $this->db = $conn; 
    }
    //user Login
    public function login($email, $password){
		session_start(); 
        $data = [];
        $pass = $password;//md5($password);
        $check_query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
        $result = mysqli_query($this->db, $check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user){ 
            $_SESSION['loggedin'] = true;
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $user['full_name'];
            $data = array(
                'success' => true,
                'message' => 'התחברות בוצעה בהצלחה!'
            );
            return json_encode($data);
        }  
        else{  
            $data = array(
                'success' => false,
                'message' => 'שם משתמש או סיסמה אינם נכונים'
            );
            return json_encode($data);
        }  
    }
    //Registration
    public function register ($post_data){
		$data = [];
        $full_name = "";
        $email = "";
        $phone_number = "";
        $city = "";
        $house_no = "";
        $apartment = "";
        $street = "";
        if (!empty($post_data)) {
            extract($post_data);
            $full_name = mysqli_real_escape_string($this->db, $full_name);
            $email = mysqli_real_escape_string($this->db, $email);
            $phone_number = mysqli_real_escape_string($this->db, $phone_number);
            $house_no = mysqli_real_escape_string($this->db, $house_no);
            $street = mysqli_real_escape_string($this->db, $street);
            $apartment = mysqli_real_escape_string($this->db, $apartment);
            $city = mysqli_real_escape_string($this->db, $city);
			$payment_status = 'not paid';
            $password = generate_random_string();
            $enc_password = $password;
            $check_email_exists = get_user_by_email($email);

            if($check_email_exists){
				$data = array(
					'success' => false,
					'message' => 'כתובת מייל כבר קיימת'
				);
                return json_encode($data);
            }

            $query = "INSERT INTO users (`full_name`, `email`, `password`,`phone_number`,`city`,`house_no`,`apartment`,`street`,`payment_status`) 
                    VALUES('$full_name', '$email', '$enc_password','$phone_number','$city','$house_no','$apartment','$street','$payment_status')";
            $insert = mysqli_query($this->db, $query);
            
            if($insert){
                $insert_id = mysqli_insert_id($this->db);
                $send_mail =  $this->send_mail($email,$password);
                if($send_mail){
					$data = array(
						'success' => true,
						'message' => 'מייל נשלח בהצלחה'
					);
					return json_encode($data);
                }
                else{
                    $data = array(
						'success' => false,
						'message' => 'מייל לא נשלח בהצלחה'
					);
					return json_encode($data);
                }
            }
            else{
                $data = array(
					'success' => false,
					'message' => 'אופס..משהו לא עובד'
				);
                return json_encode($data);
            }
        } 
    }
    // Forget password
    public function forget_password($email){
        $data = [];
        if(empty($email)){
            $data = array(
                'success' => false,
                'message' => 'שדה אימייל לא יכול להיות ריק'
            );
            return json_encode($data);
        }
        $check_user = get_user_by_email($email);
        if(! $check_user){
            $data = array(
                'success' => false,
                'message' => 'משתמש לא נמצא'
            );
            return json_encode($data);
        }
        if($check_user && !empty($check_user['email']) && $check_user['payment_status'] == 'paid'){
            $new_password = generate_random_string();
            $send_mail =  $this->send_mail($email,$new_password);
            if($send_mail){
                $pass_to_store = md5($new_password);
                $query = "UPDATE users SET password = '$pass_to_store' WHERE id = '$check_user[id]'";
                $update = mysqli_query($this->db, $query);
                if($update){
                    $data = array(
                        'success' => true,
                        'message' => 'הסיסמה שוחזרה בהצלחה. בדוק את האימייל שלך להמשך.'
                    );
                    return json_encode($data);
                }                
            }
            else{
                $data = array(
                    'success' => false,
                    'message' => 'מייל לא נמצא במערכת'
                );
                return json_encode($data);
            }
        }
        else{
            $data = array(
                'success' => false,
                'message' => 'לא התבצע תשלום...'
            );
            return json_encode($data);
        }
    }
    //send mail to user
    public function send_mail($email,$pass){
        $mail = new PHPMailer;
        $mail->isSMTP();                      // Set mailer to use SMTP 
        $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;               // Enable SMTP authentication 
        $mail->Username = '';   // SMTP username 
        $mail->Password = '';   // SMTP password 
        $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
        $mail->Port = 587; 
        $mail->From = "";
        $mail->FromName = "Development";
        $mail->addAddress($email, '');
        $mail->isHTML(true);
        $mail->Subject = "Welcome to Nizkor";
        $mail->Body .= "Here are your login details:<br>";
        $mail->Body .= "<b>Email</b>:".$email.'<br>';
        $mail->Body .= "<b>Password</b>:".$pass;
        $mail->AltBody = "Sent by Nizkor";
        try {
            $mail->send();
            return "Message has been sent successfully";
        } catch (Exception $e) {
            return "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}  
