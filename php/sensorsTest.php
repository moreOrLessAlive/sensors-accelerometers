<?php
header('Content-type: application/json');

$dbName = 'sensors';
$dbUser = 'root';
$dbPass = '';
$dbHost = '127.0.0.1:3307';

//$dbhandle = sqlite_open('sqlitedb');
//$result = sqlite_array_query($dbhandle, 'SELECT name, email FROM users LIMIT 25', SQLITE_ASSOC);
//foreach ($result as $entry) {
//    echo 'Имя: ' . $entry['name'] . '  E-mail: ' . $entry['email'];
//}

//$result = "";
//$dbhandle = sqlite_open('sensors');
//$row = sqlite_array_query($dbhandle, 'SELECT * FROM acc_accelerometers', SQLITE_ASSOC);
////$arr = $query->fetchAll();
//foreach ($row as $entry) {
//    $result .= $row;
//}
//fann_print_error($result);

//$dbName = 'sensors';
//$mysqli = new mysqli('http://127.0.0.1:81', 'root', '', 'sensors') ;
//mysqli_select_db($mysqli,$dbName);
//$data = array();
//$select_sql = ('SELECT * FROM acc_accelerometers');
//$result = mysqli_query($mysqli,$select_sql);
//while($row = mysqli_fetch_row($result)) {
//    $data = json_encode($row);
//}
//echo json_encode($result);

//$output ='';
//// если в массиве пост есть ключ nameUser, то
//if (isset($_POST['nameUser'])) {
//    // в переменную name помещаем переданное с помощью запроса имя
//    $name = $_POST['nameUser'];
//    // добавляем в переменную output строку приветствия с именем
//    $output .= 'Здравствуйте, ' . $name . '! ';
//    // добавляем в переменную output IP-адрес пользователя
//    if ($_SERVER['REMOTE_ADDR']) {
//        $output .= 'Ваш IP адрес: ' . $_SERVER['REMOTE_ADDR'];
//    }
//}

function get_sensors_list(){
    $dbName = 'sensors';
    $mysqli = new mysqli('http://127.0.0.1:81', 'root', '', 'sensors') ;
    mysqli_select_db($mysqli,$dbName);
    $data = array();
    $select_sql = ('SELECT * FROM acc_accelerometers');
    $result = mysqli_query($mysqli,$select_sql);

    while($row = mysqli_fetch_row($result)) {
        $data = json_encode($row);
    }
    return $data;
}
echo json_encode($result);