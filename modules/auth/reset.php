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
layout('header-login', $data);

$token = getBody()['token'];
if (!empty($token)) {
    $tokenQuery = firstRaw("SELECT id, fullname ,email FROM user WHERE forgotToken='$token'");
    echo "hahah";
    if (!empty($tokenQuery)) {
        $userId = $tokenQuery['id'];
        echo "kjjjk";
        $check=isPost();
        echo $_SERVER['REQUEST_METHOD'];
        echo $check;
        // echo $_POST['password'];
        if (isPost()) {
            $body = getBody();
            $password=$body['password'];
            $comfirmpassword=$body['comfirmpassword'];
            $errors = [];
            echo "babab";
            if (empty(trim($body['password']))) {
                $errors['password']['required'] = 'Không được bỏ trống';
            } else {
                if (strlen(trim($body['password'])) < 8) {
                    $errors['password']['min'] = 'Chưa nhập đủ kí tự';
                }
            }


            //Validate nhập lại mật khẩu: Bắt buộc phải nhập, giống trường mật khẩu
            // if (empty(trim($password))) {
            //     $errors['password']['required'] = 'Xác nhận mật khẩu không được để trống';
            // } else {
            //     if (trim($password) !== trim($comfirmpassword)) {
            //         $errors['confirmpassword']['match'] = 'Hai mật khẩu không khớp';
            //     }
            // }
            if (empty(trim($body['password']))) {
                $errors['password']['required'] = 'Xác nhận mật khẩu không được để trống';
            } else {
                if (trim($body['password']) !== trim($body['comfirmpassword'])) {
                    $errors['confirmpassword']['match'] = 'Hai mật khẩu không khớp';
                }
            }
            var_dump($errors);
            if (empty($errors)) {

                $passwordHash = password_hash($body['password'], PASSWORD_DEFAULT);
                $dataUpdate = [

                    'password' => $passwordHash,
                    'forgotToken' => null,
                    'createAt' => date('Y-m-d H:i:s'),
                ];
                $updateStatus = update('user', $dataUpdate, "id='$userId'");
                var_dump($updateStatus);
                if ($updateStatus) {
                    setFlashData('msg', 'Changed password succesfull');
                    setFlashData('msg_type', 'success');
                    $content = 'You have changed password successfull of account: ' . $tokenQuery['email'];
                    $subject = 'congralutation ' . $tokenQuery['fullname'];
                    $statusMail = sendMail($tokenQuery['email'], $content, $subject);
                    redirect('?module=auth&action=login');
                } else {
                    setFlashData('msg', 'Error system');
                    setFlashData('msg_type', 'danger');
                    redirect('?module=auth&action=reset&token=' . $token);
                }
            } else {
                setFlashData('msg', 'Please re-enter information');
                setFlashData('msg_type', 'danger');
                setFlashData('errors', $errors);

                redirect('?module=auth&action=reset&token=' . $token);
            }
        }
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
?>
        <div class="login-form">
            <h2 class="title">UPDATE PASSWORD</h2>
            <?php
                getMsg($msg, $msg_type);
            ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name='email' class="form-control" placeholder="Enter password" required value=<?php echo $tokenQuery['email'] ?> disabled>
                </div>
                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="text" name="password" id="password" class="form-control" placeholder="password" required>
                    <?php
                    echo (!empty($errors['password'])) ? '<span class="errors">' . reset($errors['password']) . '</span>' : '';
                    ?>
                </div>
                <div class="form-group">
                    <label for="comfirmpassword">Comfirm password</label>
                    <input type="text" name="comfirmpassword" id="comfirmpassword" class="form-control" placeholder="comfirmpassword" required>
                    <?php
                    echo (!empty($errors['comfirmpassword'])) ? '<span class="errors">' . reset($errors['comfirmpassword']) . '</span>' : '';
                    ?>
                </div>
                <button type="submit">Change</button>
                <input type="hidden" name="token" value="<?php echo $token ;?>">
                <div class="link">
                    <p><a href="?module=auth&action=login">Login</a></p>
                    <p>Chưa có tài khoản? <a href="?module=auth&action=register">Sign in</a></p>
                </div>
            </form>
        </div>
<?php
    }
}
layout('footer-login', $data);
?>