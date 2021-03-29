<?php
$files = array_filter(glob('../gambar/*'), 'is_file');

$response = [];

foreach ($files as $file) {
	$response[] = basename($file);
}

header('Content-Type: application/json');
echo json_encode($response);
die();
?>