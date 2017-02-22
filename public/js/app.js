/**
 * @auther Samar Haider <s.samar_haider@yahoo.com>
 * 
 */

(function () {

    'use strict';

    angular
            .module('app', [
//            'angularBootstrapNavTree',
//            'ngAnimate',
//            'ngCookies',
                'ngStorage',
                'ui.router',
//            'ui.load',
//            'ui.jq',
//            'ui.validate',
//            'pascalprecht.translate',
                'app.filters',
                'app.services',
                'app.directives',
                'ngResource',
                'satellizer',
                'ui.bootstrap',
//            'oc.lazyLoad',
//            'toggle-switch'
            ])
            .config(function ($stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide) {

                function redirectWhenLoggedOut($q, $injector) {

                    return {
                        responseError: function (rejection) {

                            // Need to use $injector.get to bring in $state or else we get
                            // a circular dependency error
                            var $state = $injector.get('$state');

                            // Instead of checking for a status code of 400 which might be used
                            // for other reasons in Laravel, we check for the specific rejection
                            // reasons to tell us if we need to redirect to the login state
                            var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];

                            // Loop through each rejection reason and redirect to the login
                            // state if one is encountered
                            angular.forEach(rejectionReasons, function (value, key) {

                                if (rejection.data.error === value) {

                                    // If we get a rejection corresponding to one of the reasons
                                    // in our array, we know we need to authenticate the user so 
                                    // we can remove the current user from local storage
//                                localStorage.removeItem('user');

                                    // Send the user to the auth state so they can login
                                    $state.go('login');
                                }
                            });

                            return $q.reject(rejection);
                        }
                    }
                }

                // Setup for the $httpInterceptor
                $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);

                // Push the new factory onto the $http interceptor array
                $httpProvider.interceptors.push('redirectWhenLoggedOut');
                // Satellizer configuration that specifies which API
                // route the JWT should be retrieved from
                $authProvider.loginUrl = '/api/authenticate';

                // Redirect to the auth state if any other states
                // are requested other than users
                $urlRouterProvider.otherwise('/login');
                
                $authProvider.google({
                    url: '/api/google-login',
                    clientId: '426586124483-l4gnl9dmatfr8p88nikj6rv0p2l7ku4v.apps.googleusercontent.com',
//                    redirectUri: 'http://localhost:8000',
                    scope: ['profile', 'email'],
                });

                
                $stateProvider
                        .state('login', {
                            url: '/login',
                            component: 'login',
                        })
                        .state('app', {
                            url: '/app',
                            templateUrl: 'views/app.html',
                        })
                        .state('app.companies', {
                            url: '/companies',
                            templateUrl: 'views/companies/index.html',
                            controller: 'CompanyController as company'
                        });
                ;
            });
            ;
})();