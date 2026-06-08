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
            <li><a class = "item-link text-decoration-none" href="#"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Nghỉ phép</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/ktkl"><i class="fa-solid fa-list-check"></i> <span>Khen thưởng, kỷ luật</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/cham_cong"><i class="fa-regular fa-pen-to-square"></i> <span>Chấm công</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/bang_luong"><i class="fa-regular fa-pen-to-square"></i> <span>Bảng lương</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/vai_tro"><i class="fa-regular fa-pen-to-square"></i> <span>Vai trò</span></a></li>
            <li><a class = "item-link text-decoration-none" href="/ci4_quan_ly_nhan_su/tai_khoan"><i class="fa-solid fa-list-check"></i> <span>Tài khoản</span></a></li>
        </ul>
    </div>

    <div class="flex-grow-1 main-content">
        <div class="container-fluid mt-2">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Quản lý vai trò</h3>
                <?php if(hasPermission('TAO_VAI_TRO')): ?>
                    <a href="/ci4_quan_ly_nhan_su/vai_tro/create" class="btn btn-primary">Thêm vai trò</a>
                <?php endif; ?>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class = "text-center">ID</th>
                                <th class = "text-center">Tên vai trò</th>
                                <th class = "text-center">Cấp bậc</th>
                                <th class = "text-center">Mô tả</th>
                                <th class = "text-center" width="150">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach($vaitros as $vt): ?>
                            <tr>
                                <td class = "text-center"><?= $vt['vai_tro_id'] ?></td>
                                <td class = "text-center"><?= $vt['ten_vai_tro'] ?></td>
                                <td class = "text-center"><?= $vt['cap_bac'] ?></td>
                                <td class = "text-center"><?= $vt['mo_ta'] ?></td>
                                <td class = "text-center">
                                    <?php if(hasPermission('CAP_NHAT_VAI_TRO')): ?>
                                        <a href="/ci4_quan_ly_nhan_su/vai_tro/edit/<?= $vt['vai_tro_id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if(hasPermission('XOA_VAI_TRO')): ?>
                                        <a href="/ci4_quan_ly_nhan_su/vai_tro/delete/<?= $vt['vai_tro_id'] ?>" class="btn btn-danger btn-sm btn-delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
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