<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}

// Kiểm tra đăng nhập
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $body=getBody();
 
    $dataInsert=[
     'ma_khach_hang' => $_SESSION['id'],
      'ngay_kham'=> date('Y-m-d H:i:s'),
      'tinh_trang_suc_khoe'=>$body['tinh_trang_suc_khoe'],
      'tieu_su_benh_ly'=>$body['tieu_su_benh_ly'],
    ];
    $resultInsert=insert('phieukhamsangloc',$dataInsert);
    if(!empty( $resultInsert))
    {
        setFlashData('msg', "You registered successful");
        setFlashData('msg_type', 'success');
    }
    else
    {
        setFlashData('msg', "You registered faild");
        setFlashData('msg_type', 'danger');
    }

}
// Lấy dữ liệu người dùng đăng nhập
$userId = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id = '$userId'";
$getData = getRaw($sql);

// Kiểm tra dữ liệu trả về và truy cập mảng con
if (isset($getData[0])) {
    $fullname = isset($getData[0]['fullname']) ? $getData[0]['fullname'] : '';
    $email = isset($getData[0]['email']) ? $getData[0]['email'] : '';
    $phone = isset($getData[0]['phone']) ? $getData[0]['phone'] : '';
    $id = isset($getData[0]['id']) ? $getData[0]['id'] : '';
} else {
    // Nếu không có dữ liệu, gán giá trị mặc định
    $fullname = '';
    $email = '';
    $phone = '';
}

require_once 'D:\xampp\htdocs\baitaplon\templates\layout\header.php';
// require_once 'D:\xampp\htdocs\baitaplon\templates\layout\sidebar_user.php';
$msg=getFlashData('msg');
$msg_type=getFlashData('msg_type');
?>
<div class="content-section" id="mainContent" style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px;">
    <div class="content" style="max-width: 700px; margin: 0 auto; background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);">
        <h1 style="text-align: center; color: #333; font-size: 28px;">Form Điền Thông Tin Khám Sức Khỏe</h1>
        <?php
    getMsg($msg, $msg_type);
    ?>
        <form action="" method="post" style="display: flex; flex-direction: column; gap: 20px;">
            <label for="fullname" style="font-weight: bold; font-size: 16px;">Họ và tên:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" disabled style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <label for="phone" style="font-weight: bold; font-size: 16px;">Số điện thoại:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"  disabled style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <label for="email" style="font-weight: bold; font-size: 16px;">Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"  disabled style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <!-- Ngày Khám -->
            <!-- <label for="date" style="font-weight: bold; font-size: 16px;">Ngày Khám:</label>
            <input type="datet" name="date" style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;"> -->

            <!-- Tình Trạng Sức Khỏe -->
            <label for="tinh_trang_suc_khoe" style="font-weight: bold; font-size: 16px;">Tình Trạng Sức Khỏe:</label>
            <input type="text" name="tinh_trang_suc_khoe" maxlength="100" style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <!-- Tiểu Sử Bệnh Lý -->
            <label for="tieu_su_benh_ly" style="font-weight: bold; font-size: 16px;">Tiểu Sử Bệnh Lý:</label>
            <input type="text" name="tieu_su_benh_ly" maxlength="100" style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <!-- Button Xác Nhận Gửi -->
            <input type="submit" value="Xác nhận gửi yêu cầu" style="background-color: #28a745; color: white; padding: 15px; font-size: 18px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;">

            <!-- Button Quay Lại -->
            <button type="button" onclick="history.back();" style="background-color: #dc3545; color: white; padding: 15px; font-size: 18px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;">Quay lại</button>
        </form>
    </div>
</div>
<style>
    input[type="text"]{
        width: 620px;
    }
</style>
