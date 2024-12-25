<?php
require '../oop_refactoring/models/orm.php';
$error_fields = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!(isset($_POST["name"]) && !empty($_POST["name"]))) {
    $error_fields[] = "name";
  }
  if (!(isset($_POST["email"]) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
    $error_fields[] = "email";
  }
  if (!(isset($_POST["password"]) && strlen($_POST["password"]) > 5)) {
    $error_fields[] = "password";
  }

  if (!$error_fields) {
    $orm_instance = new orm(["localhost", "root", "", "php"]);
    $conn = $orm_instance->create_connection();
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = sha1($_POST['password']);
    $admin = isset($_POST['admin']) ? 1 : 0;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : 'male';
    $avatar = "";
    if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
      $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/project/uploads';
      $tmp_dir = $_FILES['avatar']['tmp_name'];
      $img_name = basename($_FILES['avatar']['name']);
      move_uploaded_file($tmp_dir, "$upload_dir/$name.$img_name");
    } else {
      echo $_FILES['avatar']['error'];
    }
    $result = $orm_instance->insert('users', ["name" => $name, "pass" => $password, "email" => $email, "gender" => $gender, "admin" => $admin]);
    // print_r($result);
    if ($result) {
      header("Location:list_user.php");
      exit;
    } else {
      echo "Database error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }

}
require "../oop_refactoring/views/signup.php";
?>