@extends('../layout/base')

@section('body')
    <body class="contenido"  background="{{ asset('dist/images/fondo1.png') }}">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="{{ 'dist/js/app.js' }}"></script>
        <!-- END: JS Assets-->

        @yield('script')
        
    </body>
@endsection
