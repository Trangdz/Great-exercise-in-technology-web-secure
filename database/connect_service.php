<?php
if(defined('_INCODE')!=1)
{
    die('Access Deined');
}
try {
    // Kiểm tra xem lớp PDO có tồn tại không
    if (class_exists('PDO')) {
        // Tạo chuỗi DSN cho kết nối PDO
        $dsn_service = _DRIVER_HOST_SERVICE.':dbname='._DB_HOST_SERVICE .';host='._HOST_SERVICE.';port=4444';

        // Thiết lập các tùy chọn cho kết nối PDO
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',  // Thiết lập charset là UTF-8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION        // Đẩy lỗi vào ngoại lệ
        ];

        // Tạo đối tượng PDO để kết nối tới cơ sở dữ liệu
        $conn_service = new PDO($dsn_service, _USER_HOST_SERVICE, _PASS_HOST_SERVICE, $options);

        // Kiểm tra kết nối thành công bằng cách hiển thị đối tượng kết nối
        // var_dump($conn);
    }
} catch (Exception $exception) {
    // Nếu có lỗi, hiển thị thông báo lỗi dưới dạng HTML được định dạng
    echo '<div style="color: red; border: 1px solid red; padding: 5px 15px;">';
    echo $exception->getMessage() . '<br/>';
    echo '</div>';
    require_once 'modules/error/database.php';
    die(); // Dừng thực thi nếu có lỗi
}
?>
