<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body{
            font-family: DejaVu Sans;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:8px;
            text-align:center;
        }
    </style>
</head>
<body>

<h2>DANH SÁCH KHEN THƯỞNG KỶ LUẬT</h2>

<table>
    <thead>
        <tr>
            <th>Mã</th>
            <th>Nhân viên</th>
            <th>Loại</th>
            <th>Số tiền</th>
            <th>Lý do</th>
            <th>Ngày áp dụng</th>
            <th>Người tạo</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($ktkls as $item): ?>

        <tr>
            <td><?= $item['ktkl_id'] ?></td>
            <td><?= $item['ho_ten'] ?></td>
            <td><?= $item['loai'] == 'KHEN_THUONG' ? 'Khen thưởng' : 'Kỷ luật' ?></td>
            <td><?= $item['so_tien'] ?></td>
            <td><?= $item['ly_do'] ?></td>
            <td><?= $item['ngay_ap_dung'] ?></td>
            <td><?= $item['nguoi_tao_ten'] ?></td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

</body>
</html>