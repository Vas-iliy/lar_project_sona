@extends(env('THEME') . '.layouts.site')

@section('navigations')
    {!! $navigations !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection
