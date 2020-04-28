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
        if(isset($_GET["redir"])){
        
          if($_GET["redir"] == "select_grading"){
            $grade_period = "";
          }else{
            $grade_period = $_GET["redir"];
          }
      
      
        }else{
          $grade_period = "";
        }


        if(isset($_GET["_y"])){
        
          if($_GET["_y"] == "select_year"){
            $year = "";
          }else{
            $year = $_GET["_y"];
          }
      

        }else{
          $year = "";
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
          $get_course_name = "IT 2 - Application Programming 1";
          $get_semester = "First Semester";
        }else{
          $get_course_name = "IT 5 - Application Programming 2";
          $get_semester = "Second Semester";
        }

        $this->Cell(70,10,'Course Name: '.$get_course_name,0,0,'L');
        $this->Cell(25,10,'Year: '.$year,0,0,'L');
        $this->Cell(70,10,'Semester: '.$get_semester,0,0,'L');
        $this->Ln();
        $this->Cell(276,10,'Midterm Period',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(20,10,'Student ID',1,0,'C');
        $this->Cell(45,10,'Student Name',1,0,'C');
        $this->Cell(40,10,'Output',1,0,'C');
        $this->Cell(50,10,'Performance',1,0,'C');
        $this->Cell(40,10,'Major Exam',1,0,'C');
        $this->Cell(20,10,'2nd Quarter',1,0,'C');
        $this->Cell(26,10,'Midterm Grade',1,0,'C');
        $this->Cell(20,10,'Equivalent',1,0,'C');
        $this->Cell(15,10,'Remarks',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',9);
        $this->Cell(20,10,'',1,0,'C');
        $this->Cell(45,10,'Higest Possible Score',1,0,'C');
        $this->Cell(8,10,'20',1,0,'C');
        $this->Cell(8,10,'20',1,0,'C');
        $this->Cell(8,10,'40',1,0,'C');
        $this->Cell(8,10,'60',1,0,'C');
        $this->Cell(8,10,'0.40',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'20',1,0,'C');
        $this->Cell(10,10,'40',1,0,'C');
        $this->Cell(10,10,'60',1,0,'C');
        $this->Cell(10,10,'0.40',1,0,'C');
        $this->Cell(13.33,10,'70',1,0,'C');
        $this->Cell(13.33,10,'60',1,0,'C');
        $this->Cell(13.33,10,'0.20',1,0,'C');
        $this->Cell(20,10,'',1,0,'C');
        $this->Cell(26,10,'',1,0,'C');
        $this->Cell(20,10,'',1,0,'C');
        $this->Cell(15,10,'',1,0,'C');
        $this->Ln();
    }
    function viewTable($connections){
        $this->SetFont('Times','B',9);
        
        $midterm_output_1 = $midterm_output_2 =
        $midterm_output_total_score = $midterm_output_base =
        $midterm_output_weight = $midterm_performance_1 =
        $midterm_performance_2 = $midterm_performance_total_score =
        $midterm_performance_base = $midterm_performance_weight =
        $midterm_written_test = $midterm_written_test_base =
        $midterm_written_test_weight = $midterm_2nd_quarter =
        $midterm_grade = $midterm_grade_equivalent = "0";
        $midterm_remarks = "";

        if(isset($_GET["redir"])){
        
          if($_GET["redir"] == "select_grading"){
            $grade_period = "";
          }else{
            $grade_period = $_GET["redir"];
          }
      
      
        }else{
          $grade_period = "";
        }


        if(isset($_GET["_y"])){
        
          if($_GET["_y"] == "select_year"){
            $year = "";
          }else{
            $year = $_GET["_y"];
          }
      

        }else{
          $year = "";
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

        if($grade_period == "midterm"){
          if(isset($_GET["_y"])){
            if($year == $_GET["_y"]){
              if(isset($_GET["_c"])){
                if($course == $_GET["_c"]){
                  // if(isset($_GET["_s"])){
                  //   if($subject == $_GET["_s"]){
                      if(isset($_GET["_s_e_"])){
                        if($semester == $_GET["_s_e_"]){
            // $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE year=$year AND account_type='2' ");
            // echo $_GET["_y"];
          // echo"<script>alert('hay');</script>";
                          $grade_period = $grade_period . $semester[3];
                          // $semester_no = $semester[3];
                          $prelim = "prelim$semester[3]"; 
      
                          // echo $prelim;
                          // $get_student_no = mysqli_query($connections, "SELECT * FROM $grade_period");
                          // $fetch_student_no = mysqli_fetch_assoc($get_student_no);
                          // $student_no = $fetch_student_no["student_no"];
                          // $fullname = $fetch_student_no["student_name"];
      
                          // $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE course='$course' AND year='$year' AND account_type='2'");
                          $grading_period = mysqli_query($connections, "SELECT * FROM $grade_period WHERE course='$course' AND year='$year' ");
                          $prelim_qry = mysqli_query($connections, "SELECT * FROM $prelim WHERE course='$course' AND year='$year' ");
                          // $row_prelim = mysqli_fetch_assoc($prelim_qry);
      
      
      
                          // prelim_query($grading_period,$prelim_qry);
                        }
                      }
                  //   }
                  // }
                }
              }
            }
          }
        }
        
      
      // $student_qry = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE account_type='2'");
      
      // function prelim_query($grading_period,$prelim_qry){
      while($row_student = mysqli_fetch_assoc($grading_period)){
      
        $student_no = $row_student["student_no"];
      //   $lastname = $row_student["lastname"];
      //   $firstname = $row_student["firstname"];
      //   $middlename = $row_student["middlename"];
        $fullname = $row_student["student_name"];
        $row_prelim = mysqli_fetch_assoc($prelim_qry);
        $midterm_output_1 = $row_student["midterm_output_1"];
        $midterm_output_2 = $row_student["midterm_output_2"];
        $midterm_output_total_score = $row_student["midterm_output_total_score"];
        $midterm_output_base = $row_student["midterm_output_base"];
        $midterm_output_weight = $row_student["midterm_output_weight"];
        $midterm_performance_1 = $row_student["midterm_performance_1"];
        $midterm_performance_2 = $row_student["midterm_performance_2"];
        $midterm_performance_total_score = $row_student["midterm_performance_total_score"];
        $midterm_performance_base = $row_student["midterm_performance_base"];
        $midterm_performance_weight = $row_student["midterm_performance_weight"];
        $midterm_written_test = $row_student["midterm_written_test"];
        $midterm_written_test_base = $row_student["midterm_written_test_base"];
        $midterm_written_test_weight = $row_student["midterm_written_test_weight"];
        $midterm_2nd_quarter = $row_student["midterm_2nd_quarter"];
        $midterm_grade = $row_student["midterm_grade"];
        $midterm_grade_equivalent = $row_student["midterm_grade_equivalent"];
        $midterm_remarks = $row_student["midterm_remarks"];
        
      
      $prelim_output_1 = $row_prelim['prelim_output_1'];
      $prelim_output_2 = $row_prelim['prelim_output_2'];
      $prelim_performance_1 = $row_prelim['prelim_performance_1'];
      $prelim_performance_2 = $row_prelim['prelim_performance_2'];
      $prelim_written_test = $row_prelim['prelim_written_test'];
      
      $prelim_output_total_score = $prelim_output_1 + $prelim_output_2;
      $prelim_performance_total_score = $prelim_performance_1 + $prelim_performance_2;
      
      $prelim_output_base = $prelim_output_total_score / 40 * 40 + 60;
      $prelim_performance_base = $prelim_performance_total_score / 40 * 40 + 60;
      $prelim_written_test_base =  $prelim_written_test / 70 * 40 + 60;
      
      $prelim_output_weight = $prelim_output_base * 0.40;
      $prelim_performance_weight = $prelim_performance_base * 0.40;
      $prelim_written_test_weight = $prelim_written_test_base * 0.20;
      
      $prelim_grade = $prelim_output_weight + $prelim_performance_weight + $prelim_written_test_weight;
      // echo $prelim_grade;
      // $prelim_grade = $row_prelim["prelim_grade"];
      
      $check_prelim_grade = $prelim_output_1 + $prelim_output_2 + $prelim_performance_1 + $prelim_performance_2 + $prelim_written_test;
      
          // ####################______Midterm Formulas______####################
          // $midterm_formative_assessment_total_score =
          // $midterm_formative_assessment_1 + $midterm_formative_assessment_2 +
          // $midterm_formative_assessment_3 + $midterm_formative_assessment_4 +
          // $midterm_formative_assessment_5 + $midterm_formative_assessment_6 +
          // $midterm_formative_assessment_7 + $midterm_formative_assessment_8 +
          // $midterm_formative_assessment_9 + $midterm_formative_assessment_10;
      
          // $midterm_formative_assessment_base = $midterm_formative_assessment_total_score / 100 * 40 + 60;
          $midterm_output_total_score = $midterm_output_1 + $midterm_output_2;
          $midterm_output_base = $midterm_output_total_score / 40 * 40 + 60;
          $midterm_output_weight = $midterm_output_base * 0.40;
          $midterm_performance_total_score = $midterm_performance_1 + $midterm_performance_2;
          $midterm_performance_base = $midterm_performance_total_score / 40 * 40 + 60;
          $midterm_performance_weight = $midterm_performance_base * 0.40;
          $midterm_written_test_base = $midterm_written_test / 70 * 40 + 60;
          $midterm_written_test_weight = $midterm_written_test_base * 0.20;
          $midterm_2nd_quarter = $midterm_output_weight + $midterm_performance_weight + $midterm_written_test_weight;
          $midterm_grade = $prelim_grade * 0.3 + $midterm_2nd_quarter * 0.7;
      
      
          switch (true) {
            case ($midterm_grade >= 74.5 && $midterm_grade <= 76.49):
                $midterm_grade_equivalent = "3";
                break;
            case ($midterm_grade >= 76.5 && $midterm_grade <= 79.49):
                $midterm_grade_equivalent = "2.75";
                break;
            case ($midterm_grade >= 79.5 && $midterm_grade <= 82.49):
                $midterm_grade_equivalent = "2.5";
                break;
            case ($midterm_grade >= 82.5 && $midterm_grade <= 85.49):
                $midterm_grade_equivalent = "2.25";
                break;
            case ($midterm_grade >= 85.5 && $midterm_grade <= 88.49):
                $midterm_grade_equivalent = "2";
                break;
            case ($midterm_grade >= 88.5 && $midterm_grade <= 91.49):
                $midterm_grade_equivalent = "1.75";
                break;
            case ($midterm_grade >= 91.5 && $midterm_grade <= 94.49):
                $midterm_grade_equivalent = "1.5";
                break;
            case ($midterm_grade >= 94.5 && $midterm_grade <= 97.49):
                $midterm_grade_equivalent = "1.25";
                break;
            case ($midterm_grade >= 97.5 && $midterm_grade <= 100):
                $midterm_grade_equivalent = "1";
                break;
      
            default:
                $midterm_grade_equivalent = "5";
        }
      
        if($midterm_grade >= 74.5){
          $midterm_remarks = "Passed";
        }else{
          $midterm_remarks = "Failed";
        }
      
      
        $year = $_GET["_y"];
        $course = $_GET["_c"];
        $semester = $_GET["_s_e_"];
      

          $this->Cell(20,10,$student_no,1,0,'C');
          $this->Cell(45,10,$fullname,1,0,'C');
          $this->Cell(8,10,$midterm_output_1,1,0,'C');
          $this->Cell(8,10,$midterm_output_2,1,0,'C');
          $this->Cell(8,10,$midterm_output_total_score,1,0,'C');
          $this->Cell(8,10,$midterm_output_base,1,0,'C');
          $this->Cell(8,10,$midterm_output_weight,1,0,'C');
          $this->Cell(10,10,$midterm_performance_1,1,0,'C');
          $this->Cell(10,10,$midterm_performance_2,1,0,'C');
          $this->Cell(10,10,$midterm_performance_total_score,1,0,'C');
          $this->Cell(10,10,$midterm_performance_base,1,0,'C');
          $this->Cell(10,10,$midterm_performance_weight,1,0,'C');
          $this->Cell(13.33,10,$midterm_written_test,1,0,'C');
          $this->Cell(13.33,10,number_format((float)$midterm_written_test_base,2,".",""),1,0,'C');
          $this->Cell(13.33,10,number_format((float)$midterm_written_test_weight,2,".",""),1,0,'C');
          $this->Cell(20,10,number_format((float)$midterm_2nd_quarter,2,".",""),1,0,'C');
          $this->Cell(26,10,number_format((float)$midterm_grade,2,".",""),1,0,'C');
          $this->Cell(20,10,$midterm_grade_equivalent,1,0,'C');
          $this->Cell(15,10,$midterm_remarks,1,0,'C');
          $this->Ln();
          }       
          // }       
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