<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/alert') ?>

<div class = "d-flex">
    <div class="sidebar">
        <div class="logo ps-1">
            <p class = "ps-3 pt-2 fw-bold">Công ty ABC</p>
        </div>

        <ul class = "list-unstyled text-uppercase">
            <!-- Mau -->
            <!-- <li style = "padding: 10px 0;"><a class = "item-link text-decoration-none" href="login"><i class="fa-solid fa-address-card"></i> <span style="color: #333; cursor: pointer;">Sơ yếu lý lịch</span></a></li> -->
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/dashboard"><i class="fa-solid fa-address-card"></i> <span>Trang chủ</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/phong_ban"><i class="fa-solid fa-building"></i><span> Quản lý phòng ban</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/nhan_vien"><i class="fa-solid fa-users"></i><span> Quản lý nhân viên</span></a></li>
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Chấm công</h3>
                <div class = "mb-3">
                    <?php if(hasPermission('XUAT_CHAM_CONG_EXCEL')): ?>
                        <a href="<?= base_url('cham_cong/export_excel') ?>" class="btn btn-success"><i class="fa-solid fa-file-excel"></i><span> Xuất Excel</span></a>
                    <?php endif; ?>

                    <?php if(hasPermission('XUAT_CHAM_CONG_PDF')): ?>
                        <a href="<?= base_url('cham_cong/export_pdf') ?>" class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i><span> Xuất PDF</span></a>
                    <?php endif; ?>

                    <?php if(hasPermission('TAO_CHAM_CONG')): ?>
                    <a href="/ci4_quan_ly_nhan_su/cham_cong/create" class="btn btn-primary">Thêm chấm công</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class = "text-center">ID</th>
                                <th class = "text-center">Nhân viên</th>
                                <th class = "text-center">Ca làm</th>
                                <th class = "text-center">Ngày</th>
                                <th class = "text-center">Check In</th>
                                <th class = "text-center">Check Out</th>
                                <th class = "text-center">Giờ làm</th>
                                <th class = "text-center">Trạng thái</th>
                                <th class = "text-center" width="200">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach($chamcongs as $cc): ?>
                            <tr>
                                <td class = "text-center"><?= $cc['cham_cong_id'] ?></td>
                                <td class = "text-center"><?= $cc['ho_ten'] ?></td>
                                <td class = "text-center"><?= $cc['ten_ca'] ?></td>
                                <td class = "text-center"><?= $cc['ngay_cham_cong'] ?></td>
                                <td class = "text-center"><?= $cc['check_in'] ?></td>
                                <td class = "text-center"><?= $cc['check_out'] ?></td>
                                <td class = "text-center"><?= $cc['gio_lam'] ?> giờ</td>
                                <td class = "text-center"><?php 
                                        if($cc['trang_thai'] == 'PRESENT'): 
                                    ?>
                                        <span class="badge bg-success">Present</span>
                                    <?php endif; ?>
                                    <?php 
                                        if($cc['trang_thai'] == 'LATE'): 
                                    ?>
                                        <span class="badge bg-warning">Late</span>
                                    <?php endif; ?>
                                    <?php 
                                        if($cc['trang_thai'] == 'ABSENT'): 
                                    ?>
                                        <span class="badge bg-danger">Absent</span>
                                    <?php endif; ?>
                                </td>
                                <td class = "text-center">
                                    <a href="/ci4_quan_ly_nhan_su/cham_cong/checkin/<?= $cc['cham_cong_id'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-right-to-bracket"></i></a>
                                    <a href="/ci4_quan_ly_nhan_su/cham_cong/checkout/<?= $cc['cham_cong_id'] ?>"class="btn btn-warning btn-sm"><i class="fa-solid fa-right-from-bracket"></i></a>

                                    <?php if(hasPermission('CAP_NHAT_CHAM_CONG')): ?>
                                        <a href="/ci4_quan_ly_nhan_su/cham_cong/edit/<?= $cc['cham_cong_id'] ?>"class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
                                    <?php endif; ?>
                                    
                                    <?php if(hasPermission('XOA_CHAM_CONG')): ?>
                                        <a href="/ci4_quan_ly_nhan_su/cham_cong/delete/<?= $cc['cham_cong_id'] ?>"class="btn btn-danger btn-sm btn-delete"><i class="fa-solid fa-trash"></i></a>
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

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {

        button.addEventListener('click', function(e) {

            e.preventDefault();

            const url = this.getAttribute('href');

            Swal.fire({
                title: 'Bạn chắc chưa?',
                text: "Dữ liệu sẽ bị xóa!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {

                if (result.isConfirmed) {
                    window.location.href = url;
                }

            });

        });

    });
</script>
<?= $this->endSection() ?>