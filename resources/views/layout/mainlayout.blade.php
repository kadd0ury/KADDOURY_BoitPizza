<!DOCTYPE html>
<html lang="en">
 <head>

 @yield('extra-script')
 @yield('extra-meta')
@include('layout.partials.head')

 </head>
 <body>
@include('layout.partials.header')
@yield('content')
@include('layout.partials.footer')
@include('layout.partials.footer-scripts')
@yield('extra-js')
 </body>

</html>