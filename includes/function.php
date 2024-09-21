<?php
if (defined("_INCODE") != 1) die("Access denail");
function layout($layoutName = 'header', $data = [])
{

    if (file_exists(_WEB_PATH_TEMPLATE . '/'.'layout/' . $layoutName . '.php')) {
        require_once _WEB_PATH_TEMPLATE . '/'. 'layout/' . $layoutName . '.php';
    }
    // require_once '/templates/layout/'. $layoutName.'.php';
}

// function insert($email='',$fullname='',$createAt=''){
//     $sql="INSERT INTO users(email,fullname,createAt) VALUE (
//     try{
//     $statement=$conn->prepara($sql);
//     $data=[
//          $email,
//          $fullname,
//          $createAt
//         ];
//         $insertState=$statement->excute($data);

//     }catch()
// }catch (Exception $exception) {
//     echo $exception->getMessage() . '<br/>';
//     echo 'File: ' . $exception->getFile() . ' - Line: ' . $exception->getLine() . '<br/>';
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($to,$subject,$content)
{

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'trinhtrangat18actvn@gmail.com';                     //SMTP username
        $mail->Password   = 'ppyfznkjyjrobvbo';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('trangchunghaha15@gmail.com', 'Mailer');
        $mail->addAddress($to);     //Add a recipient
      //  $mail->addReplyTo();
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true); 
        $mail->CharSet='UTF-8';                                 //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
       // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

       return $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
function isPost(){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        return true;
    }
    return false;
}
function isGet(){
    if($_SERVER['REQUEST_METHOD']==='GET'){
        return true;
    }
    return false;
}

//Lay gia tri phuong thuc POST, GET
function getBody(){
    $bodyArr=[];
    if (!empty($_GET)) {
        foreach ($_GET as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
                $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
            } else {
                $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }
    if (isPost()) {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $bodyArr       ; 
}

function getRow($sql){
    // Giả sử query là một hàm thực thi câu lệnh SQL và trả về PDOStatement
    $statement = query($sql, [], true);

    // Kiểm tra nếu truy vấn thành công và trả về một đối tượng PDOStatement
    if ($statement instanceof PDOStatement) {
        return $statement->rowCount(); // Trả về số lượng dòng
    }

    // Nếu không phải là PDOStatement, báo lỗi hoặc trả về 0
    return 0; // Trả về 0 nếu truy vấn thất bại hoặc không có kết quả
}

// Kiểm tra email
function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Kiểm tra số nguyên
function isNumberInt($number, $range = []) {
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }
    
    return $checkNumber;
}
// Kiểm tra số thực
function isNumberFloat($number, $range = []) {
    if (!empty($range)) {
        $options = ['options' => $range];
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT, $options);
    } else {
        $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    }
    
    return $checkNumber;
}

//Kiem  tra so diewn thoai
function isPhone($phone){
    $checkFirst=false;
    if($phone[0]=='0')
    {
        $checkFirst=true;
        $phone=substr($phone,1);
    }

    $checkLast=false;
    if(isNumberInt($phone)&&strlen(($phone)>6))
    {
        $checkLast=true;
    }
    if($checkFirst && $checkLast)
    {
        return true;
    }
    return false;

}
// Hàm tạo thông báo
function getMsg($msg, $type = 'success') {
    if (!empty($msg)) {
        // Sử dụng htmlspecialchars để tránh XSS tấn công
    
        echo '<div  class="alert alert-'.$type.'">';
        echo $msg;
        echo '</div>';
      
    }
}
function redirect($path='index.php'){
    header("Location: $path");
    exit();
}
// Kiểm tra trạng thái đăng nhập
function isLogin() {
    $checkLogin = false;
    $tokenLogin = getSession('loginToken');
    
    if ($tokenLogin) {
        $queryToken = firstRaw("SELECT userId FROM login_token WHERE token = '$tokenLogin'");
        
        if (!empty($queryToken)) {
            $checkLogin = $queryToken;
        } else {
            removeSession('loginToken');
        }
    }

    return $checkLogin;
}

//Auto delete token
function autoRemoveTokenLogin(){
    $allUsers = getRaw("SELECT * FROM user WHERE status=1");

    if (!empty($allUsers)) {
        foreach ($allUsers as $user) {
            $now = date('Y-m-d H:i:s');
            $before = $user['lastActivity'];

            $diff = strtotime($now) - strtotime($before);
            $diff = floor($diff / 60);
            
            if ($diff >= 1) {
                delete('login_token', "userId=" . $user['id']);

                // Nếu người dùng hiện tại bị xóa token, hủy session và redirect về trang đăng nhập
                if ($user['id'] == isLogin()['userId']) {
                    // session_destroy();
                   redirect('?module=auth&action=login'); // Redirect đến trang đăng nhập
                    exit();
                }
            }
           
        }
    }
}

// Lưu lại thời gian cuối cùng hoạt động
function saveActivity(){
    // Lấy ID của user hiện tại
    $userId = isLogin()['userId'];
  
    // Cập nhật thời gian hoạt động cuối cùng của user trong bảng users
    update('user', ['lastActivity' => date('Y-m-d H:i:s')], "id=$userId");
}
