<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}

// Kiểm tra đăng nhập
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}
require_once 'D:\xampp\htdocs\baitaplon\templates\layout\header.php';
// require_once 'D:\xampp\htdocs\baitaplon\templates\layout\sidebar_user.php'; 
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

<div class="content-section" id="mainContent" style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px;">
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 30px; background-color: white; border: 1px solid #ddd; border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #D6336C; font-weight: bold; font-size: 28px;">Chi tiết dịch vụ: 
            <?php echo isset($dataService[0]['ten_vacxin']) ? htmlspecialchars($dataService[0]['ten_vacxin']) : 'Không có tên dịch vụ'; ?>
        </h2>
        
        <div class="service-detail" style="display: flex; margin-top: 30px; justify-content: space-between;">
            <!-- Hiển thị ảnh dịch vụ -->
            <div style="flex-basis: 40%; text-align: center;">
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
                <img src="<?php echo $img_base64; ?>" alt="Image" style="width: 100%; height: auto; max-width: 400px; border-radius: 8px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);">
            </div>

            <!-- Hiển thị thông tin dịch vụ -->
            <div class="service-info" style="flex-basis: 55%; padding-left: 20px;">
                <?php
                if (isset($dataService[0]['loai_dich_vu'])) {
                    $service = $dataService[0]['loai_dich_vu'];
                    if ($service === '0') {
                        $data = 'Dành cho người lớn';
                    } elseif ($service === '1') {
                        $data = 'Dành cho trẻ em';
                    } elseif ($service === '2') {
                        $data = 'Viêm nhiễm';
                    } elseif ($service === '3') {
                        $data = 'Tất cả đối tượng';
                    }
                }
                ?>
                <p style="font-size: 18px; margin-bottom: 10px;"><strong>Loại dịch vụ:</strong> 
                    <?php echo isset($dataService[0]['loai_dich_vu']) && isset($service) ? $data : 'Không có loại dịch vụ'; ?>
                </p>
                <p style="font-size: 18px; margin-bottom: 10px;"><strong>Giá:</strong> 
                    <?php echo isset($dataService[0]['gia']) ? number_format($dataService[0]['gia'], 0, ',', '.') . ' đ' : 'Không có giá'; ?>
                </p>
                <p style="font-size: 18px; margin-bottom: 10px;"><strong>Mô tả:</strong> 
                    <?php echo isset($dataService[0]['mo_ta']) ? htmlspecialchars($dataService[0]['mo_ta']) : 'Không có mô tả'; ?>
                </p>
                <p style="font-size: 18px; margin-bottom: 10px;"><strong>Ngày tạo:</strong> 
                    <?php echo isset($dataService[0]['ngay_tao']) ? date("d-m-Y", strtotime($dataService[0]['ngay_tao'])) : 'Không có ngày tạo'; ?>
                </p>
            </div>
        </div>

        <!-- Button section -->
        <div style="text-align: center; margin-top: 30px;">
            <a href="\baitaplon\modules\user\index.php?page_web=home&action_web=all_service" class="btn btn-secondary" style="display: inline-block; padding: 15px 25px; background-color: #17a2b8; color: white; text-decoration: none; border-radius: 8px; font-size: 18px; margin-right: 20px;">Quay lại danh sách</a>
            <a href="\baitaplon\modules\user\index.php?page_web=home&action_web=register_service&id=<?php echo $id; ?>" class="btn btn-primary" style="display: inline-block; padding: 15px 25px; background-color: #28a745; color: white; text-decoration: none; border-radius: 8px; font-size: 18px;">Đăng ký ngay</a>
        </div>
    </div>
</div>
