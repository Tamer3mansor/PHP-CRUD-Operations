<html>

<body>
    <form method="GET">
        <input type="text" name="search">
        <input type="submit" value="search">
    </form>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>gender</th>
                <th>admin</th>
                <th>action</th>
            </tr>
        </thead>
    </table>
    <?php
    echo session_start();
    if (isset($_SESSION["id"])) {
        echo "welcome {$_SESSION['email']} ";
    } else {
        echo "no session";
    }
    $connection = mysqli_connect("localhost", "root", "", "php");
    if ($connection->connect_error) {
        die("" . mysqli_connect_error());
    } else {
        $query = "select * from `users`";
        if (isset($_GET['search'])) {
            $search_val = mysqli_escape_string($connection, $_GET['search']);
            $query .= " where `name` Like '%{$search_val}%' or `email` like '%" . $search_val . "%' ";
        }
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["name"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["gender"] ?></td>
                <td><?= $row["admin"] ? 'Yes' : 'no' ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>">edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>">delete</a>
                </td>
                <br>
            <?php } ?>
            <footer>
                <a href="create.php">add user</a>
                Number of user <?php echo mysqli_num_rows($result);
                mysqli_free_result($result);
                mysqli_close($connection);
                ?>
            </footer>
            <br>
        </tr>
    <?php }
    ?>
</body>

</html>