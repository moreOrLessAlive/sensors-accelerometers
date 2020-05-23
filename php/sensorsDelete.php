<?php
if(isset($_POST['ID'])){

    $ID = $_POST['ID'];

    require_once('dbSelect.php');

    $sqldelete = ('UPDATE acc_accelerometers SET deleted = 1 WHERE ID='.$ID);
    $result_delete = mysqli_query($mysqli, $sqldelete);
    echo json_encode($sqldelete,JSON_UNESCAPED_UNICODE);
}
?>