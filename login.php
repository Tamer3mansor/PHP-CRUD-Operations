<?php
$conn = mysqli_connect("localhost", "root", "", "php");
if (mysqli_connect_errno()) {
    echo "" . mysqli_connect_error();
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $name= mysqli_escape_string($conn,$_POST['name']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = sha1($_POST['password']);
        $query = "SELECT * from `users` where `email` = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($password === $row['pass']) {

                    print_r($_SESSION);
                    header('location:list_user.php');
                } else {
                    echo 'password wrong \n';
                }
            }
        } else {
            echo 'error No such mail or pass';
        }

    }
}

?>
<html>

<body>
    <form method="post">
        mail <input type="email" name="email"><br>
        password <input type="password" name="password"><br>
        <input type="submit" name="LogIn">
    </form>
</body>

</html>