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
            <li><a class = "item-link text-decoration-none" href="#"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Nghỉ phép</span></a></li>
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
            <div class="d-flex justify-content-between mb-3">
                <h3>Danh sách tài khoản</h3>
                <div class = "mb-3">
                    <?php if(hasPermission('XUAT_TAI_KHOAN_EXCEL')): ?>
                        <a href="<?= base_url('tai_khoan/export_excel') ?>" class="btn btn-success">Xuất Excel</a>
                    <?php endif; ?>

                    <?php if(hasPermission('XUAT_TAI_KHOAN_PDF')): ?>
                        <a href="<?= base_url('tai_khoan/export_pdf') ?>" class="btn btn-danger">Xuất PDF</a>
                    <?php endif; ?>
                </div>
            </div>
                    
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class = "text-center">ID</th>
                                <th class = "text-center">Tên đăng nhập</th>
                                <th class = "text-center">Họ tên</th>
                                <th class = "text-center">Vai trò</th>
                                <th class = "text-center">Phòng ban</th>
                                <th class = "text-center">Trạng thái</th>
                            </tr>
                        </thead>
                                
                        <tbody>
                            <?php foreach($taikhoans as $tk): ?>
                            <tr>
                                <td class = "text-center"><?= $tk['tai_khoan_id'] ?></td>
                                <td class = "text-center"><?= $tk['ten_dang_nhap'] ?></td>
                                <td class = "text-center"><?= $tk['ho_ten'] ?></td>
                                <td class = "text-center"><?= $tk['ten_vai_tro'] ?></td>
                                <td class = "text-center"><?= $tk['ten_phong_ban'] ?></td>
                                <td class = "text-center">
                                    <?php if($tk['khoa'] == 0): ?>
                                        <span class="badge bg-success">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Đã khóa</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>