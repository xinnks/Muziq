<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="A music player.">
    <!-- Control the behavior of search engine crawling and indexing -->
    <meta name="robots" content="index,follow"><!-- All Search Engines -->
    <title>Musiq - Audio Player.</title>

    <!-- favicons -->
    {{--<link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('favicons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#662D91">--}}
    <!-- ***favicons*** -->

    {{--<script defer src="/static/font-awesome-4.7.0/css/font-awesome.min.css"></script>--}}
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/colorthief@2.0.2/src/color-thief.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--UIKIT--}}
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}">
    <style>
        html, body {
            background-color: #999999;
            color: #464b4e;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        [v-cloak]{
            display: none;
        }
    </style>

</head>
<body>
<div id="app" v-cloak>
    <start></start>
</div>
<!-- built files will be auto injected -->
<script src="{{ asset('js/muziq.js') }}"></script>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
</body>
</html>
