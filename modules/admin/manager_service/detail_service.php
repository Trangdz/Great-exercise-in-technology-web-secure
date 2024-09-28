<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}

// Kiểm tra đăng nhập
// if (!isLogin()) {
//     header('Location: http://localhost/baitaplon/index.php');
//     exit();
    
  
// }
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
// Lấy id của dịch vụ từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn dữ liệu dịch vụ từ bảng "dichvutiemchung"
    $sql = "SELECT * FROM dichvutiemchung WHERE id = $id";
    $dataService = getRaw($sql);

    // Nếu không tìm thấy dịch vụ, thông báo lỗi
    if (empty($dataService)) {
        echo "<p>Dịch vụ không tồn tại.</p>";
        exit();
    }
} else {
    echo "<p>Không có dịch vụ được chọn.</p>";
    exit();
}
?>

<div class="content-section" id="mainContent">
    <div class="container">
      
        <h2>Chi tiết dịch vụ: <?php echo isset($dataService[0]['ten_dich_vu']) ? htmlspecialchars($dataService[0]['ten_dich_vu']) : 'Không có tên dịch vụ'; ?></h2>
        <div class="service-detail" style="display: flex; margin-top: 20px;">
            <!-- Hiển thị ảnh dịch vụ -->
            <div style="margin-right: 20px;">
                <?php
                // Lấy dữ liệu hình ảnh (ảnh được lưu dưới dạng BLOB trong DB)
                if (isset($dataService[0]['anh_dich_vu']) && !empty($dataService[0]['anh_dich_vu'])) {
                    $file_data = $dataService[0]['anh_dich_vu'];
                    
                    // Kiểm tra kiểu MIME của ảnh
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $file_type = finfo_buffer($finfo, $file_data);
                    finfo_close($finfo);

                    // Chuyển đổi dữ liệu BLOB sang base64
                    $img_base64 = 'data:' . $file_type . ';base64,' . base64_encode($file_data);
                } else {
                    // Nếu không có ảnh, hiển thị ảnh mặc định
                    $img_base64 = 'path/to/default-image.jpg'; // Đường dẫn ảnh mặc định
                }
                ?>
                <img src="<?php echo $img_base64; ?>" alt="Image" style="width: 300px; height: 200px; object-fit: cover; border-radius: 5px;">
            </div>

            <!-- Hiển thị thông tin dịch vụ -->
            <div class="service-info" style="flex-grow: 1;">
                <?php
               
                if(isset($dataService[0]['loai_dich_vu']))
                {
                    $service=$dataService[0]['loai_dich_vu'];
                    if($service==='0')
                    {
                        $data='Dành cho người lớn';
                    }
                    if($service==='1')
                    {
                        $data='Dành cho trẻ em';
                    }
                    if($service==='2')
                    {
                        $data='Viêm nhiễm';
                    }
                    if($service==='3')
                    {
                        $data='Tất cả đối tượng';
                    }
                }
                 ?>
                <p><strong>Loại dịch vụ:</strong> <?php echo isset($dataService[0]['loai_dich_vu'])&isset($service) ? $data: 'Không có loại dịch vụ'; ?></p>
                <p><strong>Giá:</strong> <?php echo isset($dataService[0]['gia']) ? number_format($dataService[0]['gia'], 0, ',', '.') . ' đ' : 'Không có giá'; ?></p>
                <p><strong>Mô tả:</strong> <?php echo isset($dataService[0]['mo_ta']) ? htmlspecialchars($dataService[0]['mo_ta']) : 'Không có mô tả'; ?></p>
                <p><strong>Ngày tạo:</strong> <?php echo isset($dataService[0]['ngay_tao']) ? date("d-m-Y", strtotime($dataService[0]['ngay_tao'])) : 'Không có ngày tạo'; ?></p>
            </div>
        </div>

        <a href="index.php" class="btn btn-secondary" style="margin-top: 20px;">Quay lại danh sách</a>
    </div>
</div>
