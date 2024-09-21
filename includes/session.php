<?php
if(defined("_INCODE")!=1) die("Access denail");
function setSession($key,$value){
    if(!empty(session_id())){
     $_SESSION[$key]=$value;
  
    }
 
}

// Hàm đọc session
function getSession($key = '') {
    if (empty($key)) {
        return $_SESSION;
    } else {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    return false;
}

// Hàm xoá session
function removeSession($key = '') {
    if (empty($key)) {
        session_destroy();
        return true;
    } else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }

    return false;
}
// Hàm gán flash data
function setFlashData($key, $value) {
    // Thêm tiền tố 'flash_' vào khóa để phân biệt với các session thông thường
    $key = 'flash_' . $key;
    
    // Gọi hàm setSession để lưu flash data vào session
    return setSession($key, $value);
}

// Hàm đọc flash data
function getFlashData($key) {
    // Thêm tiền tố 'flash_' vào khóa để lấy đúng flash data
    $key = 'flash_' . $key;
    
    // Lấy giá trị của flash data từ session
    $data = getSession($key);
    
    // Xóa flash data sau khi lấy để nó chỉ tồn tại trong một lần request
    removeSession($key);
    
    // Trả về giá trị flash data
    return $data;
}
