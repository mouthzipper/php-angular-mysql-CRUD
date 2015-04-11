( function () {
	'use strict';
	function configRoutes( $stateProvider, $urlRouterProvider ) {
		$stateProvider
	    	.state('home', {
		     	url: '/home',
		    	templateUrl: 'assets/js/home/home.html',
		    	controller: 'HomeCtrl',
		    	controllerAs: 'vm'
	    	})

	    	.state('add', {
		     	url: '/add',
		    	templateUrl: 'assets/js/add/add.html',
		    	controller: 'AddCtrl',
		    	controllerAs: 'vm'
	    	})

	    	.state('edit', {
		     	url: '/edit:id',
		    	templateUrl: 'assets/js/edit/edit.html',
		    	controller: 'editCtrl',
		    	controllerAs: 'vm'
	    	})

	  	$urlRouterProvider.otherwise('home');
	}

	angular.module( 'app.config' )
		.config( configRoutes )
})();