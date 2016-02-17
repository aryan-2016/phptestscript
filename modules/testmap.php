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
$id = $_GET['id'];
  
$lat = 0;
$long = 0;
$zoom = 8;
 
$findmap = "SELECT centerLat, centerLong, zoom FROM maps WHERE ID = $id";
$db->prepareQuery($findmap);
$row = $db->fetchSingleRow();
echo "<br>row=<pre>";print_r($row);echo "</pre>";
$lat = $row['centerLat'];
$long = $row['centerLong'];
$zoom = $row['zoom'];	
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikey; ?>&sensor=false"></script>
    <script type="text/javascript">
      function initialize() 
	  {
		var mapOptions = {
          center: new google.maps.LatLng(<?php echo $lat.', '.$long; ?>),
          zoom: <?php echo $zoom; ?>
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		<?php
			$getpoints = "SELECT pointLat, pointLong, pointText FROM mappoints WHERE mapID = $id";		 
			$db->prepareQuery($findmap);
			$rows = $db->fetchResultset();
			foreach($rows as $row) 
			{
			  echo 'var myLatlng1 = new google.maps.LatLng('.
					$row[pointLat].', '.$row[pointLong].'); 
					var marker1 = new google.maps.Marker({ 
					position: myLatlng1, 
					map: map, 
					title:"'.$row[pointText].'"
				});';
			}
		?>
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>
  </body>
</html>