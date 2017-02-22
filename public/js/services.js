/* 
 * @author Samar Haider <s.samar_haider@yahoo.com>
 */

(function () {

    'use strict';

    angular.module('app.services', [])
            .factory('User', function ($resource, BASE_URL_API) {
                return $resource(BASE_URL_API + '/users/:id', {id: '@id'}, {
                    update: {
                        method: 'PUT' // this method issues a PUT request
                    },
                    me: {
                        method: 'GET', // this method issues a PUT request
                        url: BASE_URL_API + '/users/me',
                    },
                    resetPassword: {
                        method: 'POST', // this method issues a POST request
                        url: BASE_URL_API + '/users/generate-random-password',
                    },
                });
            })
            ;
})();