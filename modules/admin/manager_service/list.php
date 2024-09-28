<?php
if (!defined('_INCODE') == 1) {
    die('Access deined');
}


if (!isLogin()) {
    redirect('?module=auth&action=login');
}


if (isLogin()) {
    $filter = '';

    if (isGet()) {
        $body = getBody();

        // Xử lý lọc status
        if (!empty($body['status'])) {
            $status = $body['status'];

            // Điều kiện để xác định giá trị statusSql
            $statusSql = ($status == 2) ? 0 : $status;
            if (str_contains($filter, 'WHERE')) {
                $filter .= " AND status = $statusSql";
            } else {
                // Gán điều kiện vào biến filter
                $filter .= "WHERE status = $statusSql";
            }
        }



        if (!empty($body['keyword'])) {
            $keyword = $body['keyword'];
            if (str_contains($filter, 'WHERE') === false) {
                $filter .= " WHERE fullname LIKE '%$keyword%'";
            } else {
                $filter .= " AND fullname LIKE '%$keyword%'";
            }
        }
    }




    //Process division page
    $allUserNumber = getRow("SELECT id FROM user $filter ");

    //Identify records on a page
    $perPage = 2;

    //Caculator the number of pages

    $maxPage = ceil($allUserNumber / $perPage);

    //Process base on method GET
    if (!empty(getBody()['page'])) {
        $page = getBody()['page'];
        if ($page < 1 || $page > $maxPage) {
            $page = 1;
        }
    } else {
        $page = 1;
    }

    $flag = 1;
    $offset = ($page - 1) * $perPage;
    //Use LIMIT to take number user conform
    $listAllUser = getRaw("SELECT * FROM user $filter ORDER BY createAt DESC LIMIT $offset, $perPage");

    // layout('header-admin');

    $queryString = null;

    if (!empty($_SERVER['QUERY_STRING'])) {
        $queryString = $_SERVER['QUERY_STRING'];
        $queryString = str_replace('module=users', '', $queryString);
        $queryString = str_replace('page=' . $page, '', $queryString);
        $queryString = trim($queryString, '&');
        $queryString = '&' . $queryString;
    }


    $msg = getFlashData('msg');
    $msg_type = getFlashData('msg_type');

?>
    <!-- <div class="container"> -->
    <div class="content-section" id="mainContent">
        <hr />
        <h3>Quản lý người dùng</h3>
        <?php
        getMsg($msg, $msg_type);
        ?>
        <a href="http:\\localhost\baitaplon\index.php?module=admin&action=add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
            Add user</a>

        <div class="tool-search">
            <form action="" method="get">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="0">Chọn trạng thái</option>
                                <option value="1" <?php echo (!empty($status) && $status == 1) ? 'selected' : ''; ?>>Kích hoạt</option>
                                <option value="2" <?php echo (!empty($status) && $status == 2) ? 'selected' : ''; ?>>Chưa kích hoạt</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <input type="search" class="form-control" name="keyword" placeholder="Từ khoá tìm kiếm...">
                    </div>

                    <div class="col-3">
                        <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                    </div>
                </div>

                <input type="hidden" name="module" value="users">
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">Serial</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Status</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
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
                            <td><?php echo $item['status'] == 1 ? '<button type="submit" class="btn btn-success btn-sm" style="padding-left:11px; padding-right:11px">Active</button>' : '<button type="submit" class="btn btn-warning btn-sm">Passive</button>'; ?></td>
                            <td><a href=<?php echo _WEB_HOST_ROOT . '?page_web=admin&action=edit&id=' . $item['id'] ?> class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                            <td><a href=<?php echo _WEB_HOST_ROOT . '?page_web=admin&action=delete&id=' . $item['id'] ?> onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a></td>
                        </tr>

                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-danger text-center">Không có người dùng</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

            </td>
            </tr>

            </tbody>
        </table>
        <hr />
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php

                if ($page > 1) {
                    $prevPage = $page - 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . 'page_web=admin&action=list&page=' . $prevPage . '">Trước</a></li>';
                }


                ?>

                <?php
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
                        <a class="page-link" href="<?php echo 'http://localhost/baitaplon/modules/admin/index.php' . '?page_web=manager_service&action_web=list' . $queryString . '&page=' . $index; ?>">
                            <?php echo $index; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php
                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=users' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }

                ?>
            </ul>
        </nav>

        <!-- </div> -->
    </div>
<?php
    // layout('footer-admin');
}
