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
            <!-- <li style = "padding: 10px 0;"><a class = "item-link text-decoration-none" href="login"><i class="fa-solid fa-address-card"></i> <span>Sơ yếu lý lịch</span></a></li> -->
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
            <div class="d-flex justify-content-between mb-3">
                <h3>Danh sách nhân viên</h3>
                <div class = "mb-3">
                    <?php if(hasPermission('XUAT_NHAN_VIEN_EXCEL')): ?>
                        <a href="<?= base_url('nhan_vien/export_excel') ?>" class="btn btn-success">Xuất Excel</a>
                    <?php endif; ?>

                    <?php if(hasPermission('XUAT_NHAN_VIEN_PDF')): ?>
                        <a href="<?= base_url('nhan_vien/export_pdf') ?>" class="btn btn-danger">Xuất PDF</a>
                    <?php endif; ?>

                    <?php if(hasPermission('TAO_NHAN_VIEN')): ?>
                        <a href="/ci4_quan_ly_nhan_su/nhan_vien/create" class="btn btn-primary"> Thêm nhân viên</a>
                    <?php endif; ?>
                </div>
            </div>
         
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class = "text-center">Mã NV</th>
                                <th class = "text-center">Họ tên</th>
                                <th class = "text-center">Phòng ban</th>
                                <th class = "text-center">Vai trò</th>
                                <th class = "text-center">Lương</th>
                                <th class = "text-center">Action</th>
                            </tr>
                        </thead>
                                
                        <tbody>
                            <?php foreach($nhanviens as $nv): ?>
                                <tr>
                                    <td class = "text-center"><?= $nv['ma_nhan_vien'] ?></td>
                                    <td class = "text-center"><?= $nv['ho_ten'] ?></td>
                                    <td class = "text-center"><?= $nv['ten_phong_ban'] ?></td>
                                    <td class = "text-center"><?= $nv['ten_vai_tro'] ?></td>
                                    <td class = "text-center"><?= number_format($nv['luong']) ?></td>
                                    <?php if(hasPermission('XOA_NHAN_VIEN')): ?>
                                        <td class = "text-center"><a href="/ci4_quan_ly_nhan_su/nhan_vien/delete/<?= $nv['nhan_vien_id'] ?>" class="btn btn-danger btn-sm btn-delete"> Xóa </a></td>
                                    <?php endif; ?>
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