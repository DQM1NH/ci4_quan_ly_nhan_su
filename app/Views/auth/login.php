<!DOCTYPE html>
<html>
    <head>
        <title>Đăng nhập</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <h4>ĐĂNG NHẬP</h4>
                        </div>
                        <div class="card-body">
                            <?php if(session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
                            <form action="/ci4_quan_ly_nhan_su/do_login" method="post">
                                <div class="mb-3">
                                    <label>Tên đăng nhập</label>
                                    <input id="username" type="text" name="username" class="form-control" placeholder = "Enter username">
                                </div>

                                <div class="mb-3">
                                    <label>Mật khẩu</label>
                                    <input id="password" type="password" name="password" class="form-control" placeholder = "Enter password">
                                </div>

                                <button class="btn btn-primary w-100"> Đăng nhập </button>
                                <button class="btn btn-primary w-100 mt-2"><a href="/ci4_quan_ly_nhan_su/register" class = "item-link text-decoration-none d-block h-100 w-100" style = "color: #fff; font-size: 16px;">Đăng ký</a></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        const username = document.querySelector('#username');
        const password = document.querySelector('#password');

        username.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                password.focus();
            }
        });
    </script>
</html>