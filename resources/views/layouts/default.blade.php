<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.cssLinks')
    @stack('style')
    <title>@yield('title')</title>
</head>
<body class="sidebar-collapse ">

   <main>
   @yield('content')
   </main>

    <!-- @include('includes.footer') -->
   
    @stack('script')
    @include('includes.scriptLinks')

</body>
</html>
