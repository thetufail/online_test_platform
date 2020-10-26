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
                    <label for="password">Password: <input type="text" name="password" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
        </div>
    </div>
</body>
</html>