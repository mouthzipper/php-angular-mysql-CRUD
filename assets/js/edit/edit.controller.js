( function () {
	'use strict';

	function EditCtrl( $http, $stateParams, $state, BASE_URL ) {
		var vm = this;
		var id = $stateParams.id;
		vm.update = update;
	  	$http.get( BASE_URL + 'api/get_product/'+ id )
	  		.success( function(data) {
	  			vm.product = data[0];
	  		});

	  	function update( product ) {
	  		$http.put( BASE_URL + 'api/edit_product/' + id, product )
	  			.success( function ( data ) {
	  				console.log( data );
	  				$state.go( 'home' );
	  			} );
	  	}
	}

	EditCtrl.$inject = [ '$http', '$stateParams', '$state', 'BASE_URL' ];
	angular.module( 'app.edit' )
	.controller( 'EditCtrl', EditCtrl );
})();