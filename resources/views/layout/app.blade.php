<!Doctype html>
<html>
   <head>
     <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="/css/style.css">
     <script src="/jquery/jquery.js" ></script>
     <script src="/js/bootstrap.min.js" ></script>
    <!-- <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>-->
     <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/font/css/all.min.css">
      <script src="/axios/axios.min.js"></script>
     @yield('style')
   </head>
   <body>
     @include('header')
     @yield('content')
     @include('footer')
     @include('flashy::message')
     </body>
</html>
@yield('script')