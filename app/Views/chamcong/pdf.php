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

<h2>DANH SÁCH CHẤM CÔNG</h2>

<table>
    <thead>
        <tr>
            <th>Mã chấm công</th>
            <th>Nhân viên</th>
            <th>Ca làm</th>
            <th>Ngày</th>
            <th>Giờ vào</th>
            <th>Giờ ra</th>
            <th>Giờ làm</th>
            <th>Trạng thái</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($chamcongs as $item): ?>

        <tr>
            <td><?= $item['cham_cong_id'] ?></td>
            <td><?= $item['ho_ten'] ?></td>
            <td><?= $item['ten_ca'] ?></td>
            <td><?= $item['ngay_cham_cong'] ?></td>
            <td><?= $item['check_in'] ?></td>
            <td><?= $item['check_out'] ?></td>
            <td><?= $item['gio_lam'] ?></td>
            <td><?= $item['trang_thai'] ?></td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>