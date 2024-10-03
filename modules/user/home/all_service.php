<?php
if (defined('_INCODE') != 1) {
    die('Access Denied');
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isLogin()) {
    header("Location:http://localhost/baitaplon/modules/auth/login.php");
    exit();
}

// Lấy dữ liệu tìm kiếm từ form
$ten_vacxin = isset($_GET['ten_vacxin']) ? trim($_GET['ten_vacxin']) : '';
$gia = isset($_GET['gia']) ? trim($_GET['gia']) : '';

// Bắt đầu truy vấn SQL
$sql = "SELECT * FROM dichvutiemchung WHERE 1=1";

// Tìm kiếm theo tên
if (!empty($ten_vacxin)) {
    $sql .= " AND ten_vacxin LIKE '%$ten_vacxin%'";
}

// Tìm kiếm theo giá
if (!empty($gia)) {
    $sql .= " AND gia <= " . intval($gia);
}


// Lấy danh sách dịch vụ
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
/* Tạo kiểu cho input */
input[type="text"], input[type="number"] {
    width: 40%; /* Giảm độ rộng xuống còn 40% */
    padding: 10px 12px; /* Giảm padding để input nhỏ gọn hơn */
    margin: 5px 0; /* Khoảng cách trên dưới của input */
    box-sizing: border-box; /* Đảm bảo padding không ảnh hưởng đến kích thước của input */
    border: 1px solid #ccc; /* Đặt viền màu xám nhẹ */
    border-radius: 6px; /* Bo góc nhẹ */
    font-size: 14px; /* Kích thước chữ nhỏ hơn */
    font-family: Arial, sans-serif; /* Font chữ */
    background-color: #f1f1f1; /* Màu nền nhạt */
    transition: border-color 0.3s, box-shadow 0.3s; /* Hiệu ứng khi focus */
}

/* Đổi màu khi input được focus (người dùng nhập liệu) */
input[type="text"]:focus, input[type="number"]:focus {
    border-color: #007bff; /* Màu viền khi focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Hiệu ứng bóng xanh khi focus */
    outline: none; /* Loại bỏ viền mặc định khi focus */
}

/* Đổi kiểu placeholder */
input::placeholder {
    color: #aaa; /* Màu của placeholder */
    font-style: italic; /* In nghiêng placeholder */
}

/* Tạo kiểu cho button */
button {
    padding: 12px 20px; /* Khoảng cách bên trong button */
    background-color: #28a745; /* Màu nền xanh đậm */
    border: none; /* Loại bỏ viền mặc định */
    color: white; /* Màu chữ trắng */
    border-radius: 6px; /* Bo góc button */
    font-size: 16px; /* Kích thước chữ */
    cursor: pointer; /* Con trỏ chỉ tay khi hover */
    transition: background-color 0.3s, box-shadow 0.3s; /* Hiệu ứng khi hover */
    font-weight: bold; /* Chữ đậm */
    text-transform: uppercase; /* Chữ in hoa */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ cho button */
}

/* Tạo hiệu ứng khi hover button */
button:hover {
    background-color: #218838; /* Đổi màu nền khi hover */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Hiệu ứng bóng lớn hơn khi hover */
}

    
</style>

<!-- JavaScript để loại bỏ các tham số rỗng -->
<script>
    function handleFormSubmit(form) {
        // Lấy các giá trị từ form
        var tenVacxin = form.ten_vacxin.value.trim();
        var gia = form.gia.value.trim();

        // Nếu ten_vacxin rỗng, loại bỏ khỏi form
        if (!tenVacxin) {
            form.ten_vacxin.removeAttribute('name');
        }

        // Nếu gia rỗng, loại bỏ khỏi form
        if (!gia) {
            form.gia.removeAttribute('name');
        }

        // Tiếp tục submit form
        return true;
    }
</script>

<!-- Thanh tìm kiếm -->
<div class="content">
<form method="GET" action="" onsubmit="return handleFormSubmit(this);">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
         <input type="hidden" name="page_web" value="home">
         <input type="hidden" name="action_web" value="all_service">
        <input type="text" name="ten_vacxin" placeholder="Tìm theo tên" value="<?php echo isset($_GET['ten_vacxin']) ? htmlspecialchars($_GET['ten_vacxin']) : ''; ?>" style="width: 45%; padding: 10px;">
        <input type="number" name="gia" placeholder="Tìm theo giá" value="<?php echo isset($_GET['gia']) ? htmlspecialchars($_GET['gia']) : ''; ?>" style="width: 45%; padding: 10px;">
        <button type="submit" style="padding: 10px; background-color: #007bff; color: white;">Tìm kiếm</button>
    </div>
</form>

<!-- Nội dung -->

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
