<?php
if (defined('_INCODE') != 1) {
    die('Access Denied');
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isLogin()) {
    header("Location:http://localhost/baitaplon/modules/auth/login.php");
    exit();
}

// Lấy dữ liệu từ bảng dichvutiemchung bằng hàm getRaw
$sql = "SELECT * FROM dichvutiemchung";
$dichVuList = getRaw($sql);

require_once 'D:\xampp\htdocs\baitaplon\templates\layout\header.php';
?>

<!-- CSS -->
<style>
    .card-service-container {
        display: flex;
        justify-content: space-between; /* Căn đều các card */
        flex-wrap: wrap; /* Để khi màn hình nhỏ, các thẻ xuống hàng */
    }

    .card-service {
        width: 24%; /* Đảm bảo 4 thẻ trên mỗi hàng */
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        transition: transform 0.2s ease-in-out;
    }

    .card-service:hover {
        transform: scale(1.05); /* Hiệu ứng phóng to nhẹ khi hover */
    }

    .card-service img {
        width: 100%;
        height: 150px;
        object-fit: cover; /* Đảm bảo hình ảnh giữ tỷ lệ và vừa khung */
    }

    .card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
        color: #333;
    }

    .card-text {
        font-size: 14px;
        margin-top: 10px;
        color: #777;
        height: 50px; /* Giới hạn chiều cao để tránh hiển thị quá nhiều chữ */
        overflow: hidden; /* Ẩn phần chữ thừa */
        text-overflow: ellipsis; /* Thêm dấu "..." nếu nội dung quá dài */
    }

    .price {
        font-size: 16px;
        color: red;
        margin-top: 10px;
        font-weight: bold;
    }

    .btn {
        margin-top: 15px;
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>

<!-- Nội dung -->
<div class="content">
    <?php require_once 'D:\xampp\htdocs\baitaplon\templates\layout\sidebar_user.php'; ?>
    <h5>Bán chạy nhất</h5>
    <div class="card-service-container">
        <?php
        // Kiểm tra xem có dịch vụ không
        if (!empty($dichVuList)) {
            // Lặp qua các dịch vụ trong danh sách
            foreach ($dichVuList as $dichVu) {
                // Lấy ảnh từ cơ sở dữ liệu
                $file_data = $dichVu['anh_dich_vu'];
                $file_type = 'image/jpeg'; // Loại ảnh mặc định, bạn có thể điều chỉnh theo DB

                if (!empty($file_data)) {
                    // Chuyển đổi dữ liệu ảnh sang base64
                    $img_base64 = 'data:' . $file_type . ';base64,' . base64_encode($file_data);
                } else {
                    // Nếu không có ảnh, sử dụng hình ảnh mặc định
                    $img_base64 = 'path/to/default-image.jpg'; // Thay thế đường dẫn ảnh mặc định
                }

                // Cắt phần mô tả dài để hiển thị ngắn gọn
                $mo_ta = htmlspecialchars($dichVu['mo_ta']);
                $mo_ta_ngan = strlen($mo_ta) > 100 ? substr($mo_ta, 0, 100) . '...' : $mo_ta; // Hiển thị tối đa 100 ký tự

                // Hiển thị dịch vụ
                echo '<div class="card-service">';
                echo '<img src="' . $img_base64 . '" alt="' . htmlspecialchars($dichVu['ten_vacxin']) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($dichVu['ten_vacxin']) . '</h5>';
                echo '<p class="card-text">' . $mo_ta_ngan . '</p>';
                echo '<p class="price">' . number_format($dichVu['gia'], 0, ',', '.') . 'đ</p>';
                echo '<a href="\baitaplon\modules\user\index.php?page_web=home&action_web=detail_service&id=' . $dichVu['id'] . '" class="btn btn-primary">Xem thêm</a>'; // Nút xem thêm liên kết đến trang chi tiết
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Không có dịch vụ nào được tìm thấy.";
        }
        ?>
    </div>
</div>

<?php
require_once(__DIR__ . '/../../../../baitaplon/templates/layout/footer.php');
?>
