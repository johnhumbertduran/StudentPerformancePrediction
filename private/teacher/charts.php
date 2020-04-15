<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>

<?php
session_start();

include("../bins/connections.php");
include("../../bins/header.php");


if(isset($_SESSION["username"])){

    $session_user = $_SESSION["username"];
  
    $query_info = mysqli_query($connections, "SELECT * FROM _user_tbl_ WHERE username='$session_user'");
    $my_info = mysqli_fetch_assoc($query_info);
    $account_type = $my_info["account_type"];
    
    if($account_type != 3){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }


?>


<center>
<h1 class="py-3 text-info px-1">Student Performance System</h1>
</center>


<style>
.chart_active{
  border: 1.5px solid white;
  border-radius: 6px;
}
</style>

<?php
include("../bins/teacher_nav.php");
?>
<br>

<center>
<!-- <h1 class="py-3 text-info px-1"><font color="red">Student ID sa Register</font></h1> -->
</center>


<?php
include('overallPredictedStudentsPerformanceFirstSemesterBarChart.php');
?>

<hr>

<?php
include('pieChartPassAndFailure.php');
?>

<hr>

<?php
include('overallStudentsPerfomanceByCourse.php');
?>


<script>

 
window.onload = function () {

  
var barChart = new CanvasJS.Chart("barChartContainerFirstSem", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
    fontColor: "red",
		text: "Overall Predicted Student's Performance First Semester"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: /* "#5A5757", */ "#fff",
    indexLabelFontWeight: "bold",
    indexLabelFontSize: 16,
		indexLabelPlacement: "inside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
barChart.render();




var pieChart = new CanvasJS.Chart("pieChartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Pie Chart: Pass and Failure Percentage",
    fontColor: "green"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{label}: <strong>{y}%</strong>",
		indexLabel: "{label} - {y}%",
    // indexLabelFontWeight: "bold",
    indexLabelFontSize: 15,
    indexLabelLineThickness: 2,
		dataPoints: <?php echo json_encode($pieChartDataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
pieChart.render();


var barChart_BSCS = new CanvasJS.Chart("barChartContainer_BSCS", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
    fontColor: "red",
		text: "Overall Student's Performance in a BSCS"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: /* "#5A5757", */ "#fff",
    indexLabelFontWeight: "bold",
    indexLabelFontSize: 16,
		indexLabelPlacement: "inside",   
		dataPoints: <?php echo json_encode($dataPoints_BSCS, JSON_NUMERIC_CHECK); ?>
	}]
});
barChart_BSCS.render();

}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.pieChart.render();
 
}





</script>

<script src="../../canvasjs-2.3.2/canvasjs.min.js"></script>


 <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

<?php
include("../../bins/footer_non_fixed.php");
?>