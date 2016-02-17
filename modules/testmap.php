<?php
// Redirect if this page was accessed directly:
if(!defined('BASE_URL'))
{
	// Need the BASE_URL, defined in the config file:
	include('../includes/config.inc.php');
	
	// Redirect to the index page:
	$url = BASE_URL . 'index.php';
	header("Location : $url");
	exit;
}

$db = new DbPdoClass();

$apikey = "AIzaSyBdXbZEsLOkQmuHpIJrEIeEg3l07fJPwO8";
$id = 2; //$_GET['id'];
  
$lat = 0;
$long = 0;
$zoom = 8;
 
$findmap = "SELECT center_lat, center_long, zoom FROM maps WHERE id=$id";
$db->prepareQuery($findmap);
$row = $db->fetchSingleRow();
//echo "<br>row=<pre>";print_r($row);echo "</pre>";
$lat = $row['center_lat'];	
$long = $row['center_long'];
$zoom = $row['zoom'];
?>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">      
      #map-canvas { height: 100% }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikey; ?>&sensor=false&callback=initialize"></script>
    <script type="text/javascript">
      function initialize() 
	  {
		var mapOptions = {
          center: new google.maps.LatLng(<?php echo $lat . ', ' . $long; ?>),
          zoom: <?php echo $zoom; ?>
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		<?php
			/*$getpoints = "SELECT point_lat, point_long, point_text FROM mappoints WHERE map_id = $id";		 
			$db->prepareQuery($getpoints);
			$rows = $db->fetchResultset();
			foreach($rows as $row) 
			{
			  echo 'var myLatlng1 = new google.maps.LatLng(' . $row['point_lat'] . ', ' . $row['point_long'] . '); 
					var marker1 = new google.maps.Marker({ 
					position: myLatlng1, 
					map: map, 
					title:"'.$row['point_text'].'"
				});';
			}*/
		?>
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<div style="height:55%; width:45%;position: absolute;">
    <div id="map-canvas"></div>  
</div>
