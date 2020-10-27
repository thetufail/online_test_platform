<?php

include('configdb.php');

global $questions;
global $options;
global $answers;

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
    for ($i=1; $i<=10; $i++) {
        $opt = array();
        if (isset($_GET['question'.$i.''])) {
            $q["question"] = $_GET['question'.$i.''];
            $a["answers"] = $_GET['answers'.$i.''];
            array_push($questions, $q["question"]);
            array_push($answers, $a["answers"]);
        }
        for ($j=1; $j<=4; $j++) {
            array_push($opt, $_GET['option'.$i.$j.'']);
        }
        $o["option"] = $opt;
        array_push($options, $o["option"]);
        
        print_r($q)."<br><br><br>";
        print_r($o)."<br><br><br>";
        print_r($a)."<br><br><br>";
    }

    if (!empty($questions)) {
        $qdb = json_encode($questions);
    }
    if (!empty($options)) {
        $odb = json_encode($options);
    }
    if (!empty($answers)) {
        $adb = json_encode($answers);
    }
    
    $sql = "INSERT INTO tests (`test_no`, `questions`, `options`,`answers`,`qualifying_marks`) 
    VALUES('','".$qdb."','".$odb."','".$adb."',7)";

    if ($conn->query($sql) === true) {
        // header('Location: configdb.php');
    }
}

echo "<br><br><br><br><br>";
print_r($questions);
echo "<br><br><br><br><br>";
print_r($options);
echo "<br><br><br><br><br>";
print_r($answers);

display();

function display() {
    global $html;
    $html='';
    $html.='<table>
                <tr>
                    <th>Question No. </th>
                    <th>Question </th>
                    <th>Options </th>
                    <th>Answers </th>
                </tr>';
    for ($i=1; $i<=10; $i++) {
        $html.='<tr>
                    <td><h3>'.$i.'</h3></td>
                    <td><textarea name="question'.$i.'" id="" cols="30" rows="10" required></textarea></td>
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
                        <td><input type="checkbox" name="answers'.$i.'[]" value="'.$k.'"></td>
                    </tr>';
        }
            $html.='</table>
                    </td>
                </tr>';
    }

    $html.='</table>';
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
            <form action="" method="GET" enctype="multipart/form-data">
                <?php echo $html; ?>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
        </div>
    </div>
</body>
</html>