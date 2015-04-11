( function () {
	'use strict';

	function AddCtrl( $http, $state ) {
		var vm = this;
		vm.addNew = addNew;

		function addNew( product ) {
			$http.post('api/add_product', product )
		  		.success( function( data ) {
		  			console.log( data );
		  			$state.go( 'edit' );
		  		});
		}
	}

	AddCtrl.$inject = [ '$http', '$state' ];

	angular.module( 'app.add' )
	.controller( 'AddCtrl', AddCtrl );
})();