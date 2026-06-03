<?php

namespace App\Controllers;

use App\Models\TaiKhoanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class TaiKhoanController extends BaseController
{
    public function index()
    {
        $model = new TaiKhoanModel();

        $data['taikhoans'] = $model->getAllTaiKhoan();

        return view(
            'taikhoan/index',
            $data
        );
    }

    public function exportExcel()
    {
        $model = new TaiKhoanModel();

        $data['taikhoans'] = $model->getAllTaiKhoan();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tên đăng nhập');
        $sheet->setCellValue('C1', 'Họ tên');
        $sheet->setCellValue('D1', 'Vai trò');
        $sheet->setCellValue('E1', 'Phòng ban');
        $sheet->setCellValue('F1', 'Khóa');

        $row = 2;

        foreach ($data['taikhoans'] as $item) {

            $sheet->setCellValue('A'.$row, $item['tai_khoan_id']);
            $sheet->setCellValue('B'.$row, $item['ten_dang_nhap']);
            $sheet->setCellValue('C'.$row, $item['ho_ten']);
            $sheet->setCellValue('D'.$row, $item['ten_vai_tro']);
            $sheet->setCellValue('E'.$row, $item['ten_phong_ban']);
            $sheet->setCellValue('F'.$row, $item['khoa'] == 1 ? 'Đã khóa' : 'Hoạt động');

            $row++;
        }

        $filename = 'danh_sach_tai_khoan.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $model = new TaiKhoanModel();

        $data['taikhoans'] = $model->getAllTaiKhoan();

        $html = view('taikhoan/pdf', $data);

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html, 'UTF-8');

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('tai_khoan.pdf', [
            'Attachment' => true
        ]);
    }
}