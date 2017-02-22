/**
 * @author Samar Haider <s.samar_haider@yahoo.com>
 */

(function () {

    'use strict';

    angular.module('app')
            .constant('APP_NAME', 'Samar Haider')
            .constant('APP_VERSION', '0.0.1')
            .constant('BASE_URL', window.base_url)
            .constant('BASE_URL_API', window.base_url + '/api')
})();


(function () {

    'use strict';

    var app = angular.module('app');

//    app.config(['$compileProvider', function ($compileProvider) {
//            $compileProvider.debugInfoEnabled(false);
//        }]);

    app.config(['$httpProvider', function ($httpProvider) {
            $httpProvider.useApplyAsync(true);
        }]);

    app.config(['$animateProvider', function ($animateProvider) {
            $animateProvider.classNameFilter(/\banimated\b/);
        }]);

    app.config(['$resourceProvider', function ($resourceProvider) {
            $resourceProvider.defaults.cancellable = true;
        }]);
    /*
     app.config(function($locationProvider) {
     $locationProvider.html5Mode({
     enabled: true,
     requireBase: false
     });
     });
     */

})();
