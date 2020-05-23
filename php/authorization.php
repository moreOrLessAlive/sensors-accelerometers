<?php
require_once('dbSelect.php');
//$_SERVER;
//$_SESSION;
//$_COOKIE;

$key = $_POST['key'];

$login = $_POST['login'];
$password = $_POST['password'];

$regLogin = $_POST['regLogin'];
$regPassword = $_POST['regPassword'];
$regPasswordRepeat = $_POST['regPasswordRepeat'];
$regSurname = $_POST['regSurname'];
$regName = $_POST['regName'];
$regPatronymic = $_POST['regPatronymic'];
$Email = $_POST['Email'];
$DayNight = $_POST['DayNight'];

$errors = array();
$data = '';
switch ($key) {
    case 1: // Авторизация
        if(trim($login == "")){
            $errors[] = 'Введите логин!';
        }
        else {
            $select_sql = ('SELECT * FROM acc_users WHERE userLogin = "'.mysqli_real_escape_string($mysqli, $login).'"');
            $result = mysqli_query($mysqli, $select_sql);
            $user = mysqli_fetch_assoc($result);
            if ($user) {
                if($user['userPassword'] == $password){
                    $userSurname = $user['userSurname'];
                    $userName = $user['userName'];
                    $userPatronymic = $user['userPatronymic'];
                    $_SESSION['logged_user'] = $user;
                }
                else{
                    $errors[] = 'Неверный пароль!';
                }
            }
            else{
                $errors[] = 'Пользователь с таким логином не найден!';
            }
        }
        if(empty($errors)){
            $data = array(
                "errorKey" => 0,
                'userSurname' => $userSurname,
                'userName' => $userName,
                'userPatronymic' => $userPatronymic
            );
        }
        else{
            $data = array(
                "errorKey" => 1,
                "data" => $errors
            );
        }
        break;
    case 2: // Регистрация
        if(trim($regLogin == "")){
            $errors[] = 'Введите логин!';
        }
        if(!ctype_alpha(trim($regLogin))){
            $errors[] = 'Логин должен содержать только латиницу!';
        }
        $select_sql_login = ('SELECT * FROM acc_users WHERE userLogin = "'.mysqli_real_escape_string($mysqli, $regLogin).'"');
        $result_login = mysqli_query($mysqli, $select_sql_login);
        $user_login = mysqli_fetch_assoc($result_login);
        if($user_login){
            if($regLogin == $user_login['userLogin']){
                $errors[] = 'Логин уже используется!';
            }
        }
        if(trim($regPassword == "")){
            $errors[] = 'Введите пароль!';
        }
        if(trim($regPasswordRepeat != $regPassword)){
            $errors[] = 'Введенный пароль не совпадает!';
        }
        if(trim($regSurname == "")){
            $errors[] = 'Введите фамилию!';
        }
        if(trim($regName == "")){
            $errors[] = 'Введите имя!';
        }
        if(trim($regPatronymic == "")){
            $errors[] = 'Введите отчество!';
        }
        if ($Email != "") {
            $select_sql_Email = ('SELECT * FROM acc_users WHERE userEmail = "' . mysqli_real_escape_string($mysqli, $Email) . '"');
            $result_email = mysqli_query($mysqli, $select_sql_Email);
            $user_email = mysqli_fetch_assoc($result_email);
            if ($user_email) {
                if ($Email == $user_email['userEmail']) {
                    $errors[] = 'Email уже используется!';
                }
            }
        }
        if(empty($errors)){
            $insert_sql = ('INSERT INTO acc_users 
            (userID, userLogin, userPassword, userStatus, 
            userSurname, userName, userPatronymic, userEmail, userRegDate)
            VALUES (NULL, 
            "'.mysqli_real_escape_string($mysqli, $regLogin).'",
            "'.mysqli_real_escape_string($mysqli, $regPassword).'",
            "'.mysqli_real_escape_string($mysqli, 1).'",
            "'.mysqli_real_escape_string($mysqli, $regSurname).'",
            "'.mysqli_real_escape_string($mysqli, $regName).'",
            "'.mysqli_real_escape_string($mysqli, $regPatronymic).'",
            "'.mysqli_real_escape_string($mysqli, $Email).'",
            "'.mysqli_real_escape_string($mysqli, date("Y-m-d H:i:s")).'"
            )');
            $result = mysqli_query($mysqli, $insert_sql);
            // Костыль, вызывать ради авторизации SQL запрос исчерпывающе
            // Логин не повторяется, впрочем можно и по id
            $select_sql = ('SELECT * FROM acc_users WHERE userLogin = "'.mysqli_real_escape_string($mysqli, $regLogin).'"');
            $result = mysqli_query($mysqli, $select_sql);
            $user = mysqli_fetch_assoc($result);
            $_SESSION['logged_user'] = $user;
            $data = array(
                "errorKey" => 0,
                "data" => $insert_sql
            );
        }
        else{
            $data = array(
                "errorKey" => 1,
                "data" => array_shift($errors)
            );
        }
        break;
    case 3: // Проверка авторизации
        if(isset($_SESSION['logged_user'])){
            $data = array(
                "errorKey" => 0,
                'userSurname' => $_SESSION['logged_user']['userSurname'],
                'userName' => $_SESSION['logged_user']['userName'],
                'userPatronymic' => $_SESSION['logged_user']['userPatronymic'],
                'DayNight' => $_SESSION['DayNight'],
                'userStatus' => $_SESSION['logged_user']['userStatus']
            );
        }
        else{
            $data = array(
                "errorKey" => 1,
                'userSurname' => $_SESSION['logged_user']['userSurname'],
                'userName' => $_SESSION['logged_user']['userName'],
                'userPatronymic' => $_SESSION['logged_user']['userPatronymic'],
                'DayNight' => $_SESSION['DayNight'],
                'userStatus' => 0
            );
        }
        break;
    case 4: // Выбор темы
        $_SESSION['DayNight'] = $DayNight;
        $data = $_SESSION['DayNight'];
        break;
    case 5: // Выход
        unset($_SESSION['logged_user']);
        $data = array(
            "errorKey" => 0
        );
        break;
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);
