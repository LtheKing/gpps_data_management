@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')

    <h1 class="h1">This is Playground page</h1>
    @if(session('status'))
        <div class="alert alert-success">
            {{-- <h2>this is alert</h2> --}}
            {{ session('status') }}
        </div>
    @endif

@endsection