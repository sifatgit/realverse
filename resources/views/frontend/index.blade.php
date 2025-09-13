@extends('frontend.layouts.app')

@section('content')
    @hasSection('homeContent')
        @yield('homeContent') {{-- This will replace the include if overridden --}}
    @else
        @include('frontend.partials.home-content')
    @endif
@endsection