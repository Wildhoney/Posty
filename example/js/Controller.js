(function($app) {

    /**
     * @controller PostyController
     * @param $scope {Object}
     * @param $http {Object}
     */
    $app.controller('PostyController', function postyController($scope, $http) {

        /**
         * @property result
         * @type {Object}
         */
        $scope.result = {};

        /**
         * @property postCode
         * @type {String}
         */
        $scope.postCode = '';

        /**
         * @method find
         * @param postCode {String}
         * @return {void}
         */
        $scope.find = function find(postCode) {

            var url = '../module/php/Posty.php?postCode=' + postCode;
            $http.get(url).then(function then(response) {
                $scope.result = response.data;
            });

        };

        /**
         * @method hasResult
         * @return {Boolean}
         */
        $scope.hasResult = function() {
            return $scope.result.hasOwnProperty('latitude') && $scope.result.hasOwnProperty('longitude');
        };

    });

})(window.postyApp);