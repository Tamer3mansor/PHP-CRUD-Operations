<?php
$conn = mysqli_connect("localhost", "root", "", "php");
if (mysqli_connect_errno() != 0) {
    die("error in connection :>" . mysqli_connect_error());
} else {
    $id = $_GET['id'];

    $result = mysqli_query($conn, 'SELECT * from users where id=' . $id . ' limit 1');
    // print_r($result);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            (int) $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $query = "DELETE from `users`WHERE `id` = $id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                header('location:list_user.php');
            } else {
                echo 'mysqli_error' . mysqli_error($conn);
            }
        }
        ?>
        <html>
        <form method="post">
            <input type="text" name="name" value="<?= isset($row['name']) ? $row['name'] : " " ?>" readonly><br>
            <input type="password" name="password" value="<?= isset($row['pass']) ? $row['pass'] : " " ?>" readonly><br>
            <input type="text" name="email" placeholder="email" value="<?= isset($row['email']) ? $row['email'] : " " ?>"
                readonly><br>
            Male<input type="radio" name="gender" value="male" <?= ($row['gender'] == 'male') ? 'checked' : '' ?>><br>
            Female<input type="radio" name="gender" value="female" <?= ($row['gender'] == 'female') ? 'checked' : '' ?>
                readonly><br>
            Admin<input type="checkbox" name="admin" <?= $row['admin'] ? 'checked' : '' ?>><br>
            <input type="hidden" name="id" value=<?php echo $row['id'] ?> readonly><br>
            <input type="submit" name="submit" value="Delete">

        </form>

        </html>
        <?php

    } else {
        echo "No such id";
        header('location:delete.php');
    }
}

?>