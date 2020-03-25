<?php


if(isset($_GET["prefinal"])){
    $prefinal = $_GET["prefinal"];
}else{
    $prefinal = "nothing";
}

if(isset($_GET["final"])){
    $final = $_GET["final"];
}else{
    $final = "nothing";
}

// echo $prefinal.$final;

if(isset($_GET["prefinal"])){
    echo "true";
}else{
    echo "false";
}

include("../bins/connections.php");

// mysqli_query($connections, "INSERT INTO prefinal,final (prefinal_prediction,final_prediction,average_prediction)
// VALUES ('$student_no','$fullname')");

?>