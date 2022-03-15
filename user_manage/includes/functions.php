<?php
if (!defined('_INCODE')) die('access deined...');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function layout($layoutName = 'head', $dataTitle = []) {
    if(file_exists(_WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php')) {
        require_once _WEB_PATH_TEMPLATE.'/layout/'.$layoutName.'.php';
    }
}
function sendMail($to, $subject, $message) {
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com'; //                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'lexuanquynh0123@gmail.com';                     //SMTP username
    $mail->Password   = 'vbjefissiarqxoaa';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('lexuanquynh0123@gmail.com', 'quynh dz');
    $mail->addAddress($to);     //Add a recipient
               
    

    //Content
    $mail->isHTML(true); 
    $mail->CharSet = 'UTF-8';                                 
    $mail->Subject = $subject;
    $mail->Body    = $message;

   $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
    );

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
// lọc dữ liệu đầu vào 
function isPost() { // kiểm tra phương thưcs post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}
function isGet() { // kieemr ta phương thúc gét
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}
// lấy giá trị pthuc POST 
function getBody() {
    $bodyArray = [];
    if (isGet()) {
        if (!empty($_GET)) {
            forEach($_GET as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $bodyArray[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY); 
                } else {
                    $bodyArray[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS); 
                }
            }
        } 
    } 


    if (isPost()) {
        if (!empty($_POST)) {
            forEach($_POST as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                   $bodyArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY); 
                } else {
                   $bodyArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                   
                }
            }
        }  
    }
    return $bodyArray;
} 
// kiem tra email
function isEmail($email) {
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}
// kiem tra so nguyen
function isNumber($number, $range = []) {
    
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNUmber = filter_var($number, FILTER_VALIDATE_INT,  $options);

    } else {
        $checkNUmber = filter_var($number, FILTER_VALIDATE_INT);
    }
    return $checkNUmber;

}
function isNumberFloat($number, $range = []) {
    
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNUmber = filter_var($number, FILTER_VALIDATE_FLOAT,  $options);

    } else {
        $checkNUmber = filter_var($number, FILTER_VALIDATE_FLOAT);
    }
    return $checkNUmber;

}
// kiem tra sdt (0123456789);

function isPhone($phone) {
    $checkFirstZero = false;
    if ($phone[0] == '0') {
       $checkFirstZero = true;
       $phone  = substr($phone, 1); // xoá phần tử phone 0;

    }
    $checkNUmberLast = false;
    if (isNumber($phone) && strlen(trim($phone)) == 9) {
        $checkNUmberLast = true;
    }
    if ($checkFirstZero && $checkNUmberLast) {
        return true;
    }

    return false;

}

// hàm thông báo
function getMsg($msg, $type = 'success') {
    if (!empty($msg)) {
        echo '<div class="alert alert-'.$type.'">';
        echo $msg;
        echo '</div>';
    }

}

// hàm chuển hướng 
function redirect($path ='index.php') {
   header("Location: $path");
   exit;
}
// hamf thông báo lỗi
function form_error($fileName, $error, $beforeHtml= '', $afterHtml= '') {
   return  (!empty($error[$fileName]))? $beforeHtml.reset($error[$fileName]).$afterHtml : null;
}
function old($fileName, $oldData, $default='') {
    return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
}

