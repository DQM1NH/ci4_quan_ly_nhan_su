<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4"> Đăng ký tài khoản</h3>

                        <form action="/ci4_quan_ly_nhan_su/process_register" method="post" enctype="multipart/form-data" id="formRegister">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Họ tên</label>
                                    <input type="text" name="ho_ten" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Giới tính</label>
                                    <select name="gioi_tinh" class="form-select">
                                        <option value="NAM">Nam</option>
                                        <option value="NU">Nữ</option>
                                        <option value="KHAC">Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Ngày sinh</label>
                                    <input type="date"name="ngay_sinh"class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="so_dien_thoai" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label> Địa chỉ </label>
                                <textarea name="dia_chi" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Tên đăng nhập</label>
                                    <input type="text" name="ten_dang_nhap" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label> Mật khẩu</label>
                                    <input type="password" name="mat_khau" class="form-control">
                                </div>
                            </div>

                            <button class="btn btn-primary w-100" type ="submit"><span>Đăng ký</span></button>

                            <div class="text-center mt-3">
                                <!-- <a href="/login">Đã có tài khoản?</a> -->
                                <a href="/ci4_quan_ly_nhan_su/login">Đã có tài khoản?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    let isSubmitting = false;

    document.getElementById("formRegister").addEventListener("submit", function(e){
        if (isSubmitting) return;
        e.preventDefault();
        if (isSubmitting) return;
        let hoten = document.querySelector('input[name="ho_ten"]').value.trim();
        let gioitinh = document.querySelector('select[name="gioi_tinh"]').value.trim();
        let ngaysinh = document.querySelector('input[name="ngay_sinh"]').value.trim();
        let sdt = document.querySelector('input[name="so_dien_thoai"]').value.trim();
        let email = document.querySelector('input[name="email"]').value.trim();
        let diachi = document.querySelector('textarea[name="dia_chi"]').value.trim();
        let tendn = document.querySelector('input[name="ten_dang_nhap"]').value.trim();
        let password = document.querySelector('input[name="mat_khau"]').value.trim();

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // SĐT bắt đầu bằng 0 và đủ 10 số
        let phoneRegex = /^0\d{9}$/;

        // Password mạnh
        let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{8,}$/;

        // Kiểm tra rỗng
        if(hoten === "" || gioitinh === "" || ngaysinh === "" || sdt === "" ||
            email === "" || diachi === "" || tendn === "" || password === ""
        ){
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập đầy đủ thông tin!'
            });

            return;
        }

        // Kiểm tra email
        if(!emailRegex.test(email)){

            Swal.fire({
                icon: 'error',
                title: 'Email không hợp lệ',
                text: 'Vui lòng nhập đúng định dạng email!'
            });

            return;
        }

        // Kiểm tra số điện thoại
        if(!phoneRegex.test(sdt)){

            Swal.fire({
                icon: 'error',
                title: 'Số điện thoại không hợp lệ',
                text: 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0!'
            });

            return;
        }

        // Kiểm tra password
        if(!passRegex.test(password)){

            Swal.fire({
                icon: 'error',
                title: 'Mật khẩu không hợp lệ',
                text: 'Mật khẩu tối thiểu 8 ký tự, có chữ hoa, chữ thường, số và ký tự đặc biệt!'
            });

            return;
        }

        // Kiểm tra tuổi >= 18
        let today = new Date();
        let birthDate = new Date(ngaysinh);

        let age = today.getFullYear() - birthDate.getFullYear();

        if(age < 18){

            Swal.fire({
                icon: 'warning',
                title: 'Không đủ tuổi',
                text: 'Người dùng phải đủ 18 tuổi!'
            });

            return;
        }

        // Thành công
        Swal.fire({
            icon: 'success',
            title: 'Đăng ký thành công',
            text: 'Dữ liệu hợp lệ!',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            isSubmitting = true;
            document.getElementById("formRegister").submit();
        });
    });
</script>

</html>