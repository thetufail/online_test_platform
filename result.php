<?php

session_start();
include('admin/configdb.php');
global $html;
if (isset($_SESSION["userdata"]) && ($_SESSION["userdata"]["role"] == "Admin" || $_SESSION["userdata"]["role"] == "Student")) {

    $sql = "SELECT * FROM tests WHERE test_no=".$_SESSION["test"];
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
            $correct_answers = 10-$wrong_answers;
            $status = $correct_answers >= $row["qualifying_marks"] ? "successfully passed" : "failed";
            $html ='';
            $html.='<div class="result"><h2>You\'ve '.$status.' the test!</h2>
            <h3>Wrong Answers: '.$wrong_answers.'</h3>
            <h3>Correct Answers: '.$correct_answers.'</h3></div>';
            unset($_SESSION["test"]);
            unset($_SESSION["ans"]);
            unset($_SESSION["userdata"]);
        }
    }
    // print_r($_SESSION);
    // unset($_SESSION["ans"]);
    // unset($_SESSION["test"]);
} else {
    $html.='<h1>ACCESS DENIED!</h1>';
    print_r($_SESSION);
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
    <?php echo $html; ?>
</body>
</html>