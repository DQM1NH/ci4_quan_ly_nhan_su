<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>

        body{
            font-family: DejaVu Sans;
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th{
            background-color: #f2f2f2;
        }

        th, td{
            padding:8px;
            text-align:center;
            font-size: 12px;
        }

    </style>
</head>
<body>

<h2>DANH SÁCH BẢNG LƯƠNG</h2>

<table>

    <thead>
        <tr>
            <th>Mã bảng lương</th>
            <th>Mã nhân viên</th>
            <th>Lương cơ bản</th>
            <th>Phụ cấp</th>
            <th>Thưởng</th>
            <th>Tăng ca</th>
            <th>Khấu trừ</th>
            <th>Bảo hiểm</th>
            <th>Thuế</th>
            <th>Tổng lương</th>
            <th>Thanh toán</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($bangluongs as $item): ?>

        <tr>

            <td>
                <?= $item['bang_luong_id'] ?>
            </td>

            <td>
                <?= $item['nhan_vien_id'] ?>
            </td>

            <td>
                <?= number_format($item['luong_co_ban'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['phu_cap'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['thuong'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['luong_tang_ca'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['khau_tru'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['bao_hiem'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['thue'],0,',','.') ?>
            </td>

            <td>
                <?= number_format($item['luong_thuc_nhan'],0,',','.') ?>
            </td>

            <td>
                <?= $item['trang_thai_thanh_toan'] == 'PAID' ? 'Đã thanh toán' : 'Chưa thanh toán' ?>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

</body>
</html>