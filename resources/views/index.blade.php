@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')
    <h1>Data Jemaat</h1>

    @if(session('Success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('Success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('jemaat_create') }}" class="btn btn-info mb-3 mt-3">Jemaat Baru</a>
    <table class="table">
        <thead class="table-borderless">
            <th class="text-center">No Anggota</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Tanggal Baptis</th>
            <th class="text-center">Pelaksana Baptis</th>
            <th class="text-center">Action</th>
        </thead>

        @foreach ($jemaats as $jemaat)
            <tbody>
                    <td class="text-center">{{ $jemaat->NoAnggota }}</td>
                    <td class="text-center">{{ $jemaat->Nama }}</td>
                    <td class="text-center">{{ $jemaat->TanggalBaptis }}</td>
                    <td class="text-center">{{ $jemaat->PelaksanaBaptis }}</td>
                    <td class="text-center">
                        <form action="{{ route('jemaat_destroy', $jemaat->id) }}" method="POST">
                        
                        <a class="btn btn-warning btn-sm" href="{{ route('jemaat_edit', $jemaat->id) }}">Edit</a> 
                        <a class="btn btn-secondary btn-sm" href="{{ route('jemaat_detail', $jemaat->id) }}">Detail</a> 
                        
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                      
                    </td>
            </tbody>
        @endforeach
    </table>
@endsection