<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}

// Kiểm tra đăng nhập
// if (!isLogin()) {
//     header('Location:/../../../../../baitaplon/index.php');
//     exit();
// }
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
  }
// Truy vấn dữ liệu từ bảng "dichvutiemchung"
$sql = 'SELECT * FROM dichvutiemchung';
$dataService = getRaw($sql);

?>

<div class="content-section" id="mainContent">
    <div class="container news-container">
        <?php
        // Kiểm tra có dữ liệu từ cơ sở dữ liệu hay không
        if (!empty($dataService)) {
            // Lặp qua từng dòng kết quả
            foreach ($dataService as $row) {
                // Lấy dữ liệu hình ảnh (ảnh được lưu dưới dạng BLOB trong DB)
                $file_data = $row['anh_dich_vu'];
                $file_type = 'image/jpeg'; // Bạn có thể thay đổi hoặc lưu kiểu ảnh trong DB để linh hoạt hơn

                if (!empty($file_data)) {
                    // Chuyển đổi dữ liệu ảnh sang base64
                    $img_base64 = 'data:' . $file_type . ';base64,' . base64_encode($file_data);
                } else {
                    // Nếu không có ảnh, hiển thị ảnh mặc định
                    $img_base64 = 'path/to/default-image.jpg';
                }

                // Giới hạn số ký tự cho phần mô tả
                $mo_ta = htmlspecialchars($row['mo_ta']);
                $mo_ta_short = strlen($mo_ta) > 150 ? substr($mo_ta, 0, 150) . '...' : $mo_ta;
        ?>
                <div class="news-item" style="display: flex; justify-content: space-between; margin-bottom: 20px; padding: 15px; border: 2px solid #ddd; border-radius: 8px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <!-- Hiển thị ảnh dịch vụ -->
                    <div style="margin-right: 20px; flex-shrink: 0;">
                        <img src="<?php echo $img_base64; ?>" alt="Image" style="width: 200px; height: 120px; object-fit: cover; border-radius: 5px;">
                    </div>

                    <!-- Hiển thị thông tin dịch vụ -->
                    <div class="news-details" style="flex-grow: 1;">
                        <h3 class="news-title" style="font-size: 18px; color: #333;">
                            <?php echo htmlspecialchars($row['ten_dich_vu']); ?>
                        </h3>
                        <p class="news-date" style="color: gray;">
                            <?php echo date("d-m-Y", strtotime($row['ngay_tao'])); ?>
                        </p>
                        <p class="news-content">
                            <?php echo $mo_ta_short; ?>
                        </p>
                        <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=detail_service&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Xem thêm</a>
                    </div>

                    <!-- Nút Sửa và Xóa -->
                    <div class="action-buttons" style="display: flex; flex-direction: column; align-items: flex-end; gap: 10px;">
                        <!-- Nút Edit (Chỉnh sửa) -->
                        <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=edit_service&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>

                        <!-- Nút Delete (Xóa) -->
                        <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=delete_service&id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa dịch vụ này không?');" class="btn btn-danger btn-sm">Xóa</a>
                    </div>
                </div>
                
        <?php
            }
        } else {
            echo "<p>Không có dịch vụ tiêm chủng nào được tìm thấy.</p>";
        }
        ?>
        <hr>
    </div>
</div>

<style>
    /* Thêm hiệu ứng nổi lên và đổ bóng khi trỏ vào .news-item */
    .news-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        border-color: #007bff; /* Đổi màu viền khi trỏ vào */
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
