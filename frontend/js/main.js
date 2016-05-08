var app = angular.module('mainModule', ['ngResource']);

app.factory('Appointment', ['$resource', function($resource) {
	return $resource(
		'http://localhost:8000/api/appointments/:id',
		{appointmentId:'@_id'}
		);
}]);

app.factory('Slots', ['$resource', function($resource) {
	return $resource(
		'http://localhost:8000/api/slots/:from/:to',
		{
			from:'@_from', 
			to: '@_to'
		}	 
		);
}]);


app.controller('AppointmentController',  function($scope, Slots, Appointment) {
	$scope.range = {};
	$scope.range.fromDate = new Date();
	$scope.range.fromDate.setDate($scope.range.fromDate.getDate()+14);
	$scope.range.toDate = new Date();
	$scope.range.toDate.setDate($scope.range.toDate.getDate()+21);
	$scope.stepsIntoFuture = 0;
	$scope.slots = [];
	$scope.appointment = {};
	$scope.slotSelected = false;

	$scope.range.toDate.advance = function(modifier) {
		if (modifier == '+') {
			$scope.range.toDate.setDate($scope.range.toDate.getDate() + 14);
		} else {
			$scope.range.toDate.setDate($scope.range.toDate.getDate() - 14);						
		}					
	}

	$scope.range.fromDate.advance = function(modifier) {
		if (modifier == '+') {
			$scope.range.fromDate.setDate($scope.range.fromDate.getDate() + 14);
		} else {
			$scope.range.fromDate.setDate($scope.range.fromDate.getDate() - 14);						
		}					
	}

	$scope.advanceRange = function(modifier) {
		$scope.range.toDate.advance(modifier);					
		$scope.range.fromDate.advance(modifier);
		if (modifier == '+') {	
			$scope.stepsIntoFuture++;
		} else {
			$scope.stepsIntoFuture--;
		}
		$scope.listSlots();
	}

	$scope.listSlots = function() {
		$fromTimestamp = Math.floor($scope.range.fromDate.getTime() / 1000);
		$toTimestamp = Math.floor($scope.range.toDate.getTime() / 1000);
		$scope.slots = Slots.query(
			{ 'from': $fromTimestamp , 'to': $toTimestamp }
			);
	}

	$scope.reserveSlot = function(slot) {
		$scope.selectedSlot = new Date(slot);
		console.log($scope.selectedSlot);
		$scope.slotSelected = true;
	}

	$scope.save = function () {
		$scope.appointment.timeslot = $scope.selectedSlot.getTime() / 1000;			
		console.log(Appointment.save($scope.appointment));		
	}

	$scope.cancel = function () {
		$scope.slotSelected = false;
	}

	$scope.listSlots();
});
