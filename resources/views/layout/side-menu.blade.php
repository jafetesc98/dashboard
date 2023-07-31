@extends('../layout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection
