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

<h2>DANH SÁCH TÀI KHOẢN</h2>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Họ tên</th>
            <th>Vai trò</th>
            <th>Phòng ban</th>
            <th>Khóa</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($taikhoans as $item): ?>

        <tr>
            <td><?= $item['tai_khoan_id'] ?></td>
            <td><?= $item['ten_dang_nhap'] ?></td>
            <td><?= $item['ho_ten'] ?></td>
            <td><?= $item['ten_vai_tro'] ?></td>
            <td><?= $item['ten_phong_ban'] ?></td>
            <td><?= $item['khoa'] == 1 ? 'Đã khóa' : 'Hoạt động' ?></td>
        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

</body>
</html>