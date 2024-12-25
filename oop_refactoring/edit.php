<?php
require("../oop_refactoring/models/orm.php");
$orm_instance = new orm(["localhost", "root", "", "php"]);
$conn = $orm_instance->create_connection();
$id = $_GET['id'];
$id = $_GET['id'];
$row = $orm_instance->select('users', '*', "id = $id ");
$row = $row[0];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $gender = mysqli_escape_string($conn, $_POST['gender']);
    $admin = !empty($_POST['admin']) ? 1 : 0;
    (int) $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $password = $_POST['password'];
    $result = $orm_instance->update('users', "name = $name , email = $email , gender = $gender , admin = $admin , pass = $password", " id = $id ");
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:list_user.php');
    } else {
        echo 'mysqli_error' . mysqli_error($conn);
    }
}



require "../oop_refactoring/views/edit.php";

?>