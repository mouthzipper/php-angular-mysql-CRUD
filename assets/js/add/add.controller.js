( function () {
	'use strict';

	function AddCtrl( $http, $state , BASE_URL) {
		var vm = this;
		vm.addNew = addNew;

		function addNew( product ) {
			$http.post( BASE_URL + 'api/add_product', product )
		  		.success( function( data)  {
		  			$state.go( 'home' );
		  		});
		}
	}

	AddCtrl.$inject = [ '$http', '$state', 'BASE_URL' ];

	angular.module( 'app.add' )
	.controller( 'AddCtrl', AddCtrl );
})();