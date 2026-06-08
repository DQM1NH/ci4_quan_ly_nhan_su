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
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/phong_ban"><i class="fa-solid fa-building"></i> <span>Quản lý phòng ban</span></a></li>
            <?php if(hasPermission('XEM_NHAN_VIEN')): ?>
                <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/nhan_vien"><i class="fa-solid fa-users"></i> <span>Quản lý nhân viên</span></a></li>
            <?php endif; ?>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/nghi_phep"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Nghỉ phép</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/ktkl"><i class="fa-solid fa-list-check"></i> <span>Khen thưởng, kỷ luật</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/cham_cong"><i class="fa-regular fa-pen-to-square"></i> <span>Chấm công</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/bang_luong"><i class="fa-regular fa-pen-to-square"></i> <span>Bảng lương</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/vai_tro"><i class="fa-regular fa-pen-to-square"></i> <span>Vai trò</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/tai_khoan"><i class="fa-solid fa-list-check"></i> <span>Tài khoản</span></a></li>
        </ul>
    </div>

    <div class="flex-grow-1 main-content">
        <div class="container-fluid mt-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="fa-solid fa-chart-line"></i>Dashboard</h3>
                <div>Xin chào,
                    <b><?= session()->get('ho_ten') ?></b>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card shadow dashboard-card bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Nhân viên</h5>
                                    <h2><?= $tongNhanVien ?></h2>
                                </div>

                                <div><i class="fa-solid fa-users fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PHONG BAN -->
                <div class="col-md-3 mb-3">
                    <div class="card shadow dashboard-card bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Phòng ban</h5>
                                    <h2><?= $tongPhongBan ?></h2>
                                </div>

                                <div>
                                    <i class="fa-solid fa-building fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAI KHOAN -->
                <div class="col-md-3 mb-3">
                    <div class="card shadow dashboard-card bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Tài khoản</h5>
                                    <h2><?= $tongTaiKhoan ?></h2>
                                </div>

                                <div>
                                    <i class="fa-solid fa-user fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LUONG -->

                <div class="col-md-3 mb-3">
                    <div class="card shadow dashboard-card bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Tổng lương</h5>
                                    <h4><?= number_format($tongLuong) ?></h4>
                                </div>
                                <div><i class="fa-solid fa-money-bill fa-3x"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 2 -->

            <div class="row">
                <!-- ACTIVE -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Trạng thái nhân viên</h5>
                        </div>

                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h1 class="text-success"><?= $tongActive ?></h1>
                                    <p>Active</p>
                                </div>

                                <div class="col-6">
                                    <h1 class="text-danger"><?= $tongInactive ?></h1>
                                    <p>Inactive</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CHART -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Nhân viên theo phòng ban</h5>
                        </div>

                        <div class="card-body">
                            <canvas id="departmentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 3 -->
            <div class="row">
                <!-- NHAN VIEN MOI -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Nhân viên mới</h5>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Mã NV</th>
                                        <th>Họ tên</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($nhanVienMoi as $nv): ?>
                                        <tr>
                                            <td><?= $nv['ma_nhan_vien'] ?></td>
                                            <td><?= $nv['ho_ten'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- DON NGHI -->
                <div class="col-md-6 mb-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Đơn nghỉ phép mới</h5>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nhân viên</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($donNghiMoi as $item): ?>
                                        <tr>
                                            <td><?= $item['ho_ten'] ?></td>
                                            <td>
                                                <?php if($item['trang_thai'] == 'PENDING'): ?><span class="badge bg-warning">Pending</span>
                                                <?php endif; ?>
                                                <?php if($item['trang_thai'] == 'APPROVED'): ?><span class="badge bg-success">Appreved</span>
                                                <?php endif; ?>
                                                <?php if($item['trang_thai'] == 'REJECTED'): ?><span class="badge bg-danger">Rejected</span>
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
    </div>
</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('departmentChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $labels ?>,
            datasets: [{
                label: 'Nhân viên',
                data: <?= $dataChart ?>,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
<?= $this->endSection() ?>