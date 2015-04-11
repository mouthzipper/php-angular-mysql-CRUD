( function () {
	'use strict';

	function AddCtrl( $http ) {
		var vm = this;
		vm.users = {};
	  	$http.get('api/users' )
	  		.success( function(data) {
	  			vm.users = data;
	  		});
	}

	AddCtrl.$inject = [ '$http' ];
	angular.module( 'app.add' )
	.controller( 'AddCtrl', AddCtrl );
})();