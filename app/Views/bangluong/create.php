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
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Thêm bảng lương</h3>

                    <form action="/ci4_quan_ly_nhan_su//bang_luong/store" method="post" id="formBangLuong">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label> Nhân viên</label>
                            <select name="nhan_vien_id" class="form-select">
                                <?php foreach($nhanviens as $nv): ?>
                                    <option value="<?= $nv['nhan_vien_id'] ?>"><?= $nv['ho_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Kỳ lương</label>

                            <select name="ky_luong_id" class="form-select">
                                <?php foreach($kyluongs as $kl): ?>
                                    <option value="<?= $kl['ky_luong_id'] ?>">Tháng<?= $kl['thang'] ?>/<?= $kl['nam'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Lương cơ bản</label>
                                <input type="number" name="luong_co_ban" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Phụ cấp</label>
                                <input type="number" name="phu_cap" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Thưởng</label>
                                <input type="number" name="thuong" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Tăng ca</label>
                                <input type="number" name="luong_tang_ca" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Khấu trừ</label>
                                <input type="number" name="khau_tru" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Bảo hiểm</label>
                                <input type="number" name="bao_hiem" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Thuế</label>
                            <input type="number" name="thue" class="form-control">
                        </div>

                        <button class="btn btn-primary"><i class="fa-solid fa-save"></i>Lưu</button>
                        <a href="/ci4_quan_ly_nhan_su/bang_luong" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("formBangLuong").addEventListener("submit", function(e){

        let maNhanVien = document.querySelector('select[name="nhan_vien_id"]').value.trim();
        let makyluong = document.querySelector('select[name="ky_luong_id"]').value.trim();
        let luongcoban = document.querySelector('input[name="luong_co_ban"]').value;
        let phucap = document.querySelector('input[name="phu_cap"]').value.trim();
        let thuong = document.querySelector('input[name="thuong"]').value.trim();
        let tangca = document.querySelector('input[name="luong_tang_ca"]').value.trim();
        let khautru = document.querySelector('input[name="khau_tru"]').value.trim();
        let baohiem = document.querySelector('input[name="bao_hiem"]').value;
        let thue = document.querySelector('input[name="thue"]').value;

        // Kiểm tra rỗng
        if(
            maNhanVien === "" ||
            makyluong === "" ||
            luongcoban === "" ||
            phucap === "" ||
            thuong === "" ||
            tangca === "" ||
            khautru === "" ||
            thue === "" ||
            baohiem === ""
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
        if(parseFloat(luongcoban) <= 0){
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Lương không hợp lệ',
                text: 'Lương phải lớn hơn 0!'
            });

            return;
        }

        // Kiểm tra phụ cấp
        // if(parseFloat(phucap) <= 0){
        //     e.preventDefault();

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Phụ cấp không hợp lệ',
        //         text: 'Phụ cấp phải lớn hơn 0!'
        //     });

        //     return;
        // }

        // Kiểm tra thưởng
        // if(parseFloat(thuong) <= 0){
        //     e.preventDefault();

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Thưởng không hợp lệ',
        //         text: 'Thưởng phải lớn hơn 0!'
        //     });

        //     return;
        // }

        // Kiểm tra tang ca
        // if(parseFloat(tangca) <= 0){
        //     e.preventDefault();

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Tăng ca không hợp lệ',
        //         text: 'Tăng ca phải lớn hơn 0!'
        //     });

        //     return;
        // }

        // Kiểm tra khấu trừ
        // if(parseFloat(khautru) <= 0){
        //     e.preventDefault();

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Khấu trừ không hợp lệ',
        //         text: 'Khấu trừ phải lớn hơn 0!'
        //     });

        //     return;
        // }

        // Kiểm tra thuế
        // if(parseFloat(thue) <= 0){
        //     e.preventDefault();

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Thuế không hợp lệ',
        //         text: 'Thuế phải lớn hơn 0!'
        //     });

        //     return;
        // }

        // Kiểm tra bảo hiểm
        // if(parseFloat(baohiem) <= 0){
        //     e.preventDefault();

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Bảo hiểm không hợp lệ',
        //         text: 'Bảo hiểm phải lớn hơn 0!'
        //     });

        //     return;
        // }

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