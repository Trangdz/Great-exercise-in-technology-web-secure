<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

$data = [
    'pageTitle' => 'Edit screenning'
];


//Take id , examine Do it have exist>
$body = getBody();
$id_phieu_kham= $body['id'];
$getMaKH = first("SELECT ma_khach_hang FROM phieukhamsangloc WHERE id='$id_phieu_kham'");
$ma_khach_hang=$getMaKH['ma_khach_hang'];
$getInfor = firstRaw("SELECT user.fullname, user.phone, user.email, ls.ngay_kham, ls.tinh_trang_suc_khoe, ls.tieu_su_benh_ly, ls.dieu_kien_tiem, ls.ma_khach_hang
                           FROM user 
                           INNER JOIN phieukhamsangloc AS ls 
                           ON user.id = ls.ma_khach_hang 
                           WHERE user.id = '$ma_khach_hang'
                           ");
if (!empty($getInfor)) {

    // setFlashData('content', $getInfor);
    $fullname = $getInfor['fullname'];
    $phone = $getInfor['phone'];
    $email = $getInfor['email'];
    $tinh_trang_suc_khoe = $getInfor['tinh_trang_suc_khoe'];
    $tieu_su_benh_ly = $getInfor['tieu_su_benh_ly'];
    $dieu_kien_tiem=$getInfor['dieu_kien_tiem'];
}
// }
if (isLogin() && $_SERVER['REQUEST_METHOD'] == 'POST') { // Kiểm tra nếu form đã được gửi
    // Lấy tất cả dữ liệu từ form
    $body = getBody();

    $dataUpdate = [
        'tinh_trang_suc_khoe' => $body['tinh_trang_suc_khoe'],
        'tieu_su_benh_ly' => $body['tieu_su_benh_ly'],
        'dieu_kien_tiem' => $body['dieu_kien_tiem'],
        'ngay_kham' => date('Y-m-d H:i:s'),
    ];
    $upDate = update('phieukhamsangloc', $dataUpdate, "id=$id_phieu_kham");

    if ($upDate) {
        setFlashData('msg', 'Updated successfully!');
        setFlashData('msg_type', 'success');
        // redirect('?module=users&action=list');
    } else {
        setFlashData('msg', 'The system encountered a problem. Please try again.');
        setFlashData('msg_type', 'danger');
    }

    // redirect('?module=users&action=add');
}

// layout('header', $data);
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
// $errors = getFlashData('errors');
// $old = getFlashData('content');
// $fullname = $old['fullname'];
// $phonenumber = $old['phone'];
// $email = $old['email'];


?>

<!-- Form HTML -->
<div class="content-section" id="mainContent">
    <div class='container'>
        <h3><?php echo $data['pageTitle']; ?></h3>
        <?php getMsg($msg, $msg_type); ?>

        <form action="" method='post'>
            <div class="row">
                <div class='col'>
                    <div class='form-group'>
                        <label>Họ và tên</label>
                        <input type='text' class='form-control' name='fullname' placeholder="fullname" value="<?php echo htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8');  ?>" disabled>
                    </div>
                    <div class='form-group'>
                        <label>Số điện thoại</label>
                        <input type='text' class='form-control' name='phone' placeholder="phone" value="<?php echo $phone; ?>" disabled>
                    </div>

                    <div class='form-group'>
                        <label>Email</label>
                        <input type='text' class='form-control' name='email' placeholder="email" value="<?php echo $email ?>" disabled>

                    </div>
                </div>
                <div class='col'>
                    <div class='form-group'>
                        <label>Tình trạng sức khỏe</label>
                        <input type='text' class='form-control' name='tinh_trang_suc_khoe' placeholder="tinh_trang_suc_khoe" value="<?php echo $tinh_trang_suc_khoe ?>">

                    </div>

                    <div class='form-group'>
                        <label>Tiểu sử bệnh lý</label>
                        <input type='text' class='form-control' name='tieu_su_benh_ly' placeholder="tieu_su_benh_ly" value="<?php echo $tieu_su_benh_ly ?>">

                    </div>

                    <div class="form-group">
                        <label for="status">Điều kiện tiêm</label>
                        <select id="status" name="status" class="form-control">

                            <option value="0" <?php echo ($dieu_kien_tiem == 0) ? 'selected' : '' ?>>Chưa đủ điều kiện</option>
                            <option value="1" <?php echo ($dieu_kien_tiem == 1) ? 'selected' : '' ?>>Đủ điều kiện</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $userId; ?>">
                    <input type="hidden" name="action" value="list">
                </div>
            </div>
            <div class='button-submit'>
                <button class="btn btn-primary add-user" type="submit">Update User</button>
                <a href=<?php echo 'D:\xampp\htdocs\baitaplon\modules\admin\manager_service\manage_screening.php?module=users&action=list' ?> class='btn btn-success'>Back</a>
            </div>
        </form>
    </div>
</div>
<?php
// layout('footer');
