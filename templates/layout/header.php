<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng tiêm chủng an toàn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tùy chỉnh thêm cho phần sidebar và nội dung */
        .sidebar {
            background-color: #343a40;
            padding: 20px;
            color: #fff;
            height: 100vh;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            margin: 10px 0;
            display: block;
            padding: 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #ffc107;
            border-radius: 5px;
        }

        .sidebar a.active {
            background-color: #495057;
            color: #ffc107;
        }

        .content-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease;
        }

        .content-section:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: white;
        }

        .header a {
            color: #fff;
        }

        .header .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        .item1 {
            grid-area: header;
        }

        .item2 {
            grid-area: menu;
        }

        .item3 {
            grid-area: main;
        }

        .item4 {
            grid-area: right;
        }

        .item5 {
            grid-area: footer;
        }

        .grid-container {
            display: grid;
            grid-template-areas:
                'header header header header header header'
                'menu main main main right right'
                'menu footer footer footer footer footer';
            gap: 10px;
            background-color: #2196F3;
            padding: 10px;
        }

        .grid-container>div {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 sidebar">
                <h2>Admin Panel</h2>
                <a href="?page=manager_service&action=services" class="<?php if ($page == 'services') echo 'active'; ?>">Services</a>
                <a href="?page=manager_service&action=list" class="<?php if ($page == 'list') echo 'active'; ?>">User management</a>
                <a href="?page=manager_service&action=pre_screening" class="<?php if ($page == 'pre_screening') echo 'active'; ?>">Vaccination service management</a>
                <a href="?page=manager_service&action=vaccine_records" class="<?php if ($page == 'vaccine_records') echo 'active'; ?>">Vaccination Card management</a>
                <a href="?page=manager_service&action=bills" class="<?php if ($page == 'bills') echo 'active'; ?>">Invoice management</a>
                <a href="?page=manager_service&action=reports" class="<?php if ($page == 'reports') echo 'active'; ?>">Revenue statistics</a>
            </nav>

            <!-- Main Content (Header + Content) -->
            <div class="col-md-9">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Quản lý phòng tiêm chủng an toàn</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Settings
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Account Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Privacy Settings</a></li>
                                        <li><a class="dropdown-item" href="#">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Header (will be displayed below navbar) -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="header">
                            <h1>Quản lý phòng tiêm chủng</h1>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="row">
                    <div class="content-section">
                        <?php
                        // Kiểm tra xem biến $_GET['page'] có tồn tại không, nếu không thì gán giá trị mặc định là 'dashboard'
                        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

                        // Hiển thị nội dung dựa vào trang được chọn
                        switch ($page) {
                            case 'services':
                                include 'modules/admin/manager_service/services.php'; // Quản lý dịch vụ
                                break;
                            case 'list':
                                include 'modules/admin/manager_service/list.php'; // Quản lý dịch vụ
                                break;
                            case 'pre_screening':
                                include 'modules/admin/manager_service/pre_screening.php'; // Quản lý phiếu khám sàng lọc
                                break;
                            case 'vaccine_records':
                                include 'modules/admin/manager_service/vaccine_records.php'; // Quản lý phiếu tiêm chủng
                                break;
                            case 'bills':
                                include 'modules/admin/manager_service/bills.php'; // Quản lý hóa đơn
                                break;
                            case 'reports':
                                include 'modules/admin/manager_service/reports.php'; // Thống kê doanh thu
                                break;
                            case 'dashboard':
                                include 'modules/admin/manager_service/dashboard.php'; // Mặc định là Dashboard
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> -->