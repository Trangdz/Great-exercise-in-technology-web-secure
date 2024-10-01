<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phòng tiêm chủng an toàn</title>
    <!-- Bootstrap CSS -->


    <!-- Bootstrap JS and Popper.js -->

    <link href="http:\\localhost\baitaplon\modules\user\home\add_service.css" rel="stylesheet">
    <link href="http:\\localhost\baitaplon\modules\user\home\manage_service.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Sidebar styles */
        body {
            margin-top: 30px;
        }

        .sidebar {
            background-color: #343a40;
            padding: 20px;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            overflow-y: auto;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar h2 {
            display: block;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed h2 {
            opacity: 0;
            visibility: hidden;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            margin: 10px 0;
            display: block;
            padding: 10px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #ffc107;
            border-radius: 5px;
        }

        .sidebar.collapsed a .link-text {
            display: none;
        }

        .sidebar .link-text {
            transition: opacity 0.3s ease;
        }

        /* Accordion functionality */
        .panel {
            padding-left: 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #444;
        }

        .accordion {
            cursor: pointer;
            padding: 10px;
            background-color: #343a40;
            border: none;
            outline: none;
            text-align: left;
            width: 100%;
            color: white;
        }

        .accordion:after {
            content: '\25BC';
            color: white;
            font-weight: bold;
            float: right;
        }

        .accordion.active:after {
            content: '\25B2';
        }

        /* Content section */
        .content-section {
            background-color: #fff;
            padding: 20px;
            margin-left: 270px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-top: 20px;
            transition: margin-left 0.3s ease;
        }

        .content-section.collapsed {
            margin-left: 100px;
        }

        /* Header styles */
        .header {
            background-color: #f8f9fa;
            color: #343a40;
            padding: 1rem;
            margin-left: 250px;
            position: fixed;
            width: calc(100% - 250px);
            top: 0;
            z-index: 1000;
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .header.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        /* Footer */
        footer {
            text-align: center;
            font-size: 14px;
            padding: 20px;
            background-color: #f8f9fa;
            
            /* border-top: 1px solid #ddd; */
            transition: margin-left 0.3s ease;
        }

        footer.collapsed {
            margin-left: 80px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .header {
                margin-left: 0;
                width: 100%;
            }

            .content-section {
                margin-left: 0;
            }

            footer {
                margin-left: 0;
            }
        }

        .navbar-brand img {
            width: 30px;
            /* Chỉnh chiều rộng logo */
            height: 30px;
            /* Tự động điều chỉnh chiều cao theo tỷ lệ */
        }

        .centered-image {
            max-width: 100%;
            /* Hình ảnh không vượt quá chiều rộng của thẻ chứa */
            height: auto;
            /* Chiều cao tự động tính theo tỷ lệ */
            display: inline-block;
            /* Hiển thị hình ảnh như một phần tử inline-block */
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Custom styling cho phần header */
        /* .navbar-brand img {
            width: 150px;
        } */

        /* Phần giới thiệu */
        .intro-section {
            padding: 60px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .intro-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .intro-section p {
            font-size: 18px;
            color: #6c757d;
        }

        /* Phần tin tức */
        .news-section {
            padding: 60px 0;
            text-align: center;
            margin-right: 25px;
        }

        .news-section h2 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #dc3545;
            text-align: center;
            align-items: center;
        }

        /* Hiệu ứng khi trỏ vào card (tin tức) */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
            /* display: flex; */
            /* padding: 20px 0; */
            /* text-align: center;
            align-items: center;
            justify-content: center; */
            width: auto;
            /* margin-right: 40px; */
            position: relative;
            right: 80px;
        }

        footer {
            text-align: center;
            font-size: 14px;
            padding: 20px;
          
           
            /* border-top: 1px solid #ddd; */
            transition: margin-left 0.3s ease;
        }



        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text {
            font-size: 14px;
            color: #6c757d;
        }

        .form-group {
            font-size: 20px;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

    <!-- Sidebar Menu -->
    <div>

    </div>
    <div class="sidebar" id="sidebar">

        <h2>Admin Panel</h2>
        <a href="?page_web=manager_service&action_web=dashboard" class="active">
            <i class="fa fa-dashboard"></i>
            <span class="link-text">Dashboard</span>
        </a>

        <!-- Accordion Menu -->
        <button class="accordion">
            <i class="fa fa-cogs"></i>
            <span class="link-text">Services</span>
        </button>
        <div class="panel">
            <a href="?page_web=manager_service&action_web=manage_service">

                <i class="fa fa-cog"></i> <span class="link-text">Manage Services</span>
            </a>
            <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=add_service">
                <i class="fa fa-plus"></i> <span class="link-text">Add New Service</span>
            </a>
        </div>

        <button class="accordion">
            <i class="fa fa-users"></i>
            <span class="link-text">User Management</span>
        </button>
        <div class="panel">
            <a href="?page_web=manager_service&action_web=list">
                <?php $page_web = 'list'; ?>
                <i class="fa fa-user"></i> <span class="link-text">Manage Users</span>
            </a>
            <a href="http:\\localhost\baitaplon\index.php?module=admin&action=add">

                <i class="fa fa-user-plus"></i> <span class="link-text">Add New User</span>
            </a>
        </div>

        <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=manage_screening">
            <i class="fa fa-stethoscope"></i>
            <span class="link-text">Manage screening sheets </span>
        </a>
        <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=vaccine_records">
            <i class="fa fa-medkit"></i>
            <span class="link-text">Manage vaccination cards</span>
        </a>
        <a href="http:\\localhost\baitaplon\modules\admin\index.php?page_web=manager_service&action_web=vaccine_records">
            <i class="fa fa-medkit"></i>
            <span class="link-text">Manage invoices</span>
        </a>

        <!-- Accordion for Invoice Management -->


        <a href="?page_web=manager_service&action_web=reports">
            <?php $page_web = 'reports'; ?>
            <i class="fa fa-bar-chart"></i>
            <span class="link-text">Revenue Statistics</span>
        </a>
    </div>

    <!-- Header -->
    <div class="header" id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="http://localhost/baitaplon/assets/image/actvn_big_icon.png" alt="Logo">
                </a>
                <a class="navbar-brand" href="#">Quản lý phòng tiêm chủng an toàn</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="?page_web=manager_service&action_web=home">

                                Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http:\\location\baitaplon\modules\auth\login.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Account Settings</a></li>
                                <li><a class="dropdown-item" href="http:\\localhost\baitaplon\index.php?module=auth&action=logout&loginToken=" .$loginToken>Log out</a></li>


                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Nút thu/hiện sidebar -->
                <button class="btn btn-outline-light" onclick="toggleSidebar()">Toggle Sidebar</button>
            </div>
        </nav>
    </div>

    <!-- Nút thu/hiện sidebar -->
    <button class="btn btn-outline-dark" onclick="toggleSidebar()">Toggle Sidebar</button>
    </div>
    </nav>
    </div>

    <!-- Main Content -->

    </div>