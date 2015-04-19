(function() {
	'use strict';

	angular.module( 'app.config', [ 'ui.router', 'angular-loading-bar' ] )
	.constant('BASE_URL', 'http://localhost/php-crud/');
})();