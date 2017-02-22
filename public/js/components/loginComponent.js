/**
 * @auther Samar Haider <s.samar_haider@yahoo.com>
 * 
 */
(function() {

    'use strict';

    angular
        .module('app')
        .component('login', {
                templateUrl: 'views/login.html',
                controller: 'LoginController',
                controllerAs: 'auth',
//                require: {
//                    app: '^appComponent',
//                }
            })
        .controller('LoginController', LoginController);


    function LoginController($auth, $state) {

        var vm = this;
        vm.error = false;
        vm.message = '';
        vm.login = function() {

            var credentials = {
                email: vm.email,
                password: vm.password
            }
            
            // Use Satellizer's $auth service to login
            $auth.login(credentials).then(function(data) {

                // If login is successful, redirect to the users state
//                $state.go('users', {});
                $state.go('app.companies', {});
                
                
            }, function(response) {
                vm.error = true;
                vm.message = response.data.message;
            });
        }
        
        if($auth.isAuthenticated()){
//            $state.go('companies', {});
        }
       
        vm.authenticate = function(provider) {
          $auth.authenticate(provider).then(function(response) {
                // Signed in with provider.
              })
              .catch(function(response) {
                // Something went wrong.
                vm.error = true;
                vm.message = response.data.message;
              });
        };
    }

})();