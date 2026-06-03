
<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class = "d-flex">
    <div class="sidebar">
        <div class="logo ps-1">
            <p class = "ps-3 pt-2 fw-bold">Công ty ABC</p>
        </div>

        <ul class = "list-unstyled text-uppercase">
            <!-- Mau -->
            <!-- <li style = "padding: 10px 0;"><a class = "item-link text-decoration-none" href="login"><i class="fa-solid fa-address-card"></i> <span style="color: #333; cursor: pointer;">Sơ yếu lý lịch</span></a></li> -->
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/dashboard"><i class="fa-solid fa-address-card"></i> <span>Trang chủ</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/phong_ban"><i class="fa-solid fa-triangle-exclamation"></i> <span>Quản lý phòng ban</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/nhan_vien"><i class="fa-solid fa-building-user"></i> <span>Quản lý nhân viên</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/nghi_phep"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Nghỉ phép</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/ktkl"><i class="fa-solid fa-list-check"></i> <span>Khen thưởng, kỷ luật</span></a></li>
            <li><a class = "item-link text-decoration-none" href="#"><i class="fa-solid fa-clipboard"></i> <span>Ca làm</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/cham_cong"><i class="fa-regular fa-pen-to-square"></i> <span>Chấm công</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/bang_luong"><i class="fa-regular fa-pen-to-square"></i> <span>Bảng lương</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/vai_tro"><i class="fa-regular fa-pen-to-square"></i> <span>Vai trò</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/tai_khoan"><i class="fa-solid fa-list-check"></i> <span>Tài khoản</span></a></li>
        </ul>
    </div>

    <div class="flex-grow-1 main-content">
        <div class="container-fluid mt-2">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Chi tiết bảng lương</h3>
                    <a href="/ci4_quan_ly_nhan_su/bang_luong" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>Quay lại</a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Nhân viên</th>
                                    <td><?= $bangluong['ho_ten'] ?></td>
                                </tr>

                                <tr>
                                    <th>Kỳ lương</th>
                                    <td>Tháng<?= $bangluong['thang'] ?> / <?= $bangluong['nam'] ?></td>
                                </tr>

                                <tr>
                                    <th>Lương cơ bản</th>
                                    <td><?= number_format($bangluong['luong_co_ban']) ?> VNĐ</td>
                                </tr>

                                <tr>
                                    <th>Phụ cấp</th>
                                    <td><?= number_format($bangluong['phu_cap']) ?> VNĐ</td>
                                </tr>

                                <tr>
                                    <th>Thưởng</th>
                                    <td><?= number_format($bangluong['thuong']) ?> VNĐ</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr><th width="40%">Lương tăng ca</th>
                                    <td><?= number_format($bangluong['luong_tang_ca']) ?> VNĐ</td>
                                </tr>

                                <tr>
                                    <th>Khấu trừ</th>
                                    <td><?= number_format($bangluong['khau_tru']) ?> VNĐ</td>
                                </tr>

                                <tr>
                                    <th>Bảo hiểm</th>
                                    <td><?= number_format($bangluong['bao_hiem']) ?> VNĐ</td>
                                </tr>

                                <tr>
                                    <th>Thuế</th>
                                    <td><?= number_format($bangluong['thue']) ?> VNĐ</td>
                                </tr>

                                <tr>
                                    <th>Lương thực nhận</th>
                                    <td class="fw-bold text-success">
                                        <?= number_format($bangluong['luong_thuc_nhan']) ?> VNĐ
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h5>Trạng thái thanh toán:
                            <?php if($bangluong['trang_thai_thanh_toan']== 'PAID'): ?>
                                <span class="badge bg-success">PAID</span>
                            <?php else: ?>
                                <span class="badge bg-danger">UNPAID</span>
                            <?php endif; ?>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>