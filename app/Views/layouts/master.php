<!DOCTYPE html>
<html>
<head>
    <title>Quản lý nhân sự</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/fontawesome/css/all.min.css') ?>">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand"> QUẢN LÝ NHÂN SỰ </a>
            <div class="text-white">
                <a href="/ci4_quan_ly_nhan_su/logout" class="text-white text-decoration-none"><i class="fa-solid fa-right-from-bracket"></i><span> Đăng xuất</span></a>
            </div>
        </div>
    </nav>
    <?= $this->renderSection('content') ?>
</body>

</html>