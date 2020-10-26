<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>
<body>
    <!-- <div id="errors">
        <?php if (sizeof($errors) > 0) : ?>
            <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error['message']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div> -->
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