<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<h1>ภูวเดช โลเกตุ(ภู) - โปรแกรมสูตรคูณ</h1>
<form method = "post" action="">
	แม่สูตรคูณ<input type = "number"min="2" max="1000" name="a"autofocus required>
    <button type="submit" name = "Submit">OK</button>
</form>
<hr>

<?php
if(isset($_POST['Submit'])){
	$m = $_POST ['a'];
	for($i = 1; $i<=12; $i++){
	$x = $m*$i ;
	echo "{$m} x {$i} = {$x}<br> ";
	}
}
	

?>
<body>
</body>
</html>
