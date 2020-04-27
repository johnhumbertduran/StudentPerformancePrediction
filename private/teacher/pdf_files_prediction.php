<?php
require "fpdf.php";
include("../bins/connections.php");

class myPDF extends FPDF{
    function header(){
        // $this->Image('logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'Student Performance Prediction System',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Student Records','0','0','C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times','B',10);

        if(isset($_GET["_y"])){
        
          if($_GET["_y"] == "select_year"){
            $year = "Empty";
          }else{
            $year = $_GET["_y"];
          }
      

        }else{
          $year = "Empty";
        }


        if(isset($_GET["_c"])){
        
          if($_GET["_c"] == "select_course"){
            $course = "";
          }else{
            $course = $_GET["_c"];
            // echo $course;
          }
    
        }else{
          $course = "";
        }

        // Select Semester here Kara nag tapos
        if(isset($_GET["_s_e_"])){
        
          if($_GET["_s_e_"] == "select_semester"){
            $semester = "";
          }else{
            $semester = $_GET["_s_e_"];
            // echo $semester;
          }
      

        }else{
          $semester = "";
        }

        if($semester == "sem1"){
          $get_course_name = "Application Programming 1";
          $get_semester = "First Semester";
        }else if($semester == "sem2"){
          $get_course_name = "Application Programming 2";
          $get_semester = "Second Semester";
        }else{
          $get_course_name = "Empty";
          $get_semester = "Empty";
        }

        $this->Cell(70,10,'Course Name: '.$get_course_name,0,0,'L');
        $this->Cell(25,10,'Year: '.$year,0,0,'L');
        $this->Cell(70,10,'Semester: '.$get_semester,0,0,'L');
        $this->Ln();
        $this->Cell(276,10,'Student Prediction',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(29,10,'Student ID',1,0,'C');
        $this->Cell(73,10,'Student Name',1,0,'C');
        $this->Cell(25,10,'Prelim',1,0,'C');
        $this->Cell(25,10,'Midterm',1,0,'C');
        $this->Cell(25,10,'Prefinal',1,0,'C');
        $this->Cell(25,10,'Final',1,0,'C');
        $this->Cell(24,10,'Average',1,0,'C');
        $this->Cell(25,10,'Equivalent',1,0,'C');
        $this->Cell(25,10,'Remarks',1,0,'C');
        $this->Ln();
    }
    function viewTable($connections){
        $this->SetFont('Times','B',9);

        if(isset($_GET["_y"])){
          $year = $_GET["_y"];
        }else{
          $year = "";
        }
      
        
      
        if(isset($_GET["_c"])){
          $course = $_GET["_c"];
        }else{
          $course = "BSIT";
        }
      
      
        if(isset($_GET["_s_e_"])){
          $semester = $_GET["_s_e_"];
        }else{
          $semester = "sem1";
        }
      
        if(isset($_GET["_y"]) && !isset($_GET["_c"]) && !isset($_GET["_s_e_"])){
          $ready = "100";
        }elseif(isset($_GET["_y"]) && isset($_GET["_c"]) && !isset($_GET["_s_e_"])){
          $ready = "110";
        }elseif(isset($_GET["_y"]) && isset($_GET["_c"]) && isset($_GET["_s_e_"])){
          $ready = "111";
        }else{
          $ready = "";
        }
      
        // echo $ready;
      
        
      
        $prelim = "prelim$semester[3]";
        $midterm = "midterm$semester[3]";
        $prefinal = "prefinal$semester[3]";
        $final = "final$semester[3]";
      
        if($ready == "100"){
          $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE year='$year' ");
          $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE year='$year' ");
          $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE year='$year' ");
          $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE year='$year' ");
          $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year='$year' ");
          // echo "<script>alert('there is a year');</script>";
      }elseif($ready == "110"){
          $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE year='$year' AND course='$course' ");
          $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE year='$year' AND course='$course' ");
          $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE year='$year' AND course='$course' ");
          $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE year='$year' AND course='$course' ");
          $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year='$year' AND course='$course' ");
          // echo "<script>alert('$course');</script>";
        }elseif($ready == "111"){
          $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE year='$year' AND course='$course' ");
          $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm WHERE year='$year' AND course='$course' ");
          $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal WHERE year='$year' AND course='$course' ");
          $final_qry = mysqli_query($connections, "SELECT * FROM $final WHERE year='$year' AND course='$course' ");
          $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' AND year='$year' AND course='$course' ");
        }else{
          $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim ");
          $midterm_qry = mysqli_query($connections, "SELECT * FROM $midterm ");
          $prefinal_qry = mysqli_query($connections, "SELECT * FROM $prefinal ");
          $final_qry = mysqli_query($connections, "SELECT * FROM $final ");
          $students_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2' ");
          // echo "<script>alert('there is no year');</script>";
        }
      
        
      
      
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
      
      $prelim_status = 0;
      $prelim_status_missed = "";
      
      $midterm_status = 0;
      $midterm_status_missed = "";
      
      $prefinal_status = 0;
      $prefinal_status_missed = "";
      
      $final_status = 0;
      $final_status_missed = "";
      
      if ($prelim_output_1 == 0){
        $prelim_status++;
        $prelim_status_missed .= "Prelim Output 1 </br>";
      }
      
      if ($prelim_output_2 == 0){
        $prelim_status++;
        $prelim_status_missed .= "Prelim Output 2 </br>";
      }
      
      if ($prelim_performance_1 == 0){
        $prelim_status++;
        $prelim_status_missed .= "Prelim Performance 1 </br>";
      }
      
      if ($prelim_performance_2 == 0){
        $prelim_status++;
        $prelim_status_missed .= "Prelim Performance 2 </br>";
      }
      
      if ($prelim_written_test == 0){
        $prelim_status++;
        $prelim_status_missed .= "Prelim Written Test </br>";
      }
      
      
      
      if ($midterm_output_1 == 0){
        $midterm_status+=1;
        $midterm_status_missed .= "Midterm Output 1 </br>";
      }
      
      if ($midterm_output_2 == 0){
        $midterm_status+=1;
        $midterm_status_missed .= "Midterm Output 2 </br>";
      }
      
      if ($midterm_performance_1 == 0){
        $midterm_status+=1;
        $midterm_status_missed .= "Midterm Performance 1 </br>";
      }
      
      if ($midterm_performance_2 == 0){
        $midterm_status+=1;
        $midterm_status_missed .= "Midterm Performance 2 </br>";
      }
      
      if ($midterm_written_test == 0){
        $midterm_status+=1;
        $midterm_status_missed .= "Midterm Written Test </br>";
      }
      
      
      if ($prefinal_output_1 == 0){
        $prefinal_status+=1;
        $prefinal_status_missed .= "Prefinal Output 1 </br>";
      }
      
      if ($prefinal_output_2 == 0){
        $prefinal_status+=1;
        $prefinal_status_missed .= "Prefinal Output 2 </br>";
      }
      
      if ($prefinal_performance_1 == 0){
        $prefinal_status+=1;
        $prefinal_status_missed .= "Prefinal Performance 1 </br>";
      }
      
      if ($prefinal_performance_2 == 0){
        $prefinal_status+=1;
        $prefinal_status_missed .= "Prefinal Performance 2 </br>";
      }
      
      if ($prefinal_written_test == 0){
        $prefinal_status+=1;
        $prefinal_status_missed .= "Prefinal Written Test </br>";
      }
      
      
      if ($final_output_1 == 0){
        $final_status+=1;
        $final_status_missed .= "final Output 1 </br>";
      }
      
      if ($final_output_2 == 0){
        $final_status+=1;
        $final_status_missed .= "final Output 2 </br>";
      }
      
      if ($final_performance_1 == 0){
        $final_status+=1;
        $final_status_missed .= "final Performance 1 </br>";
      }
      
      if ($final_performance_2 == 0){
        $final_status+=1;
        $final_status_missed .= "final Performance 2 </br>";
      }
      
      if ($final_written_test == 0){
        $final_status+=1;
        $final_status_missed .= "final Written Test </br>";
      }

        $this->Cell(29,10,$student_no,1,0,'C');
        $this->Cell(73,10,$student_name,1,0,'C');
        $this->Cell(25,10,$prelim_grade,1,0,'C');
        $this->Cell(25,10,$midterm_grade,1,0,'C');
        if($prefinal_grade>0){
          // if($prefinal_status > 0){
          //   echo $prefinal_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#prefinal$student_no'><b>$prefinal_status</b><sup>";
          // }else{
          //   echo $prefinal_grade;
          // }
          $this->Cell(25,10,$prefinal_grade,1,0,'C');
        }else{
          if($prefinal_prediction>0){
            $this->Cell(25,10,$prefinal_prediction,1,0,'C');
          }else{
            $this->Cell(25,10,'00',1,0,'C');
          }
        };
        if($final_grade>0){
          if($final_status > 0){
            // echo $final_grade." <sup class='grade_status bg-warning rounded-circle px-1' data-toggle='modal' data-target='#final$student_no'><b>$final_status</b><sup>";
          }else{
            // $this->Cell(32,10,'Final',1,0,'C');
          }
          $this->Cell(25,10,$final_grade,1,0,'C');
        }else{
          if($final_prediction>0){
            // echo "<h6>".$final_prediction."</h6>";
          $this->Cell(25,10,$final_prediction,1,0,'C');
          }else{
          $this->Cell(25,10,'00',1,0,'C');
          }
        }
        if($final_grade>0){
          $average = $final_grade;
          $this->Cell(24,10,$final_grade,1,0,'C');
        }else{
          if($final_prediction>0){
            $average = $final_prediction;
            // echo "<h6>".$final_prediction."</h6>";
            $this->Cell(24,10,$final_prediction,1,0,'C');
          }else{
            $this->Cell(24,10,'00',1,0,'C');
          }
        }
        switch (true) {
          // case ($average <= 74.4):
          //     $equivalent = "5";
          //     break;
          case ($average >= 74.5 && $average <= 76.49):
              $equivalent = "3";
              break;
          case ($average >= 76.5 && $average <= 79.49):
              $equivalent = "2.75";
              break;
          case ($average >= 79.5 && $average <= 82.49):
              $equivalent = "2.5";
              break;
          case ($average >= 82.5 && $average <= 85.49):
              $equivalent = "2.25";
              break;
          case ($average >= 85.5 && $average <= 88.49):
              $equivalent = "2";
              break;
          case ($average >= 88.5 && $average <= 91.49):
              $equivalent = "1.75";
              break;
          case ($average >= 91.5 && $average <= 94.49):
              $equivalent = "1.5";
              break;
          case ($average >= 94.5 && $average <= 97.49):
              $equivalent = "1.25";
              break;
          case ($average >= 97.5 && $average <= 100):
              $equivalent = "1";
              break;
      
          default:
              $equivalent = "---";
      }
      
      if($average > 0 && $average <= 74.4){
        $equivalent = "5";
      }
      
      
      
       if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_grade>0)){
        // echo $equivalent; 
        $this->Cell(25,10,$equivalent,1,0,'C');
       }else{
        if(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_prediction > 0) && ($final_prediction>0)){
          // echo "<h6>".$equivalent."</h6>"; 
          $this->Cell(25,10,$equivalent,1,0,'C');
          }elseif(($prelim_grade>0) && ($midterm_grade>0) && ($prefinal_grade > 0) && ($final_prediction>0)){
          //  echo "<h6>".$equivalent."</h6>";
          $this->Cell(25,10,$equivalent,1,0,'C');
          }else{
            $this->Cell(25,10,'---',1,0,'C');
          }
       }
         if($equivalent > 0 && $equivalent <= 3){
          $remarks = "Passed";
          // echo "<h6 class='passed remarks'>".$remarks."</h6>";
          
          $this->Cell(25,10,$remarks,1,0,'C');
          }elseif($equivalent == 5){
            $remarks = "Failed";
            // echo "<h6 class='failed remarks'>".$remarks."</h6>";
            // $this->SetTextColor(255,0,0);
            $this->Cell(25,10,$remarks,1,0,'C');
            // $this->SetTextColor(0,0,0);
          }else{
            $remarks = "---";
            // echo $remarks;
            $this->Cell(25,10,$remarks,1,0,'C');
        }
        
        $this->Ln();

        }
        $this->Ln();
        $this->Ln();
        $this->Cell(80,5,'',0,0,'L');
        $this->Cell(80,5,'_______________________',0,0,'L');
        $this->Cell(80,5,'_______________________',0,0,'L');
        $this->Ln();
        $this->Cell(75,5,'',0,0,'C');
        $this->Cell(50,5,'Date Submitted',0,0,'C');
        $this->Cell(109,5,'Signature over Printed Name',0,0,'C');
        $this->Ln();
    }

     
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($connections);
$pdf->Output();

?>