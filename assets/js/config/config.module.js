(function() {
	'use strict';

	angular.module( 'app.config', [ 'ui.router', 'angular-loading-bar', 'ui.bootstrap' ] )
	.constant('BASE_URL', 'http://localhost/php-crud/');
})();