<?php
// Kiểm tra xem hằng số _INCODE đã được định nghĩa chưa
// echo _INCODE;
if (defined('_INCODE') != 1) {
    die('Access Denied');
}
// Không bao giờ đạt đến dòng này vì die() đã dừng thực thi mã
$data = [
    'pageTitle' => 'Reset password'
];



if (isLogin()) {
    redirect('?module=users');
}

if (isPost()) {

    $body = getBody();


    if (!empty($body['email'])) {
        $email = $body['email'];
        $queryUser = firstRaw("SELECT id FROM user WHERE email='$email'");
        if (!empty($queryUser)) {
            $userId = $queryUser['id'];
            $forgotToken = sha1(uniqid() . time());
            $dataUpdate = [
                'forgotToken' => $forgotToken,
            ];
            $dataUpdateStatus = update('user', $dataUpdate, "id='$userId'");

            if ($dataUpdateStatus) {
                $loginLink = _WEB_HOST_ROOT.'?module=auth&action=reset&token='.$forgotToken;
                $subject = 'Require restore password';
                $content = "Hello" . $email;
                $content .= "We receive required restore password from you.Please clcik at link follow to restore: " . $loginLink;
                $sendStatus = sendMail($email, $subject, $content);
                if ($sendStatus) {
                    setFlashData('msg', 'Please check email to see instruction');
                    setFlashData('msg_type', 'success');
                } else {
                    setFlashData('msg', 'Errors system');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Errors system!');
                setFlashData('msg_type', 'danger');
            };
        } else {
            setFlashData('msg', 'Address email no exist');
            setFlashData('msg_type', 'danger');
        }
        die();
    } else {
        setFlashData('msg', 'Please enter email address');
        setFlashData('msg_type', 'danger');
    }
    redirect('?module=auth&action=forgot');
}

layout('header-login', $data);
$msg = getFlashData('msg');
$msg = getFlashData('msg_type');
?>
<div class="login-form">
    <h2 class="title">RESET PASSWORD</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name='email' class="form-control" placeholder="Nhập email" required>
        </div>

        <button type="submit">Verify</button>
        <div class="link">
            <p><a href="?module=auth&action=login">Login</a></p>
            <p>Chưa có tài khoản? <a href="?module=auth&action=register">Sign in</a></p>
        </div>
    </form>
</div>

<?php
// Sửa dấu gạch ngược thành dấu gạch chéo trong đường dẫn

layout('footer-login', $data);
