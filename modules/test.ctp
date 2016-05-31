<!DOCTYPE html>
<html ng-app>
<head>
<title>Search form with AngualrJS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" />
	<script src="http://code.angularjs.org/angular-1.0.0.min.js"></script>
	<script>	
	function SearchCtrl($scope, $http) {
		$scope.url = '<?php echo Configure::read('site_url').'Pages/search'; ?>'; // The url of our search
			
		// The function that will be executed on button click (ng-click="search()")
		$scope.search = function() {
			
			// Create the http post request
			// the data holds the keywords
			// The request is a JSON request.
			$http.post($scope.url, { "data" : $scope.keywords}).
			success(function(data, status) {
				$scope.status = status;
				$scope.data = data;
				$scope.result = data; // Show result from server in our <pre></pre> element
			})
			.
			error(function(data, status) {
				$scope.data = data || "Request failed";
				$scope.status = status;			
			});
		};
	}
	</script>
</head>

<body>

	<div ng-controller="SearchCtrl">
	<form class="well form-search">
		<label>Search:</label>
		<input type="text" ng-model="keywords" class="input-medium search-query" placeholder="Keywords...">
		<button type="submit" class="btn" ng-click="search()">Search</button>
		<p class="help-block">Try for example: "php" or "angularjs" or "asdfg"</p>		
    </form>
<pre ng-model="result">
{{result}}
</pre>
   </div>
</body>

</html> 