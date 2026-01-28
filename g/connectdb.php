<?php
		$host = "localhost";
		$user = "root";
		$pwd = "1234";
		$db = "2558";
		$conn = mysqli_connect($host, $user, $pwd, $db) or die ("เชื่อมต่อฐานข้อมูลไม่ได้");
		mysqli_query($conn, "SET NAMES utf8");
?>