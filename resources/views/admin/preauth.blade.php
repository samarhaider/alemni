<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	<link rel="icon" href="/neon/images/favicon.ico">
	<title>{{ $title or 'Login' }} / {{ config('app.name', 'Laravel') }}</title>

	 <link rel="stylesheet" href="{{url('neon/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="'{{url('neon/css/font-icons/font-awesome/css/font-awesome.min.css')}}'">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{url('neon/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{url('neon/css/custom.css')}}">
    <style>
        .vertical-center {

        padding-top: 200px;
}
    </style>
    <script src="{{url('neon/js/jquery-1.11.3.min.js')}}"></script>

	<!--[if lt IE 9]><script src="/neon/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page" data-url="">

	@yield('content')

	<script src="{{url('neon/js/gsap/TweenMax.min.js')}}"></script>
    <script src="{{url('neon/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
    <script src="{{url('neon/js/bootstrap.js')}}"></script>
    
    <script src="{{url('neon/js/joinable.js')}}"></script>
    <script src="{{url('neon/js/resizeable.js')}}"></script>
    <script src="{{url('neon/js/neon-api.js')}}"></script>
    <!-- Imported scripts on this page -->
    @stack('scripts')
    <!-- JavaScripts initializations and stuff -->
    <script src="{{url('neon/js/neon-custom.js')}}"></script>
</body>
</html>