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
        <div class="container-fluid mt-3">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h3>Chi tiết đơn nghỉ phép</h3>
                    <a href="/ci4_quan_ly_nhan_su/nghi_phep" class="btn btn-secondary">Quay lại</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="250">Nhân viên</th>
                            <td><?= $don['ho_ten'] ?></td>
                        </tr>

                        <tr>
                            <th>Loại nghỉ phép</th>
                            <td><?= $don['ten_loai_nghi'] ?></td>
                        </tr>

                        <tr>
                            <th>Ngày bắt đầu</th>
                            <td><?= $don['ngay_bat_dau'] ?></td>
                        </tr>

                        <tr>
                            <th>Ngày kết thúc</th>
                            <td><?= $don['ngay_ket_thuc'] ?></td>
                        </tr>

                        <tr>
                            <th>Tổng số ngày</th>
                            <td><?= $don['tong_so_ngay'] ?></td>
                        </tr>

                        <tr>
                            <th>Lý do</th>
                            <td><?= $don['ly_do'] ?></td>
                        </tr>

                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                <?php if($don['trang_thai'] == 'APPROVED'): ?><span class="badge bg-success">APPROVED</span>
                                <?php elseif($don['trang_thai'] == 'REJECTED'): ?><span class="badge bg-danger">REJECTED</span>
                                <?php else: ?><span class="badge bg-warning">PENDING</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Ngày duyệt</th>
                            <td><?= $don['ngay_duyet'] ?? '-' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>