<?php
if (!defined('_INCODE')) {
    die('Access denied');
}

// Kiểm tra người dùng đã đăng nhập chưa
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}

// Nếu có yêu cầu POST cập nhật trạng thái
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['trang_thai'])) {
    $id = (int)$_POST['id']; // Lấy ID của hóa đơn
    $trang_thai = (int)$_POST['trang_thai']; // Lấy trạng thái mới từ POST

    // Dữ liệu cần cập nhật
    $dataUpdate = [
        'trang_thai' => $trang_thai
    ];

    // Thực hiện cập nhật trạng thái trong cơ sở dữ liệu với điều kiện id
    $updateResult = update('hoadontiemchung', $dataUpdate, "id = $id");

    // Kiểm tra kết quả và đưa ra thông báo
    // if ($updateResult) {
    //     setFlashData('msg', 'Cập nhật trạng thái thành công!');
    //     setFlashData('msg_type', 'success');
    // } else {
    //     setFlashData('msg', 'Cập nhật trạng thái thất bại!');
    //     setFlashData('msg_type', 'danger');
    // }

 
    header("Location:http://localhost/baitaplon/modules/admin/index.php?page_web=manager_service&action_web=bills");
    
}

// Truy vấn dữ liệu danh sách hóa đơn
$filter = ''; // Biến điều kiện tìm kiếm

// Lọc theo từ khóa nếu có yêu cầu GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $filter = "WHERE hoadontiemchung.ten_khach_hang LIKE '%$keyword%'";
}

// Đếm tổng số bản ghi
$allUserNumber = getRow("SELECT COUNT(id) FROM hoadontiemchung $filter");

// Phân trang
$perPage = 5;
$maxPage = ceil($allUserNumber / $perPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1 || $page > $maxPage) {
    $page = 1;
}

$offset = ($page - 1) * $perPage;

// Truy vấn dữ liệu với điều kiện phân trang
$listAllUser = getRaw("SELECT id, ten_khach_hang, ten_vacxin, ngay_lap, tong_tien, trang_thai 
                       FROM hoadontiemchung 
                       $filter 
                       ORDER BY ngay_lap DESC 
                       LIMIT $offset, $perPage");

// Hiển thị thông báo nếu có
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>
<div class="content-section" id="mainContent">
    <hr />
    <h3>Quản lý hóa đơn</h3>
    <?php getMsg($msg, $msg_type); ?>

    <div class="tool-search">
        <!-- Form tìm kiếm -->
        <form action="" method="get">
            <div class="row">
                <div class="col-6">
                    <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm..." value="<?php echo !empty($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>            
                <td width="5%">STT</td>
                <td>Tên khách hàng</td>
                <td>Tên vacxin</td>
                <td>Ngày lập</td>
                <td>Tổng tiền</td>
                <td width="15%">Thanh Toán</td>
                <td width="5%">Edit</td>
                <td width="5%">Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($listAllUser)) : ?>
                <?php foreach ($listAllUser as $count => $item) : ?>
                    <tr>
                        <td><?php echo $count + 1; ?></td>
                        <td><?php echo $item['ten_khach_hang']; ?></td>
                        <td><?php echo $item['ten_vacxin']; ?></td>
                        <td><?php echo $item['ngay_lap']; ?></td>
                        <td><?php echo $item['tong_tien']; ?></td>

                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="trang_thai" value="<?php echo $item['trang_thai'] == 1 ? 0 : 1; ?>">
                                <button type="submit" class="btn btn-sm <?php echo $item['trang_thai'] == 1 ? 'btn-success' : 'btn-warning'; ?>">
                                    <?php echo $item['trang_thai'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán'; ?>
                                </button>
                            </form>
                        </td>

                        <td><a href="<?php echo '\baitaplon\modules\admin\index.php?page_web=admin&action_web=edit_screening&id=' . $item['id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                        <td><a href="<?php echo '\baitaplon\modules\admin\index.php?page_web=admin&action_web=delete_screening&id=' . $item['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="text-center">Không có hóa đơn</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr />
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            if ($page > 1) {
                $prevPage = $page - 1;
                echo '<li class="page-item"><a class="page-link" href="?page=' . $prevPage . '">Trước</a></li>';
            }

            $begin = $page - 2;
            $end = $page + 2;
            if ($begin < 1) $begin = 1;
            if ($end >= $maxPage) $end = $maxPage;

            for ($index = $begin; $index <= $end; $index++) : ?>
                <li class="page-item <?php echo ($index == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $index; ?>"><?php echo $index; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $maxPage) {
                $nextPage = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="?page=' . $nextPage . '">Sau</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>
<?php
?>
