<html ng-app>
<head>
    <title>首页</title>
    <script src="<?php echo PUBLICPATH; ?>js/angular.js" type="text/javascript"></script>
    <style type="text/css">
        .ng-cloak {
            display: none;
        }
    </style>
</head>
<body>
这里是ng-app外面的~~{{1+2}}
<div ng-app class="ng-cloak">这里是ng-app里面~~~{{1+3*2}}</div>
<div ng-app class="ng-cloak" ng-controller="ControllerA">
    name:{{name}}
    <button ng-app ng-click="doIt()">DoItasdfasdf</button>
</div>

<hr/>
<script type="text/javascript">

    function ControllerA($scope) {
        $scope.name = 'yahui';
        $scope.doIt = function () {
            $scope.name += "12312";
        };
    }
</script>
</body>
</html>