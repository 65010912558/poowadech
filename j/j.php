<?php
// --- ส่วนของการกำหนดข้อมูล (Data Section) ---
$work_name = "งาน J";
$student_id = "65010912558"; // ใส่รหัสนิสิตของคุณ
$name = "นายภูวเดช โลเกตุ"; // ใส่ชื่อของคุณ
$image_path = "profile.jpg"; // ชื่อไฟล์รูปภาพของคุณ (ต้องอยู่ในโฟลเดอร์เดียวกับไฟล์ php)
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แสดงข้อมูลนิสิต</title>
    <style>
        body { font-family: 'Tahoma', sans-serif; text-align: center; margin-top: 50px; }
        .card { border: 1px solid #ddd; padding: 20px; width: 300px; margin: 0 auto; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        img { width: 150px; height: 180px; object-fit: cover; border-radius: 10px; margin-bottom: 15px; }
        h2 { color: #333; }
        p { color: #666; font-size: 1.1em; }
    </style>
</head>
<body>

    <div class="card">
        <img src="<?php echo $image_path; ?>" alt="รูปนิสิต">

        <h2><?php echo $work_name; ?></h2>
        <p><strong>รหัสนิสิต:</strong> <?php echo $student_id; ?></p>
        <p><strong>ชื่อ:</strong> <?php echo $name; ?></p>
    </div>

</body>
</html>