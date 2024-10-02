<?php
if (!defined('_INCODE') == 1) {
  die('Access denied');
}

// if (!isLogin()) {
//   header('Location: http://localhost/baitaplon/index.php');
// exit();

  
// }
// if (!isLogin()) {
//   redirect('\baitaplon\index.php?module=auth&action=login');
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $body = getBody();

  // Kiểm tra và xử lý ảnh dịch vụ
  if (isset($_FILES['anh_dich_vu']) && $_FILES['anh_dich_vu']['error'] == 0) {
    // Lấy thông tin file ảnh
    $fileTmp = $_FILES['anh_dich_vu']['tmp_name'];
    $fileSize = $_FILES['anh_dich_vu']['size'];

    // Đọc nội dung file ảnh và mã hóa base64
    $imageData = file_get_contents($fileTmp);
    
    // Lưu dữ liệu vào cơ sở dữ liệu
    $dataInsert = [
      'ten_vacxin' => $body['ten_vacxin'],
      'loai_dich_vu' => $body['loai_dich_vu'],
      'anh_dich_vu'  => $imageData, // Lưu nội dung ảnh
      'gia' => $body['gia_dich_vu'],
      'mo_ta' => $body['mo_ta'],
      'ngay_tao' => date('Y-m-d H:i:s') // Thêm ngày tạo nếu cần
    ];

    $insert = insert('dichvutiemchung', $dataInsert);
    if ($insert) {
      setFlashData('msg', 'Add service successfully');
      setFlashData('msg_type', 'success');
    } else {
      setFlashData('msg', 'Add service failed');
      setFlashData('msg_type', 'danger');
    }
  } else {
    setFlashData('msg', 'No image file uploaded');
    setFlashData('msg_type', 'warning');
  }

  // Hiển thị thông báo
}
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<div class="content-section" id="mainContent">
  <div class="">
    <h2>Add new service</h2>
  </div>
  <?php getMsg($msg, $msg_type); ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="tenDichVu" class="form-label">Tên Dịch Vụ</label>
        <input type="text" class="form-control" name="ten_vacxin" id="tenDichVu" placeholder="Tên Dịch Vụ" autocomplete="off">
      </div>
      <div class="col-md-6">
        <label for="loaiDichVu" class="form-label">Loại Dịch Vụ</label>
        <select id="loaiDichVu" name="loai_dich_vu" class="form-select">
          <option selected>Chọn loại dịch vụ...</option>
          <option value="0">Dành cho người lớn</option>
          <option value="1">Trẻ em</option>
          <option value="2">Viêm nhiễm</option>
          <option value="3">Mọi lứa tuổi</option>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <label for="anhDichVu" class="form-label">Ảnh Dịch Vụ</label>
      <input type="file" class="form-control" name="anh_dich_vu" id="anhDichVu">
    </div>
    <div class="mb-3">
      <label for="gia" class="form-label">Giá</label>
      <input type="text" class="form-control" name="gia_dich_vu" id="gia" placeholder="Giá" autocomplete="off">
    </div>
    <div class="row mb-3">
      <div class="col-md-6">
        <label for="moTa" class="form-label">Mô Tả</label>
        <textarea class="form-control" id="moTa" name="mo_ta" rows="3" placeholder="Mô tả dịch vụ"></textarea>
      </div>
      <div class="col-md-2">
        <label for="tuoi" class="form-label">Tuổi</label>
        <input type="number" class="form-control" name="tuoi" id="tuoi" placeholder="Tuổi">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Thêm dịch vụ</button>
  </form>
</div>

<?php
require_once('D:\xampp\htdocs\baitaplon\templates\layout\footer-admin.php');
