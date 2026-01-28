<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Sales Dashboard - ชัชวาล</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f4f7f9; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .content-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; }
        
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #0984e3; color: white; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; }
        
        .total-row { background-color: #dfe6e9; font-weight: bold; color: #2d3436; }
        .chart-box { position: relative; width: 100%; height: 350px; }
        
        /* สไตล์สำหรับตัวเลขยอดรวมเด่นๆ */
        .summary-badge { text-align: center; margin-bottom: 20px; padding: 15px; background: #e3f2fd; border-radius: 10px; border-left: 5px solid #0984e3; }
    </style>
</head>
<body>

<div class="container">
    <div style="text-align:center; margin-bottom:20px;">
        <h2 style="margin:0;">📊 สรุปรายงานยอดขายรายเดือน</h2>
        <p>คุณชัชวาล สิงห์เทศ (แบงค์)</p>
    </div>

    <?php
    include_once("connectdb.php");
    $sql = "SELECT MONTH(p_date) AS Month_Num, SUM(p_amount) AS Total_Sales 
            FROM popsupermarket GROUP BY MONTH(p_date) ORDER BY Month_Num";
    $rs = mysqli_query($conn, $sql);

    $labels = [];
    $sales = [];
    $grand_total = 0; // ตัวแปรเก็บผลรวมทั้งหมด

    if ($rs && mysqli_num_rows($rs) > 0) {
        while ($data = mysqli_fetch_array($rs)) {
            $labels[] = "เดือนที่ " . $data['Month_Num'];
            $sales[] = (float)$data['Total_Sales'];
            $grand_total += $data['Total_Sales']; // บวกสะสมยอดรวม
        }
    } else {
        // ข้อมูลจำลองกรณีไม่มีใน DB
        $labels = ["มกราคม", "กุมภาพันธ์", "มีนาคม"];
        $sales = [5000, 7000, 8000];
        $grand_total = array_sum($sales);
    }
    ?>

    <div class="summary-badge">
        <span style="font-size: 1.1rem;">ยอดขายรวมสุทธิ: </span>
        <span style="font-size: 1.8rem; color: #0984e3; font-weight: bold;">
            <?php echo number_format($grand_total, 2); ?> บาท
        </span>
    </div>

    <div class="content-grid">
        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>เดือนที่</th>
                        <th style="text-align:right;">ยอดขาย (บาท)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($labels as $key => $label): ?>
                    <tr>
                        <td><?php echo $label; ?></td>
                        <td align="right"><?php echo number_format($sales[$key], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td>รวมทั้งสิ้น</td>
                        <td align="right"><?php echo number_format($grand_total, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="chart-section">
            <div class="chart-box">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut', // ทรงโดนัทจะดูทันสมัยกว่า
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($sales); ?>,
                backgroundColor: ['#0984e3', '#00cec9', '#6c5ce7', '#fd79a8', '#fab1a0', '#ffeaa7'],
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            },
            cutout: '70%' // เว้นที่ตรงกลาง
        }
    });
</script>

</body>
</html>