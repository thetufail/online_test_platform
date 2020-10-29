<?php

session_start();
include('admin/configdb.php');

if (isset($_SESSION["userdata"]) && ($_SESSION["userdata"]["role"] == "Admin" || $_SESSION["userdata"]["role"] == "Student")) {

    $number_of_page = 10;

    echo $_SESSION["test"]."<BR>";

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
            $questions = json_decode($row["questions"], true);
            $options = json_decode($row["options"], true);
            foreach ($questions as $no => $question) {
                if ($no == $x) {
                    echo $page.")".$question."<br>";
                    echo "<br>OPTIONS<br>";
                    foreach ($options as $key => $value) {
                        if ($key == $x) {
                            $html='';
                            $html.='<form method="POST">';
                            foreach ($value as $k => $v) {
                                $html.='<input type="checkbox" name="answers[]" value="'.($v).'">'.$v.'<br>';
                            }
                            $html.='<input type="submit" name="submit" value="Submit"></form>';
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
    if (isset($_POST['submit']) && (!empty($checkbox))) {
        // print_r($_SESSION["ans"]);
        $pages_list='';
        $pages_list.='<a href="showtest.php?page='.$next.'" >Next</a>';
        echo $pages_list;
        if (count($_SESSION["ans"]) == 10) {
            header('Location: result.php');
        }
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["navigation"] == 1) {
                $pages_list='';
                $pages_list.='<ul><li><a href="showtest.php?page='.$prev.'" >Previous</a></li>';
                $pages_list.='<li><a href="showtest.php?page='.$next.'" >Next</a></li></ul>';
                echo $pages_list;
            }
        }
    }
} else {
    echo "<h1>ACCESS DENIED!</h1>";
}
?>

<!-- 
// echo "ANSWERS<bR>";
            // $answers = json_decode($row["answers"], true);
            // foreach ($answers as $key => $value) {
            //     foreach ($value as $k => $v) {
            //         echo $v."<br>";
            //     }
            //     echo "<br>";
            // } -->