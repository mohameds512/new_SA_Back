<!DOCTYPE html>
<html>

@include('include.head')

<body class="alternative-font-4 loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 100}">
<div class="loading-overlay">
    <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<div class="body">
@include('include.header')
@yield('content')

  @include('include.footer')
</div>

@include('include.linkFooter')

</body>

</html>
