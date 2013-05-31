<?php

define('ga_account','###GOOGLE_MAIL###');
define('ga_password','###GOOGLE_PASSWORT###');
define('ga_profile_id','###GOOGLE_ID###');
 
require 'gapi.class.php';

$ga = new gapi(ga_account,ga_password);
$ga->requestReportData(ga_profile_id, array('isMobile'), array('visits'),'-visits');
$gaResults = $ga->getResults();

?>

<!doctype html>
<html>
  <head>
		<title>Visualizing Google Analytics: Mobile vs. Desktop</title>
			
			<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
		
		<script src="chart.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	</head>

	<body>
	
		<canvas id="donut" height="310" width="310"></canvas>


<script>
var analyticsData = [
<?php
  foreach($gaResults as $result) : 
    if ( $result == 'Yes')
      echo '{ value: ' . $result->getVisits() . ', color:"#333333" }, ';
    elseif ( $result == 'No')
    echo '{ value: ' . $result->getVisits() . ', color:"#12d237" }, '; 
 endforeach; 
?>
];

var analyticsDoughnut = {
 segmentShowStroke : true,
 animation : true
} 

var myAnalytics = new Chart(document.getElementById("donut").getContext("2d")).Doughnut(analyticsData, analyticsDoughnut);
</script>

	</body>
</html>
