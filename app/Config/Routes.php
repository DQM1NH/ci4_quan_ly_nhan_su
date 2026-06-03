<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// TEST
// $routes->get('/', 'Home::index');
// $routes->get('/nhanvien', 'NhanVienController::index');
// $routes->get('/taikhoan', 'TaiKhoanController::index');
// $routes->get('/phongban', 'PhongBanController::index');
// $routes->get('/phongban/create', 'PhongBanController::create');
// $routes->get('/phongban/edit', 'PhongBanController::edit');
// $routes->get('/ktkl', 'KTKLController::index');
// $routes->get('/register', 'AuthController::register');
// $routes->get( '/dashboard', 'DashboardController::index');
// $routes->get( '/bangluong', 'BangLuongController::index');
// $routes->get( '/chamcong', 'ChamCongController::index');
// $routes->get( '/cham_cong/create', 'ChamCongController::create');
// $routes->post('/do_login', 'AuthController::processLogin');
// $routes->get('/logout', 'AuthController::logout');


$routes->setAutoRoute(true);

// =========================================
// AUTH
// =========================================
$routes->get('/login', 'AuthController::login');
$routes->post('/do_login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::register');
$routes->post('/process_register', 'AuthController::processRegister');

// =========================================
// ROUTE CAN LOGIN
// =========================================
$routes->group('', ['filter' => 'auth'], function($routes){

    // DASHBOARD
    $routes->get( '/dashboard', 'DashboardController::index');

    // =========================================
    // NHAN VIEN
    // =========================================
    $routes->group('nhan_vien', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'NhanVienController::index', [
            'filter' => 'permission:XEM_NHAN_VIEN']);
        $routes->get('create', 'NhanVienController::create', [
            'filter' => 'permission:TAO_NHAN_VIEN'
        ]);
        $routes->post('store', 'NhanVienController::store');
        $routes->get('edit/(:num)', 'NhanVienController::edit/$1', [
            'filter' => 'permission:CAP_NHAT_NHAN_VIEN'
        ]);
        $routes->post('update/(:num)', 'NhanVienController::update/$1');
        $routes->get('delete/(:num)', 'NhanVienController::delete/$1', [
            'filter' => 'permission:XOA_NHAN_VIEN'
        ]);
        $routes->get('detail/(:num)', 'NhanVienController::detail/$1');

        $routes->get('export_excel', 'NhanVienController::exportExcel', [
            'filter' => 'permission:XUAT_NHAN_VIEN_EXCEL'
        ]);
        $routes->get('export_pdf', 'NhanVienController::exportPDF', [
            'filter' => 'permission:XUAT_NHAN_VIEN_PDF'
        ]);
    });

    // =========================================
    // TAI KHOAN
    // =========================================
    $routes->group('tai_khoan', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'TaiKhoanController::index', [
                    'filter' => 'permission:XEM_TAI_KHOAN'
        ]);
        $routes->get('create', 'TaiKhoanController::create');
        $routes->post('store', 'TaiKhoanController::store');
        $routes->get('delete/(:num)', 'TaiKhoanController::delete/$1');

        $routes->get('export_excel', 'TaiKhoanController::exportExcel', [
                    'filter' => 'permission:XUAT_TAI_KHOAN_EXCEL'
        ]);
        $routes->get('export_pdf', 'TaiKhoanController::exportPDF', [
                    'filter' => 'permission:XUAT_TAI_KHOAN_PDF'
        ]);
    });

    // =========================================
    // LUONG
    // =========================================
    $routes->group('bang_luong', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'BangLuongController::index', [
            'filter' => 'permission:XEM_BANG_LUONG'
        ]);
        $routes->get('create', 'BangLuongController::create', [
                    'filter' => 'permission:TAO_BANG_LUONG'
        ]);
        $routes->post('store', 'BangLuongController::store');
        $routes->get('edit/(:num)', 'BangLuongController::edit/$1', [
                    'filter' => 'permission:CAP_NHAT_BANG_LUONG'
        ]);
        $routes->post('update/(:num)', 'BangLuongController::update/$1');
        $routes->get('delete/(:num)', 'BangLuongController::delete/$1', [
                'filter' => 'permission:XOA_BANG_LUONG'
        ]);
        $routes->get('detail/(:num)', 'BangLuongController::detail/$1');
        $routes->get('tinh_luong/(:num)', 'BangLuongController::tinhLuong/$1');
        $routes->get('thanh_toan/(:num)', 'BangLuongController::thanhToan/$1');
        $routes->get('export_excel', 'BangLuongController::exportExcel', [
            'filter' => 'permission:XUAT_BANG_LUONG_EXCEL'
        ]);
        $routes->get('export_pdf', 'BangLuongController::exportPDF', [
            'filter' => 'permission:XUAT_BANG_LUONG_PDF'
        ]);
    });

    // =========================================
    // KHEN THUONG - KY LUAT
    // =========================================
    $routes->group('ktkl', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'KTKLController::index', [
                'filter' => 'permission:XEM_KTKL'
        ]);
        $routes->get('create','KTKLController::create', [
                'filter' => 'permission:TAO_KTKL'
        ]);
        $routes->post('store','KTKLController::store');
        $routes->get('edit/(:num)','KTKLController::edit/$1', [
                'filter' => 'permission:CAP_NHAT_KTKL'
        ]);
        $routes->post('update/(:num)','KTKLController::update/$1');
        $routes->get('delete/(:num)','KTKLController::delete/$1', [
                'filter' => 'permission:XOA_KTKL'
        ]);

        $routes->get('export_excel', 'KTKLController::exportExcel', [
                'filter' => 'permission:XUAT_KTKL_EXCEL'
        ]);
        $routes->get('export_pdf', 'KTKLController::exportPDF', [
                'filter' => 'permission:XUAT_KTKL_PDF'
        ]);
    });

    // =========================================
    // PHONG BAN
    // =========================================
    $routes->group('phong_ban', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'PhongBanController::index', [
                'filter' => 'permission:XEM_PHONG_BAN'
        ]);
        $routes->get('create', 'PhongBanController::create', [
            'filter' => 'permission:TAO_PHONG_BAN'
        ]);
        $routes->post('store', 'PhongBanController::store');
        $routes->get('edit/(:num)', 'PhongBanController::edit/$1', [
            'filter' => 'permission:CAP_NHAT_PHONG_BAN'
        ]);
        $routes->post('update/(:num)', 'PhongBanController::update/$1');
        $routes->get('delete/(:num)', 'PhongBanController::delete/$1', [
            'filter' => 'permission:XOA_PHONG_BAN'
        ]);

        $routes->get('export_excel', 'PhongBanController::exportExcel', [
            'filter' => 'permission:XUAT_PHONG_BAN_EXCEL'
        ]);
        $routes->get('export_pdf', 'PhongBanController::exportPDF', [
            'filter' => 'permission:XUAT_PHONG_BAN_PDF'
        ]);
    });
    // =========================================
    // CHAM CONG
    // =========================================
    $routes->group('cham_cong', ['filter' => 'auth'], function($routes) {
        $routes->get('/','ChamCongController::index', [
            'filter' => 'permission:QUAN_LY_CHAM_CONG'
        ]);
        $routes->get('create', 'ChamCongController::create', [
            'filter' => 'permission:TAO_CHAM_CONG'
        ]);
        $routes->post('store', 'ChamCongController::store');
        $routes->get('edit/(:num)','ChamCongController::edit/$1', [
            'filter' => 'permission:CAP_NHAT_CHAM_CONG'
        ]);
        $routes->post('update/(:num)','ChamCongController::update/$1');
        $routes->get('delete/(:num)','ChamCongController::delete/$1', [
            'filter' => 'permission:XOA_CHAM_CONG'
        ]);
        $routes->get('checkin/(:num)','ChamCongController::checkIn/$1');
        $routes->get('checkout/(:num)','ChamCongController::checkOut/$1');

        $routes->get('export_excel', 'ChamCongController::exportExcel', [
            'filter' => 'permission:XUAT_CHAM_CONG_EXCEL'
        ]);
        $routes->get('export_pdf', 'ChamCongController::exportPDF', [
            'filter' => 'permission:XUAT_CHAM_CONG_PDF'
        ]);
    });

    // =========================================
    // VAI TRO
    // =========================================
    $routes->group('vai_tro', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'VaiTroController::index', [
            'filter' => 'permission:XEM_VAI_TRO'
        ]);
        $routes->get('create', 'VaiTroController::create', [
            'filter' => 'permission:TAO_VAI_TRO'
        ]);
        $routes->post('store', 'VaiTroController::store');
        $routes->get('edit/(:num)', 'VaiTroController::edit/$1', [
            'filter' => 'permission:CAP_NHAT_VAI_TRO'
        ]);
        $routes->post('update/(:num)', 'VaiTroController::update/$1');
        $routes->get('delete/(:num)', 'VaiTroController::delete/$1', [
            'filter' => 'permission:XOA_VAI_TRO'
        ]);
    });
    // ======================================
    // NGHI PHEP
    // ======================================
    $routes->group('nghi_phep', ['filter' => 'auth'], function($routes) {
        $routes->get('/', 'NghiPhepController::index');

        $routes->get('create', 'NghiPhepController::create');

        $routes->post('store', 'NghiPhepController::store');

        $routes->get('detail/(:num)', 'NghiPhepController::detail/$1');

        $routes->get('edit/(:num)', 'NghiPhepController::edit/$1');

        $routes->post('update/(:num)', 'NghiPhepController::update/$1');

        $routes->get('delete/(:num)', 'NghiPhepController::delete/$1');

        $routes->get('approve/(:num)', 'NghiPhepController::approve/$1');

        $routes->get('reject/(:num)', 'NghiPhepController::reject/$1');
        $routes->get('export_excel', 'NghiPhepController::exportExcel', [
            'filter' => 'permission:XUAT_NGHI_PHEP_EXCEL'
        ]);
        $routes->get('export_pdf', 'NghiPhepController::exportPDF', [
            'filter' => 'permission:XUAT_NGHI_PHEP_PDF'
        ]);
    });
});