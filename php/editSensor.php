<?php
$ID = $_POST['ID'];
$title = $_POST['title'];
$producer = $_POST['producer'];
$resource_h = $_POST['resource_h'];
$sensitive_element = $_POST['sensitive_element'];
$weight_g = $_POST['weight_g'];
$infelicity_percent = $_POST['infelicity_percent'];
$lower_temperature_threshold_c = $_POST['lower_temperature_threshold_c'];
$upper_temperature_threshold_c = $_POST['upper_temperature_threshold_c'];
$lower_measurement_range = $_POST['lower_measurement_range'];
$upper_measurement_range = $_POST['upper_measurement_range'];
$unit_of_measurement = $_POST['unit_of_measurement'];
$length_mm = $_POST['length_mm'];
$width_mm = $_POST['width_mm'];
$height_mm = $_POST['height_mm'];

require_once('dbSelect.php');

$update_sql = ('UPDATE acc_accelerometers SET
title = "'.mysqli_real_escape_string($mysqli, $title).'",
producer = "'.mysqli_real_escape_string($mysqli, $producer).'",
resource_h = "'.mysqli_real_escape_string($mysqli, $resource_h).'",
sensitive_element = "'.mysqli_real_escape_string($mysqli, $sensitive_element).'",
weight_g = "'.mysqli_real_escape_string($mysqli, $weight_g).'",
infelicity_percent = "'.mysqli_real_escape_string($mysqli, $infelicity_percent).'",
lower_temperature_threshold_c = "'.mysqli_real_escape_string($mysqli, $lower_temperature_threshold_c).'",
upper_temperature_threshold_c = "'.mysqli_real_escape_string($mysqli, $upper_temperature_threshold_c).'",
lower_measurement_range = "'.mysqli_real_escape_string($mysqli, $lower_measurement_range).'",
upper_measurement_range = "'.mysqli_real_escape_string($mysqli, $upper_measurement_range).'",
unit_of_measurement = "'.mysqli_real_escape_string($mysqli, $unit_of_measurement).'",
length_mm = "'.mysqli_real_escape_string($mysqli, $length_mm).'",
width_mm = "'.mysqli_real_escape_string($mysqli, $width_mm).'",
height_mm = "'.mysqli_real_escape_string($mysqli, $height_mm).'"
WHERE ID='.$ID);

//if ($mysqli->query($update_sql) === TRUE) {
//    echo "Record updated successfully";
//} else {
//    echo "Error updating record: " . $mysqli->error;
//}

//if (mysqli_query($mysqli, $update_sql)) {
//    echo "Record updated successfully";
//} else {
//    echo "Error updating record: " . mysqli_error($mysqli);
//}

$result = mysqli_query($mysqli, $update_sql);

echo json_encode($result,JSON_UNESCAPED_UNICODE);