<!-- overallPredictedStudentsPerformanceFirstSemesterBarChart.php -->



<?php


//  class myCounter implements Countable {
//   private $count = 0;
//   public function count() {
//       return ++$this->count;
//   }
// }

$counter_5 = 0;
$counter_3 = 0;
$counter_2_75 = 0;
$counter_2_5 = 0;
$counter_2_25 = 0;
$counter_2 = 0;
$counter_1_75 = 0;
$counter_1_5 = 0;
$counter_1_25 = 0;
$counter_1 = 0;
$counter_passed = 0;
$counter_failed = 0;

$prelim_qry = mysqli_query($connections, "SELECT * FROM prelim1 ");
$midterm_qry = mysqli_query($connections, "SELECT * FROM midterm1 ");
$prefinal_qry = mysqli_query($connections, "SELECT * FROM prefinal1 ");
$final_qry = mysqli_query($connections, "SELECT * FROM final1 ");
$students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' ");

while($row_prelim = mysqli_fetch_assoc($prelim_qry)){
  
  
  $row_midterm = mysqli_fetch_assoc($midterm_qry);
  $row_prefinal = mysqli_fetch_assoc($prefinal_qry);
  $row_final = mysqli_fetch_assoc($final_qry);
 
  $row_students = mysqli_fetch_assoc($students_qry);
  $student_no = $row_students["student_no"];
  $lastname = $row_students["lastname"];
  $firstname = $row_students["firstname"];
  $middlename = $row_students["middlename"];
  $student_name = $firstname . " " . $middlename[0] . ". " . $lastname;
  
 
 $prelim_output_1 = $row_prelim['prelim_output_1'];
 $prelim_output_2 = $row_prelim['prelim_output_2'];
 $prelim_performance_1 = $row_prelim['prelim_performance_1'];
 $prelim_performance_2 = $row_prelim['prelim_performance_2'];
 $prelim_written_test = $row_prelim['prelim_written_test'];
 
 
 
 if($prelim_output_1 == 0 && $prelim_output_2 == 0 &&
    $prelim_performance_1 == 0 && $prelim_performance_1 == 0 &&
    $prelim_written_test == 0){
   
     $prelim_grade = 0;
 
 }else{
 
 $prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
 $prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;
 
 $prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
 $prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
 $prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;
 
 $prelim_output_weight = $prelim_output_base * 0.40;
 $prelim_performance_weight = $prelim_performance_base * 0.40;
 $prelim_written_test_weight = $prelim_written_test_base * 0.20;
 
 $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;
 
 $prelim_grade = number_format((float)$prelim_grade,2,".","");
 
 }
 
 $midterm_output_1 = $row_midterm["midterm_output_1"];
 $midterm_output_2 = $row_midterm["midterm_output_2"];
 $midterm_performance_1 = $row_midterm["midterm_performance_1"];
 $midterm_performance_2 = $row_midterm["midterm_performance_2"];
 $midterm_written_test = $row_midterm["midterm_written_test"];
 
 if($midterm_output_1 == 0 && $midterm_output_2 == 0 &&
    $midterm_performance_1 == 0 && $midterm_performance_1 == 0 &&
    $midterm_written_test == 0){
   
     $midterm_grade = 0;
 
 }else{
 
 $midterm_output_total_score = $midterm_output_1 + $midterm_output_2;
 $midterm_output_base = $midterm_output_total_score / 40 * 40 + 60;
 $midterm_output_weight = $midterm_output_base * 0.40;
 
 
 $midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
 $midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
 $midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;
 $midterm_performance_weight = $midterm_performance_base * 0.40;
 $midterm_written_test_weight = $midterm_written_test_base * 0.20;
 $midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;
 
 $midterm_output_weight = $midterm_output_base * 0.40;
 $midterm_performance_weight = $midterm_performance_base * 0.40;
 $midterm_written_test_weight = $midterm_written_test_base * 0.20;
 $midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;
 
 $midterm_grade = number_format((float)$midterm_grade,2,".","");
 
 }
 
 
 $prefinal_output_1 = $row_prefinal["prefinal_output_1"]; //ok
 $prefinal_output_2 = $row_prefinal["prefinal_output_2"]; //ok
 $prefinal_performance_1 = $row_prefinal["prefinal_performance_1"]; //ok
 $prefinal_performance_2 = $row_prefinal["prefinal_performance_2"]; //ok
 $prefinal_written_test = $row_prefinal["prefinal_written_test"]; //ok
 
 $prefinal_prediction = $row_prefinal["prefinal_prediction"];
 
 if($prefinal_output_1 <= 0 && $prefinal_output_2 <= 0 &&
    $prefinal_performance_1 <= 0 && $prefinal_performance_2 <= 0 &&
    $prefinal_written_test <= 0){
   
     $prefinal_grade = 0;
 
 }else{
 
 $prefinal_output_total_score = $prefinal_output_1 + $prefinal_output_2; //ok
 $prefinal_performance_total_score = $prefinal_performance_1 + $prefinal_performance_2; //ok
 
 $prefinal_output_base = $prefinal_output_total_score / 40 * 40 + 60; //ok
 $prefinal_performance_base = $prefinal_performance_total_score / 40 * 40 + 60; //ok
 $prefinal_written_test_base = $prefinal_written_test / 70 * 40 + 60; //ok
 
 $prefinal_output_weight = $prefinal_output_base * 0.40; //ok
 $prefinal_performance_weight = $prefinal_performance_base * 0.40; //ok
 $prefinal_written_test_weight = $prefinal_written_test_base * 0.20; //ok
 
 $prefinal_3rd_quarter = $prefinal_output_weight + $prefinal_performance_weight + $prefinal_written_test_weight; //ok
 $prefinal_grade = $midterm_grade * 0.3 + $prefinal_3rd_quarter * 0.7;
 
 $prefinal_grade = number_format((float)$prefinal_grade,2,".","");
 
 }
 
 
 $final_output_1 = $row_final["final_output_1"];
 $final_output_2 = $row_final["final_output_2"];
 $final_performance_1 = $row_final["final_performance_1"];
 $final_performance_2 = $row_final["final_performance_2"];
 $final_written_test = $row_final["final_written_test"];
 
 $final_prediction = $row_final["final_prediction"];
 
 
 if($final_output_1 <= 0 && $final_output_2 <= 0 &&
    $final_performance_1 <= 0 && $final_performance_2 <= 0 &&
    $final_written_test <= 0){
   
     $final_grade = 0;
 
 }else{
 
 $final_output_total_score = $final_output_1 + $final_output_2;
 $final_output_base = $final_output_total_score / 40 * 40 + 60;
 $final_output_weight = $final_output_base * 0.40;
 $final_performance_total_score = $final_performance_1 + $final_performance_2;
 $final_performance_base = $final_performance_total_score / 40 * 40 + 60;
 $final_performance_weight = $final_performance_base * 0.40;
 $final_written_test_base = $final_written_test / 70 * 40 + 60;
 $final_written_test_weight = $final_written_test_base * 0.20;
 $final_4th_quarter = $final_output_weight + $final_performance_weight + $final_written_test_weight;
 $final_grade = $prefinal_grade * 0.3 + $final_4th_quarter * 0.7;
 
 $final_grade = number_format((float)$final_grade,2,".","");
 
 }
   
 
 
 // $prefinal_prediction = 0;
 // $final_prediction = 0;
 $average_prediction = 0;
 $average = "";
//  $stack = array($average);
 
 
 if($final_grade>0){
  $average = $final_grade;

}else{
  if($final_prediction>0){
    $average = $final_prediction;
  }
}



 switch (true) {
     // case ($average <= 74.4):
     //     $equivalent = "5";
     //     break;
     case ($average >= 74.5 && $average <= 76.49):
         $equivalent = "3";
         $counter_3++;
         break;
     case ($average >= 76.5 && $average <= 79.49):
         $equivalent = "2.75";
         $counter_2_75++;
         break;
     case ($average >= 79.5 && $average <= 82.49):
         $equivalent = "2.5";
         $counter_2_5++;
         break;
     case ($average >= 82.5 && $average <= 85.49):
         $equivalent = "2.25";
         $counter_2_25++;
         break;
     case ($average >= 85.5 && $average <= 88.49):
         $equivalent = "2";
         $counter_2++;
         break;
     case ($average >= 88.5 && $average <= 91.49):
         $equivalent = "1.75";
         $counter_1_75++;
         break;
     case ($average >= 91.5 && $average <= 94.49):
         $equivalent = "1.5";
         $counter_1_5++;
         break;
     case ($average >= 94.5 && $average <= 97.49):
         $equivalent = "1.25";
         $counter_1_25++;
         break;
     case ($average >= 97.5 && $average <= 100):
         $equivalent = "1";
         $counter_1++;
         break;
 
     default:
         $equivalent = "---";
 }
 
 if($average > 0 && $average <= 74.4){
   $equivalent = "5";
   $counter_5++;

 }

 
if($equivalent > 0 && $equivalent <= 3){
  // $remarks = "Passed";
  $counter_passed++;
}elseif($equivalent == 5){
  // $remarks = "Failed";
  $counter_failed++;
}

$total_passed = $counter_passed / ( $counter_passed + $counter_failed);
$total_failed = $counter_failed / ( $counter_passed + $counter_failed);


 
//  if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_prediction > 0) && ($final_prediction>0)){
//   echo "<h6>".$equivalent.",</h6>"; 

//   }elseif(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_prediction>0)){
//    $average = ($prelim_grade + $midterm_grade + $prefinal_grade + $final_prediction) / 4;
//    echo "<h6>".$equivalent.",</h6>";

//   }else{
  // echo $equivalent.","; 
  // }



  
}

// $text="12aap33";

// echo countDigits($equivalent);
// print_r($stack);

// echo "hay".$counter_5;
 
$dataPoints = array(
	array("x"=> 10, "y"=> $counter_1, "label"=> "1"),
	array("x"=> 20, "y"=> $counter_1_25, "label"=> "1.25"),
	array("x"=> 30, "y"=> $counter_1_5, "label"=> "1.5"),
	array("x"=> 40, "y"=> $counter_1_75, "label"=> "1.75"),
	array("x"=> 50, "y"=> $counter_2, "label"=> "2"),
	array("x"=> 60, "y"=> $counter_2_25, "label"=> "2.25"),
	array("x"=> 70, "y"=> $counter_2_5, "label"=> "2.5"),
	array("x"=> 80, "y"=> $counter_2_75, "label"=> "2.75"),
	array("x"=> 90, "y"=> $counter_3, "label"=> "3"),
	array("x"=> 100, "y"=> $counter_5, "label"=> "5"),
);

	
?>

<br>

<div id="barChartContainerFirstSem" style="height: 370px; width: 95%;"></div>
 

