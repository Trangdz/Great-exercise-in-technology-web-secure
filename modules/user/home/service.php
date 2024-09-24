<?php
if (defined('_INCODE') != 1) {
    die('Access Denied');
}
if(!isLogin())
{
    header("Location:http:\\localhost\baitaplon\modules\auth\login.php");
}
require_once(__DIR__ . '/../../../../baitaplon/templates/layout/header.php');
?>

<!-- Sidebar -->
<div class="sidebar">

    <h2>ahahah</h2>
    <a href="?page_web=manager_service&action_web=dashboard" class="active">
        <i class="fa fa-dashboard"></i>
        <span class="link-text">Tất cả</span>
    </a>





    <a href="?page_web=manager_service&action_web=dashboard" class="active">
        <i class="fa fa-cogs"></i>
        <span class="link-text">Tiêm phòng bệnh truyền nhiễm</span>
    </a>

    <a href="?page_web=manager_service&action_web=dashboard" class="active">
        <i class="fa fa-users"></i>
        <span class="link-text">Tiêm chủng cho trẻ em</span>
    </a>



    <a href="?page_web=manager_service&action_web=pre_screening">

        <i class="fa fa-stethoscope"></i>
        <span class="link-text">Tiêm chủng cho người lớn</span>
    </a>
    <a href="?page_web=manager_service&action_web=vaccine_records">

        <i class="fa fa-medkit"></i>
        <span class="link-text">Tiêm chủng du lịch</span>
    </a>

    <!-- Accordion for Invoice Management -->



   
    <button class="accordion">
    <i class="fa fa-bar-chart"></i>
        <span class="link-text">Lịch sử tiêm chủng</span>
</button>
<div class="panel">
    <a href="?page_web=manager_service&action_web=services">
        <?php $page_web = 'services'; ?>
        <i class="fa fa-cog"></i> <span class="link-text">Phiếu khám lâm sàn</span>
    </a>
    <a href="?page_web=manager_service&action_web=add_service">
        <?php $page_web = 'add_service'; ?>
        <i class="fa fa-plus"></i> <span class="link-text">Phiếu tiêm chủng</span>
    </a>
</div>


</div>

<!-- Nội dung chính -->
<div class="content">


    <h5>Bán chạy nhất</h5>
    <div class="best-sellers">
        <!-- Card sản phẩm 1 -->
        <div class="card-service">
            <div class="discount">-20%</div>
            <img src="http://localhost/baitaplon/assets/image/5.png" class="card-img-service" alt="News 2">
            <h6>Bao cao su Sagami Classic</h6>

            <p style="color: red;">118.400đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>

        <!-- Card sản phẩm 2 -->
        <div class="card-service">
            <div class="discount">-20%</div>
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Love Me Gold">
            <h6>Bao cao su Love Me Gold</h6>

            <p style="color: red;">72.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>

        <!-- Card sản phẩm 3 -->
        <div class="card-service">
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Safefit Freezer Max">
            <h6>Bao cao su Safefit Freezer Max</h6>
            <p style="color: red;">49.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>

        <!-- Card sản phẩm 4 -->
        <div class="card-service">
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Safefit 003">
            <h6>Bao cao su Safefit 003</h6>
            <p style="color: red;">59.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>

        <!-- Card sản phẩm 5 -->
        <div class="card-service">
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Safefit 003">
            <h6>Bao cao su Safefit 003</h6>
            <p style="color: red;">19.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>
        <!-- Card sản phẩm 2 -->
        <div class="card-service">
            <div class="discount">-20%</div>
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Love Me Gold">
            <h6>Bao cao su Love Me Gold</h6>

            <p style="color: red;">72.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>

        <!-- Card sản phẩm 3 -->
        <div class="card-service">
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Safefit Freezer Max">
            <h6>Bao cao su Safefit Freezer Max</h6>
            <p style="color: red;">49.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>

        <!-- Card sản phẩm 4 -->
        <div class="card-service">
            <img src="http://localhost/baitaplon/assets/image/1.png" alt="Bao cao su Safefit 003">
            <h6>Bao cao su Safefit 003</h6>
            <p style="color: red;">59.000đ</p>
            <button class="btn btn-primary btn-sm">Xem thêm</button>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="user_manager\templates\js\bootrap.min.js"></script>
<script type="text/javascript" src="user_manager\templates\js\custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl1xI7L4rx0Vn2GMblWlD37x5rH1u5hFozW90QF" crossorigin="anonymous"></script> -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var accordions = document.getElementsByClassName("accordion");

    for (var i = 0; i < accordions.length; i++) {
        accordions[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null; // Thu gọn panel
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px"; // Mở rộng panel
            }
        });
    }
});

</script>


<script type="text/javascript" src="user_manager\templates\js\bootrap.min.js"></script>
<script type="text/javascript" src="user_manager\templates\js\custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl1xI7L4rx0Vn2GMblWlD37x5rH1u5hFozW90QF" crossorigin="anonymous"></script>
<?php
// require_once(__DIR__ . '/../../../../baitaplon/templates/layout/footer.php');
?>