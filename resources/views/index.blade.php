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

    <a href="{{ route('jemaat_create') }}" class="btn btn-info mb-3 mt-3">Jemaat Baru</a>
    <table class="table">
        <thead class="table-borderless">
            <th>No Anggota</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Status</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Tanggal Baptis</th>
            <th>Pelaksana Baptis</th>
            <th>Action</th>
        </thead>

        @foreach ($jemaats as $jemaat)
            <tbody>
                    <td>{{ $jemaat->NoAnggota }}</td>
                    <td>{{ $jemaat->Nama }}</td>
                    <td>{{ $jemaat->Alamat }}</td>
                    <td>{{ $jemaat->Tlp }}</td>
                    <td>{{ $jemaat->Status }}</td>
                    <td>{{ $jemaat->NamaAyah }}</td>
                    <td>{{ $jemaat->NamaIbu }}</td>
                    <td>{{ $jemaat->TanggalBaptis }}</td>
                    <td>{{ $jemaat->PelaksanaBaptis }}</td>
                    <td>
                        <form action="#" method="POST">
                        
                        <a class="btn btn-warning btn-sm btn-block mb-3" href="{{ route('jemaat_edit', $jemaat->id) }}">Edit</a> 
                        <a class="btn btn-secondary btn-sm btn-block mb-3" href="#">Detail</a> 
                        
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                      
                    </td>
            </tbody>
        @endforeach
    </table>
@endsection