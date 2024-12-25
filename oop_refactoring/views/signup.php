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
            <!-- Admin <input type="checkbox" name="admin"><br> -->
            <input type="file" value="file" name="avatar"><br>
            <input type="submit" value="add user">
        </form>
    </body>

    </html>