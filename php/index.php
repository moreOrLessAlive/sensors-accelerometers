<?php
//function get_sensors_list(){
    $dbName = 'sensors';
    $mysqli = new mysqli('127.0.0.1:3307', 'root', '', 'sensors');
    mysqli_select_db($mysqli, $dbName);
//header("Content-Type: application/json; charset=UTF-8");

$data = array();
    $select_sql = ('SELECT * FROM acc_accelerometers');
    $result = mysqli_query($mysqli, $select_sql);

    $dataOutput = '';
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $measurement_range = $row['Lower measurement range'].' - '.$row['Upper measurement range'];
        $row['Resource, h'] = str_replace(',','.',$row['Resource, h']);
        $row['Measuring method'] = str_replace(',','.',$row['Measuring method']);
        $measurement_range = str_replace(',','.',$measurement_range);
//        $dataOutput = json_encode([$row['title'],$row['producer'],$row['Resource, h'],$row['Measuring method'],$measurement_range],JSON_UNESCAPED_UNICODE);
        $dataOutput = ([$row['title'],$row['producer'],$row['Resource, h'],$row['Measuring method'],$measurement_range]);
//        $dataOutput .= json_encode($row);
//        $data = json_encode($row);
//        echo $data;
        $i++;
    }
//    echo $dataOutput;
    echo json_encode($dataOutput,JSON_UNESCAPED_UNICODE);
//}
//include_once 'sensors.php';
//get_sensors_list();

function get_sensors_list(){
$dbName = 'sensors';
$mysqli = new mysqli('127.0.0.1:3307', 'root', '', 'sensors');
mysqli_select_db($mysqli, $dbName);

$data = array();
$select_sql = ('SELECT * FROM acc_accelerometers');
$result = mysqli_query($mysqli, $select_sql);

$dataOutput = '';
while ($row = mysqli_fetch_assoc($result)) {
    $measurement_range = $row['Lower measurement range'].' - '.$row['Upper measurement range'];
    $dataOutput .= json_encode([$row['title'],$row['producer'],$row['Resource, h'],$row['Measuring method'],$measurement_range],JSON_UNESCAPED_UNICODE);
}
echo $dataOutput;
}

function sensor_edit(){
    $result = '<tr>hi</tr>';
    return $result;
}