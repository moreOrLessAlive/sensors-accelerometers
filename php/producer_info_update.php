<?php
$key = $_POST['key'];
$IDproducer = $_POST['IDproducer'];
$producer = $_POST['producer'];
$producer_info = $_POST['producer_info'];

require_once('dbSelect.php');

$data = array();
switch ($key) {
    case 1:
        $select_sql = ('SELECT * FROM acc_prod WHERE IDproducer = "'.mysqli_real_escape_string($mysqli, $IDproducer).'"');
        $result = mysqli_query($mysqli, $select_sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array(
                'key' => $key,
                'producer' => $row['producer'],
                'producer_info' => $row['producer_info']
            );
        }
        break;
    case 2:
        if ($IDproducer == 0){
            $insert_sql = ('INSERT INTO acc_prod (IDproducer, producer, producer_info)
            VALUES (NULL,
            "'.mysqli_real_escape_string($mysqli, $producer).'",
            "'.mysqli_real_escape_string($mysqli, $producer_info).'"
            )');
            $result = mysqli_query($mysqli, $insert_sql);
            $data = array(
                'key' => $key,
                'producer' => $producer,
                'producer_info' => $producer_info
            );
        }
        else {
            $update_sql = ('UPDATE acc_prod SET
                producer = "' . mysqli_real_escape_string($mysqli, $producer) . '",
                producer_info = "' . mysqli_real_escape_string($mysqli, $producer_info) . '"
                WHERE IDproducer = "' . mysqli_real_escape_string($mysqli, $IDproducer) . '"');
            $result = mysqli_query($mysqli, $update_sql);
            $data = array(
                'key' => $key,
                'producer' => $producer,
                'producer_info' => $producer_info
            );
        }
        break;
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);