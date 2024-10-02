<?php
if (!defined('_INCODE') == 1) {
    die('Access denied');
}
if (!isLogin()) {
    redirect('\baitaplon\index.php?module=auth&action=login');
}

// Lấy dữ liệu từ session
$ma_khach_hang = $_SESSION['ma_khach_hang'];
$ma_vacxin = $_SESSION['ma_vacxin'];

// Lấy thông tin phiếu tiêm và khách hàng
$getPhieuTiemChung = firstRaw("SELECT * FROM phieutiemchung WHERE ma_khach_hang='$ma_khach_hang' AND ma_vacxin='$ma_vacxin'");
$getCusInfor = firstRaw("SELECT * FROM user WHERE id='$ma_khach_hang'");
$ten_vacxin = $getPhieuTiemChung['ten_vacxin'];

// Lấy thông tin giá của loại vắc xin
$getLoaiVaxin = firstRaw("SELECT gia FROM dichvutiemchung WHERE ten_vacxin='$ten_vacxin'");
$dataHoaDon = [
    'ma_phieu_tiem_chung' => $getPhieuTiemChung['id'],
    'ten_khach_hang' => $getCusInfor['fullname'],
    'so_dien_thoai' =>$getCusInfor['phone'],
    'ten_vacxin' => $getPhieuTiemChung['ten_vacxin'],
    'ngay_lap' => $getPhieuTiemChung['ngay_tiem'],
    'tong_tien' => $getLoaiVaxin['gia'],
];
// Chuẩn bị dữ liệu để chèn vào hóa đơnif
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    // Thực hiện chèn dữ liệu hóa đơn (tùy chọn nếu cần lưu vào database)
    $resultInsert = insert('hoadontiemchung', $dataHoaDon);
    if ($resultInsert) {
        setFlashData('msg', 'Bạn đã lập hoá đơn');
        setFlashData('msg_type', 'success');
    } else {
        setFlashData('msg', 'Bạn lập hóa đơn thất bại');
        setFlashData('msg_type', 'danger');
    }
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn Thanh Toán</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .invoice-header {
            background-color: #28a745;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-body {
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .invoice-body label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .invoice-body input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        .invoice-body input:disabled {
            background-color: #e9ecef;
        }

        .invoice-footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .submit-button {
            background-color: #218838;
            color: black;
            padding: 12px 24px;
            font-size: 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin: 10px;
            /* transition: background-color 0.3s ease; */
    
        }

        .submit-button:hover {
            background-color: #28a745;

        }

        .full-width {
            /* grid-column: 1 / span 2; */
            display: flex;
    justify-content: center;
    align-items: center;
        }

        .invoice-body div {
            margin-bottom: 20px;
        }
        .input-bill{
            margin: 20px;
        }
        .back{
            background-color: red;
        }
    </style>
</head>

<body>

    <div class="invoice-container">
        <div class="invoice-header">
            Hóa Đơn Thanh Toán
        </div>
        <?php getMsg($msg, $msg_type); ?>
        <form action="" method="POST">
            <div class="invoice-body">
                <div class="input-bill">
                    <label for="ma_phieu_tiem_chung">Mã phiếu tiêm chủng:</label>
                    <input type="text" name="ma_phieu_tiem_chung" id="ma_phieu_tiem_chung" value="<?php echo htmlspecialchars($dataHoaDon['ma_phieu_tiem_chung']); ?>" disabled>
                </div>

                <div class="input-bill">
                    <label for="ten_khach_hang">Tên khách hàng:</label>
                    <input type="text" name="ten_khach_hang" id="ten_khach_hang" value="<?php echo htmlspecialchars($dataHoaDon['ten_khach_hang']); ?>" disabled>
                </div>

                <div class="input-bill">
                    <label for="ten_vacxin">Tên vắc xin:</label>
                    <input type="text" name="ten_vacxin" id="ten_vacxin" value="<?php echo htmlspecialchars($dataHoaDon['ten_vacxin']); ?>" disabled>
                </div>

                <div class="input-bill">
                    <label for="tong_tien">Tổng tiền:</label>
                    <input type="text" name="tong_tien" id="tong_tien" value="<?php echo htmlspecialchars(number_format($dataHoaDon['tong_tien'], 0, ',', '.')) . ' VND'; ?>" disabled>
                </div>

                <div class="input-bill">
                    <label for="ngay_lap">Ngày lập:</label>
                    <input type="text" name="ngay_lap" id="ngay_lap" value="<?php echo htmlspecialchars($dataHoaDon['ngay_lap']); ?>" disabled>
                </div>

                <div class="input-bill">
                    <label for="trang_thai">Số điện thoại</label>
                    <input type="text" name="so_dien_thoai" value="<?php echo htmlspecialchars($getCusInfor['phone']); ?>" disabled>
                </div>

                
            </div>
            <div class="full-width">
                    <button type="submit" class="submit-button ">Xác nhận</button>
                    <button type="button" class="submit-button back" onclick="history.back();" >Quay lại</button>
                </div>
        </form>
        <div class="invoice-footer">
            Cảm ơn quý khách đã sử dụng dịch vụ!
        </div>
    </div>

</body>

</html>