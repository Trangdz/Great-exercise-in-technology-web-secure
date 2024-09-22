<?php
session_start();
if($_SESSION['role']!=='1')
{
  header('Location:/baitaplon/modules/auth/login.php');
}


// Yêu cầu các tệp cần thiết với đường dẫn chính xác, sử dụng __DIR__ để lấy đường dẫn tuyệt đối
require_once('D:\xampp\htdocs\baitaplon\config.php'); 
require_once(__DIR__ . '/../../../baitaplon/database/database.php');
require_once(__DIR__ . '/../../../baitaplon/database/connect_auth.php');
require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/Exception.php');
require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/PHPMailer.php');
require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/SMTP.php');
require_once(__DIR__ . '/../../../baitaplon/includes/function.php');
require_once(__DIR__ . '/../../../baitaplon/includes/session.php');
require_once(__DIR__ . '/../../../baitaplon/templates/layout/header-admin.php');

// Đặt mặc định cho $page và $action
$page = isset($_GET['page']) && is_string($_GET['page']) ? trim($_GET['page']) : 'manager_service';
$action = isset($_GET['action']) && is_string($_GET['action']) ? trim($_GET['action']) : 'dashboard';

// Đường dẫn tệp cần nạp (lấy từ thư mục admin/manager_service)
$path = __DIR__ . '/' . $page . '/' . $action . '.php';

// Kiểm tra xem tệp có tồn tại không và nạp tệp
if (file_exists($path)) {
    require_once $path;
} else {
    // Xử lý lỗi khi không tìm thấy tệp, điều hướng tới trang 404
    require_once(__DIR__ . '/../../../baitaplon/modules/error/404.php'); // Trang 404 tùy chỉnh
}

// Nạp footer
require_once(__DIR__ . '/../../../baitaplon/templates/layout/footer-admin.php');
