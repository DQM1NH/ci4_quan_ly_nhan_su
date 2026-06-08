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
        <div class="container-fluid mt-2">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Cập nhật bảng lương</h3>

                    <form action="/ci4_quan_ly_nhan_su/bang_luong/update/<?= $bangluong['bang_luong_id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nhân viên</label>
                                    <select name="nhan_vien_id" class="form-select">
                                        <?php foreach($nhanviens as $nv): ?>
                                            <option value="<?= $nv['nhan_vien_id'] ?>"
                                                <?= $nv['nhan_vien_id'] == $bangluong['nhan_vien_id'] ? 'selected' : '' ?>>
                                                <?= $nv['ho_ten'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kỳ lương</label>
                                    <select name="ky_luong_id" class="form-select">
                                        <?php foreach($kyluongs as $kl): ?>
                                            <option value="<?= $kl['ky_luong_id'] ?>"
                                                <?= $kl['ky_luong_id'] == $bangluong['ky_luong_id'] ? 'selected': '' ?>>Tháng <?= $kl['thang'] ?>/ <?= $kl['nam'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Lương cơ bản</label>
                                    <input type="number" name="luong_co_ban" value="<?= $bangluong['luong_co_ban'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label"> Phụ cấp </label>
                                    <input type="number" name="phu_cap" value="<?= $bangluong['phu_cap'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Thưởng</label>
                                    <input type="number" name="thuong" value="<?= $bangluong['thuong'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Lương tăng ca</label>
                                    <input type="number" name="luong_tang_ca" value="<?= $bangluong['luong_tang_ca'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Khấu trừ</label>
                                    <input type="number" name="khau_tru" value="<?= $bangluong['khau_tru'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Bảo hiểm</label>
                                    <input type="number" name="bao_hiem" value="<?= $bangluong['bao_hiem'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Thuế</label>
                                    <input type="number" name="thue" value="<?= $bangluong['thue'] ?>" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái thanh toán</label>
                                    <select name="trang_thai_thanh_toan" class="form-select">
                                        <option value="UNPAID"
                                            <?= $bangluong['trang_thai_thanh_toan'] == 'UNPAID' ? 'selected' : '' ?>>UNPAID
                                        </option>

                                        <option value="PAID"
                                            <?= $bangluong['trang_thai_thanh_toan'] == 'PAID' ? 'selected' : '' ?>>PAID
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-update"><i class="fa-solid fa-save"></i>Cập nhật</button>
                        <a href="/ci4_quan_ly_nhan_su/bang_luong" class="btn btn-secondary">Quay lại</a>
                    </form>
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