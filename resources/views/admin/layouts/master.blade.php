@include('admin.layouts.header')

@include('admin.layouts.sidebar')

    @include('sweetalert::alert')
    @yield('content')

@include('admin.layouts.footer')
