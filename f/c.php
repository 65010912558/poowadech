<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<h1>ภูวเดช โลเกตุ(ภู)</h1>
<form method = "get" action="">
	กรอกคะแนน<input type = "number"min="0" max="100" name="a"autofocus required>
    <button type="submit" name = "Submit">OK</button>
</form>
<hr>

<?php
if(isset($_GET['Submit'])) {
	$score = $_GET['a'];
if ($score >= 80) {
$grade = "A" ;
} else if ($score >= 70) {
$grade = "B" ;
} else if ($score >= 60) {
$grade = "C" ;
} else if ($score >= 50) {
$grade = "D" ;
} else {
$grade = "F" ;
}
echo "คะแนน $score ได้เกรด $grade" ;
	}
	
	

?>
<body>
</body>
</html>
