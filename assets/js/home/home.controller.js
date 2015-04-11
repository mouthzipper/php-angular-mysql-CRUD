( function () {
	'use strict';

	function HomeCtrl( $http ) {
		var vm = this;
		vm.products = {};
	  	$http.get('api/products' )
	  		.success( function(data) {
	  			vm.products = data;
	  		});
	}

	HomeCtrl.$inject = [ '$http' ];
	angular.module( 'app.home' )
	.controller( 'HomeCtrl', HomeCtrl );
})();