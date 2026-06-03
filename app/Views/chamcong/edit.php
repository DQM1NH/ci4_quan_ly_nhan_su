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
        <div class="container-fluid mt-2">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Cập nhật chấm công</h3>
                    <form action="/ci4_quan_ly_nhan_su/cham_cong/update/<?= $chamcong['cham_cong_id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nhân viên</label>
                            <select name="nhan_vien_id" class="form-select">
                                <?php foreach($nhanviens as $nv): ?>
                                    <option
                                        value="<?= $nv['nhan_vien_id'] ?>"
                                        <?= $nv['nhan_vien_id'] == $chamcong['nhan_vien_id'] ? 'selected' : '' ?>>
                                        <?= $nv['ho_ten'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ca làm</label>
                            <select name="ca_lam_id" class="form-select">
                                <?php foreach($calams as $ca): ?>
                                    <option
                                        value="<?= $ca['ca_lam_id'] ?>"
                                        <?= $ca['ca_lam_id'] == $chamcong['ca_lam_id'] ? 'selected': '' ?>>
                                        <?= $ca['ten_ca'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ngày chấm công</label>
                            <input type="date" name="ngay_cham_cong" value="<?= $chamcong['ngay_cham_cong'] ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"> Check In </label>
                            <input type="datetime-local" name="check_in" value="<?= date('Y-m-d\TH:i', strtotime($chamcong['check_in'])) ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Check Out</label>
                            <input type="datetime-local" name="check_out" value="<?= $chamcong['check_out'] ? date('Y-m-d\TH:i', strtotime($chamcong['check_out'])): '' ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="trang_thai" class="form-select">
                                <option value="PRESENT" <?= $chamcong['trang_thai'] == 'PRESENT' ? 'selected' : '' ?>>PRESENT</option>
                                <option value="LATE" <?= $chamcong['trang_thai'] == 'LATE' ? 'selected' : '' ?>>LATE</option>
                                <option value="ABSENT" <?= $chamcong['trang_thai'] == 'ABSENT' ? 'selected' : '' ?>>ABSENT</option>
                                <option value="EARLY_LEAVE" <?= $chamcong['trang_thai'] == 'EARLY_LEAVE' ? 'selected' : '' ?>>EARLY_LEAVE</option>
                                <option value="OVERTIME" <?= $chamcong['trang_thai'] == 'OVERTIME' ? 'selected' : '' ?>>OVERTIME</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="ghi_chu" rows="4" class="form-control"><?= $chamcong['ghi_chu'] ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-update">
                            <i class="fa-solid fa-save"></i>Cập nhật
                        </button>

                        <a href="/ci4_quan_ly_nhan_su/cham_cong" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
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