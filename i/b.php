<?php
// เปิดการแจ้งเตือน Error ทั้งหมดเพื่อหาจุดที่ทำให้หน้าขาว
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ================== ตั้งค่า DB ==================
$host = "localhost";
$user = "root";
$pass = "1234";
$db   = "2558db"; 

$conn = mysqli_connect($host, $user, $pass, $db);
mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
}

// ================== ลบข้อมูล ==================
if (isset($_GET['del'])) {
    $pid = (int)$_GET['del'];

    $res = mysqli_query($conn, "SELECT p_image FROM provinces WHERE p_id=$pid");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        $file = __DIR__ . "/" . $row['p_image'];
        if (is_file($file)) {
            @unlink($file);
        }
    }

    mysqli_query($conn, "DELETE FROM provinces WHERE p_id=$pid");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ================== เพิ่มข้อมูล ==================
if (isset($_POST['submit'])) {
    $pname = trim($_POST['pname'] ?? "");
    $rid   = (int)($_POST['rid'] ?? 0);

    if ($pname !== "" && $rid > 0 && isset($_FILES['pimage']) && $_FILES['pimage']['error'] === 0) {
        
        $uploadDir = __DIR__ . "/upload/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $ext = strtolower(pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION));
        $newName = "p_" . time() . "_" . rand(1000, 9999) . "." . $ext;
        $dest = $uploadDir . $newName;

        if (move_uploaded_file($_FILES['pimage']['tmp_name'], $dest)) {
            $imgPath = "upload/" . $newName;
            $stmt = mysqli_prepare($conn, "INSERT INTO provinces (p_name, r_id, p_image) VALUES (?,?,?)");
            mysqli_stmt_bind_param($stmt, "sis", $pname, $rid, $imgPath);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// ดึงข้อมูลภาค
$regions = mysqli_query($conn, "SELECT r_id, r_name FROM register ORDER BY r_id ASC");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ระบบจัดการจังหวัด</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        img { width: 100px; height: auto; }
        .form-box { background: #f4f4f4; padding: 20px; border-radius: 5px; }
    </style>
</head>
<body>

<div class="form-box">
    <h2>เพิ่มข้อมูลจังหวัด</h2>
    <form method="post" enctype="multipart/form-data">
        <p>ชื่อจังหวัด: <input type="text" name="pname" required></p>
        <p>รูปภาพ: <input type="file" name="pimage" required></p>
        <p>ภาค: 
            <select name="rid" required>
                <option value="">-- เลือกภาค --</option>
                <?php while($r = mysqli_fetch_assoc($regions)): ?>
                    <option value="<?= $r['r_id'] ?>"><?= htmlspecialchars($r['r_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </p>
        <button type="submit" name="submit">บันทึก</button>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อจังหวัด</th>
            <th>ภาค</th>
            <th>รูป</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT p.*, r.r_name 
                FROM provinces p 
                LEFT JOIN register r ON p.r_id = r.r_id 
                ORDER BY p.p_id DESC";
        $result = mysqli_query($conn, $sql);
        $i = 1;
        while($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($row['p_name']) ?></td>
            <td><?= htmlspecialchars($row['r_name']) ?></td>
            <td><img src="<?= htmlspecialchars($row['p_image']) ?>"></td>
            <td>
                <a href="?del=<?= $row['p_id'] ?>" onclick="return confirm('ลบหรือไม่?')">ลบ</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>