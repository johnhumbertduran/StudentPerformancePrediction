<?php

$query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
$my_info = mysqli_fetch_assoc($query_info);
$student_no = $my_info["student_no"];

if(isset($_GET["_s"])){
    if(isset($_GET["_s"])){
        $semester = $_GET["_s"];
        $grading_period = $_GET["_gr"].$semester[3];
        // echo $grading_period;
        $get_student_grade = mysqli_query($connections, "SELECT * FROM $grading_period WHERE student_no='$student_no'");
        // $my_info = mysqli_fetch_assoc($query_info);
        // $account_type = $get_student_grade["account_type"];
    }
}


while($row_grading = mysqli_fetch_assoc($get_student_grade)){

    $prelim_output_1 = $row_grading["prelim_output_1"];
    $prelim_output_2 = $row_grading["prelim_output_2"];
    $prelim_output_total_score = $row_grading["prelim_output_total_score"];
    $prelim_output_base = $row_grading["prelim_output_base"];
    $prelim_output_weight = $row_grading["prelim_output_weight"];
    $prelim_performance_1 = $row_grading["prelim_performance_1"];
    $prelim_performance_2 = $row_grading["prelim_performance_2"];
    $prelim_performance_total_score = $row_grading["prelim_performance_total_score"];
    $prelim_performance_base = $row_grading["prelim_performance_base"];
    $prelim_performance_weight = $row_grading["prelim_performance_weight"];
    $prelim_written_test = $row_grading["prelim_written_test"];
    $prelim_written_test_base = $row_grading["prelim_written_test_base"];
    $prelim_written_test_weight = $row_grading["prelim_written_test_weight"];
    $prelim_grade = $row_grading["prelim_grade"];

    $prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
    $prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
    $prelim_output_weight = $prelim_output_base * 0.40;
    $prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;
    $prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
    $prelim_performance_weight = $prelim_performance_base * 0.40;
    $prelim_written_test_base = $prelim_written_test / 30 * 40 + 60;
    $prelim_written_test_weight = $prelim_written_test_base * 0.20;
    $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;
  

    $grade = $prelim_grade;
    
    echo $grade;
}



?>