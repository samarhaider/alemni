<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!--<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">-->
        <!--<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">-->
        <title>Samar Haider</title>
        <script>
            window.base_url = "<?= url('/'); ?>";
        </script>
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="node_modules/components-font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css">
        <link href="css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="app app-header-fixed" id="app"  ui-view></div>
    </body>

    <!-- Application Dependencies -->
    <script src="node_modules/angular/angular.js"></script>
    <script src="node_modules/ngstorage/ngStorage.min.js"></script>
    <script src="node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="node_modules/satellizer/dist/satellizer.js"></script>
    <script src="node_modules/angular-resource/angular-resource.js"></script>
    <script src="node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js"></script>
    <script src="node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>

    <!-- Application Scripts -->
    <script src="js/app.js"></script>
    <script src="js/constants.js"></script>
    <script src="js/filters.js"></script>
    <script src="js/services.js"></script>
    <script src="js/directives.js"></script>
    <!--<script src="js/components/app.js"></script>-->
    <script src="js/components/loginComponent.js"></script>

    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</html>
