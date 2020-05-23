<?php
require_once('dbSelect.php');

$data = array();
$select_sql = ('SELECT * FROM acc_accelerometers');
$result = mysqli_query($mysqli, $select_sql);

$dataOutput = array();
while ($row = mysqli_fetch_assoc($result)) {
    $measurement_range = $row['Lower measurement range'].' - '.$row['Upper measurement range'];
    $row['Resource, h'] = str_replace(',','.',$row['Resource, h']);
    $row['Measuring method'] = str_replace(',','.',$row['Measuring method']);
    $measurement_range = str_replace(',','.',$measurement_range);
//        $dataOutput = json_encode([$row['title'],$row['producer'],$row['Resource, h'],$row['Measuring method'],$measurement_range],JSON_UNESCAPED_UNICODE);
//    $dataOutput[$row['ID']] = ([$row['title'],$row['producer'],$row['Resource, h'],$row['Measuring method'],$measurement_range]);
    $dataOutput = [$row['title'],$row['producer'],$row['Resource, h'],$row['Measuring method'],$measurement_range];
}

echo json_encode($dataOutput,JSON_UNESCAPED_UNICODE);