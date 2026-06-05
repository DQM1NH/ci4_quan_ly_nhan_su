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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Bảng lương</h3>
                <div class = "mb-3">
                    <?php if(hasPermission('XUAT_BANG_LUONG_EXCEL')): ?>
                        <a href="<?= base_url('bang_luong/export_excel') ?>" class="btn btn-success">Xuất Excel</a>
                    <?php endif; ?>

                    <?php if(hasPermission('XUAT_BANG_LUONG_PDF')): ?>
                        <a href="<?= base_url('bang_luong/export_pdf') ?>" class="btn btn-danger">Xuất PDF</a>
                    <?php endif; ?>

                    <?php if(hasPermission('TAO_BANG_LUONG')): ?>
                        <a href="/ci4_quan_ly_nhan_su/bang_luong/create" class="btn btn-primary">Thêm bảng lương</a>
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
                                <th class = "text-center">Kỳ lương</th>
                                <th class = "text-center">Lương thực nhận</th>
                                <th class = "text-center">Thanh toán</th>
                                <th class = "text-center" width="250">Hành động</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php foreach($bangluongs as $bl): ?>
                            <tr>
                                <td class = "text-center"><?= $bl['bang_luong_id'] ?></td>
                                <td class = "text-center"><?= $bl['ho_ten'] ?></td>
                                <td class = "text-center">Tháng<?= $bl['thang'] ?>/<?= $bl['nam'] ?></td>
                                <td class = "text-center"><b class="text-success"><?= number_format($bl['luong_thuc_nhan']) ?></b></td>
                                <td class = "text-center"><?php if($bl['trang_thai_thanh_toan']== 'PAID'): ?>
                                        <span class="badge bg-success">Đã thanh toán</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Chưa thanh toán</span>
                                    <?php endif; ?>
                                </td>

                                <td class = "text-center">
                                    <a href="/ci4_quan_ly_nhan_su/bang_luong/detail/<?= $bl['bang_luong_id'] ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>

                                    <?php if(hasPermission('CAP_NHAT_BANG_LUONG')): ?>
                                        <a href="/ci4_quan_ly_nhan_su/bang_luong/edit/<?= $bl['bang_luong_id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen"></i></a>
                                    <?php endif; ?>
                
                                    <a href="/ci4_quan_ly_nhan_su/bang_luong/thanh_toan/<?= $bl['bang_luong_id'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-money-bill"></i></a>

                                    <?php if(hasPermission('XOA_BANG_LUONG')): ?>
                                        <a href="/ci4_quan_ly_nhan_su/bang_luong/delete/<?= $bl['bang_luong_id'] ?>" class="btn btn-danger btn-sm btn-delete"><i class="fa-solid fa-trash"></i></a>
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