<?php

include("../bins/connections.php");

if(isset($_GET["s_"])){
    $grade_period = $_GET["s_"];
}

if(isset($_GET["prefinal"])){
    $prefinal = $_GET["prefinal"];
    echo $prefinal."\n";
}

if(isset($_GET["final"])){
    $final = $_GET["final"];
    echo $final."\n";
}

if(isset($_GET["id"])){
    $id = $_GET["id"];
}

echo $id."\n";


if((isset($_GET["prefinal"])) & (isset($_GET["final"]))){
    $prefinal_grade_semester = "prefinal".$grade_period;
    $final_grade_semester = "final".$grade_period;

mysqli_query($connections, "UPDATE $prefinal_grade_semester SET 
prefinal_prediction='$prefinal' WHERE student_no='$id'");
// echo $prefinal_grade_semester."\n";

mysqli_query($connections, "UPDATE $final_grade_semester SET 
final_prediction='$final' WHERE student_no='$id'");
// echo $prefinal_grade_semester."\n";

}else if((!isset($_GET["prefinal"])) & (isset($_GET["final"]))){
    $final_grade_semester = "final".$grade_period;

mysqli_query($connections, "UPDATE $final_grade_semester SET 
final_prediction='$final' WHERE student_no='$id'");

}
echo $final_grade_semester;


    

?>