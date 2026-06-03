<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>DANH SÁCH NHÂN VIÊN</h2>

<table>
    <thead>
        <tr>
            <th>Mã NV</th>
            <th>Họ tên</th>
            <th>Phòng ban</th>
            <th>Vai trò</th>
            <th>Lương</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($nhanviens as $nv): ?>
            <tr>
                <td><?= $nv['ma_nhan_vien'] ?></td>
                <td><?= $nv['ho_ten'] ?></td>
                <td><?= $nv['ten_phong_ban'] ?></td>
                <td><?= $nv['ten_vai_tro'] ?></td>
                <td><?= number_format($nv['luong']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>