<?php

session_start();
include('admin/configdb.php');
$sql = "SELECT * FROM tests WHERE test_no=".'20';
$a = $_SESSION["ans"];
$wrong_answers = 0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $answers = json_decode($row["answers"], true);
        // print_r($answers);
        // echo "<BR>";
        // print_r($_SESSION["ans"]);
        foreach ($answers as $key => $value) {
            // echo $key;
            foreach ($value as $k => $v) {
                // echo $k;
                if (count($a[$key]) == count($answers[$key])) {
                    if ($a[$key][$k] != $v) {
                        $wrong_answers+=1;
                        break;
                    }
                } else {
                    $wrong_answers+=1;
                    break;    
                }
                // echo $v."<br>";
            }
        }
        echo "<br>Wrong Answers: ";
        echo $wrong_answers;
        echo "<br>Correct Answers: ";
        echo 10-$wrong_answers;
    }
}
unset($a[8]);
unset($a[9]);

// foreach ($a as $key => $value) {

// }

?>