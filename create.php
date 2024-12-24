<?php
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
        $conn = mysqli_connect("localhost", "root", "", "php");
        if (!$conn) {
            echo mysqli_connect_error();
            exit;
            // die("Connection error: " . mysqli_connect_error());
        }

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = sha1($_POST['password']);
        $admin = isset($_POST['admin']) ? 1 : 0;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
        $avatar = "";
        if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/project/uploads';
            $tmp_dir = $_FILES['avatar']['tmp_name'];
            $img_name = basename($_FILES['avatar']['name']);
            move_uploaded_file($tmp_dir, "$upload_dir/$name.$img_name");
        } else {
            echo $_FILES['avatar']['error'];
        }
        $query = "INSERT INTO `users` (`name`, `pass`, `email`, `gender`, `admin`) 
                  VALUES ('$name', '$password', '$email', '$gender', $admin)";

        if (mysqli_query($conn, $query)) {
            header("Location:list_user.php");
            exit;
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }

}
?>

<!DOCTYPE html>
<html>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '--' ?>" /><?php if (in_array("name", $error_fields))
                  echo "Enter the name" ?>
            <br>
            <input type="email" id="email" placeholder="Email" name="email"
                value="<?= isset($_POST['email']) ? $_POST['email'] : '--' ?>"><?php if (in_array("email", $error_fields))
                          echo "Enter the email" ?><br>
            <input type="password" id="password" placeholder="Password" name="password"><?php if (in_array("password", $error_fields))
                          echo "Enter password high than 5 char" ?><br>
            Male <input type="radio" id="male" name="gender" value="male" required> <br>
            Female <input type="radio" id="female" name="gender" value="female" required><br>
            Admin <input type="checkbox" name="admin"><br>
            <input type="file" value="file" name="avatar"><br>
            <input type="submit" value="add user">
        </form>
    </body>

    </html>