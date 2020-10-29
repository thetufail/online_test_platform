<?php

session_start();
include('admin/configdb.php');
$errors = array();

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username']:'';
    $password = isset($_POST['password']) ? md5($_POST['password']):'';

    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM users WHERE 
        `username`='".$username."' AND `password`='".$password."' 
        AND `role`='Admin'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['userdata'] = array('username'=>$row['username'],'user_id'=>$row['user_id'],'role'=>$row['role']);
                header('Location: listalltests.php');
            }
        } else {
            $errors[] = array('input'=>'form', 'message'=>'invalid login details');
        }

        $sql = "SELECT * FROM users WHERE 
        `username`='".$username."' AND `password`='".$password."' 
        AND `role`='Student'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['userdata'] = array('username'=>$row['username'],'user_id'=>$row['user_id'],'role'=>$row['role']);
                header('Location: listalltests.php');
            }
        } else {
            $errors[] = array('input'=>'form', 'message'=>'invalid login details');
        }
        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Login
    </title>
    <!-- <link href="style.css" type="text/css" rel="stylesheet"> -->
</head>
<body>
    <div id="wrapper">
        <div id="login-form">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password" name="password" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
        </div>
    </div>
</body>
</html>