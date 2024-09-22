<?php
// File này chứa các hằng số cấu hình
date_default_timezone_set('Asia/Ho_Chi_Minh');


const _MODULE_DEFAULT = 'home';
const _ACTION_DEFAULT = 'list';
const _INCODE = true;

// Establish host
define('_WEB_HOST_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/baitaplon/index.php');
define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/templates');

// Establish paths
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/templates');

// Thông tin kết nối đến cơ sở dữ liệu
const _HOST = 'localhost';           // Địa chỉ máy chủ (localhost cho máy cục bộ)
const _USER = 'root';                // Tên người dùng MySQL
const _PASS = '';               // Mật khẩu của người dùng (Xampp có thể để trống)
const _DB = 'phponline';             // Tên cơ sở dữ liệu
const _DRIVER = 'mysql';             // Loại cơ sở dữ liệu