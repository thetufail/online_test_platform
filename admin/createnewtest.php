<?php

session_start();
include('configdb.php');

if (isset($_SESSION["userdata"]) && ($_SESSION["userdata"]["role"] == "Admin")) {

    $questions = array();
    $options = array();
    $answers = array();

    $q = array(
        "question"=>'',
    );

    $o = array(
        "option"=>'',
    );

    $a = array("answers"=>''
    );

    if (isset($_GET['submit'])) {
        if (isset($_GET['qualifyingmarks']) && !empty($_GET['qualifyingmarks'])) {
            $passing_marks = $_GET['qualifyingmarks'];
        }

        if (isset($_GET['navigation']) && !empty($_GET['navigation'])) {
            $nav = $_GET['navigation'];
        }

        for ($i=1; $i<=10; $i++) {
            $opt = array();
            // if (isset($_GET['question'.$i.''])) {
                // $q["question"] = $_GET['question'.$i.''];
                array_push($questions, $_GET['question'.$i.'']);
            // }

            for ($j=1; $j<=4; $j++) {
                array_push($opt, $_GET['option'.$i.$j.'']);
            }
            $o["option"] = $opt;
            array_push($options, $o["option"]);

            // if (!empty($_GET['answers'.$i.''])) {
                // $a["answers"] = $_GET['answers'.$i.''];
                array_push($answers, $_GET['answers'.$i.'']);
            // }
            // print_r($q)."<br><br><br>";
            // print_r($o)."<br><br><br>";
            // print_r($a)."<br><br><br>";
        }

        $qdb = json_encode($questions);
        $odb = json_encode($options);
        $adb = json_encode($answers);
        $sql = "INSERT INTO tests (`test_no`, `questions`, `options`,`answers`,`qualifying_marks`, `navigation`) 
        VALUES('','".$qdb."','".$odb."','".$adb."','".$passing_marks."','".$nav."')";
        $conn->query($sql);

        header('Location: http://localhost/training/online_test_platform/listalltests.php');
    }

    // echo "<br><br><br><br><br>";
    // print_r($questions);
    // echo "<br><br><br><br><br>";
    // print_r($options);
    // echo "<br><br><br><br><br>";
    // print_r($answers);
    // echo "<br><br><br><br><br>";
    // echo $passing_marks;
    // echo "<br><br><br><br><br>";
    // echo $nav;

    $html='';  
    $html.='<form method="GET"><table>
                <tr>
                    <th>Question No. </th>
                    <th>Question </th>
                    <th>Options </th>
                    <th>Answers </th>
                </tr>';
    for ($i=1; $i<=10; $i++) {
        $html.='<tr>
                    <td><h3>'.$i.'</h3></td>
                    <td><textarea name="question'.$i.'" rows="10" cols="100"></textarea></td>
                    <td>
                        <table>';
        for ($j=1; $j<=4; $j++) {
            $html.='<tr>
                        <td>Option '.$j.'</td>
                        <td><input type="text" name="option'.$i.$j.'"></td>
                    </tr>';
        }
            $html.='</table>
                    </td>';
            $html.='<td>
                    <table>';
        for ($k=1; $k<=4; $k++) {
            $html.='<tr>
                        <td><input type="checkbox" name="answers'.$i.'[]" value='.$k.'></td>
                    </tr>';
        }
            $html.='</table>
                    </td>
                </tr>';
    }
    $html.='</table>
    <label for="qualifyingmarks">Passing marks</label>
    <p>
        <input type="number" name="qualifyingmarks" id="qualifyingmarks">
    </p>
    <label>Do you want to include navigation?</label>
    <p>
        <select name="navigation" id="">
            <option value="-1">No</option>
            <option value="1">Yes</option>
        </select>
    </p><br>
    <p>
        <input type="submit" name="submit" value="Submit">
    </p></form>';

} else {
    $html.='<h1>ACCESS DENIED!</h1>';
    print_r($_SESSION);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
    <!-- <link rel="stylesheet" type="text/css" href="admin.css"> -->
</head>
<body>
    <div id="wrapper">
        <div id="addproduct-form">
            <h2>Create Test</h2>
                <?php echo $html; ?>
        </div>
    </div>
</body>
</html>