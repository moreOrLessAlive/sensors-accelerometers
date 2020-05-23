<?php
require_once('dbSelect.php');

$data = array();
//$select_sql = ('SELECT * FROM acc_accelerometers WHERE deleted != 1');
$select_sql = ('SELECT * FROM acc_accelerometers
    LEFT JOIN acc_prod ON acc_accelerometers.IDproducer = acc_prod.IDproducer
    LEFT JOIN acc_way ON acc_accelerometers.IDmeasuring = acc_way.IDmeasuring
    WHERE deleted != 1');
$result = mysqli_query($mysqli, $select_sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $subdata = array();
    $measurement_range = $row['lower_measurement_range'].' — '.$row['upper_measurement_range'].' ['.$row['unit_of_measurement'].']';
    $row['resource_h'] = intval(str_replace(',','.',$row['resource_h']))." ч";
    $row['measuring_method'] = str_replace(',','.',$row['measuring_method']);
    $measurement_range = str_replace(',','.',$measurement_range);
    $subdata[]=$row['title']; // Название
    $subdata[]=$row['infelicity_percent'].' %'; // Погрешность
    $subdata[]=$measurement_range; // диапазон иземерений
    $subdata[]=$row['resource_h']; // Ресурс, ч
    $subdata[]=$row['weight_g']. ' г'; // Вес
    $subdata[]=$row['length_mm'].'x'.$row['width_mm'].'x'.$row['height_mm']. ' мм'; // Габариты
    $subdata[]=$row['measuring_method']; // способ измерения
//    $subdata[]='<button type="button" id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row['ID'].'"><img height="16px" src="source/file_edit.png"></button>
    $subdata[]='<a id="getEdit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$row['ID'].'"><img height="16px" src="source/file_edit.png"></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a id="getDelete" data-toggle="modal" data-target="#myModal" data-id="'.$row['ID'].'" class="btn btn-danger btn-xs"><img height="16px" src="source/file_delete.png"></a>';
    $data[] = $subdata;
}

$json_data = array(
//    "draw"              =>  intval($request['draw']),
//    "recordsTotal"      =>  intval($totalData),
//    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);