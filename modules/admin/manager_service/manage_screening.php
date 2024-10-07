<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}

if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}

if (isLogin()) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $id = (int)$_POST['id']; // Lấy ID của hóa đơn
        $trang_thai = (int)$_POST['dieu_kien_tiem']; // Lấy trạng thái mới từ POST

        // Dữ liệu cần cập nhật
        $dataUpdate = [
            'dieu_kien_tiem' => $trang_thai
        ];
        // $latestRecord = getRow("SELECT ngay_kham FROM phieukhamsangloc WHERE id = $id ORDER BY ngay_kham DESC LIMIT 1");
        // Thực hiện cập nhật trạng thái trong cơ sở dữ liệu với điều kiện id

        // Lấy thời gian gần nhất từ bảng phieukhamsangloc
       

        // Kiểm tra nếu tồn tại bản ghi với thời gian gần nhất
        // if (!empty($latestRecord)) {
        //     $latestNgayKham = $latestRecord['ngay_kham'];

            // Thực hiện cập nhật bản ghi với mã khách hàng và thời gian gần nhất
            $updateResult = update('phieukhamsangloc', $dataUpdate, "id = $id ");
        

       
        // Kiểm tra kết quả và đưa ra thông báo
        if ($updateResult) {
            setFlashData('msg', 'Cập nhật trạng thái thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Cập nhật trạng thái thất bại!');
            setFlashData('msg_type', 'danger');
        }
    }
    // header("Location:http://localhost/baitaplon/modules/admin/index.php?page_web=manager_service&action_web=management_screening");

    $filter = ''; // Biến này sẽ chứa điều kiện tìm kiếm

    if (isGet()) {
        $body = getBody(); // Lấy dữ liệu GET (nếu có)
        if (!empty($body['keyword'])) {
            $keyword = $body['keyword'];
            // Nếu có keyword, thêm điều kiện tìm kiếm vào $filter
            $filter = "WHERE user.fullname LIKE '%$keyword%'";
        }
    }

    // Truy vấn để đếm tổng số người dùng phù hợp với điều kiện
    $allUserNumber = getRow("SELECT COUNT(user.id) as total 
                             FROM user 
                             INNER JOIN phieukhamsangloc 
                             ON user.id = phieukhamsangloc.ma_khach_hang 
                             $filter");

    // Số lượng bản ghi trên một trang
    $perPage = 5;

    // Tính số trang tối đa
    $maxPage = ceil($allUserNumber / $perPage);

    // Xử lý phân trang
    if (!empty(getBody()['page'])) {
        $page = getBody()['page'];
        if ($page < 1 || $page > $maxPage) {
            $page = 1; // Nếu trang không hợp lệ, mặc định là trang 1
        }
    } else {
        $page = 1; // Mặc định trang đầu tiên
    }

    // Tính toán offset
    $offset = ($page - 1) * $perPage;

    // Truy vấn để lấy danh sách người dùng dựa trên phân trang và điều kiện tìm kiếm
    $listAllUser = getRaw("SELECT ls.id,user.fullname, user.phone, user.email, ls.ngay_kham, ls.tinh_trang_suc_khoe, ls.tieu_su_benh_ly, ls.dieu_kien_tiem, ls.ma_khach_hang
                           FROM user 
                           INNER JOIN phieukhamsangloc AS ls 
                           ON user.id = ls.ma_khach_hang 
                           $filter 
                           ORDER BY createAt DESC 
                           LIMIT $offset, $perPage");

    // Hiển thị thông báo nếu có
    $msg = getFlashData('msg');
    $msg_type = getFlashData('msg_type');

?>
    <div class="content-section" id="mainContent">
        <hr />
        <h3>Quản lý phiếu khám lâm sàng</h3>
        <?php getMsg($msg, $msg_type); ?>
        
        <div class="tool-search">
            <!-- Form tìm kiếm -->
            <form action="" method="get">
                <div class="row">
                    <div class="col-6">
                        <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm..." value="<?php echo !empty($body['keyword']) ? $body['keyword'] : ''; ?>">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                    </div>
                </div>
                <!-- Giữ lại tham số page_web và action_web để không mất khi tìm kiếm -->
                <input type="hidden" name="page_web" value="manager_service">
                <input type="hidden" name="action_web" value="manage_screening">
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <td width="5%">Serial</td>
                    <td>Fullname</td>
                    <td>Email</td>
                    <td>Phone number</td>
                    <td>Medical history</td>
                    <td>Date</td>
                    <td width="15%">Examination conditions</td>
                    <td width="5%">Edit</td>
                    <td width="5%">Delete</td>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listAllUser)) : ?>
                    <?php
                    $count = 0; // Khởi tạo biến đếm để hiển thị số thứ tự
                    foreach ($listAllUser as $item) :
                        
                        $count++;
                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $item['fullname']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td><?php echo $item['tieu_su_benh_ly']; ?></td>
                            <td><?php echo $item['ngay_kham']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="dieu_kien_tiem" value="<?php echo $item['dieu_kien_tiem'] == 1 ? 0 : 1; ?>">
                                    <button type="submit" class="btn btn-sm <?php echo $item['dieu_kien_tiem'] == 1 ? 'btn-success' : 'btn-warning'; ?>">
                                        <?php echo $item['dieu_kien_tiem'] == 1 ? 'Đạt yêu cầu' : 'Chưa Đạt yêu cầu'; ?>
                                    </button>
                                </form>
                            </td>
                            <td><a href=<?php echo '\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=edit_screening&id=' . $item['id'] ?> class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                            <td><a href=<?php echo '\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=delete_screening&id=' . $item['id'] ?> onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9">
                            <div class="alert alert-danger text-center">Không có người dùng</div>
                        </td>
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
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?page_web=admin&action_web=manage_screening&page=' . $prevPage . '">Trước</a></li>';
                }

                $begin = $page - 2;
                $end = $page + 2;
                if ($begin < 1) {
                    $begin = 1;
                }
                if ($end >= $maxPage) {
                    $end = $maxPage;
                }
                for ($index = $begin; $index <= $end; $index++) : ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="<?php echo _WEB_HOST_ROOT . '?page_web=admin&action_web=manage_screening&page=' . $index; ?>">
                            <?php echo $index; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?page_web=admin&action_web=manage_screening&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
<?php
}
