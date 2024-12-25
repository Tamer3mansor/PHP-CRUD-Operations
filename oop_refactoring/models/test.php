<?php
// $models = include('dbconnection.php');
require('dbconnection.php');
$instance = new orm(["localhost", "root", "", "php"]);
$instance->create_connection();
// print_r($instance->selectall("users"));
print_r($instance->select("users",'*',''));
?>