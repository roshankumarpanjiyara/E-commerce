@include('auth.layouts.header')

    @include('sweetalert::alert')
    @yield('content')

@include('auth.layouts.footer')
