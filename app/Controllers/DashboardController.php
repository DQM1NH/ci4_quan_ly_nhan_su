<?php

namespace App\Controllers;

use App\Models\NhanVienModel;
use App\Models\PhongBanModel;
use App\Models\TaiKhoanModel;
use App\Models\BangLuongModel;
use App\Models\DonNghiPhepModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $nhanVienModel = new NhanVienModel();
        $phongBanModel = new PhongBanModel();
        $taiKhoanModel = new TaiKhoanModel();
        $bangLuongModel = new BangLuongModel(); 
        $nghiPhepModel = new DonNghiPhepModel();

        $data = [];
            $data['tongNhanVien'] = $nhanVienModel->countAll();
            $data['tongPhongBan'] = $phongBanModel->countAll();

            $tongLuong = $bangLuongModel
                ->selectSum('luong_thuc_nhan')
                ->first();

            $data['tongLuong'] = $tongLuong['luong_thuc_nhan'] ?? 0;

            $data['tongTaiKhoan'] = $taiKhoanModel->countAll();

            $data['tongActive'] = $nhanVienModel
                ->where('trang_thai', 'ACTIVE')
                ->countAllResults();

            $data['tongInactive'] = $nhanVienModel
                ->where('trang_thai', 'INACTIVE')
                ->countAllResults();

            $data['nhanVienMoi'] = $nhanVienModel
                ->orderBy( 'nhan_vien_id', 'DESC')
                ->findAll(5);
       
            $data['donNghiMoi'] = $nghiPhepModel
                ->select('don_nghi_phep.*, nhan_vien.ho_ten')
                ->join('nhan_vien', 'nhan_vien.nhan_vien_id = don_nghi_phep.nhan_vien_id')
                ->orderBy('don_nghi_phep_id', 'DESC')
                ->findAll(5);
       
            $phongBanStats = $nhanVienModel
                ->select('phong_ban.ten_phong_ban, COUNT(nhan_vien.nhan_vien_id)as tong')
                ->join('phong_ban','phong_ban.phong_ban_id = nhan_vien.phong_ban_id')
                ->groupBy('phong_ban.ten_phong_ban')
                ->findAll();
       
            $labels = [];
            $dataChart = [];
            foreach($phongBanStats as $item){
                $labels[] = $item['ten_phong_ban'];
                $dataChart[] = $item['tong'];
            }
       
            $data['labels'] = json_encode($labels);
            $data['dataChart'] = json_encode($dataChart);
            return view('dashboard/index', $data);
    }
}