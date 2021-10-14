<?php  
require('./global.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

class Paymentclass {
    private $db;
    function __construct() {
        $conn = dbconnect();
        $this->db = $conn; 
    }
    //Add memory
    public function validate_payment($user_data,$status){
        $user = new Authclass();
        if(!empty($user_data) && $status == 'success'){
            $user_data['payment_status'] = 'paid';
            $register = $user->register($user_data);
            if($register){
                $sendemail = $this->send_payment_status_email($user_data['email'],$status);
                return true;
            }
            else{
                return false;
            }
        }
        if(!empty($user_data) && $status == 'fail'){
            $sendemail = $this->send_payment_status_email($user_data['email'],$status);
            return false;
        }
    }

    public function send_payment_status_email($user,$status){
        $mail = new PHPMailer;
        $mail->isSMTP();      
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'saurabhnakoti.geektech@gmail.com';
        $mail->Password = 'htmmerexybbtuyqq';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; 
        $mail->From = "development.geeektech@gmail.com";
        $mail->FromName = "Development";
        $mail->addAddress($user['email'], $user['full_name']);
        $mail->isHTML(true);

        if($status == 'success'){
            $email = $user['email'];
           
            $mail->Subject = "Welcome to Nizkor";
            $mail->Body = "Your payment was successfull. Noow you can login to you account";
            $mail->AltBody = "Sent by Nizkor";
            try {
                $mail->send();
                return "Message has been sent successfully";
            } catch (Exception $e) {
                return "Mailer Error: " . $mail->ErrorInfo;
            }
        }
        if($status == 'fail'){
            $mail->Subject = "Payment was failed";
            $mail->Body = "Your payment was failed. Please try again.";
            $mail->AltBody = "Sent by Nizkor";
            try {
                $mail->send();
                return "Message has been sent successfully";
            } catch (Exception $e) {
                return "Mailer Error: " . $mail->ErrorInfo;
            }
        }
        
    }
}  
?>