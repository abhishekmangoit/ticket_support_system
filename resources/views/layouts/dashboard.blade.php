<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.cssLinks')
    @stack('style')
    <title>@yield('title')</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    @include('includes.navbar')
    

    <main>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        @yield('content')
        </div>
   </main>

    @include('includes.sidebar')
    @include('includes.footer')
   
    @include('includes.scriptLinks')
    @stack('script')

</div>
    
</body>
</html>