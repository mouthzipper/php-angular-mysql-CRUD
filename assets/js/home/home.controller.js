( function () {
	'use strict';

	function HomeCtrl( $http, BASE_URL ) {
		var vm = this;
		vm.deleteProduct= deleteProduct;
		vm.isAuthenticated = false;
		vm.login = login;
		vm.user;


		$http.get( BASE_URL + 'api/is_login' ) 
			.success( function ( data ) {
				if( data.isLogin === true ) {
					vm.isAuthenticated = true;
					loadData();
				}
			} )

		function loadData() {
			$http.get( BASE_URL  +'api/products' )
	  		.success( function(data) {
	  			vm.products = data;
	  		});	
		}
	  	
	  	function deleteProduct( id ) {
	  		var deleteIt = confirm('Are you absolutely sure you want to delete?');
		    if ( deleteIt) {
		      $http.put( BASE_URL  +'api/delete_product/'+ id )
		      	.success( function ( data ) {
		      		vm.products= data;
		      	});
		    }	
	  	}

	  	function login() {
	  		console.log( vm.user );
	  	}
	}

	HomeCtrl.$inject = [ '$http', 'BASE_URL' ];
	angular.module( 'app.home' )
	.controller( 'HomeCtrl', HomeCtrl );
})();