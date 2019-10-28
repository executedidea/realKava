<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="{{(request()->is('/') || request()->is('user-management*') ? 'layout-3' : '')}}">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="se-pre-con"></div>
            @include('layouts.partials.topbar')
            @unless (request()->is('/') or request()->is('user-management*'))
            @include('layouts.partials.sidebar')
            @endunless
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('content-title')</h1>
                    </div>
                    @yield('content')
                </section>
            </div>
            @yield('modal')
        </div>
    </div>
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
    @yield('script')
</body>

</html>
