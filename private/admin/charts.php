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
    
    if($account_type != 1){
    
        header('Location: ../../forbidden');
    
    }
  
  }else{
    
    header('Location: ../../');
  
  }


?>


<center>
<h1 class="py-3 text-info px-1">Student Performance Charts</h1>
</center>


<style>
.chart_active{
  border: 1.5px solid white;
  border-radius: 6px;
}

.secondSemester{
	display: none;
}

.bsit{
	display: none;
}

.displayBlock{
	display: block;
}

.displayNone{
	display: none;
}

</style>

<?php
include("../bins/admin_nav.php");
?>
<br>

<center>
<!-- <h1 class="py-3 text-info px-1"><font color="red">Student ID sa Register</font></h1> -->
</center>

<div>

<div id="overAllSemesterBefore"></div>
<br>

<select name="overAllSemester" id="overAllSemester" class="form-control col-2 ml-3 bg-info text-white" onchange="semester()">
<option value="firstSemester">First Semester</option>
<option value="secondSemester">Second Semester</option>
</select>

<input type="hidden" id="overAllSemesterText" value="<?php if(isset($_GET['sem'])){ echo $_GET['sem'];} ?>">

<div id="firstSemester" class="firstSemester">
<?php
include('overallPredictedStudentsPerformanceFirstSemesterBarChart.php');
?>
</div>

<div id="secondSemester" class="secondSemester">
<?php
include('overallPredictedStudentsPerformanceSecondSemesterBarChart.php');
?>
</div>

</div>

<hr>

<?php
include('pieChartPassAndFailure.php');
?>

<hr>


<div>

<div id="overAllByCourseBefore"></div>
<br>
<br>
<select name="overAllByCourse" id="overAllByCourse" class="form-control col-2 ml-3 bg-info text-white" onchange="course()">
<option value="BSCS">BSCS</option>
<option value="BSIT">BSIT</option>
</select>

<input type="hidden" id="overAllByCourseText" value="<?php if(isset($_GET['course'])){ echo $_GET['course'];} ?>">

<div id="bscs" class="bscs">
<?php
include('overallStudentsPerfomanceBSCS.php');
?>
</div>

<div id="bsit" class="bsit">
<?php
include('overallStudentsPerfomanceBSIT.php');
?>
</div>

</div>

<br>
<hr>


<?php
include('midtermVSfinal.php');
?>


<script>

 
window.onload = function () {

	var overAllSemesterText = document.getElementById("overAllSemesterText");
	var overAllSemester = document.getElementById("overAllSemester");
	var firstSemester = document.getElementById("firstSemester");
	var secondSemester = document.getElementById("secondSemester");
	var secondSemesterValue = document.getElementById("secondSemester").value;


	if(overAllSemesterText.value == "secondSemester"){
    // alert("hay");
    overAllSemester.value = "secondSemester";
    secondSemester.classList.add("displayBlock");
	firstSemester.classList.add("displayNone");
    window.location.href = "#overAllSemesterBefore";
	}

	if(overAllSemesterText.value == "firstSemester"){
    window.location.href = "#overAllSemesterBefore";
	}


	var overAllByCourseText = document.getElementById("overAllByCourseText");
	var overAllByCourse = document.getElementById("overAllByCourse");
	var bscs = document.getElementById("bscs");
	var bsit = document.getElementById("bsit");


	if(overAllByCourseText.value == "BSIT"){
    // alert("hay");
    overAllByCourse.value = "BSIT";
    bsit.classList.add("displayBlock");
	bscs.classList.add("displayNone");
    window.location.href = "#overAllByCourseBefore";
	}

	if(overAllByCourseText.value == "BSCS"){
    // alert("hay");
    window.location.href = "#overAllByCourseBefore";
	}

  
var barChartFirstSemester = new CanvasJS.Chart("barChartContainerFirstSem", {
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
		dataPoints: <?php echo json_encode($dataPointsFirstSemester, JSON_NUMERIC_CHECK); ?>
	}]
});
barChartFirstSemester.render();


// setTimeout(function(){
  
var barChartSecondSemester = new CanvasJS.Chart("barChartContainerSecondSem", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
    fontColor: "red",
		text: "Overall Predicted Student's Performance Second Semester"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: /* "#5A5757", */ "#fff",
    indexLabelFontWeight: "bold",
    indexLabelFontSize: 16,
		indexLabelPlacement: "inside",   
		dataPoints: <?php echo json_encode($dataPointsSecondSemester, JSON_NUMERIC_CHECK); ?>
	}]
});

barChartSecondSemester.render();

// },1000);


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
		text: "Overall Student's Performance of BSCS"
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


// setTimeout(function(){

var barChart_BSIT = new CanvasJS.Chart("barChartContainer_BSIT", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
    fontColor: "red",
		text: "Overall Student's Performance of BSIT"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: /* "#5A5757", */ "#fff",
    indexLabelFontWeight: "bold",
    indexLabelFontSize: 16,
		indexLabelPlacement: "inside",   
		dataPoints: <?php echo json_encode($dataPoints_BSIT, JSON_NUMERIC_CHECK); ?>
	}]
});

barChart_BSIT.render();

// },1000);


var midtermVSfinalChart = new CanvasJS.Chart("midtermVSfinalChartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	axisX:{
    labelAngle: -90,
 	},
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
    fontColor: "red",
		text: "Overall Predicted Student's Performance First Semester"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelOrientation: "vertical",
		indexLabelFontColor: /* "#5A5757", */ "#fff",
    	indexLabelFontWeight: "bold",
    	indexLabelFontSize: 16,
		indexLabelPlacement: "inside",
		name: "Midterm Grade",
		showInLegend: true, 
		dataPoints: <?php echo json_encode($getPushData, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Final Grade",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints: <?php echo json_encode($getPushData2, JSON_NUMERIC_CHECK); ?>
	}]
});
midtermVSfinalChart.render();


}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.pieChart.render();
 
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}



</script>

<script src="../../canvasjs-2.3.2/canvasjs.min.js"></script>
<script src="../bins/sc/charts.js"></script>


 <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

<?php
include("../../bins/footer_non_fixed.php");
?>