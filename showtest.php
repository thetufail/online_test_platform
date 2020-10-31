<?php

session_start();
include('admin/configdb.php');

if (isset($_SESSION["userdata"]) && ($_SESSION["userdata"]["role"] == "Admin" || $_SESSION["userdata"]["role"] == "Student")) {
    $number_of_page = 10;
    if (!isset($_GET['page']) ) {  
        $page = 1;
        $x = $page-1;  
    } else {  
        $page = $_GET['page'];
        $x = $page -1;  
    }

    if ($page == '' || $page == 1) {
        $_SESSION["ans"]=array();
    }

    $sql = "SELECT * FROM tests WHERE test_no=".$_SESSION["test"];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['userdata']['navigation'] = $row["navigation"];
            $questions = json_decode($row["questions"], true);
            $options = json_decode($row["options"], true);
            foreach ($questions as $no => $question) {
                if ($no == $x) {
                    $html='';
                    $html.='<div class="testformat"><div class="question">'.$page.'. '.htmlspecialchars($question).'</div><p>Select the correct option(s)</p><div class="options">';
                    foreach ($options as $key => $value) {
                        if ($key == $x) {
                            $html.='<form method="POST">';
                            foreach ($value as $k => $v) {
                                $html.='<div class="option"><span class="optionno">'.htmlspecialchars($v).'</span><input class="opt" type="checkbox" name="answers[]" value="'.($k+1).'"></div>';
                            }
                            $html.='</div><input class="submitanswer" type="submit" name="submit" value="SUBMIT"></form>';
                            if (isset($_POST['submit']) && (!empty($_POST['answers']))) {
                                $checkbox = $_POST['answers'];
                                array_push($_SESSION["ans"], $checkbox);
                            }
                            echo $html;
                            break;
                        }
                    }
                    break;
                }
            }
        }
    }

    if (isset($_GET['page']) ) {  
        if ($_GET['page']>1) {
            $prev = $_GET['page']-1;
        } else {
            $prev = $_GET['page'];
        }
        if ($_GET['page']<$number_of_page) {
            $next = $_GET['page']+1;
        } else {
            $next = $_GET['page'];
        }
    } else {
        $prev=1;
        $next=2;
    }
    // unset($_SESSION["ans"][8]);
    // unset($_SESSION["ans"][9]);
    // unset($_SESSION["ans"][10]);
    // unset($_SESSION["ans"][11]);
    // unset($_SESSION["ans"][12]);
    // unset($_SESSION["ans"][13]);
    // unset($_SESSION["ans"][14]);
    if (isset($_POST['submit']) && (!empty($checkbox)) && $_SESSION['userdata']['navigation'] == -1) {
        // print_r($_SESSION["ans"]);
        $pages_list='';
        $pages_list.='<a class="nextaftersubmit" href="showtest.php?page='.$next.'" >NEXT</a>';
        echo $pages_list;
    }

    if (count($_SESSION["ans"]) == 10) {
        header('Location: result.php');
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["navigation"] == 1) {
                $pages_list='';
                $pages_list.='<div id="nav"><a class="prev" href="showtest.php?page='.$prev.'" >PREVIOUS</a>';
                $pages_list.='<a class="next" href="showtest.php?page='.$next.'" >NEXT</a></div>
                </div>';
                echo $pages_list;
            }
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
</body>
</html>