<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สรุปยอดขายตามประเทศ</title>
</head>

<body>

<h1>ภูวเดช โลเกตุ (ภู)</h1>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ประเทศ</th>
    <th>ยอดขายรวม</th>
</tr>

<?php
include_once("connectdb.php");

$sql = "SELECT p_country, SUM(p_amount) AS total
        FROM popsupermarket
        GROUP BY p_country";

$rs = mysqli_query($conn, $sql);

$grandTotal = 0; // ⭐ ยอดรวมทั้งหมด

while ($data = mysqli_fetch_array($rs)) {
    $grandTotal += $data['total']; // ⭐ บวกยอดแต่ละประเทศ
?>
<tr>
    <td><?php echo $data['p_country']; ?></td>
    <td align="right"><?php echo number_format($data['total'], 0); ?></td>
</tr>
<?php
}
?>

<!-- แถวแสดงยอดรวมทั้งหมด -->
<tr>
    <td align="right"><strong>รวมทั้งหมด</strong></td>
    <td align="right"><strong><?php echo number_format($grandTotal, 0); ?></strong></td>
</tr>

</table>

<?php
mysqli_close($conn);
?>

</body>
</html>