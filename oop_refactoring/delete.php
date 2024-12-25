<?php
require '../oop_refactoring/models/orm.php';
$orm_instance = new orm(["localhost", "root", "", "php"]);
$conn = $orm_instance->create_connection();
if ($conn) {
    $id = $_GET['id'];
    $row = $orm_instance->select('users', '*', "id = $id ");
    $row = $row[0];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $result = $orm_instance->delete('users', " id = $id");
        if ($result) {
            header('location:list_user.php');
        } else {
            echo 'mysqli_error' . mysqli_error($conn);
        }
    }
    ?>
    <?php
    require "../oop_refactoring/views/delete.php";

}

?>