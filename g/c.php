<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายการสินค้า - ภูวเดช โลเกตุ</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        body { padding: 20px; background-color: #f8f9fa; }
        .container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        img { border-radius: 5px; object-fit: cover; }
    </style>
</head>

<body>

<div class="container">
    <h1 class="text-center mb-4">ภูวเดช โลเกตุ (ภู)</h1>
    <h4 class="mb-3 text-secondary">รายการคำสั่งซื้อ Pop Supermarket</h4>

    <div class="table-responsive">
        <table id="myTable" class="table table-striped table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภทสินค้า</th>
                    <th>วันที่</th>
                    <th>ประเทศ</th>
                    <th class="text-end">จำนวนเงิน</th>
                    <th class="text-center">รูปภาพ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include_once("connectdb.php");
            $sql = "SELECT * FROM `popsupermarket`";
            $rs = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_array($rs)){
            ?>
                <tr>
                    <td><?php echo $data['p_order_id'];?></td>
                    <td><strong><?php echo $data['p_product_name'];?></strong></td>
                    <td><span class="badge bg-info text-dark"><?php echo $data['p_category'];?></span></td>
                    <td><?php echo $data['p_date'];?></td>
                    <td><?php echo $data['p_country'];?></td>
                    <td class="text-end"><?php echo number_format($data['p_amount'], 2);?></td>
                    <td class="text-center">
                        <img src="img/<?php echo $data['p_product_name'];?>.jpg" 
                             width="50" height="50" 
         
                    </td>
                </tr>   
            <?php 
            }
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json" // เมนูภาษาไทย
            },
            "pageLength": 10,
            "order": [[0, "desc"]] // เรียงจาก Order ID ล่าสุด
        });
    });
</script>

</body>
</html>