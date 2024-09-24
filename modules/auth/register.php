<?php
// Kiểm tra xem hằng số _INCODE đã được định nghĩa chưa
// echo _INCODE;
if (defined('_INCODE') != 1) {
    die('Access Denied');
}
// Không bao giờ đạt đến dòng này vì die() đã dừng thực thi mã
$data = [
    'pageTitle' => 'System Register'
];



layout('header-login', $data);

if (isPost()) {
    //validate form
    $body = getBody(); //Lay tat ca du lieu cua form

   
    $errors = [];

    //validate name : bat buoc nhap >=5 character

    if (empty(trim(($body['fullname'])))) {
        $errors['fullname']['required'] = 'full name is required ';
    } else {
        if (strlen(trim($body['fullname'])) < 5) {
            $errors['fullname']['min'] = 'Ho ten phai >=5 ky tu';
        }
    }

    //Validate number phone
    if (empty(trim($body['phonenumber']))) {
        $errors['phonenumber']['required'] = 'Số điện thoại không được bỏ trống';
    } else {
        if (!isPhone(trim($body['phonenumber']))) {
            $errors['phonenumber']['isPhone'] = 'Số điện thoại không hợp lê';
        }
    }

    //validate email
    if (empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email không được để rỗng';
    } else {
        if (!isEmail(trim($body['email']))) {
            $errors['email']['isEmail'] = 'Email không hợp lệ';
        } else {
            //Kiem tra email da ton tai trong data base chua
            $email = trim($body['email']);
            $sql = "SELECT id FROM user WHERE email='$email'";
            if (getRow($sql) > 0) {
                $errors['email']['unique'] = 'Địa chỉ email đã tồn tại';
            }
        }
    }

    if (empty(trim($body['password']))) {
        $errors['password']['required'] = 'Không được bỏ trống';
    } else {
        if (strlen(trim($body['password'])) < 8) {
            $errors['password']['min'] = 'Chưa nhập đủ kí tự';
        }
    }


    //Validate nhập lại mật khẩu: Bắt buộc phải nhập, giống trường mật khẩu
    if (empty(trim($body['confirmpassword']))) {
        $errors['confirmpassword']['required'] = 'Xác nhận mật khẩu không được để trống';
    } else {
        if (trim($body['password']) !== trim($body['confirmpassword'])) {
            $errors['confirmpassword']['match'] = 'Hai mật khẩu không khớp';
        }
    }

    if (empty($errors)) {
        setFlashData('msg', 'You have login successfull');
        setFlashData('msg_type', 'success');
        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'email' => $body['email'],
            'fullname' => $body['fullname'],
            'phone' => $body['phonenumber'],
            'password' => password_hash($body['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'createAt' => date('Y-m-d H:i:s'),
        ];
        $insertStatus = insert('user', $dataInsert);


        if ($insertStatus) {
            // Tạo link kích hoạt
            $linkActive = _WEB_HOST_ROOT.'?module=auth&action=active&token='. $activeToken;

            // Thiết lập nội dung email
            $subject = $body['fullname'] . ' vui lòng kích hoạt tài khoản';
            $content = 'Chào bạn: ' . $body['fullname'] . ',<br/>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản:'. $linkActive ;
            $content .= 'Trân trọng!';

            // Tiến hành gửi email
            $sendStatus = sendMail($body['email'], $content, $subject);

            // Kiểm tra trạng thái gửi email
            if ($sendStatus) {
                setFlashData('msg', 'Đăng ký tài khoản thành công. Vui lòng kiểm tra email để kích hoạt tài khoản.');
                setFlashData('msg_type', 'success');
            } else {
                setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
                setFlashData('msg_type', 'danger');
            }
        } else {
            setFlashData('msg', 'Hệ thống đang gặp sự cố! Vui lòng thử lại sau.');
            setFlashData('msg_type', 'danger');
        }

        var_dump($insertStatus);
        //    redirect('?module=auth&action=login');
    } else {
        setFlashData('msg', 'Please re-enter information');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('content', $body);
        // redirect('?module=auth&action=register');
    }
    // echo '<pre>';
    // print_r($errors);
    // echo '</pre>';

   
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$msg_error = getFlashData('errors');
$content = getFlashData('content');

?>


<div class="login-form">
    <h2 class="title">Đăng Nhập</h2>
    <?php

    getMsg($msg, $msg_type);

    ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="fullname">Full name</label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full name" required value=<?php echo empty($content['fullname']) || !empty($errors['fullname']) ? '' : $content['fullname']; ?>>
            <?php
            echo (!empty($errors['fullname'])) ? '<span class="errors">' . reset($errors['fullname']) . '</span>' : '';
            ?>
        </div>
        <div class="form-group">
            <label for="Phone number">Phone number</label>
            <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="Phone number" required value=<?php echo empty($content['phonenumber']) || !empty($errors['phonenumber']) ? '' : $content['phonenumber']; ?>>
            <?php
            echo (!empty($errors['phonenumber'])) ? '<span class="errors">' . reset($errors['phonenumber']) . '</span>' : '';
            ?>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email" required value=<?php echo empty($content['email']) || !empty($errors['email']) ? '' : $content['email']; ?>>
            <?php
            echo (!empty($errors['email'])) ? '<span class="errors">' . reset($errors['email']) . '</span>' : '';
            ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required value=<?php echo empty($content['password']) || !empty($errors['password']) ? '' : $content['password']; ?>>
            <?php
            echo (!empty($errors['password'])) ? '<span class="errors">' . reset($errors['password']) . '</span>' : '';
            ?>
        </div>
        <div class="form-group">
            <label for="confirmpassword">Comfirm password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Comfirm password" required value=<?php echo empty($content['confirmpassword']) || !empty($errors['confirmpassword']) ? '' : $content['confirmpassword']; ?>>
            <?php
            echo (!empty($errors['confirmpassword'])) ? '<span class="errors">' . reset($errors['confirmpassword']) . '</span>' : '';
            ?>
        </div>
        <button type="submit">Sign In </button>
        <div class="link">
            <p><a href="?module=auth&action=login">Login</a></p>

        </div>
    </form>

    <?php
    // Sửa dấu gạch ngược thành dấu gạch chéo trong đường dẫn

    layout('footer-login', $data);
