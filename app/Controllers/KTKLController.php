<?php

namespace App\Controllers;

use App\Models\KTKLModel;
use App\Models\NhanVienModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class KTKLController extends BaseController
{
    public function index()
    {
        $model = new KTKLModel();

        $data['ktkls'] =
            $model->getAllKTKL();

        return view(
            'ktkl/index',
            $data
        );
    }

    public function create()
    {
        $nhanVienModel =
            new NhanVienModel();

        $data['nhanviens'] =
            $nhanVienModel->getNhanVien();

        return view(
            'ktkl/create',
            $data
        );
    }

    public function store()
    {
        $rules = [
            'nhan_vien_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mã nhân viên không được để trống'
                ]
            ],
            'loai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Loại không được để trống'
                ]
            ],
            'so_tien' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Số tiền không được để trống',
                    'numeric' => 'Số tiền phải là số',
                    'greater_than' => 'Số tiền phải lớn hơn 0'
                ]
            ],
            'ly_do' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lý do không được để trống'
                ]
            ],
            'ngay_ap_dung' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ngày áp dụng không được để trống'
                ]
            ]
        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new KTKLModel();

        $model->save([

            'nhan_vien_id' =>
                $this->request->getPost('nhan_vien_id'),

            'loai' =>
                $this->request->getPost('loai'),

            'so_tien' =>
                $this->request->getPost('so_tien'),

            'ly_do' =>
                $this->request->getPost('ly_do'),

            'ngay_ap_dung' =>
                $this->request->getPost('ngay_ap_dung'),

            'nguoi_tao' =>
                session()->get('nhan_vien_id')
        ]);

        return redirect()

            ->to('/ktkl')

            ->with(
                'success',
                'Thêm thành công'
            );
    }

    public function edit($id)
    {
        $model = new KTKLModel();

        $nhanVienModel =
            new NhanVienModel();

        $data['ktkl'] =
            $model->find($id);

        $data['nhanviens'] =
            $nhanVienModel->getNhanVien();

        return view(
            'ktkl/edit',
            $data
        );
    }

    public function update($id)
    {
        $model = new KTKLModel();

        $model->update($id, [

            'nhan_vien_id' =>
                $this->request->getPost('nhan_vien_id'),

            'loai' =>
                $this->request->getPost('loai'),

            'so_tien' =>
                $this->request->getPost('so_tien'),

            'ly_do' =>
                $this->request->getPost('ly_do'),

            'ngay_ap_dung' =>
                $this->request->getPost('ngay_ap_dung')
        ]);

        return redirect()

            ->to('/ktkl')

            ->with(
                'success',
                'Cập nhật thành công'
            );
    }

    public function delete($id)
    {
        $model = new KTKLModel();

        $model->delete($id);

        return redirect()

            ->to('/ktkl')

            ->with(
                'success',
                'Xóa thành công'
            );
    }
    public function exportExcel()
    {
        $model = new KTKLModel();

        $data = $model->getAllKTKL();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã');
        $sheet->setCellValue('B1', 'Nhân viên');
        $sheet->setCellValue('C1', 'Loại');
        $sheet->setCellValue('D1', 'Số tiền');
        $sheet->setCellValue('E1', 'Lý do');
        $sheet->setCellValue('F1', 'Ngày áp dụng');
        $sheet->setCellValue('G1', 'Người tạo');

        $row = 2;

        foreach ($data as $item) {

            $sheet->setCellValue('A'.$row, $item['ktkl_id']);
            $sheet->setCellValue('B'.$row, $item['ho_ten']);
            $sheet->setCellValue('C'.$row, $item['loai'] == 'KHEN_THUONG' ? 'Khen thưởng' : 'Kỷ luật');
            $sheet->setCellValue('D'.$row, $item['so_tien']);
            $sheet->setCellValue('E'.$row, $item['ly_do']);
            $sheet->setCellValue('F'.$row, $item['ngay_ap_dung']);
            $sheet->setCellValue('G'.$row, $item['nguoi_tao_ten']);

            $row++;
        }

        $filename = 'danh_sach_khen_thuong_ky_luat.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new KTKLModel();

        $data['ktkls'] = $model->getAllKTKL();

        $html = view('ktkl/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream('ktkl.pdf', [
            'Attachment' => true
        ]);
    }
}