CREATE TABLE `DichVuTiemChung` (
  `id` integer PRIMARY KEY,
  `ten_dich_vu` varchar(255),
  `loai_dich_vu` integer,
  `anh_dich_vu` longblob,
  `gia` decimal(10,2),
  `mo_ta` text,
  `tuoi` integer
);

CREATE TABLE `PhieuKhamSangLoc` (
  `id` integer PRIMARY KEY,
  `ma_khach_hang` integer,
  `ngay_kham` date,
  `ket_qua` text,
  `bac_si_kham` varchar(255)
);

CREATE TABLE `PhieuTiemChung` (
  `id` integer PRIMARY KEY,
  `ma_khach_hang` integer,
  `ma_dich_vu` integer,
  `ngay_tiem` date,
  `ma_phieu_kham_sang_loc` integer,
  `loai_vacxin` varchar(255),
  `bac_si_tiem` varchar(255)
);

CREATE TABLE `HoaDonTiemChung` (
  `id` integer PRIMARY KEY,
  `ma_phieu_tiem_chung` integer,
  `tong_tien` decimal(10,2),
  `ngay_lap` date,
  `trang_thai` varchar(255)
);

CREATE TABLE `KhachHang` (
  `id` integer PRIMARY KEY,
  `ho_ten` varchar(255),
  `ngay_sinh` date,
  `gioi_tinh` varchar(255),
  `dia_chi` varchar(255),
  `so_dien_thoai` varchar(255)
);

CREATE TABLE `DoanhThu` (
  `id` integer PRIMARY KEY,
  `ma_hoa_don` integer,
  `doanh_thu` decimal(10,2),
  `ngay` date
);

ALTER TABLE `PhieuKhamSangLoc` ADD FOREIGN KEY (`ma_khach_hang`) REFERENCES `KhachHang` (`id`);

ALTER TABLE `PhieuTiemChung` ADD FOREIGN KEY (`ma_khach_hang`) REFERENCES `KhachHang` (`id`);

ALTER TABLE `PhieuTiemChung` ADD FOREIGN KEY (`ma_dich_vu`) REFERENCES `DichVuTiemChung` (`id`);

ALTER TABLE `HoaDonTiemChung` ADD FOREIGN KEY (`ma_phieu_tiem_chung`) REFERENCES `PhieuTiemChung` (`id`);

ALTER TABLE `DoanhThu` ADD FOREIGN KEY (`ma_hoa_don`) REFERENCES `HoaDonTiemChung` (`id`);

ALTER TABLE `PhieuTiemChung` ADD FOREIGN KEY (`ngay_tiem`) REFERENCES `PhieuTiemChung` (`ma_khach_hang`);
