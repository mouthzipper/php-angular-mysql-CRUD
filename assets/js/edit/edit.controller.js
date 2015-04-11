( function () {
	'use strict';

	function EditCtrl( $http ) {
		var vm = this;
		vm.users = {};
	  	$http.get('api/users' )
	  		.success( function(data) {
	  			vm.users = data;
	  		});
	}

	EditCtrl.$inject = [ '$http' ];
	angular.module( 'app.edit' )
	.controller( 'EditCtrl', EditCtrl );
})();