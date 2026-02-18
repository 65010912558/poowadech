<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>65010912558 ภูวเดช โลเกตุ(ภู)</title>
<style>
    /* ตกแต่งปุ่มเล็กน้อยเพื่อให้ดูง่ายขึ้น */
    .btn-green { background-color: #28a745; color: white; padding: 10px; cursor: pointer; border: none; }
    .btn-yellow { background-color: #ffc107; color: black; padding: 10px; cursor: pointer; border: none; }
    .image-container { margin-top: 20px; }
</style>
</head>

<body>
    <h1>งาน K 65010912558 ภูวเดช โลเกตุ(ภู)</h1>

    <button class="btn-green" onclick="showImage('me')">รูปตัวเอง</button>
    <button class="btn-yellow" onclick="showImage('teacher')">รูปอาจารย์</button>

    <div class="image-container">
        <img id="display-img" src="../j/img/1.PNG" width="300" style="display:none;">
    </div>

    <script>
        function showImage(type) {
            const imgElement = document.getElementById('display-img');
            imgElement.style.display = 'block'; // แสดงรูปภาพเมื่อมีการกดปุ่ม
            
            if (type === 'me') {
                // ใส่ที่อยู่ไฟล์รูปของตัวเอง
                imgElement.src = '../j/img/1.PNG'; 
            } else if (type === 'teacher') {
                // ใส่ที่อยู่ไฟล์รูปของอาจารย์ (แก้ชื่อไฟล์ให้ถูกต้องนะครับ)
                imgElement.src = '../j/img/2.PNG'; 
            }
        }
    </script>
</body>
</html>