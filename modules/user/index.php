<?php
session_start();
// if (defined('_INCODE') != 1) {
//   die('Access Denied');
// }
if($_SESSION['role']==='0')
{
 // Yêu cầu các tệp cần thiết với đường dẫn chính xác, sử dụng __DIR__ để lấy đường dẫn tuyệt đối
require_once('D:\xampp\htdocs\baitaplon\config.php'); 
// require_once(__DIR__ . '/../../../baitaplon/database/database.php');
// require_once(__DIR__ . '/../../../baitaplon/database/connect_auth.php');
// require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/Exception.php');
// require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/PHPMailer.php');
// require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/SMTP.php');
// require_once(__DIR__ . '/../../../baitaplon/includes/function.php');
// require_once(__DIR__ . '/../../../baitaplon/includes/session.php');
// require_once(__DIR__ . '/../../../baitaplon/templates/layout/header.php');

// // Đặt mặc định cho $page và $action
// $page = isset($_GET['page_web']) && is_string($_GET['page_web']) ? trim($_GET['page_web']) : 'user';
// $action = isset($_GET['action_web']) && is_string($_GET['action_web']) ? trim($_GET['action_web']) : 'home';
// // var_dump($page);
// // var_dump($action);
// // Đường dẫn tệp cần nạp (lấy từ thư mục admin/manager_service)
// if(!isset($_GET['page_web']))
// {
//   $path = __DIR__ . '/' . $action . '.php';
// }
// else
// {
//   $path = __DIR__ . '/' . $page . '/' . $action . '.php';
// }


// // Kiểm tra xem tệp có tồn tại không và nạp tệp
// if (file_exists($path)) {
//     require_once $path;
// } else {
//     // Xử lý lỗi khi không tìm thấy tệp, điều hướng tới trang 404
//     require_once(__DIR__ . '/../../../baitaplon/modules/error/404.php'); // Trang 404 tùy chỉnh
// }

// // Nạp footer
// require_once(__DIR__ . '/../../../baitaplon/templates/layout/footer.php');


// Yêu cầu các tệp cần thiết với đường dẫn chính xác, sử dụng __DIR__ để lấy đường dẫn tuyệt đối
// require_once('D:\xampp\htdocs\baitaplon\modules\user\config.php'); 
require_once(__DIR__ . '/../../../baitaplon/database/database.php');
require_once(__DIR__ . '/../../../baitaplon/database/connect.php');
require_once(__DIR__ . '/../../../baitaplon/database/connect.php');
require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/Exception.php');
require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/PHPMailer.php');
require_once(__DIR__ . '/../../../baitaplon/includes/phpmailer/SMTP.php');
require_once(__DIR__ . '/../../../baitaplon/includes/function.php');
require_once(__DIR__ . '/../../../baitaplon/includes/session.php');


// Đặt mặc định cho $page và $action
// $page = isset($_GET['page_web']) && is_string($_GET['page_web']) ? trim($_GET['page_web']) : 'home';
// $action = isset($_GET['action_web']) && is_string($_GET['action_web']) ? trim($_GET['action_web']) : 'home_user';
// var_dump($page);
// var_dump($action);
// Đường dẫn tệp cần nạp (lấy từ thư mục admin/manager_service)
// if(!isset($_GET['page_web']))
// {
//   $path = __DIR__ . '/' . $action . '.php';
// }
// else
// {
  // $path = __DIR__ . '/' . $page . '/' . $action . '.php';
  $module='_MODULE_DEFAULT';
  $action='_ACTION_DEFAULT';
  
  
   if (!empty($_GET['page_web']))
   {
     if(is_string($_GET['page_web'])){
        $module=trim($_GET['page_web']);
     }
   }
   if (empty($_GET['page_web']))
   {
     $module='home';
   }
   if (!empty($_GET['action_web']))
   {
     if(is_string($_GET['action_web'])){
  
        $action=trim($_GET['action_web']);
     }
   } 
   if(empty($_GET['action_web']))
   {
    $action='home_user';
   }
   $path=__DIR__ .'/'.$module.'/'.$action.'.php';
  // if(file_exists($path))
  // {
  //     require_once $path;
  // }


// Kiểm tra xem tệp có tồn tại không và nạp tệp

if (file_exists($path)) {
    require_once $path;
} else {
    // Xử lý lỗi khi không tìm thấy tệp, điều hướng tới trang 404
    require_once(__DIR__ . '/../../../baitaplon/modules/error/404.php'); // Trang 404 tùy chỉnh
}

// Nạp footer

}



