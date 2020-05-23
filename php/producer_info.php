<?php
$key = $_POST['key'];

require_once('dbSelect.php');

$select_sql = ('SELECT * FROM acc_prod');
$result = mysqli_query($mysqli, $select_sql);

$data = '<table><tr><td><select id="select_producer" onchange="selectProducer(1)" width="100px">';
$data .= '<option value="0">Новый производитель</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $data .= '<option value="'.$row['IDproducer'].'">'.$row['producer'].'</option>';
}
$data .= '</select></td>';
$data .= '<td align="right" width="400px"><input style="width: 300px" id="input_producer" placeholder="Название"></td>';
$data .= '<td align="right"><button id="producer-btn" onclick="selectProducer(2)" class="sensor-btn">Сохранить</button></td>';
$data .= '<tr><td colspan="4"><textarea id="textarea_producer" cols="150" rows="15"></textarea></td></tr></table>';

echo $data;