<?php

namespace App\Controllers;

use App\Models\BangLuongModel;
use App\Models\NhanVienModel;
use App\Models\KyLuongModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class BangLuongController extends BaseController
{
    public function index()
    {
        $model = new BangLuongModel();
        $data['bangluongs'] = $model->getAllBangLuong();
        return view('bangluong/index', $data);
    }

    public function create()
    {
        $nhanVienModel = new NhanVienModel();
        $kyLuongModel = new KyLuongModel();

        $data['nhanviens'] = $nhanVienModel->findAll();
        $data['kyluongs'] = $kyLuongModel->findAll();
        return view('bangluong/create', $data);
    }

    public function store()
    {
        $rules = [
            'luong_co_ban' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Lương cơ bản không được để trống',
                    'numeric' => 'Lương cơ bản phải là số',
                    'greater_than' => 'Lương cơ bản phải lớn hơn 0'
                ]
            ],

            'phu_cap' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Phụ cấp không được để trống',
                    'numeric' => 'Phụ cấp phải là số'
                ]
            ],

            'thuong' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Thưởng không được để trống',
                    'numeric' => 'Thưởng phải là số'
                ]
            ],

            'luong_tang_ca' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tăng ca không được để trống',
                    'numeric' => 'Tăng ca phải là số',
                ]
            ],

            'khau_tru' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Khấu trừ không được để trống',
                    'numeric' => 'Khấu trừ phải là số'
                ]
            ],

            'bao_hiem' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Bảo hiểm không được để trống',
                    'numeric' => 'Bảo hiểm phải là số'
                ]
            ],

            'thue' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Thuế không được để trống',
                    'numeric' => 'Thuế phải là số'
                ]
            ]

        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new BangLuongModel();
        $luongCoBan = $this->request ->getPost('luong_co_ban');
        $phuCap = $this->request ->getPost('phu_cap');
        $thuong = $this->request ->getPost('thuong');
        $tangCa = $this->request ->getPost('luong_tang_ca');
        $khauTru = $this->request ->getPost('khau_tru');
        $baoHiem = $this->request ->getPost('bao_hiem');
        $thue = $this->request ->getPost('thue');
        $luongThucNhan = $luongCoBan + $phuCap + $thuong + $tangCa - $khauTru - $baoHiem - $thue;
        $model->save([
            'nhan_vien_id' => $this->request ->getPost('nhan_vien_id'),
            'ky_luong_id' => $this->request ->getPost('ky_luong_id'),
            'luong_co_ban' => $luongCoBan,
            'phu_cap' => $phuCap,
            'thuong' => $thuong,
            'luong_tang_ca' => $tangCa,
            'khau_tru' => $khauTru,
            'bao_hiem' => $baoHiem,
            'thue' => $thue,
            'luong_thuc_nhan' => $luongThucNhan
        ]);

        return redirect()
            ->to('/bang_luong')
            ->with('success', 'Thêm bảng lương thành công');
    }

    public function edit($id)
    {
        $model = new BangLuongModel();
        $nhanVienModel = new NhanVienModel();
        $kyLuongModel = new KyLuongModel();

        $data['bangluong'] = $model->find($id);

        $data['nhanviens'] = $nhanVienModel->findAll();

        $data['kyluongs'] = $kyLuongModel->findAll();

        return view(
            'bangluong/edit',
            $data
        );
    }

    public function update($id)
    {
        $model = new BangLuongModel();
        $luongCoBan = $this->request ->getPost('luong_co_ban');
        $phuCap = $this->request ->getPost('phu_cap');
        $thuong = $this->request ->getPost('thuong');
        $tangCa = $this->request ->getPost('luong_tang_ca');
        $khauTru = $this->request ->getPost('khau_tru');
        $baoHiem = $this->request ->getPost('bao_hiem');
        $thue = $this->request ->getPost('thue');
        $luongThucNhan = $luongCoBan + $phuCap + $thuong + $tangCa - $khauTru - $baoHiem - $thue;

        $model->update($id,[
            'nhan_vien_id' => $this->request->getPost('nhan_vien_id'),

            'ky_luong_id' => $this->request->getPost('ky_luong_id'),

            'luong_co_ban' => $luongCoBan,
            
            'phu_cap' =>$phuCap,

            'thuong' =>$thuong,

            'luong_tang_ca' =>$tangCa,

            'khau_tru' =>$khauTru,

            'bao_hiem' =>$baoHiem,

            'thue' =>$thue,

            'luong_thuc_nhan' =>$luongThucNhan
        ]);

        return redirect()
            ->to('/bang_luong')
            ->with('success', 'Cập nhật bảng lương thành công');
    }

    public function delete($id)
    {
        $model = new BangLuongModel();

        $model->delete($id);

        return redirect()
            ->to('/bang_luong')
            ->with('success', 'Xóa bảng lương thành công');
    }

    public function detail($id)
    {
        $model = new BangLuongModel();
        $data['bangluong'] = $model->getDetail($id);

        return view('bangluong/detail', $data);
    }

    public function thanhToan($id)
    {
        $model = new BangLuongModel();
        $model->update($id,[
            'trang_thai_thanh_toan'=> 'PAID',
            'ngay_thanh_toan'=> date('Y-m-d')
        ]);

        return redirect()
            ->back()
            ->with('success','Thanh toán thành công');
    }

    public function exportExcel()
    {
        $model = new BangLuongModel();
        $data = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã bảng lương');
        $sheet->setCellValue('B1', 'Mã nhân viên');
        $sheet->setCellValue('C1', 'Lương cơ bản');
        $sheet->setCellValue('D1', 'Phụ cấp');
        $sheet->setCellValue('E1', 'Thưởng');
        $sheet->setCellValue('F1', 'Tăng ca');
        $sheet->setCellValue('G1', 'Khấu trừ');
        $sheet->setCellValue('H1', 'Bảo hiểm');
        $sheet->setCellValue('I1', 'Thuế');
        $sheet->setCellValue('J1', 'Tổng lương');
        $sheet->setCellValue('J1', 'Thanh toán');

        $row = 2;

        foreach ($data as $item) {
            $sheet->setCellValue('A'.$row, $item['bang_luong_id']);
            $sheet->setCellValue('B'.$row, $item['nhan_vien_id']);
            $sheet->setCellValue('C'.$row, $item['luong_co_ban']);
            $sheet->setCellValue('D'.$row, $item['phu_cap']);
            $sheet->setCellValue('E'.$row, $item['thuong']);
            $sheet->setCellValue('F'.$row, $item['luong_tang_ca']);
            $sheet->setCellValue('G'.$row, $item['khau_tru']);
            $sheet->setCellValue('H'.$row, $item['bao_hiem']);
            $sheet->setCellValue('I'.$row, $item['thue']);
            $sheet->setCellValue('J'.$row, $item['luong_thuc_nhan']);
            $sheet->setCellValue('I'.$row, $item['trang_thai_thanh_toan'] == 'PAID' ? 'Đã thanh toán' : 'Chưa thanh toán');
            
            $row++;
        }

        $filename = 'danh_sach_bang_luong.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new BangLuongModel();

        $data['bangluongs'] = $model->findAll();

        $html = view('bangluong/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream('bang_luong.pdf');
    }
}