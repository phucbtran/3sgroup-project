@extends('public.template')

@section('styles')
    <link type="text/css" href="{{asset('assets/public/css/')}}" rel="stylesheet" />
@endsection

@section('content')
        {{--footer--}}
            @include('public.layout.footer')
        {{--endfooter--}}
@endsection

@section('scripts')
    <script type="text/javascript" defer src="{{asset('assets/public/js/')}}"></script>
@endsection