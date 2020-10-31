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
    <link rel="stylesheet" type="text/css" href="admin/style.css?t=1">
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
            <h2>SIGN UP</h2>
            <form id="signupForm" action="signup.php" method="POST">
                <p>
                    <input class="signuploginformdetails" type="text" name="username" required placeholder="Username">
                </p>
                <p>
                    <input class="signuploginformdetails" type="password" name="password" required placeholder="Password">
                </p>
                <p>
                    <input class="signuploginformdetails" type="password" name="password2" required placeholder="Confirm Password">
                </p>
                <p>
                    <input class="signuploginformdetails" type="email" name="email" required placeholder="Email">
                </p>
                <p>
                    <input class="submitsignupform" type="submit" name="submit" value="SUBMIT">
                </p>
            </form>
        </div>
    </div>
</body>
</html>