<?php
require_once('dbSelect.php');

$key = $_POST['key'];

$select_sql = ('SELECT * FROM acc_literature');
$result = mysqli_query($mysqli, $select_sql);

$data = '<table width="800px"><tr><td colspan="2"><select id="select_literature" onchange="selectLiterature(1)" width="100px">';
$data .= '<option value="0">Новая литература</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $data .= '<option value="'.$row['IDliterature'].'">'.$row['title'].'</option>';
}
$data .= '</select></td></tr>';
$data .= '<tr><td align="right" colspan="2"><input style="width: 800px" id="literature_title" placeholder="Название"></td></tr>';
$data .= '<tr><td align="right">Автор: <input style="width: 300px" id="literature_author" placeholder="Автор"></td>';
$data .= '<td align="right">Издатель: <input style="width: 300px" id="literature_publisher" placeholder="Издатель"></td></tr>';
$data .= '<tr align="right"><td>Год: <input class="datepicker" style="width: 300px" id="literature_year" placeholder="Год"></td>';
$data .= '<td align="right">Язык: <input style="width: 300px" id="literature_language" placeholder="Язык"></td></tr>';
$data .= '<tr><td align="right" colspan="2"><button id="literature-btn" onclick="selectLiterature(2)" class="sensor-btn">Сохранить</button></td></tr></table>';

echo $data;