<?php
require '../oop_refactoring/models/orm.php';
require '../oop_refactoring/views/login.php';
$orm_instance = new orm(["localhost", "root", "", "php"]);
$conn = $orm_instance->create_connection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = sha1($_POST['password']);

    $result = $orm_instance->select("users", '*', " email = '$email'");
    $row = $result[0];
    if ($row) {
        if ($password === $row['pass']) {
            print_r($_SESSION);
            header('location:list_user.php');
        } else {
            echo 'password wrong \n';
        }
    } else {
        echo 'error No such mail or pass';
    }

}
