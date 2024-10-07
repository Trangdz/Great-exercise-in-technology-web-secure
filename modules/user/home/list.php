<?php
if (!defined('_INCODE')) {
    die('Access Denied');
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}

// Lấy dữ liệu tìm kiếm từ form
$ten_vacxin = isset($_GET['ten_vacxin']) ? trim($_GET['ten_vacxin']) : '';
$gia = isset($_GET['gia']) ? trim($_GET['gia']) : '';

// Xác định số dịch vụ trên mỗi trang
$limit = 8;

// Lấy số trang hiện tại từ URL, mặc định là 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Tính toán giá trị offset để lấy dữ liệu cho trang hiện tại
$offset = ($page - 1) * $limit;

// Bắt đầu truy vấn SQL với điều kiện tìm kiếm
$sql = "SELECT * FROM dichvutiemchung WHERE 1=1";

// Tìm kiếm theo tên vắc xin
if (!empty($ten_vacxin)) {
    $sql .= " AND ten_vacxin LIKE '%$ten_vacxin%'";
}

// Tìm kiếm theo giá
if (!empty($gia)) {
    $sql .= " AND gia <= " . intval($gia);
}

// Thêm phần giới hạn phân trang
$sql .= " LIMIT $limit OFFSET $offset";

// Lấy danh sách dịch vụ cho trang hiện tại
$dichVuList = getRaw($sql);

// Tính tổng số dịch vụ dựa trên điều kiện tìm kiếm để phân trang
$sql_total = "SELECT COUNT(*) AS total FROM dichvutiemchung WHERE 1=1";

// Thêm điều kiện tìm kiếm vào truy vấn tổng số dịch vụ
if (!empty($ten_vacxin)) {
    $sql_total .= " AND ten_vacxin LIKE '%$ten_vacxin%'";
}

if (!empty($gia)) {
    $sql_total .= " AND gia <= " . intval($gia);
}

// Lấy tổng số dịch vụ phù hợp với điều kiện tìm kiếm
$total_services_data = getRow($sql_total);
$total_services = $total_services_data['total'];

// Tính tổng số trang dựa trên số dịch vụ và giới hạn mỗi trang
$total_pages = ceil($total_services / $limit);

// Tạo chuỗi query string để giữ lại điều kiện tìm kiếm khi chuyển trang
$queryString = '';

if (!empty($ten_vacxin)) {
    $queryString .= '&ten_vacxin=' . urlencode($ten_vacxin);
}

if (!empty($gia)) {
    $queryString .= '&gia=' . urlencode($gia);
}

?>

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

<!-- HTML hiển thị nội dung -->
<div class="content-section" id="mainContent">
    <hr />
    <h3>Quản lý dịch vụ</h3>

    <!-- Form tìm kiếm -->
    <form method="GET" action="" onsubmit="return handleFormSubmit(this);">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <input type="text" name="ten_vacxin" placeholder="Tìm theo tên" value="<?php echo isset($_GET['ten_vacxin']) ? htmlspecialchars($_GET['ten_vacxin']) : ''; ?>">
            <input type="number" name="gia" placeholder="Tìm theo giá" value="<?php echo isset($_GET['gia']) ? htmlspecialchars($_GET['gia']) : ''; ?>">
            <button type="submit">Tìm kiếm</button>
        </div>
    </form>

    <!-- Danh sách dịch vụ -->
    <div class="card-service-container">
        <?php
        if (!empty($dichVuList)) {
            foreach ($dichVuList as $dichVu) {
                $file_data = $dichVu['anh_dich_vu'];
                $file_type = 'image/jpeg';
                $img_base64 = !empty($file_data) ? 'data:' . $file_type . ';base64,' . base64_encode($file_data) : 'path/to/default-image.jpg';
                $mo_ta = htmlspecialchars($dichVu['mo_ta']);
                $mo_ta_ngan = strlen($mo_ta) > 100 ? substr($mo_ta, 0, 100) . '...' : $mo_ta;

                echo '<div class="card-service">';
                echo '<img src="' . $img_base64 . '" alt="' . htmlspecialchars($dichVu['ten_vacxin']) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($dichVu['ten_vacxin']) . '</h5>';
                echo '<p class="card-text">' . $mo_ta_ngan . '</p>';
                echo '<p class="price">' . number_format($dichVu['gia'], 0, ',', '.') . 'đ</p>';
                echo '<a href="\baitaplon\modules\user\index.php?page_web=home&action_web=detail_service&id=' . $dichVu['id'] . '" class="btn btn-primary">Xem thêm</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Không có dịch vụ nào được tìm thấy.";
        }
        ?>
    </div>

    <!-- Phân trang -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Nút quay lại trang trước
            if ($page > 1) {
                $prevPage = $page - 1;
                echo '<li class="page-item"><a class="page-link" href="index.php?page_web=home&action_web=list&page=' . $prevPage . $queryString . '">Trước</a></li>';
            }

            // Hiển thị các trang
            $begin = $page - 2;
            $end = $page + 2;
            if ($begin < 1) {
                $begin = 1;
            }
            if ($end >= $total_pages) {
                $end = $total_pages;
            }

            for ($index = $begin; $index <= $end; $index++) {
                $activeClass = ($index == $page) ? 'active' : '';
                echo '<li class="page-item ' . $activeClass . '">';
                echo '<a class="page-link" href="index.php?page_web=home&action_web=list&page=' . $index . $queryString . '">' . $index . '</a>';
                echo '</li>';
            }

            // Nút chuyển sang trang tiếp theo
            if ($page < $total_pages) {
                $nextPage = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="index.php?page_web=home&action_web=list&page=' . $nextPage . $queryString . '">Sau</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>

<?php
// Đừng quên include phần footer
require_once(__DIR__ . '/../../../../baitaplon/templates/layout/footer.php');
