<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>
<?= $this->include('layouts/alert') ?>

<div class = "d-flex">
    <div class="sidebar">
        <div class="logo ps-1">
            <p class = "ps-3 pt-2 fw-bold">Công ty ABC</p>
        </div>

        <ul class = "list-unstyled ps-3 text-uppercase">
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
        <div class="container mt-3">
        <div class="card shadow">
            <div class="card-header">
                <h4>Thêm Khen thưởng / Kỷ luật</h4>
            </div>

            <div class="card-body">
                <form action="/ci4_quan_ly_nhan_su/ktkl/store" method="post" id="formKTKL">
                    <div class="mb-3">
                        <label>Nhân viên</label>
                        <select name="nhan_vien_id" class="form-select">
                            <option value="">-- Chọn nhân viên --</option>
                            <?php foreach($nhanviens as $nv): ?>
                                <option value="<?= $nv['nhan_vien_id'] ?>"><?= $nv['ho_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Loại</label>
                        <select name="loai" class="form-select">
                            <option value="KHEN_THUONG">Khen thưởng</option>
                            <option value="KY_LUAT">Kỷ luật</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Số tiền</label>
                        <input type="number" name="so_tien" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Lý do</label>
                        <textarea name="ly_do" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Ngày áp dụng</label>
                        <input type="date" name="ngay_ap_dung" class="form-control">
                    </div>

                    <button class="btn btn-primary"><i class="fa-solid fa-save"></i>Lưu</button>
                    <a href="/ci4_quan_ly_nhan_su/ktkl" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("formKTKL").addEventListener("submit", function(e){

        let maNhanVien = document.querySelector('select[name="nhan_vien_id"]').value.trim();
        let loai = document.querySelector('select[name="loai"]').value.trim();
        let sotien = document.querySelector('input[name="so_tien"]').value;
        let lydo = document.querySelector('textarea[name="ly_do"]').value.trim();
        let ngayapdung = document.querySelector('input[name="ngay_ap_dung"]').value.trim();

        // Kiểm tra rỗng
        if(
            maNhanVien === "" ||
            loai === "" ||
            sotien === "" ||
            lydo === "" ||
            ngayapdung === ""
        ){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập đầy đủ thông tin!'
            });

            return;
        }

        // Kiểm tra so tien
        if(parseFloat(sotien) <= 0){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Số tiền không hợp lệ',
                text: 'Số tiền phải lớn hơn 0!'
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