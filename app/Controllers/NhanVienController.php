<?php

namespace App\Controllers;

use App\Models\NhanVienModel;
use App\Models\PhongBanModel;
use App\Models\VaiTroModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class NhanVienController extends BaseController
{
    public function index()
    {
        $model = new NhanVienModel();
        $data['nhanviens'] = $model->getAllNhanVien();
        return view('nhanvien/index', $data);
    }

    public function create()
    {
        $phongBanModel = new PhongBanModel();

        $vaiTroModel = new VaiTroModel();

        $data['phongbans'] = $phongBanModel->findAll();

        $data['vaitros'] = $vaiTroModel->findAll();

        return view('nhanvien/create', $data);
    }

    public function store()
    {
        $rules = [
            'ma_nhan_vien' => [
                'rules' => 'required|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => 'Mã nhân viên không được để trống'
                ]
            ],

            'ho_ten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Họ tên không được để trống'
                ]
            ],

            'ngay_sinh' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vui lòng chọn ngày sinh'
                ]
            ],

            'luong' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Lương không được để trống',
                    'numeric' => 'Lương phải là số',
                    'greater_than' => 'Lương phải lớn hơn 0'
                ]
            ],

            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email không được để trống',
                    'valid_email' => 'Email không đúng định dạng'
                ]
            ],

            'so_dien_thoai' => [
                'rules' => 'required|regex_match[/^0\d{9}$/]',
                'errors' => [
                    'required' => 'Số điện thoại không được để trống',
                    'regex_match' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng số 0'
                ]
            ],

            'dia_chi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Địa chỉ không được để trống'
                ]
            ],

            'ngay_vao_lam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vui lòng chọn ngày vào làm'
                ]
            ]
        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new NhanVienModel();
        $model->save([
            'ma_nhan_vien' => $this->request->getPost('ma_nhan_vien'),
            'ho_ten' => $this->request->getPost('ho_ten'),
            'gioi_tinh' => $this->request->getPost('gioi_tinh'),
            'ngay_sinh' => $this->request->getPost('ngay_sinh'),
            'so_dien_thoai' => $this->request->getPost('so_dien_thoai'),
            'email' => $this->request->getPost('email'),
            'luong' => $this->request->getPost('luong'),
            'ngay_vao_lam' => $this->request->getPost('ngay_vao_lam'),
            'phong_ban_id' => $this->request->getPost('phong_ban_id'),
            'vai_tro_id' => $this->request->getPost('vai_tro_id'),
            'trang_thai' => $this->request->getPost('trang_thai')
        ]);
        return redirect()
            ->to('/nhan_vien')
            
            ->with(
                'success',
                'Thêm nhân viên thành công'
            );
    }

    public function edit($id)
    {
        $model = new NhanVienModel();

        $phongBanModel = new PhongBanModel();

        $vaiTroModel = new VaiTroModel();

        $data['nhanvien'] = $model->find($id);

        $data['phongbans'] = $phongBanModel->findAll();

        $data['vaitros'] = $vaiTroModel->findAll();

        return view('nhanvien/edit', $data);
    }

    public function update($id)
    {
        $model = new NhanVienModel();

        $model->update($id,[
            'ma_nhan_vien' => $this->request->getPost('ma_nhan_vien'),

            'ho_ten' => $this->request->getPost('ho_ten'),

            'gioi_tinh' => $this->request->getPost('gioi_tinh'),

            'ngay_sinh' => $this->request->getPost('ngay_sinh'),

            'so_dien_thoai' => $this->request->getPost('so_dien_thoai'),

            'email' => $this->request->getPost('email'),

            'dia_chi' => $this->request->getPost('dia_chi'),

            'luong' => $this->request->getPost('luong'),

            'ngay_vao_lam' => $this->request->getPost('ngay_vao_lam'),

            'phong_ban_id' => $this->request->getPost('phong_ban_id'),

            'vai_tro_id' => $this->request->getPost('vai_tro_id'),

            'trang_thai' => $this->request->getPost('trang_thai')
        ]);

        return redirect()

            ->to('/nhan_vien')

            ->with(
                'success',
                'Cập nhật nhân viên thành công'
            );
    }

    public function delete($id)
    {
        $model = new NhanVienModel();
        $model->delete($id);
        return redirect()
            ->to('/nhan_vien')

            ->with(
                'success',
                'Xóa nhân viên thành công'
            );
    }

    public function detail($id)
    {
        $model = new NhanVienModel();

        $data['nhanvien'] = $model->getDetail($id);

        return view('nhanvien/detail', $data);
    }

    public function exportExcel()
    {
        $model = new NhanVienModel();
        $nhanviens = $model->getAllNhanVien();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'Mã NV');
        $sheet->setCellValue('B1', 'Họ tên');
        $sheet->setCellValue('C1', 'Phòng ban');
        $sheet->setCellValue('D1', 'Vai trò');
        $sheet->setCellValue('E1', 'Lương');

        // Data
        $row = 2;

        foreach ($nhanviens as $nv) {
            $sheet->setCellValue('A' . $row, $nv['ma_nhan_vien']);
            $sheet->setCellValue('B' . $row, $nv['ho_ten']);
            $sheet->setCellValue('C' . $row, $nv['ten_phong_ban']);
            $sheet->setCellValue('D' . $row, $nv['ten_vai_tro']);
            $sheet->setCellValue('E' . $row, $nv['luong']);

            $row++;
        }

        $filename = 'danh_sach_nhan_vien.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new NhanVienModel();

        $data['nhanviens'] = $model->getAllNhanVien();

        $html = view('nhanvien/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream('danh_sach_nhan_vien.pdf', [
            'Attachment' => true
        ]);
    }
}