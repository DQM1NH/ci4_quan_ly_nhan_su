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
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Thêm nhân viên</h3>

                    <form action="/ci4_quan_ly_nhan_su/nhan_vien/store" method="post" id="formNhanVien">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Mã nhân viên</label>
                                <input type="text" name="ma_nhan_vien" class="form-control" placeholder = "Mã nhân viên">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Họ tên</label>
                                <input type="text" name="ho_ten" class="form-control" placeholder = "Nhập họ và tên">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Giới tính</label>
                                <select name="gioi_tinh" class="form-select">
                                    <option value="NAM">Nam</option>
                                    <option value="NU">Nữ</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Ngày sinh</label>
                                <input type="date" name="ngay_sinh" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Lương</label>
                                <input type="number" name="luong" class="form-control" placeholder = "Nhập lương">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder = "Nhập email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Số điện thoại</label>
                                <input type="text" name="so_dien_thoai" class="form-control" placeholder = "Nhập số điện thoại">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <textarea name="dia_chi" class="form-control"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Phòng ban</label>
                                <select name="phong_ban_id" class="form-select">
                                    <?php foreach($phongbans as $pb): ?>
                                        <option value="<?= $pb['phong_ban_id'] ?>">
                                            <?= $pb['ten_phong_ban'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Vai trò</label>
                                <select name="vai_tro_id" class="form-select">
                                    <?php foreach($vaitros as $vt): ?>
                                        <option value="<?= $vt['vai_tro_id'] ?>"><?= $vt['ten_vai_tro'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Trạng thái</label>
                                <select name="trang_thai" class="form-select">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Ngày vào làm</label>
                            <input type="date" name="ngay_vao_lam" class="form-control">
                        </div>

                        <button class="btn btn-primary"><i class="fa-solid fa-save"></i>Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("formNhanVien").addEventListener("submit", function(e){

        let maNhanVien = document.querySelector('input[name="ma_nhan_vien"]').value.trim();
        let hoTen = document.querySelector('input[name="ho_ten"]').value.trim();
        let ngaySinh = document.querySelector('input[name="ngay_sinh"]').value;
        let luong = document.querySelector('input[name="luong"]').value.trim();
        let email = document.querySelector('input[name="email"]').value.trim();
        let soDienThoai = document.querySelector('input[name="so_dien_thoai"]').value.trim();
        let diaChi = document.querySelector('textarea[name="dia_chi"]').value.trim();
        let ngayVaoLam = document.querySelector('input[name="ngay_vao_lam"]').value;

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // SĐT bắt đầu bằng 0 và đủ 10 số
        let phoneRegex = /^0\d{9}$/;

        // Kiểm tra rỗng
        if(
            maNhanVien === "" ||
            hoTen === "" ||
            ngaySinh === "" ||
            luong === "" ||
            email === "" ||
            soDienThoai === "" ||
            diaChi === "" ||
            ngayVaoLam === ""
        ){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập đầy đủ thông tin!'
            });

            return;
        }

        // Kiểm tra lương
        if(parseFloat(luong) <= 0){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Lương không hợp lệ',
                text: 'Lương phải lớn hơn 0!'
            });

            return;
        }

        // Kiểm tra email
        if(!emailRegex.test(email)){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Email không hợp lệ',
                text: 'Vui lòng nhập đúng định dạng email!'
            });

            return;
        }

        // Kiểm tra số điện thoại
        if(!phoneRegex.test(soDienThoai)){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Số điện thoại không hợp lệ',
                text: 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0!'
            });

            return;
        }

        // Kiểm tra tuổi >= 18
        let today = new Date();
        let birthDate = new Date(ngaySinh);

        let age = today.getFullYear() - birthDate.getFullYear();

        if(age < 18){
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Không đủ tuổi',
                text: 'Nhân viên phải đủ 18 tuổi!'
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