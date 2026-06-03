<?php

namespace App\Controllers;

use App\Models\ChamCongModel;
use App\Models\NhanVienModel;
use App\Models\CaLamModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class ChamCongController extends BaseController
{
    public function index()
    {
        // $model = new ChamCongModel();
        // $data['chamcongs'] = $model->getAllChamCong();

        // return view(
        //     'chamcong/index',
        //     $data
        // );
        $model = new ChamCongModel();
        $nhanVienId = session()->get('nhan_vien_id');

        if (session()->get('vai_tro') == 'Admin') {
            $data['chamcongs'] = $model->getAllChamCong();
        } else {
            $data['chamcongs'] = $model->getChamCongByNhanVien($nhanVienId);
        }

        return view('chamcong/index', $data);
    }

    // public function checkIn($id)
    // {
    //     $model = new ChamCongModel();

    //     $model->update($id,[
    //         'check_in' => date('Y-m-d H:i:s'),
    //         'trang_thai' =>'PRESENT'
    //     ]);

    //     return redirect()
    //         ->back()
    //         ->with(
    //             'success',
    //             'Check in thành công'
    //         );
    // }
    public function checkIn($id)
    {
        $model = new ChamCongModel();
        $row = $model->find($id);

        if (!$row) {
            return redirect()->back();
        }

        if (session()->get('vai_tro') != 'Admin' && $row['nhan_vien_id'] != session()->get('nhan_vien_id')) {
            return redirect()->back()
                ->with('error','Bạn không có quyền');
        }

        $model->update($id,[
            'check_in' => date('Y-m-d H:i:s'),
            'trang_thai' => 'PRESENT'
        ]);

        return redirect()->back()
            ->with('success','Check in thành công');
    }

    public function checkOut($id)
    {
        $model = new ChamCongModel();

        $data = $model->find($id);

        if (session()->get('vai_tro') != 'Admin' && $data['nhan_vien_id'] != session()->get('nhan_vien_id')) {
            return redirect()->back()
                ->with('error','Bạn không có quyền');
        }

        $checkIn = strtotime($data['check_in']);

        $checkOut = time();

        $gioLam = round(($checkOut - $checkIn) / 3600, 2);

        $model->update($id,[
            'check_out' => date('Y-m-d H:i:s'),
            'gio_lam' => $gioLam
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Check out thành công'
            );
    }

    public function create()
    {
        $nhanVienModel = new NhanVienModel();
        $caLamModel = new CaLamModel();

        $data['nhanviens'] = $nhanVienModel->findAll();

        $data['calams'] = $caLamModel->findAll();

        return view('chamcong/create', $data);
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
            'ca_lam_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ca làm không được để trống'
                ]
            ],
            'ngay_cham_cong' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ngày chấm công không được để trống'
                ]
            ],
            'trang_thai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Trạng thái không được để trống'
                ]
            ]
        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new ChamCongModel();

        $model->save([
            'nhan_vien_id' => $this->request->getPost('nhan_vien_id'),

            'ca_lam_id' =>$this->request->getPost('ca_lam_id'),

            'ngay_cham_cong' =>$this->request->getPost('ngay_cham_cong'),

            'check_in' =>$this->request->getPost('check_in'),

            'check_out' =>$this->request->getPost('check_out'),

            'trang_thai' =>$this->request->getPost('trang_thai'),

            'ghi_chu' =>$this->request->getPost('ghi_chu')
        ]);

        return redirect()

            ->to('/cham_cong')

            ->with(
                'success',
                'Thêm chấm công thành công'
            );
    }

    public function edit($id)
    {
        $model = new ChamCongModel();

        $nhanVienModel = new NhanVienModel();

        $caLamModel = new CaLamModel();

        $data['chamcong'] = $model->find($id);

        $data['nhanviens'] = $nhanVienModel->findAll();

        $data['calams'] = $caLamModel->findAll();

        return view(
            'chamcong/edit',
            $data
        );
    }

    public function update($id)
    {
        $model = new ChamCongModel();

        $model->update($id,[
            'nhan_vien_id' =>$this->request->getPost('nhan_vien_id'),

            'ca_lam_id' =>$this->request->getPost('ca_lam_id'),

            'ngay_cham_cong' =>$this->request->getPost('ngay_cham_cong'),

            'check_in' =>$this->request->getPost('check_in'),

            'check_out' =>$this->request->getPost('check_out'),

            'trang_thai' =>$this->request->getPost('trang_thai'),

            'ghi_chu' =>$this->request->getPost('ghi_chu')
        ]);

        return redirect()

            ->to('/cham_cong')
            ->with(
                'success',
                'Cập nhật thành công'
            );
    }

    public function delete($id)
    {
        $model =new ChamCongModel();

        $model->delete($id);

        return redirect()

            ->to('/cham_cong')

            ->with(
                'success',
                'Xóa thành công'
            );
    }

    public function exportExcel()
    {
        $model = new ChamCongModel();
        $data['chamcongs'] = $model->getAllChamCong();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã chấm công');
        $sheet->setCellValue('B1', 'Nhân viên');
        $sheet->setCellValue('C1', 'Ca làm');
        $sheet->setCellValue('D1', 'Ngày');
        $sheet->setCellValue('E1', 'Giờ vào');
        $sheet->setCellValue('F1', 'Giờ ra');
        $sheet->setCellValue('G1', 'Giờ làm');
        $sheet->setCellValue('H1', 'Trạng thái');

        $row = 2;

        foreach ($data['chamcongs'] as $item) {
            $sheet->setCellValue('A'.$row, $item['cham_cong_id']);
            $sheet->setCellValue('B'.$row, $item['ho_ten']);
            $sheet->setCellValue('C'.$row, $item['ten_ca']);
            $sheet->setCellValue('D'.$row, $item['ngay_cham_cong']);
            $sheet->setCellValue('E'.$row, $item['check_in']);
            $sheet->setCellValue('F'.$row, $item['check_out']);
            $sheet->setCellValue('G'.$row, $item['gio_lam']);
            $sheet->setCellValue('H'.$row, $item['trang_thai']);

            $row++;
        }

        $filename = 'danh_sach_cham_cong.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new ChamCongModel();

        $data['chamcongs'] = $model->getAllChamCong();

        $html = view('chamcong/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream('cham_cong.pdf', [
            'Attachment' => true
        ]);
    }
}