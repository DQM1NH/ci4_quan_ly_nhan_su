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
                <h4><i class="fa-solid fa-pen"></i>Cập nhật dữ liệu</h4>
            </div>

            <div class="card-body">
                <form action="/ci4_quan_ly_nhan_su/ktkl/update/<?= $ktkl['ktkl_id'] ?>" method="post">
                    <div class="mb-3">
                        <label>Nhân viên</label>
                        <select name="nhan_vien_id" class="form-select">
                            <?php foreach($nhanviens as $nv): ?>
                                <option value="<?= $nv['nhan_vien_id'] ?>"<?= $nv['nhan_vien_id']== $ktkl['nhan_vien_id']? 'selected' : '' ?>><?= $nv['ho_ten'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Loại</label>

                        <select name="loai" class="form-select">
                            <option value="KHEN_THUONG" <?= $ktkl['loai'] == 'KHEN_THUONG' ? 'selected' : '' ?>>Khen thưởng</option>
                            <option value="KY_LUAT" <?= $ktkl['loai']== 'KY_LUAT' ? 'selected' : '' ?>>Kỷ luật</option>
                        </select>

                    </div>

                    <div class="mb-3">
                        <label>Số tiền</label>
                        <input type="number" name="so_tien" value="<?= $ktkl['so_tien'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Lý do</label>
                        <textarea name="ly_do" class="form-control" rows="4"><?= $ktkl['ly_do'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Ngày áp dụng</label>
                        <input type="date" name="ngay_ap_dung" value="<?= $ktkl['ngay_ap_dung'] ?>" class="form-control">
                    </div>

                    <button class="btn btn-primary btn-update">
                        <i class="fa-solid fa-save"></i>Cập nhật
                    </button>
                    <a href="/ci4_quan_ly_nhan_su/ktkl" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-update').forEach(button => {

        button.addEventListener('click', function(e){

            e.preventDefault();

            let form = this.closest('form');
            let url = this.href;

            Swal.fire({
                title: 'Lưu thay đổi?',
                text: 'Dữ liệu sẽ được cập nhật.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Cập nhật',
                cancelButtonText: 'Hủy'
            }).then((result) => {

                if(result.isConfirmed){

                    // nếu là button submit trong form
                    if(form){
                        form.submit();
                    }

                    // nếu là link
                    else if(url){
                        window.location.href = url;
                    }

                }

            });

        });

    });

</script>
<?= $this->endSection() ?>