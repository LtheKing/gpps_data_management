@extends('layout')

@section('section_menu')
    @parent
@endsection

@section('content')
    <div class="container">
        <h1>{{ $message }}</h1>
        <br />

        <a href="{{route('jemaat_tamu')}}" class="btn btn-succees">Kembali</a>
    </div>
@endsection
