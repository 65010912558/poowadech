<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>สรุปยอดขาย Dashboard - ภูวเดช</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f4f7f6; padding: 30px; color: #333; }
        h1 { text-align: center; color: #2c3e50; margin-bottom: 30px; border-bottom: 3px solid #3498db; display: inline-block; padding-bottom: 10px; }
        
        /* Layout จัดระเบียบ */
        .dashboard-container { max-width: 1200px; margin: 0 auto; }
        .grid { display: grid; grid-template-columns: 1fr; gap: 30px; }
        @media (min-width: 992px) { .grid { grid-template-columns: 350px 1fr; } }

        /* ตกแต่งตาราง */
        .card { background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #3498db; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        tr:last-child { background-color: #f8f9fa; font-weight: bold; }

        /* ปรับขนาดกราฟ */
        .chart-box { height: 450px; margin-bottom: 20px; } /* ขยายความสูงกราฟ */
    </style>
</head>

<body>

<div class="dashboard-container text-center" style="text-align: center;">
    <h1>รายงานสรุปยอดขาย: ภูวเดช โลเกตุ (ภู)</h1>
</div>

<div class="dashboard-container grid">
    
    <div class="card">
        <h3><i class="fas fa-table"></i> ตารางสรุปรายเดือน</h3>
        <?php
        include_once("connectdb.php");
        // สร้าง Array ชื่อเดือนภาษาไทย
        $thaiMonths = [1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
                       "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

        $sql = "SELECT MONTH(p_date) AS m, SUM(p_amount) AS total FROM popsupermarket GROUP BY MONTH(p_date) ORDER BY m ASC";
        $rs = mysqli_query($conn, $sql);

        $labels = []; $values = []; $grandTotal = 0; $tableRows = "";
        while ($data = mysqli_fetch_array($rs)) {
            $mName = $thaiMonths[$data['m']];
            $labels[] = $mName;
            $values[] = $data['total'];
            $grandTotal += $data['total'];
            $tableRows .= "<tr><td>{$mName}</td><td align='right'>".number_format($data['total'], 2)."</td></tr>";
        }
        ?>
        <table>
            <thead>
                <tr><th>เดือน</th><th style="text-align:right">ยอดขาย (บาท)</th></tr>
            </thead>
            <tbody>
                <?php echo $tableRows; ?>
                <tr><td>รวมทั้งสิ้น</td><td align="right"><?php echo number_format($grandTotal, 2); ?></td></tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3><i class="fas fa-chart-bar"></i> วิเคราะห์ยอดขายรายเดือน (Bar Chart)</h3>
        <div class="chart-box">
            <canvas id="barChart"></canvas>
        </div>
        
        <hr style="margin: 40px 0; border: 0; border-top: 1px solid #eee;">
        
        <h3><i class="fas fa-chart-pie"></i> สัดส่วนยอดขาย (Pie Chart)</h3>
        <div class="chart-box">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

</div>

<script>
    const labels = <?php echo json_encode($labels); ?>;
    const dataValues = <?php echo json_encode($values); ?>;

    // ตั้งค่ากราฟ Bar แบบมี Gradient สวยๆ
    const ctxBar = document.getElementById('barChart').getContext('2d');
    const gradient = ctxBar.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(52, 152, 219, 1)');
    gradient.addColorStop(1, 'rgba(46, 204, 113, 0.6)');

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขายรวม (บาท)',
                data: dataValues,
                backgroundColor: gradient,
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    // ตั้งค่ากราฟ Pie
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#2ecc71'
                ],
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' }
            }
        }
    });
</script>

<?php mysqli_close($conn); ?>

</body>
</html>