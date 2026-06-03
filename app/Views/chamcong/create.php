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
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Thêm chấm công</h3>
                    <form action="/ci4_quan_ly_nhan_su/cham_cong/store" method="post" id="formChamCong">
                        <?= csrf_field() ?>
                        <div class="mb-3"><label>Nhân viên</label>
                            <select name="nhan_vien_id" class="form-select">
                                <?php foreach($nhanviens as $nv): ?>
                                    <option value="<?= $nv['nhan_vien_id'] ?>"><?= $nv['ho_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Ca làm</label>
                            <select name="ca_lam_id" class="form-select">
                                <?php foreach($calams as $ca): ?>
                                    <option value="<?= $ca['ca_lam_id'] ?>"><?= $ca['ten_ca'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Ngày chấm công</label>
                            <input type="date" name="ngay_cham_cong" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Trạng thái</label>
                            <select name="trang_thai" class="form-select">
                                <option value="PRESENT">PRESENT</option>
                                <option value="LATE">LATE</option>
                                <option value="ABSENT">ABSENT</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Ghi chú</label>
                            <textarea name="ghi_chu" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary"><i class="fa-solid fa-save"></i>Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("formChamCong").addEventListener("submit", function(e){

        let maNhanVien = document.querySelector('select[name="nhan_vien_id"]').value.trim();
        let maCalam = document.querySelector('select[name="ca_lam_id"]').value.trim();
        let ngayChamcong = document.querySelector('input[name="ngay_cham_cong"]').value;
        let trangthai = document.querySelector('select[name="trang_thai"]').value.trim();

        // Kiểm tra rỗng
        if(
            maNhanVien === "" ||
            maCalam === "" ||
            ngayChamcong === "" ||
            trangthai === "" ||
        ){
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
