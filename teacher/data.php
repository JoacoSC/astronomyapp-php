<?php 
include ('../helper.php');
include ('../connection.php');

$cardbody = '<div id="show" class="card-body">';

$content = '';

$endCardBody = '</div>';

$row = actualizarDatos($con);

/* echo $row['num']; */



foreach ($row as $value) {
	/* echo "ID: ".$value[0];
	echo " - Valor: ".$value[1]."<br>"; */

	/* ELECCIÓN DE COLOR ALEATORIO */

	$n = $value[0];  
	$sum=0;  
	while($n > 0 || $sum > 9)
    {
        if($n == 0)
        {
            $n = $sum;
            $sum = 0;
        }
        $sum += $n % 10;
        $n = (int)$n / 10;
    }

	$color = '';

	if($sum == 0 || $sum == 5){
		$color = 'danger';
	}else if($sum == 1 || $sum == 6){
		$color = 'warning';
	}else if($sum == 2 || $sum == 7){
		$color = 'info';
	}else if($sum == 3 || $sum == 8){
		$color = 'success';
	}else if($sum == 4 || $sum == 9){
		$color = 'primary';
	}

	/* ELECCIÓN DE COLOR ALEATORIO */
	
	$graph = '<h4 class="small font-weight-bold">'.$value[2].' <span
					class="float-right">'.$value[1].'%</span></h4>
				<div class="progress mb-4">
				<div class="progress-bar bg-'.$color.'" role="progressbar" style="width: '.$value[1].'%"
					aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
				</div>';

	$content .= $graph;	
	
}

	$html = $cardbody.$content.$endCardBody;

	echo $html;
/* print_r ($row); */

/* $strings = array(
    'Red',
    'Blue',
);
$key = array_rand($strings);
echo $strings[$key]; */
?>

	<!-- <div id="show" class="card-body">
		<h4 class="small font-weight-bold">Server Migration <span
				class="float-right">20%</span></h4>
		<div class="progress mb-4">
			<div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
				aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<h4 class="small font-weight-bold">Sales Tracking <span
				class="float-right">40%</span></h4>
		<div class="progress mb-4">
			<div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
				aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<h4 class="small font-weight-bold">Customer Database <span
				class="float-right">60%</span></h4>
		<div class="progress mb-4">
			<div class="progress-bar" role="progressbar" style="width: 60%"
				aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<h4 class="small font-weight-bold">Payout Details <span
				class="float-right">80%</span></h4>
		<div class="progress mb-4">
			<div class="progress-bar bg-info" role="progressbar" style="width: 80%"
				aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
		<h4 class="small font-weight-bold">Account Setup <span
				class="float-right">Complete!</span></h4>
		<div class="progress">
			<div class="progress-bar bg-success" role="progressbar" style="width: 100%"
				aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	</div> -->

	