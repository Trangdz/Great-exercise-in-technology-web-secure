<?php
if (defined('_INCODE') != 1) {
    die('Access Denied');
}
if (!isLogin()) {
    header('Location:/../../../../../baitaplon/index.php');
}

// require_once('D:\xampp\htdocs\baitaplon\templates\layout\header-admin.php');
?>
<div class="content-section" id="mainContent">
    <!-- Carousel (Slider) -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active centered-image">
                <img src="http://localhost/baitaplon/assets/image/1.png" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item centered-image">
                <img src="http://localhost/baitaplon/assets/image/2.png" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item centered-image">
                <img src="http://localhost/baitaplon/assets/image/3.png" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Phần Giới thiệu -->
    <section class="intro-section">
        <div class="container">
            <h2>Trung tâm Tiêm chủng Quốc gia</h2>
            <p>Học viện Kỹ thuật Mật mã là trường đại học thuộc hệ thống giáo dục quốc dân, trực thuộc Ban Cơ yếu Chính phủ, thực hiện nhiệm vụ
                đào tạo nguồn nhân lực về lĩnh vực An toàn thông tin và Kỹ thuật mật mã.</p>
        </div>
    </section>

    <!-- Phần Tin tức -->
    <section class="news-section">
        <div class="container">
            <h2>Vaccin <span style="color: #000;">news</span></h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <img src="http://localhost/baitaplon/assets/image/4.png" class="card-img-top" alt="News 1">
                        <div class="card-body">
                            <h5 class="card-title">WORKSHOP - Hướng dẫn viết CV</h5>
                            <p class="card-text">Tham gia để học cách tạo ấn tượng với CV của bạn.</p>
                            <a href="#" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <img src="http://localhost/baitaplon/assets/image/5.png" class="card-img-top" alt="News 2">
                        <div class="card-body">
                            <h5 class="card-title">Ưu đãi mừng lễ Quốc Khánh</h5>
                            <p class="card-text">Giảm giá đặc biệt cho các khóa học trong dịp Quốc Khánh.</p>
                            <a href="#" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <img src="http://localhost/baitaplon/assets/image/6.png" class="card-img-top" alt="News 3">
                        <div class="card-body">
                            <h5 class="card-title">Xuất phát sớm cùng ACT</h5>
                            <p class="card-text">Đăng ký ngay để nhận những ưu đãi khi tham gia các khóa học của ACT.</p>
                            <a href="#" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <img src="http://localhost/baitaplon/assets/image/7.png" class="card-img-top" alt="News 4">
                        <div class="card-body">
                            <h5 class="card-title">Thông báo tuyển dụng</h5>
                            <p class="card-text">Học viện ACT đang tuyển dụng các vị trí cộng tác viên năng động.</p>
                            <a href="#" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Học Viện Kỹ Thuật Mật Mã. All rights reserved.</p>
            <p><a href="#">Chính sách bảo mật</a> | <a href="#">Điều khoản sử dụng</a></p>
        </div>
    </footer>
</div>
<?php

    // require_once('D:\xampp\htdocs\baitaplon\templates\layout\footer-admin.php');
// }
// else
// {
//     redirect('')
// }
