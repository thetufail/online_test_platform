<?php

session_start();
include('admin/configdb.php');
$total_test = $conn->query("SELECT MAX(`test_no`) FROM online_test_platform.tests");
$total_test_no = $total_test->fetch_array()[0] ?? '';
// echo $total_test_no;
$as = '';
$as.='<form method="POST">';
for ($i=1; $i <= $total_test_no; $i++) {
    $_SESSION["test"] = $i;
    // $_SESSION["test"] = '';
    // unset($_SESSION["test"]);
    $as.='<input type="submit" name="'.$i.'" value="TEST '.$i.'"><br>';
}
$as.='</form>';

echo $as;

for ($i=1; $i <= $total_test_no; $i++) {
    if (isset($_POST[''.$i.''])) {
        $_SESSION["test"] = $i;
        echo $_SESSION["test"];
        header('Location: showtest.php');
        break;
    }
}
?>