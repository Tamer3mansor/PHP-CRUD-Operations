<?php
$error_arr = [];
if (isset($_GET['error'])) {
  $error_arr = explode(",", $_GET['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <form method="post" action="process.php">
    <label for="name">Name</label> <br />
    <input type="text" id="1" name="name" required /><?php if (in_array("name", $error_arr))
      echo "enter name"; ?><br />
    <label for="password">password</label> <br />
    <input type="password" id="2" name="password"
      required /><?php if (in_array("password", $error_arr))
        echo "enter name"; ?><br />
    <label for="email">email</label><br />
    <input type="email" id="3" name="email"
      required /><?php if (in_array("email", $error_arr))
        echo "enter name"; ?><br />
    <label for="gender">gender</label><br />
    <input type="radio" id="4" name="gender" value="male" required />male<br />
    <input type="radio" id="5" name="gender" value="female" required />female<br />
    <input type="submit" id="6" name="submit" value="Done" required /><br />
  </form>
  <a href="login.php">Have an account ? Log IN</a>
</body>

</html>