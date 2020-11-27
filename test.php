<?php


$dataPoints = array();
try{

    $link = new \PDO(   'mysql:host=localhost;dbname=khanstore;charset=utf8mb4', 
                        'root', 
                        '', 
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('select product_id, product_price as somme from products'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->product_id, "y"=> $row->somme));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
	
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Statistics Bitcoin from January to July"
	},
	axisY: {
		title: "Statistics Bitcoin from january to july",
		
	},
	data: [{
        
		type: "spline",
      
		markerSize: 5,
		xValueFormatString: "YYYY",
		yValueFormatString: "DH #,##0.##",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
 
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="margin-top:40px;height: 370px; width: 100%;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   