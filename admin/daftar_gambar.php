<?php
session_start();
if($_SESSION['admin_username'] == ''){
   header("location:login.php");
   exit();
}
$files = array_filter(glob('../gambar/*'), 'is_file');

$response = [];

foreach ($files as $file) {
	$response[] = basename($file);
}

header('Content-Type: application/json');
echo json_encode($response);
die();
?>