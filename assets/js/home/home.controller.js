( function () {
	'use strict';

	function HomeCtrl( $http ) {
		var vm = this;
		vm.deleteProduct= deleteProduct;


	  	$http.get('api/products' )
	  		.success( function(data) {
	  			vm.products = data;

	  			console.log( vm.products );
	  		});
	  	function deleteProduct( product ) {
	  		var deleteIt = confirm('Are you absolutely sure you want to delete?');
		    if ( deleteIt) {
		      $http.delete('api/products/'+product.product_id)
		      	.success( function() {
		      		var index = vm.products.indexOf(product);
  					vm.products.splice(index, 1); 
		      	});
		    }	
	  	}
	}

	HomeCtrl.$inject = [ '$http' ];
	angular.module( 'app.home' )
	.controller( 'HomeCtrl', HomeCtrl );
})();