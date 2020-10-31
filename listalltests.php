<?php

session_start();
include('admin/configdb.php');

if (isset($_SESSION["userdata"]) && ($_SESSION["userdata"]["role"] == "Admin" || $_SESSION["userdata"]["role"] == "Student")) {
    $total_test = $conn->query("SELECT MAX(`test_no`) FROM online_test_platform.tests");
    $total_test_no = $total_test->fetch_array()[0] ?? '';
    $as = '';
    $as.='<form method="POST">';
    for ($i=1; $i <= $total_test_no; $i++) {
        $as.='<input class="tests" type="submit" name="'.$i.'" value="TEST '.$i.'">';
    }

    if ($_SESSION["userdata"]["role"] == "Admin") {
        $as.='<input class="addnewtests" type="submit" name="addnewtest" value="ADD NEW TEST">';    
    }

    $as.='</form>';

    if (isset($_POST['addnewtest'])) {
        header('Location: admin/createnewtest.php');
    }

    for ($i=1; $i <= $total_test_no; $i++) {
        if (isset($_POST[''.$i.''])) {
            $_SESSION["test"] = $i;
            header('Location: showtest.php');
            break;
        }
    }
} else {
    echo "<h1>ACCESS DENIED!</h1>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="admin/style.css?t=1">
</head>
<body>
    <h2>Select the test you want to give.</h2>
    <?php echo $as; ?>
</body>
</html>