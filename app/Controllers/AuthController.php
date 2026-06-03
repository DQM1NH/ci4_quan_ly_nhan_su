<?php
// namespace App\Controllers;

// use App\Models\AuthModel;

// class AuthController extends BaseController
// {
//     public function login()
//     {
//         return view('auth/login');
//     }

//     public function doLogin()
//     {
//         $username = $this->request->getPost('username');
//         $password = $this->request->getPost('password');

//         $model = new AuthModel();

//         $user = $model->login($username);

        // if ($user) {
        //     if ($password == $user['mat_khau']) {
        //         session()->set([
        //             'tai_khoan_id' => $user['tai_khoan_id'],
        //             'nhan_vien_id' => $user['nhan_vien_id'],
        //             'ho_ten'       => $user['ho_ten'],
        //             'vai_tro'      => $user['ten_vai_tro'],
        //             'logged_in'    => true
        //         ]);
        //         return redirect()->to('/dashboard');
        //     }
        // }

        // return redirect()
        //     ->back()
        //     ->with('error', 'Sai tài khoản hoặc mật khẩu');
//     }

//     public function logout()
//     {
//         session()->destroy();
//         return redirect()->to('/login');
//     }
// }

namespace App\Controllers;

use App\Models\TaiKhoanModel;
use App\Models\NhanVienModel;
use App\Services\AuthService;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }


    public function processLogin()
    {
        // $username = $this->request->getPost('username');
        // $password = $this->request->getPost('password');

        // $model = new TaiKhoanModel();

        // $user = $model
        //     ->select('tai_khoan.*, nhan_vien.ho_ten, vai_tro.ten_vai_tro')
        //     ->join('nhan_vien', 'nhan_vien.nhan_vien_id = tai_khoan.nhan_vien_id')
        //     ->join('vai_tro', 'vai_tro.vai_tro_id = nhan_vien.vai_tro_id')
        //     ->where('ten_dang_nhap', $username)
        //     ->first();

        // if (!$user) {
        //     return redirect()->back()->with('error', 'Sai tài khoản');
        // }

        // if ($password != $user['mat_khau']) {
        //     return redirect()->back()->with('error', 'Sai mật khẩu');
        // }

        // session()->set([
        //     'tai_khoan_id' => $user['tai_khoan_id'],
        //     'nhan_vien_id' => $user['nhan_vien_id'],
        //     'ho_ten' => $user['ho_ten'],
        //     'vai_tro' => $user['ten_vai_tro'],
        //     'logged_in' => true
        // ]);

        // return redirect()->to(base_url('dashboard'));
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $authModel = new \App\Models\AuthModel();

        $user = $authModel->login($username);

        if (!$user) {
            return redirect()->back()->with('error', 'Sai tài khoản');
        }

        // DEMO
        if ($password !== $user['mat_khau']) {
            return redirect()->back()->with('error', 'Sai mật khẩu');
        }

        // LAY PERMISSION
        $permissions = $authModel->getPermissions($user['vai_tro_id']);

        $permissionNames = [];

        foreach ($permissions as $permission) {
            $permissionNames[] = $permission['ten_quyen'];
        }

        session()->set([
            'logged_in' => true,
            'tai_khoan_id' => $user['tai_khoan_id'],
            'nhan_vien_id' => $user['nhan_vien_id'],
            'ho_ten' => $user['ho_ten'],
            'vai_tro_id' => $user['vai_tro_id'],
            'vai_tro' => $user['ten_vai_tro'],
            'permissions' => $permissionNames
        ]);

        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $nhanVienModel = new NhanVienModel();
        $taiKhoanModel = new TaiKhoanModel();

        $rules = [

            'ho_ten' => 'required|min_length[3]',

            'email' => 'required|valid_email|is_unique[nhan_vien.email]',

            'so_dien_thoai' => 'required|is_unique[nhan_vien.so_dien_thoai]',

            'ten_dang_nhap' => 'required|is_unique[tai_khoan.ten_dang_nhap]',

            'mat_khau' => 'required|min_length[6]'
        ];

        if(!$this->validate($rules)){
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $maNhanVien = 'NV' . rand(1000,9999);

        $nhanVienModel->save([

            'ma_nhan_vien' => $maNhanVien,
            'ho_ten' => $this->request->getPost('ho_ten'),

            'gioi_tinh' => $this->request->getPost('gioi_tinh'),

            'ngay_sinh' => $this->request->getPost('ngay_sinh'),

            'so_dien_thoai' => $this->request->getPost('so_dien_thoai'),

            'email' => $this->request->getPost('email'),

            'dia_chi' => $this->request->getPost('dia_chi'),

            'ngay_vao_lam' => date('Y-m-d'),

            // mặc định nhân viên
            'vai_tro_id' => 4,

            // mặc định IT
            'phong_ban_id' => 1,

            'luong' => 0,
        ]);

        // =========================
        // LẤY ID NHÂN VIÊN
        // =========================
        $nhanVienId = $nhanVienModel->insertID();

        // =========================
        // INSERT TAI KHOAN
        // =========================

        $taiKhoanModel->save([
            'ten_dang_nhap' =>
                $this->request->getPost('ten_dang_nhap'),

            'mat_khau' => $this->request->getPost('mat_khau'),

            'nhan_vien_id' => $nhanVienId
        ]);

        return redirect()

            ->to('/login')

            ->with(
                'success',
                'Đăng ký thành công'
            );
    }
}