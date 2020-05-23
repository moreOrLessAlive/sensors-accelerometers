<?php
//if(isset($_POST['ID']) && $_POST['ID'] != '')
$ID = $_POST['ID'];
require_once('dbSelect.php');

$data = array();
//$select_sql = ('SELECT * FROM acc_accelerometers WHERE ID='.$ID);
$select_sql = ('SELECT * FROM acc_accelerometers
    LEFT JOIN acc_prod ON acc_accelerometers.IDproducer = acc_prod.IDproducer
    LEFT JOIN acc_way ON acc_accelerometers.IDmeasuring = acc_way.IDmeasuring
    WHERE ID='.$ID);
$result = mysqli_query($mysqli, $select_sql);

$row = mysqli_fetch_array($result);
    $data = array(
            'ID'=>$row['ID'],
            'title'=>$row['title'],
            'producer'=>$row['producer'],
            'resource_h'=>$row['resource_h'],
            'sensitive_element'=>$row['sensitive_element'],
            'electric_circuit'=>$row['electric_circuit'],
            'weight_g'=>$row['weight_g'],
            'infelicity_percent'=>$row['infelicity_percent'],
            'lower_temperature_threshold_c'=>$row['lower_temperature_threshold_c'],
            'upper_temperature_threshold_c'=>$row['upper_temperature_threshold_c'],
            'lower_measurement_range'=>$row['lower_measurement_range'],
            'upper_measurement_range'=>$row['upper_measurement_range'],
            'unit_of_measurement'=>$row['unit_of_measurement'],
            'length_mm'=>$row['length_mm'],
            'width_mm'=>$row['width_mm'],
            'height_mm'=>$row['height_mm']
    );
echo json_encode($data,JSON_UNESCAPED_UNICODE);