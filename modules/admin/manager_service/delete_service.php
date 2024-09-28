<?php

if (!defined('_INCODE') == 1) {
    die('Access denied');
}

// Kiểm tra đăng nhập
// if (!isLogin()) {
//     header("Location:/baitaplon/modules/auth/login.php");
//     exit();
// }
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
$body = getBody();
$serviceId = $body['id'];

//Examine Do it have exist?
$getInfor = firstRaw("SELECT * FROM dichvutiemchung WHERE id='$serviceId'");

if (!empty($getInfor)) {
    $deteteService = delete('dichvutiemchung', "id=$serviceId");
    if ($deteteService) {
        setFlashData('msg', 'Deleted service successfull');
        setFlashData('msg_type', 'success');
    } else {
        setFlashData('msg', 'The system is having problems');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg','Service no exist on the system');
    setFlashData('msg_type','danger');
}
header("Location:\baitaplon\modules\admin\manager_service\manage_service.php");
echo "hahah";


     