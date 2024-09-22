<?php
// Kiểm tra xem hằng số _INCODE đã được định nghĩa chưa
// echo _INCODE;


if (defined('_INCODE') != 1) {
    die('Access Denied');
}
// Không bao giờ đạt đến dòng này vì die() đã dừng thực thi mã
$data = [
    'pageTitle' => 'System Login'
];

if (isLogin()) {
    // redirect('?module=users');
}

if (isPost()) {
  
    $body = getBody();
    $email=$body['email'];
    $password=$body['password'];
 
    if (!empty($email) && !empty($password)) {
        //Check login
      
       
        //Query take inform fllowing email
        $userQuery = firstRaw("SELECT id, password,role FROM user WHERE email ='$email' AND status=1");
        var_dump($userQuery);
        //  var_dump($userQuery);
        if (!empty($userQuery)) {
            $passwordHash = $userQuery['password'];
            $userId = $userQuery['id'];
            $role=$userQuery['role'];

            if (password_verify($password, $passwordHash)) {
                //Create token login
                $tokenLogin = sha1(uniqid() . time());

                //Insert data into table
                $dataToken = [
                    'userId' => $userId,
                    'token' => $tokenLogin,
                    'createAt' => date('Y-m-d H:i:s')
                ];
              
                $insertTokenStatus = insert('login_token', $dataToken);
               
                // var_dump($insertTokenStatus);
                if ($insertTokenStatus) {
                    //Isert token success

                    //Save token_login into session
                    // setSession('loginToken', $tokenLogin);
                    $_SESSION['loginToken']=$tokenLogin;
                    saveActivity();
                    //Redirection across manager page
                   
                    var_dump($role);
                    $_SESSION['role']=$role;
                    if($role==='1')
                    {
                       
                        header("Location:/baitaplon/modules/admin/index.php");
                    }
                    else
                    {
                        header("Location: /baitaplon/modules/user/index.php");
                    }
                  
                //    echo $_SESSION['loginToken'];
                //    echo "Da co session";
                } else {
                    setFlashData('msg', "Errors system , You can't login");
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', "Password no correct");
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', "Please , re-enter email and password or no yet activeted");
            setFlashData('msg_type', 'danger');
        }
    }
     //redirect('?module=users&action=login');
}


layout('header-login', $data);

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<?php

?>
<div class="login-form">
    <h2 class="title">Đăng Nhập</h2>
    <?php
    getMsg($msg, $msg_type);
    ?>
    <form action="" method="post" >
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name ='email' class="form-control" placeholder="Nhập email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name='password' class="form-control" placeholder="Nhập mật khẩu" required>
        </div>
        <button type="submit">Đăng Nhập</button>
        <div class="link">
            <p><a href="?module=auth&action=forgot">Quên mật khẩu?</a></p>
            <p>Chưa có tài khoản? <a href="?module=auth&action=register">Đăng ký ngay</a></p>
        </div>
    </form>
</div>
<!-- <div class="registration-form">
        <h2 class="title">Đăng Ký</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <br/>
                <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <br/>
                <input type="email" id="email" class="form-control" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <br/>
                <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Nhập lại mật khẩu</label>
                <br/>
                <input type="password" id="confirm-password" class="form-control" placeholder="Nhập lại mật khẩu" required>
            </div>
            <button type="submit">Đăng Ký</button>
            <div class="link">
                <p><a href="?module=auth&action=login">Đăng nhập tại đây</a></p>
                <p><a href="?module=auth&action=forgot">Forgot pass</a></p>
            </div>
        </form>
    </div> -->
<?php
// Sửa dấu gạch ngược thành dấu gạch chéo trong đường dẫn

layout('footer-login', $data);
