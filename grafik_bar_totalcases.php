<?php
include('koneksi_covid.php');
$data = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($data)){
	$country[] = $row['country'];
	$query = mysqli_query($koneksi,"select total_cases from tb_covid where id='".$row['id']."'");
	$row = $query->fetch_array();
	$total_cases[] = $row['total_cases'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Membuat Grafik Menggunakan Chart JS</title>
<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
<div style="width: 800px;height: 800px">
<canvas id="myChart"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
		labels: <?php echo json_encode($country); ?>,
		datasets: [{
			label: 'Grafik Data 10 Negara Asia Covid-19',
			data: <?php echo json_encode($total_cases);

		?>,

		backgroundColor: 'rgba(255, 99, 132, 0.2)',
		borderColor: 'rgba(255,99,132,1)',
		borderWidth: 1
		}]
	},
		options: {
		scales: {
		yAxes: [{
		ticks: {
		beginAtZero:true
		}
		}]
		}
		}
		});
</script>
</body>

</html>