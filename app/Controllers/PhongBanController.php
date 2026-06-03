<?php

namespace App\Controllers;

use App\Models\PhongBanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class PhongBanController extends BaseController
{
    public function index()
    {
        $model = new PhongBanModel();

        $data['phongbans'] = $model->getAllPhongBan();

        return view('phongban/index', $data);
    }

    public function create()
    {
        return view('phongban/create');
    }

    public function store()
    {
        $rules = [
            'ten_phong_ban' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tên phòng ban không được để trống'
                ]
            ],
            'mo_ta' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mô tả không được để trống'
                ]
            ]
        ];

        // Nếu validate thất bại
        if (!$this->validate($rules)) {

            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        $model = new PhongBanModel();

        $model->save([
            'ten_phong_ban' => $this->request->getPost('ten_phong_ban'),
            'mo_ta' => $this->request->getPost('mo_ta')
        ]);

        return redirect()
            ->to('/phong_ban')
            ->with(
                'success',
                'Thêm phòng ban thành công'
            );
    }

    public function edit($id)
    {
        $model = new PhongBanModel();

        $data['phongban'] = $model->find($id);

        return view(
            'phongban/edit',
            $data
        );
    }

    public function update($id)
    {
        $model = new PhongBanModel();

        $model->update($id, [

            'ten_phong_ban' =>
                $this->request->getPost('ten_phong_ban'),

            'mo_ta' =>
                $this->request->getPost('mo_ta')
        ]);

        return redirect()
            ->to('/phong_ban')
            ->with(
                'success',
                'Cập nhật phòng ban thành công'
            );
    }

    public function delete($id)
    {
        $model = new PhongBanModel();

        $model->delete($id);

        return redirect()
            ->to('/phong_ban')
            ->with(
                'success',
                'Xóa phòng ban thành công'
            );
    }

    public function exportExcel()
    {
        $model = new PhongBanModel();

        $data['phongbans'] = $model->getAllPhongBan();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Mã phòng');
        $sheet->setCellValue('B1', 'Tên phòng');
        $sheet->setCellValue('C1', 'Mô tả');
        $sheet->setCellValue('D1', 'Số nhân viên');

        $row = 2;

        foreach ($data['phongbans'] as $item) {

            $sheet->setCellValue('A'.$row, $item['phong_ban_id']);
            $sheet->setCellValue('B'.$row, $item['ten_phong_ban']);
            $sheet->setCellValue('C'.$row, $item['mo_ta']);
            $sheet->setCellValue('D'.$row, $item['tong_nhan_vien']);


            $row++;
        }

        $filename = 'danh_sach_phong_ban.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new PhongBanModel();

        $data['phongbans'] = $model->getAllPhongBan();

        $html = view('phongban/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('phong_ban.pdf', [
            'Attachment' => true
        ]);
    }
}