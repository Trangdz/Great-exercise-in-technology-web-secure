<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}
// if ($getData['dieu_kien_kham'] === '0') {
//     //Đăng kí thành công và trừ tiền
//     //Thông báo đăng kí thành công
// }

// if($getData['dieu_kien_kham']==='1')
// {
//     //Đăng kí thành công và trừ tiền
//     //Thông báo đăng kí thành công
// }
// Kiểm tra đăng nhập
if(isset($_GET['id']))
{
    $idVacxin=$_GET['id'];
}

$sqlVacxin="SELECT ten_vacxin,loai_dich_vu FROM dichvutiemchung WHERE id = '$idVacxin'";
$getVacxin=firstRaw($sqlVacxin);
$ten_vacxin=$getVacxin['ten_vacxin'];
$id = $_SESSION['id'];
$sql = "SELECT id,dieu_kien_tiem
FROM phieukhamsangloc 
WHERE ma_khach_hang=$id
ORDER BY ngay_kham DESC
LIMIT 1";
$getData = firstRaw($sql);
$sqlUser = "SELECT fullname,phone,email 
FROM user 
WHERE id=$id";
$getUser=firstRaw($sqlUser);
$fullname=$getUser['fullname'];
$email=$getUser['email'];
$phone=$getUser['phone'];
$dieu_kien_tiem=$getData['dieu_kien_tiem'];
var_dump($fullname);
var_dump($dieu_kien_tiem);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $body = getBody();
    if($dieu_kien_tiem==1)
    {
        setFlashData('msg', "You aren't yet qualified");
        setFlashData('msg_type', 'danger');
    }
    else
    {
        $dataInsert = [
            'ma_khach_hang' => $_SESSION['id'],
            'ma_vacxin' => $idVacxin,
            'ngay_tiem' => date('Y-m-d H:i:s'),
            'ma_phieu_kham_sang_loc' => $getData['id'],
            'ten_vacxin' => $body['ten_vacxin'],
        ];

        $resultInsert = insert('phieutiemchung', $dataInsert);
        var_dump($resultInsert);
        if ($resultInsert) {
            // Lấy id của bản ghi vừa chèn vào từ cơ sở dữ liệu
            // $lastInsertId = mysqli_insert_id($conn); // $connection là biến kết nối MySQL của bạn
            
            // Lưu id khách hàng vào session
            $_SESSION['ma_khach_hang'] = $_SESSION['id'];
            $_SESSION['ma_vacxin'] =$idVacxin;
           
            // Điều hướng sang trang bill kèm theo id của bản ghi vừa thêm
            redirect("\baitaplon\modules\user\index.php?page_web=home&action_web=bill");
        } else {
            setFlashData('msg', "You registered failed");
            setFlashData('msg_type', 'danger');
        }
        
    }
    
   
}
// Lấy dữ liệu người dùng đăng nhập
// $userId = $_GET['id'];
// $sql = "SELECT * FROM user WHERE id = '$userId'";
// $getData = getRaw($sql);

// Kiểm tra dữ liệu trả về và truy cập mảng con
// if (isset($getData[0])) {
//     $fullname = isset($getData[0]['fullname']) ? $getData[0]['fullname'] : '';
//     $email = isset($getData[0]['email']) ? $getData[0]['email'] : '';
//     $phone = isset($getData[0]['phone']) ? $getData[0]['phone'] : '';
//     $id = isset($getData[0]['id']) ? $getData[0]['id'] : '';
// } else {
//     // Nếu không có dữ liệu, gán giá trị mặc định
//     $fullname = '';
//     $email = '';
//     $phone = '';
// }

require_once 'D:\xampp\htdocs\baitaplon\templates\layout\header.php';
require_once 'D:\xampp\htdocs\baitaplon\templates\layout\sidebar_user.php';
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>
<div class="content-section" id="mainContent" style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px;">
    <div class="content" style="max-width: 700px; margin: 0 auto; background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);">
        <h1 style="text-align: center; color: #333; font-size: 28px;">Form Điền Thông Tin Khám Sức Khỏe</h1>
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post" style="display: flex; flex-direction: column; gap: 20px;">
            <label for="fullname" style="font-weight: bold; font-size: 16px;">Họ và tên:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>"  style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <label for="phone" style="font-weight: bold; font-size: 16px;">Số điện thoại:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"  style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <label for="email" style="font-weight: bold; font-size: 16px;">Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"  style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">

            <!-- Tình Trạng Sức Khỏe -->
            <label for="tinh_trang_suc_khoe" style="font-weight: bold; font-size: 16px;">Tên vacxin:</label>
            <input type="text" name="ten_vacxin" value="<?php echo htmlspecialchars($ten_vacxin); ?>" readonly maxlength="100" style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;">
            <!-- Ngày Khám -->
            <!-- <label for="date" style="font-weight: bold; font-size: 16px;">Ngày tiêm</label>
            <input type="date" name="ngay_tiem" style="padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px;"> -->

            <!-- Button Xác Nhận Gửi -->
            <input type="submit" value="Xác nhận gửi yêu cầu" style="background-color: #28a745; color: white; padding: 15px; font-size: 18px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;">

            <!-- Button Quay Lại -->
            <button type="button" onclick="history.back();" style="background-color: #dc3545; color: white; padding: 15px; font-size: 18px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;">Quay lại</button>
        </form>
    </div>
</div>