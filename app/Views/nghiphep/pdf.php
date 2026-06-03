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

<h2>DANH SÁCH NGHỈ  PHÉP</h2>

<table>
    <thead>
        <tr>
            <th>Mã đơn nghỉ phép</th>
            <th>Nhân viên</th>
            <th>Loại nghỉ</th>
            <th>Số ngày</th>
            <th>Trạng thái</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($nghipheps as $item): ?>

        <tr>
            <td><?= $item['don_nghi_phep_id'] ?></td>
            <td><?= $item['ho_ten'] ?></td>
            <td><?= $item['ten_loai_nghi'] ?></td>
            <td><?= $item['tong_so_ngay'] ?></td>
            <td><?= $item['trang_thai'] == 'APPROVED' ? 'Đã duyệt' : 'Từ chối'?></td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>