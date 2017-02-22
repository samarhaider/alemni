/**
 * @auther Samar Haider <s.samar_haider@yahoo.com>
 * 
 */

(function () {

    'use strict';

    angular
            .module('jumbleFundApp', ['ui.router', 'satellizer'])
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
                                    $state.go('auth');
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
                $urlRouterProvider.otherwise('/auth');
                $authProvider.facebook({
                    clientId: '569668783136256'
                });
                
                $authProvider.google({
                    clientId: '426586124483-l4gnl9dmatfr8p88nikj6rv0p2l7ku4v.apps.googleusercontent.com',
                    redirectUri: 'http://localhost:8000',
                    scope: ['profile', 'email'],
                });

                // Facebook
                $authProvider.facebook({
                    name: 'facebook',
                    url: '/api/authenticate/facebook',
                    authorizationEndpoint: 'https://www.facebook.com/v2.5/dialog/oauth',
                    redirectUri: window.location.origin + '/',
                    requiredUrlParams: ['display', 'scope'],
                    scope: ['email'],
                    scopeDelimiter: ',',
                    display: 'popup',
                    type: '2.0',
                    popupOptions: { width: 580, height: 400 }
                });
                // Twitter
                $authProvider.twitter({
                    url: '/api/authenticate/twitter',
                    authorizationEndpoint: 'https://api.twitter.com/oauth/authenticate',
                    redirectUri: window.location.origin,
                    type: '1.0',
                    popupOptions: { width: 495, height: 645 }
                });
                
                $stateProvider
                        .state('auth', {
                            url: '/auth',
                            templateUrl: 'views/authView.html',
                            controller: 'AuthController as auth'
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
})();