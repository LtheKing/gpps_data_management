@extends('layout')

@section('section_menu')
    @parent
@endsection

@section('content')
    <h1>Edit Tamu</h1>

    {{-- @if (session('message_type') == 'error')
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('message') }}
        </div>
    @endif

    @if (session('message_type') == 'success')
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('message') }}
        </div>
    @endif --}}

    @if (session('pesan'))
        <div class="alert alert-success }}">
            <p> {{ session('pesan') }} </p>
        </div>
    @endif

    <a class="btn btn-secondary mb-3 mt-3" href="{{ route('jemaat_tamu') }}"> Kembali </a>

    <form action="{{ route('jemaat_tamu_update', $tamu->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3" id="div_NamaTamu">
            <label for="inputNamaTamu" class="form-label">Nama Tamu</label>
            <input type="text" class="form-control" id="inputNamaTamu" name="NamaTamu"
                value="{{ old('NamaTamu', $tamu->NamaTamu) }}">
        </div>

        <div class="mb-3" id="div_Alias">
            <label for="inputAlias" class="form-label">Alias</label>
            <input type="text" class="form-control" id="inputAlias" name="Alias"
                value="{{ old('Alias', $tamu->Alias) }}" disabled>
        </div>

        <div class="mb-3" id="div_NoTelp">
            <label for="inputNoTelp" class="form-label">Nomor Telepon</label>
            <input type="number" class="form-control" id="inputNoTelp" name="NoTelp"
                value="{{ old('NoTelp', $tamu->NoTelp) }}"></input>
        </div>

        <div class="mb-3" id="div_Email">
            <label for="inputEmail" class="form-label">Email</label>
            <input type="text" class="form-control" id="inputEmail" name="Email"
                value="{{ old('Email', $tamu->Email) }}"></input>
        </div>

        <div class="mb-3" id="div_Alamat">
            <label for="inputAlamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="inputAlamat" name="Alamat"> {{ old('Alamat', $tamu->Alamat) }} </textarea>
        </div>

        <div class="mb-3" id="div_cabang">
            <label for="input_cabang" class="form-label">Cabang</label>
            <select name="cabang_id" id="input_cabang" class="form-control" value="{{ old('cabang') }}">
                @foreach ($cabangsObj as $item)
                    <option value="{{ $item->id }}" {{ $tamu->cabang_id == $item->id ? 'selected' : '' }}>
                        {{ $item->NamaCabang }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="div_ibadahke">
            <label for="input_ibadahKe" class="form-label">Ibadah Ke</label>
            <select name="IbadahKe" id="input_ibadahKe" class="form-control" value="{{ old('IbadahKe') }}">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2 mb-3">Submit</button>
    </form>
@endsection
