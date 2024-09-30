<div class="content-section">
    <h3>Quản lý Phiếu khám sàng lọc</h3>
    <!-- Form thêm phiếu khám -->
    <form action="" method="POST">
        <div class="mb-3">
            <label for="screeningName" class="form-label">Tên phiếu khám</label>
            <input type="text" class="form-control" id="screeningName" name="screeningName">
        </div>
        <button type="submit" class="btn btn-primary">Thêm phiếu khám</button>
    </form>

    <!-- Bảng liệt kê phiếu khám -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Tên phiếu khám</th>
                <th scope="col">Ngày</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu mẫu -->
            <tr>
                <td>Khám sàng lọc lần 1</td>
                <td>2024-01-01</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="#" class="btn btn-danger btn-sm
