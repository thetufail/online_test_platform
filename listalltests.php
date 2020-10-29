<?php

session_start();
include('admin/configdb.php');

if (isset($_SESSION["userdata"]) && ($_SESSION["userdata"]["role"] == "Admin" || $_SESSION["userdata"]["role"] == "Student")) {
    $total_test = $conn->query("SELECT MAX(`test_no`) FROM online_test_platform.tests");
    $total_test_no = $total_test->fetch_array()[0] ?? '';
    // echo $total_test_no;
    $as = '';
    $as.='<form method="POST">';
    for ($i=1; $i <= $total_test_no; $i++) {
        $as.='<input type="submit" name="'.$i.'" value="TEST '.$i.'"><br>';
    }

    if ($_SESSION["userdata"]["role"] == "Admin") {
        $as.='<input type="submit" name="addnewtest" value="Add new test"><br>';    
    }

    $as.='</form>';

    echo $as;

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