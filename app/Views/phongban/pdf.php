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

<h2>DANH SÁCH PHÒNG BAN</h2>

<table>

    <thead>
        <tr>
            <th>Mã phòng</th>
            <th>Tên phòng</th>
            <th>Mô tả</th>
            <th>Số nhân viên</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($phongbans as $item): ?>

        <tr>
            <td><?= $item['phong_ban_id'] ?></td>
            <td><?= $item['ten_phong_ban'] ?></td>
            <td><?= $item['mo_ta'] ?></td>
            <td><?= $item['tong_nhan_vien'] ?></td>
        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

</body>
</html>