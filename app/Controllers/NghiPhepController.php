<?php

namespace App\Controllers;

use App\Models\DonNghiPhepModel;
use App\Models\NhanVienModel;
use App\Models\LoaiNghiPhepModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class NghiPhepController extends BaseController
{
    public function index()
    {
        $model = new DonNghiPhepModel();
        $data['donnghipheps'] = $model->getAll();
        return view('nghiphep/index', $data);
    }

    public function create()
    {
        $data['ho_ten'] = session()->get('ho_ten');

        $data['nhan_vien_id'] = session()->get('nhan_vien_id');

        $data['loainghis'] =(new LoaiNghiPhepModel())->findAll();

        return view('nghiphep/create', $data);
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

            'loai_nghi_phep_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Loại nghỉ phép không được để trống'
                ]
            ],

            'ngay_bat_dau' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vui lòng chọn ngày bắt đầu'
                ]
            ],

            'ngay_ket_thuc' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vui lòng chọn ngày kết thúc'
                ]
            ]
        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new DonNghiPhepModel();
        $start = $this->request->getPost('ngay_bat_dau');
        $end = $this->request->getPost('ngay_ket_thuc');
        $tongNgay = date_diff(date_create($start), date_create($end))->days + 1;

        $model->save([
            'nhan_vien_id' => $this->request->getPost('nhan_vien_id'),
            'loai_nghi_phep_id' => $this->request->getPost('loai_nghi_phep_id'),
            'ngay_bat_dau' => $start,
            'ngay_ket_thuc' => $end,
            'tong_so_ngay' => $tongNgay,
            'ly_do' => $this->request->getPost('ly_do'),
            'trang_thai' => 'PENDING'
        ]);

        return redirect()
            ->to('/nghi_phep')
            ->with(
                'success',
                'Tạo đơn nghỉ phép thành công'
            );
    }

    public function detail($id)
    {
        $model = new DonNghiPhepModel();

        $data['don'] = $model

            ->select('
                don_nghi_phep.*,
                nhan_vien.ho_ten,
                loai_nghi_phep.ten_loai_nghi
            ')

            ->join(
                'nhan_vien',
                'nhan_vien.nhan_vien_id = don_nghi_phep.nhan_vien_id'
            )

            ->join(
                'loai_nghi_phep',
                'loai_nghi_phep.loai_nghi_phep_id = don_nghi_phep.loai_nghi_phep_id'
            )

            ->find($id);

        return view(
            'nghiphep/detail',
            $data
        );
    }

    public function approve($id)
    {
        $model = new DonNghiPhepModel();

        $model->update($id,[
            'trang_thai' => 'APPROVED',

            'ngay_duyet' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back();
    }

    public function reject($id)
    {
        $model = new DonNghiPhepModel();

        $model->update($id,[
            'trang_thai' => 'REJECTED',

            'ngay_duyet' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $model = new DonNghiPhepModel();
        $model->delete($id);

        return redirect()
            ->to('/nghi_phep')

            ->with(
                'success',
                'Xóa nghỉ phép thành công'
            );
    }
    public function edit($id)
    {
        $model = new DonNghiPhepModel();

        $data['don'] = $model->find($id);

        $data['nhanviens'] = (new NhanVienModel())->findAll();

        $data['loainghis'] = (new LoaiNghiPhepModel())->findAll();

        return view('nghiphep/edit', $data);
    }

    public function update($id)
    {
        $start = $this->request->getPost('ngay_bat_dau');

        $end = $this->request->getPost('ngay_ket_thuc');

        $tongNgay =
            date_diff(
                date_create($start),
                date_create($end)
            )->days + 1;

        $model = new DonNghiPhepModel();

        $model->update($id, [

            'nhan_vien_id' => $this->request->getPost('nhan_vien_id'),

            'loai_nghi_phep_id' => $this->request->getPost('loai_nghi_phep_id'),

            'ngay_bat_dau' => $start,

            'ngay_ket_thuc' => $end,

            'tong_so_ngay' => $tongNgay,

            'ly_do' => $this->request->getPost('ly_do')
        ]);

        return redirect()
            ->to('/nghi_phep')
            ->with(
                'success',
                'Cập nhật thành công'
            );
    }
    public function exportExcel()
    {
        $model = new DonNghiPhepModel();
        $data['donnghipheps'] = $model->getAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã đơn nghỉ phép');
        $sheet->setCellValue('B1', 'Nhân viên');
        $sheet->setCellValue('C1', 'Loại nghỉ');
        $sheet->setCellValue('D1', 'Số ngày');
        $sheet->setCellValue('E1', 'Trạng thái');
        $row = 2;

        foreach ($data['donnghipheps'] as $item) {
            $sheet->setCellValue('A'.$row, $item['don_nghi_phep_id']);
            $sheet->setCellValue('B'.$row, $item['ho_ten']);
            $sheet->setCellValue('C'.$row, $item['ten_loai_nghi']);
            $sheet->setCellValue('D'.$row, $item['tong_so_ngay']);
            $sheet->setCellValue('E'.$row, $item['trang_thai'] == 'APPROVED' ? 'Đã duyệt' : 'Từ chối');

            $row++;
        }

        $filename = 'danh_sach_nghi_phep.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new DonNghiPhepModel();

        $data['nghipheps'] = $model->getAll();

        $html = view('nghiphep/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream('nghi_phep.pdf');
    }
}