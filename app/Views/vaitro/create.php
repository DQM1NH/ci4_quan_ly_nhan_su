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
                <div class="card-body">
                    <h3 class="mb-4">Thêm vai trò</h3>

                    <form action="/ci4_quan_ly_nhan_su/vai_tro/store" method="post" id="formVaiTro">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label>Tên vai trò</label>
                            <input type="text" name="ten_vai_tro" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Cấp bậc</label>
                            <input type="number" name="cap_bac" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Mô tả</label>
                            <textarea name="mo_ta" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary"><i class="fa-solid fa-save"></i>Lưu</button>
                        <a href="/ci4_quan_ly_nhan_su/phong_ban" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("formVaiTro").addEventListener("submit", function(e){

        let tenvaitro = document.querySelector('input[name="ten_vai_tro"]').value.trim();
        let capbac = document.querySelector('input[name="cap_bac"]').value.trim();
        let mota = document.querySelector('textarea[name="mo_ta"]').value.trim();

        // Kiểm tra rỗng
        if(tenvaitro === "" ||capbac ==="" || capbac === ""){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập đầy đủ thông tin!'
            });

            return;
        }

        // Thành công
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: 'Dữ liệu hợp lệ!',
            timer: 1500,
            showConfirmButton: false
        });
    });
</script>

<?= $this->endSection() ?>