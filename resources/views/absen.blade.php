@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')

{{-- <body class="h-screen bg-gray-100">

<div class="container px-4 mx-auto">

    <div class="p-6 mt-3 bg-white rounded shadow">
        {!! $chart->container() !!}
    </div>

</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
</body> --}}
<div>
    {!! $chart->container() !!}
</div>
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

@endsection