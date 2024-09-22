<?php

if (defined('_INCODE') != 1) {
    die('Access Denied');
}
// autoRemoveTokenLogin();

// saveActivity();



// $page = isset($_GET['page']) ? $_GET['page'] : 'services'; // Lấy trang hiện tại từ URL, mặc định là quản lý dịch vụ
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng tiêm chủng an toàn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f0f2f5;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            margin: 10px 0;
            display: block;
            padding: 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Hiệu ứng chuyển tiếp */
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #ffc107;
            /* Màu vàng khi hover */
            border-radius: 5px;
        }

        .sidebar a.active {
            background-color: #495057;
            color: #ffc107;
            /* Màu vàng khi được chọn */
        }

        .content {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px;
            background-color: #f0f2f5;
        }

        .navbar {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
        }

        .navbar-brand {
            font-size: 1.4rem;
            color: #fff;
        }

        .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
            /* Hiệu ứng chuyển màu chữ */
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
            /* Màu vàng khi hover */
        }

        /* Dropdown menu style */
        .dropdown-menu {
            background-color: #343a40;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a {
            color: white;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #495057;
        }

        /* Button style with hover effect */
        .btn {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #007bff;
            transform: scale(1.05);
            /* Tăng nhẹ kích thước khi hover */
        }

        .content-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease;
            /* Hiệu ứng cho section */
        }

        .content-section:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            /* Tăng độ sâu khi hover */
        }

        .content-section h3 {
            font-size: 1.6rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="side-bar">
        <nav class="sidebar">
            <h2>Admin Panel</h2>

            <a href="?page=manager_service&action=services" class="<?php if ($page == 'services') echo 'active'; ?>">Services</a>
            <a href="?page=manager_service&action=list" class="<?php if ($page == 'list') echo 'active'; ?>">User management</a>
            <a href="?page=manager_service&action=pre_screening" class="<?php if ($page == 'pre_screening') echo 'active'; ?>">Vaccination service management</a>
            <a href="?page=manager_service&action=vaccine_records" class="<?php if ($page == 'vaccine_records') echo 'active'; ?>">Vaccination Card management</a>
            <a href="?page=manager_service&action=bills" class="<?php if ($page == 'bills') echo 'active'; ?>">Invoice management</a>
            <a href="?page=manager_service&action=reports" class="<?php if ($page == 'reports') echo 'active'; ?>">Revenua statistics</a>
        </nav>
    </div>

    <div class="header">
        <!-- Content Area -->
        <div class="content">
            <!-- Navbar with Home, Profile, Contact, and Settings Dropdown -->
            <nav class="navbar navbar-expand-lg navbar-dark">
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
        </div>


        <!-- Content sections -->
        <!-- <div class="container mt-4"> -->
        <div class="content">

        
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