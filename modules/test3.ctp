<!DOCTYPE html>
<html >
<style>
table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd) {
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body>
 
<div ng-app="myApp" ng-controller="customersCtrl">
 
<table>
  <tr ng-repeat="x in names">
    <td>{{ x.id }}</td>
    <td ng-click="ConfirmDialog(x.name)">{{ x.name }}</td>
  </tr>
</table>
 
</div>
 
<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   /*$http.get("http://synapse.asia/zeto8223/api/getLabourList")
   .then(function (response) {$scope.names = response.data.data;});*/
   
   $scope.names = <?php echo $channelOptions; ?>;
   
   $scope.ConfirmDialog = function (name) {
         alert('name: '+ name);
 };
});
</script>
 
</body>
</html>
