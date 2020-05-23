<?php
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

$insert_sql = ('INSERT INTO acc_accelerometers (
ID, title, producer, resource_h, sensitive_element, 
weight_g, infelicity_percent, lower_temperature_threshold_c, upper_temperature_threshold_c,	lower_measurement_range, 
upper_measurement_range, unit_of_measurement, length_mm, width_mm, height_mm, deleted)
VALUES (NULL, 
"'.mysqli_real_escape_string($mysqli, $title).'",
"'.mysqli_real_escape_string($mysqli, $producer).'",
"'.mysqli_real_escape_string($mysqli, $resource_h).'",
"'.mysqli_real_escape_string($mysqli, $sensitive_element).'",
"'.mysqli_real_escape_string($mysqli, $weight_g).'",
"'.mysqli_real_escape_string($mysqli, $infelicity_percent).'",
"'.mysqli_real_escape_string($mysqli, $lower_temperature_threshold_c).'",
"'.mysqli_real_escape_string($mysqli, $upper_temperature_threshold_c).'",
"'.mysqli_real_escape_string($mysqli, $lower_measurement_range).'",
"'.mysqli_real_escape_string($mysqli, $upper_measurement_range).'",
"'.mysqli_real_escape_string($mysqli, $unit_of_measurement).'",
"'.mysqli_real_escape_string($mysqli, $length_mm).'",
"'.mysqli_real_escape_string($mysqli, $width_mm).'",
"'.mysqli_real_escape_string($mysqli, $height_mm).'",
0)');
//"'.($title).'",
//"'.($producer).'",
//"'.($resource_h).'",
//"'.($sensitive_element).'",
//"'.($weight_g).'",
//"'.($infelicity_percent).'",
//"'.($lower_temperature_threshold_c).'",
//"'.($upper_temperature_threshold_c).'",
//"'.($lower_measurement_range).'",
//"'.($upper_measurement_range).'",
//"'.($unit_of_measurement).'",
//"'.($length_mm).'",
//"'.($width_mm).'",
//"'.($height_mm).'")');

//$result = mysqli_query($mysqli, $select_sql);

$result = mysqli_query($mysqli, $insert_sql);

echo json_encode($insert_sql,JSON_UNESCAPED_UNICODE);