<?php

include "config.php";

$sql = "SELECT * FROM led_status WHERE id = 1";
$result = $conn->query($sql);

$data = $result->fetch_assoc();

header('Content-Type: application/json');

echo json_encode($data);

?>