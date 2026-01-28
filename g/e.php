<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สรุปยอดขายตามประเทศและกราฟ</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* จัด CSS เล็กน้อยเพื่อให้กราฟอยู่คู่กันแบบกระชับ */
    .chart-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }
    .chart-box {
        width: 45%; /* แบ่งครึ่งหน้าจอ */
        min-width: 300px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 8px;
    }
</style>
</head>

<body>

<h1>ภูวเดช โลเกตุ (ภู)</h1>

<?php
include_once("connectdb.php");

$sql = "SELECT p_country, SUM(p_amount) AS total 
        FROM popsupermarket 
        GROUP BY p_country";
$rs = mysqli_query($conn, $sql);

// --- ส่วนเตรียมข้อมูล (สำคัญมาก) ---
$reportData = []; // เก็บข้อมูลเพื่อวนลูปสร้างตาราง
$labels = [];     // เก็บชื่อประเทศส่งให้ JS
$dataValues = []; // เก็บยอดขายส่งให้ JS

$grandTotal = 0;

while ($data = mysqli_fetch_array($rs)) {
    // เก็บข้อมูลลง Array
    $reportData[] = $data;
    
    // แยกเก็บใส่ตัวแปรสำหรับกราฟ
    $labels[] = $data['p_country'];
    $dataValues[] = $data['total'];
    
    // บวกยอดรวม
    $grandTotal += $data['total'];
}
// ------------------------------
?>

<div class="chart-container">
    <div class="chart-box">
        <h3 align="center">แผนภูมิแท่ง (Bar Chart)</h3>
        <canvas id="barChart"></canvas>
    </div>
    <div class="chart-box">
        <h3 align="center">แผนภูมิวงกลม (Pie Chart)</h3>
        <canvas id="pieChart"></canvas>
    </div>
</div>

<hr>

<h3>ตารางสรุปข้อมูล</h3>
<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ประเทศ</th>
    <th>ยอดขายรวม</th>
</tr>

<?php
// วนลูปจากตัวแปร Array ที่เราเก็บไว้ข้างบน
foreach ($reportData as $row) {
?>
<tr>
    <td><?php echo $row['p_country']; ?></td>
    <td align="right"><?php echo number_format($row['total'], 0); ?></td>
</tr>
<?php
}
?>

<tr>
    <td align="right"><strong>รวมทั้งหมด</strong></td>
    <td align="right"><strong><?php echo number_format($grandTotal, 0); ?></strong></td>
</tr>
</table>

<?php mysqli_close($conn); ?>

<script>
    // รับค่าจาก PHP มาเป็น JS Array
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($dataValues); ?>;
    const backgroundColors = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF' // สีต่าง ๆ
    ];

    // --- กราฟแท่ง (Bar Chart) ---
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'ยอดขาย',
                data: data,
                backgroundColor: '#36A2EB', // สีฟ้า
                borderWidth: 1
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // --- กราฟวงกลม (Pie Chart) ---
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: backgroundColors, // ใช้หลายสี
                hoverOffset: 4
            }]
        }
    });
</script>

</body>
</html>