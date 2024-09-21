<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'services'; // Lấy trang hiện tại từ URL, mặc định là quản lý dịch vụ
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
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
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
        .content-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .content-section h3 {
            font-size: 1.6rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h2>Admin Panel</h2>
        <a href="?page=services">Quản lý Dịch vụ tiêm chủng</a>
        <a href="?page=pre_screening">Quản lý Phiếu khám sàng lọc</a>
        <a href="?page=vaccine_records">Quản lý Phiếu tiêm chủng</a>
        <a href="?page=bills">Quản lý Hóa đơn</a>
        <a href="?page=reports">Thống kê Doanh thu</a>
    </nav>

    <!-- Content Area -->
    <div class="content">
        <!-- Navbar with Collapse -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Quản lý phòng tiêm chủng an toàn</a>
            </div>
        </nav>

        <!-- Content sections -->
        <div class="container mt-4">
            <?php
            // Hiển thị nội dung dựa vào trang được chọn
            switch($page) {
                case 'services':
                    include 'services.php'; // Quản lý dịch vụ
                    break;
                case 'pre_screening':
                    include 'pre_screening.php'; // Quản lý phiếu khám sàng lọc
                    break;
                case 'vaccine_records':
                    include 'vaccine_records.php'; // Quản lý phiếu tiêm chủng
                    break;
                case 'bills':
                    include 'bills.php'; // Quản lý hóa đơn
                    break;
                case 'reports':
                    include 'reports.php'; // Thống kê doanh thu
                    break;
                default:
                    include 'services.php'; // Mặc định là dịch vụ
                    break;
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
