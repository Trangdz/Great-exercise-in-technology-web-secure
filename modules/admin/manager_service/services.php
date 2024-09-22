<div class="content-section">
    <h3>Quản lý Dịch vụ tiêm chủng</h3>
    <!-- Form thêm dịch vụ -->
    <form action="" method="POST">
        <div class="mb-3">
            <label for="serviceName" class="form-label">Tên dịch vụ</label>
            <input type="text" class="form-control" id="serviceName" name="serviceName">
        </div>
        <div class="mb-3">
            <label for="servicePrice" class="form-label">Giá dịch vụ</label>
            <input type="number" class="form-control" id="servicePrice" name="servicePrice">
        </div>
        <button type="submit" class="btn btn-primary">Thêm dịch vụ</button>
    </form>

    <!-- Bảng liệt kê dịch vụ -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">Tên dịch vụ</th>
                <th scope="col">Giá</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu mẫu, bạn có thể thay bằng dữ liệu từ cơ sở dữ liệu -->
            <tr>
                <td>Tiêm chủng cơ bản</td>
                <td>500,000 VND</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
