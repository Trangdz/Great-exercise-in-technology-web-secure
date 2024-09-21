<?php
// Kiểm tra xem hằng số _INCODE đã được định nghĩa chưa
// echo _INCODE;
if (defined('_INCODE') != 1) {
    die('Access Denied');
}

if(isLogin())
{
    echo"jjaj";
    $token=getSession('loginToken');
    delete('login_token',"token='$token'");
    removeSession('loginToken');
    redirect('?module=auth&action=login');
}
echo "kkk";
