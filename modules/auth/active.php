<?php
if (!defined('_INCODE') == 1) die('Access deined...');

layout('header-login');
$token = getBody();
var_dump(!empty($token['token']));
if (!empty($token['token'])) {
    $tk=$token['token'];
    echo $tk;
    $tokenQuery = firstRaw("SELECT id,fullname,email FROM user WHERE activeToken = '$tk'");
    var_dump(!empty($tokenQuery));
    if (!empty($tokenQuery)) {
        $userId = $tokenQuery['id'];
        $dataUpdate = [
            'status' => 1,
            'activeToken' => null
        ];
        $updateStatus = update('user', $dataUpdate, "id=$userId");
        if ($updateStatus) {
            setFlashData('msg', 'Account activation successful! You can log in now');
            setFlashData('msg_type', 'success');

            //Send mail if activation successfull
            $loginLink=_WEB_HOST_ROOT."/index.php?module=auth&action=login";
            $subject="Actived success";
            $content="congratulation, You have login success</br>"."You can login according to the: "."$loginLink";
            sendMail($tokenQuery['email'],$subject,$content);
            redirect('?module=auth&action=login');
        } else {
            setFlashData('msg', 'Account activation failed!');
            setFlashData('msg_type', 'danger');
        }
    } else {
        getMsg('Associate no exist or expired', 'danger');
    }

} else {
    getMsg('Associate no exist or expired', 'danger');
}

layout('header-footer');
