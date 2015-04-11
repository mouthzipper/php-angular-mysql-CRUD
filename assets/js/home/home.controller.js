( function () {
	'use strict';

	function HomeCtrl( $http, BASE_URL ) {
		var vm = this;
		vm.deleteProduct= deleteProduct;


	  	$http.get( BASE_URL  +'api/products' )
	  		.success( function(data) {
	  			vm.products = data;
	  		});
	  	function deleteProduct( id ) {
	  		var deleteIt = confirm('Are you absolutely sure you want to delete?');
		    if ( deleteIt) {
		      $http.put( BASE_URL  +'api/delete_product/'+ id )
		      	.success( function ( data ) {
		      		vm.products= data;
		      	});
		    }	
	  	}
	}

	HomeCtrl.$inject = [ '$http', 'BASE_URL' ];
	angular.module( 'app.home' )
	.controller( 'HomeCtrl', HomeCtrl );
})();