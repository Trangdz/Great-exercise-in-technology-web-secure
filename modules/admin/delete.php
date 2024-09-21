<?php

if (!defined('_INCODE') == 1) {
    die('Access denied');
}

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

$body=getBody();
$userId=$body['id'];
var_dump($body);
//Examine Do it have exist?
$getInfor=firstRaw("SELECT * FROM user WHERE id='$userId'");
var_dump($getInfor);
if(!empty($getInfor))
{
    $deteteToken=delete('login_token',"id=$userId");
    if($deteteToken)
    {
        $deteteUser=delete('user',"id=$userId");
        if( $deteteUser)
        {
            setFlashData('msg','Deleted user successfull');
            setFlashData('msg_type','success');
        }
        else{
            setFlashData('msg','The system is having problems');
            setFlashData('msg_type','danger');
        }
    }
    else{
        setFlashData('msg','The system is having problems');
            setFlashData('msg_type','danger');
    }
    
}
else
{
    setFlashData('msg','User no exist on the system');
            setFlashData('msg_type','danger');
}
redirect('?module=users&action=list');
echo "dan vao";
?>