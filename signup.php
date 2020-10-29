<?php

include('admin/configdb.php');
$errors = array();

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username']:'';
    $password = isset($_POST['password']) ? md5($_POST['password']):'';
    $repassword = isset($_POST['password2']) ? md5($_POST['password2']):'';
    $email = isset($_POST['email']) ? $_POST['email']:'';
    $sql ='';

    if ($password != $repassword) {
        $errors[] = array('input'=>'password','message'=>'password doesn\'t match');
    }

    if (sizeof($errors) == 0) {
        $check = "SELECT * FROM online_test_platform.users WHERE `email`='".$email."'";
        $result = $conn->query($check);

        if ($result->num_rows > 0) {
            $errors[] = array('input'=>'form', 'message'=>'email id already exists.');
        } else {
            $sql = "INSERT INTO online_test_platform.users (`role`,`username`, `password`, `email`) 
            VALUES('Student','".$username."','".$password."','".$email."')";

            if ($conn->query($sql) === true) {
                header('Location: login.php');
            } else {
                $errors[] = array('input'=>'form', 'message'=>$conn->error);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>
<body>
    <div id="errors">
        <?php if (sizeof($errors) > 0) : ?>
            <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error['message']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <form action="signup.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password" name="password" required></label>
                </p>
                <p>
                    <label for="password2">Re-Password: <input type="password" name="password2" required></label>
                </p>
                <p>
                    <label for="email">Email: <input type="email" name="email" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
        </div>
    </div>
</body>
</html>