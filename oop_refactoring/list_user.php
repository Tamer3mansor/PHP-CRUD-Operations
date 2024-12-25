<html>
<?php require "../oop_refactoring/models/orm.php";
$orm_instance = new orm(["localhost", "root", "", "php"]);
$counter = 0;
?>

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
    $connection = $orm_instance->create_connection();
    if ($connection) {
        $result = $orm_instance->selectall('users');
        if (isset($_GET['search'])) {
            $search_val = mysqli_escape_string($connection, $_GET['search']);
            $result = $orm_instance->select('users', "*", "`name` Like '%{$search_val}%' or `email` like '%" . $search_val . "%' ");
        }
        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            // print_r($row);
            $counter++;

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
                Number of user <?php echo count($result); ?>
            </footer>
            <br>
        </tr>
    <?php }
    ?>
</body>

</html>