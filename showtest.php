<?php

include('admin/configdb.php');
$number_of_page = 10;

$sql = "SELECT * FROM tests WHERE test_no=".'16';
$result = $conn->query($sql);

if (!isset($_GET['page']) ) {  
    $page = 1;
    $x = $page-1;  
} else {  
    $page = $_GET['page'];
    $x = $page -1;  
}

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
                        $html.='<form method="GET">';
                        foreach ($value as $k => $v) {
                            $html.='<input type="checkbox" name="answers[]" value="'.($v).'">'.$v.'<br>';
                        }
                        $html.='<input type="submit" name="submit" value="Submit"></form>';
                        $checkbox = $_GET['answers'];
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

if (isset($_GET['submit']) ) {  
    print_r($checkbox);
}

$pages_list='';
$pages_list.='<ul><li><a href="showtest.php?page='.$prev.'" >Previous</a></li>';
$pages_list.='<li><a href="showtest.php?page='.$next.'" >Next</a></li></ul>';

echo $pages_list;

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