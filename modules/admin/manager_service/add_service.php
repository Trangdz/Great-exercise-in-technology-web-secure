<?php
if (!defined('_INCODE') == 1) {
  die('Access denied');
}

if (!isLogin()) {
  header("Location:http:\\localhost\baitaplon\modules\auth\login.php");
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
  $dataInsert=[

  ];
}
?>
<div class="content-section" id="mainContent">
  <div class="">
  <h2>Add new service</h2>
  </div>

<form action="" method='post'>
  <div class="row mb-3">
    <div class="col-md-6">
      <label for="tenDichVu" class="form-label">Tên Dịch Vụ</label>
      <input type="text" class="form-control" id="tenDichVu" placeholder="Tên Dịch Vụ" autocomplete="off">
    </div>
    <div class="col-md-6">
      <label for="loaiDichVu" class="form-label">Loại Dịch Vụ</label>
      <select id="loaiDichVu" class="form-select">
        <option selected>Chọn loại dịch vụ...</option>
        <option value="nguoi_lon">Dành cho người lớn</option>
        <option value="tre_em">Trẻ em</option>
        <option value="viem_nhiem">Viêm nhiễm</option>
        <option value="di_du_lich">Đi du lịch</option>
      </select>
    </div>
  </div>
  <div class="mb-3">
    <label for="anhDichVu" class="form-label">Ảnh Dịch Vụ</label>
    <input type="file" class="form-control" id="anhDichVu">
  </div>
  <div class="mb-3">
    <label for="gia" class="form-label">Giá</label>
    <input type="text" class="form-control" id="gia" placeholder="Giá (decimal)" autocomplete="off">
  </div>
  <div class="row mb-3">
    <div class="col-md-6">
      <label for="moTa" class="form-label">Mô Tả</label>
      <textarea class="form-control" id="moTa" rows="3" placeholder="Mô tả dịch vụ"></textarea>
    </div>
    <div class="col-md-2">
      <label for="tuoi" class="form-label">Tuổi</label>
      <input type="number" class="form-control" id="tuoi" placeholder="Tuổi">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Thêm dịch vụ</button>
</form>


</div>
<?php
require_once('D:\xampp\htdocs\baitaplon\templates\layout\footer-admin.php');
