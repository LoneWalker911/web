<?php
require '../cookiechk.php';
 ?>
<style media="screen">
.chart { width: 49%; height: 500px;display: inline-block;}
/* @media (min-width: 300px) {
  .chart {
    max-width: 720px; } } */
 </style>

<div class="chart" id="chartContainer1" ></div>
<div class="chart" id="chartContainer2" ></div>
<div class="chart" id="chartContainer3" ></div>
<div class="chart" id="chartContainer4" ></div>

<script src="//localhost/web/charts/canvasjs.min.js"></script>
<script type="text/javascript">
var chart = new CanvasJS.Chart("chartContainer1", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Vegetable Market Share"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [	]
	}]
});
var chart2 = new CanvasJS.Chart("chartContainer2", {
	theme: "dark2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Farmers by Province"
	},
	data: [{
		type: "bar",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}",
		dataPoints: [	]
	}]
});
var chart3 = new CanvasJS.Chart("chartContainer3", {
	theme: "dark1", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Total harvest by province"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: []
	}]
});
var chart4 = new CanvasJS.Chart("chartContainer4", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: false,
	animationEnabled: true,
	title: {
		text: "Vegetable Wastage"
	},
	data: [{
		type: "column",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}kg",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}kg",
		dataPoints: [	]
	}]
});
</script>
<script>
<?php
require "../dbcon.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT crop.crop_type,count(harvest.id)/(SELECT count(id) AS count FROM harvest)*100 AS bb FROM harvest,crop WHERE crop_type_id=crop.id GROUP BY crop.crop_type";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)){
	echo "chart.options.data[0].dataPoints.push({ y: ".$row['bb'].", label: \"".$row['crop_type']."\" });\n";
}
}

$sql = "SELECT province.province,count(nic) AS bb FROM farmer,province,district WHERE farmer.district=district.id AND district.province=province.id GROUP BY province.province";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)){
	echo "chart2.options.data[0].dataPoints.push({ y: ".$row['bb'].", label: \"".$row['province']."\" });\n";
}
}

$sql = "SELECT province.province,count(nic)/(SELECT count(nic) AS count FROM farmer)*100 AS bb FROM farmer,province,district WHERE farmer.district=district.id AND district.province=province.id GROUP BY province.province";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)){
	echo "chart3.options.data[0].dataPoints.push({ y: ".$row['bb'].", label: \"".$row['province']."\" });\n";
}
}

$sql = "SELECT crop.crop_type,sum(harvest.qty_kg)-sum(transaction.qty_kg) AS qty FROM transaction,harvest,crop WHERE transaction.harvest_id=harvest.id AND harvest.crop_type_id=crop.id GROUP BY crop.crop_type";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)){
	echo "chart4.options.data[0].dataPoints.push({ y: ".$row['qty'].", label: \"".$row['crop_type']."\" });\n";
}
}
?>
</script>
