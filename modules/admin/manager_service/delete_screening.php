<?php

if (!defined('_INCODE') == 1) {
    die('Access denied');
}

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

$body = getBody();
$Id_phieu_kham = $body['id'];
var_dump($body);
//Examine Do it have exist?
$getInfor = firstRaw("SELECT * FROM phiemkhamsangloc WHERE id='$Id_phieu_kham'");
var_dump($getInfor);

if (!empty($getInfor)) {
    $xoa_phieu=delete('phieukhamsangloc',"id=$Id_phieu_kham");
    if ($xoa_phieu) {
        setFlashData('msg', 'Bạn đã xóa thành công');
        setFlashData('msg_type', 'success');
    }
    else
    {
        setFlashData('msg', 'Bạn xóa thất bại');
        setFlashData('msg_type', 'danger');
    }
} else {
    setFlashData('msg', ' Phiếu không tồn tại trên hệ thống');
    setFlashData('msg_type', 'danger');
}
redirect('D:\xampp\htdocs\baitaplon\modules\admin\index.php?page_web=manager_service&action_page=manage_screening');
echo "dan vao";
