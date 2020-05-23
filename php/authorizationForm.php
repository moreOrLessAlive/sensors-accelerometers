<?php
$key = $_POST['key'];

require_once('dbSelect.php');

$data = "<table>";
$data = "<tr>
              <td>Логин</td><td><input id='login'></td>
          </tr>
          <tr>
              <td>Пароль</td><td><input id='password'></td>
          </tr>
          <tr>
              <td align=\"left\"><a onclick=\"authorization(1)\">Вход</a></td>
              <td align=\"right\"><a onclick=\"authorization(2)\">Регистрация</a></td>
          </tr>";
$data .= "</table>";

echo $data;
