<html>
<form method="post">
    <input type="text" name="name" value="<?= isset($row['name']) ? $row['name'] : " " ?>"><br>
    <input type="password" name="password" value="<?= isset($row['pass']) ? $row['pass'] : " " ?>"><br>
    <input type="text" name="email" placeholder="email" value="<?= isset($row['email']) ? $row['email'] : " " ?>"><br>
    Male<input type="radio" name="gender" value="male" <?= ($row['gender'] == 'male') ? 'checked' : '' ?>><br>
    Female<input type="radio" name="gender" value="female" <?= ($row['gender'] == 'female') ? 'checked' : '' ?>><br>
    Admin<input type="checkbox" name="admin" <?= $row['admin'] ? 'checked' : '' ?>><br>
    <input type="hidden" name="id" value=<?php echo $row['id'] ?>><br>
    <input type="submit" name="submit" value="update">

</form>

</html>