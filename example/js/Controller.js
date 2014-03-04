(function($app) {

    /**
     * @controller PostyController
     * @param $scope {Object}
     */
    $app.controller('PostyController', function postyController($scope) {

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
         * @method hasResult
         * @return {Boolean}
         */
        $scope.hasResult = function() {
            return $scope.result.hasOwnProperty('latitude') && $scope.result.hasOwnProperty('longitude');
        };

    });

})(window.postyApp);