@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')
    <h1>Input Jemaat Baru</h1>
    <a class="btn btn-secondary mb-3 mt-3" href="{{ route('jemaat_index') }}"> Kembali </a>

    <form action="#" method="post" enctype="multipart/form-data">
            <div class="mb-3" id="div_noAnggota">
              <label for="inputNoAnggota" class="form-label">Nomor Anggota</label>
              <input type="text" class="form-control" id="inputNoAnggota" name="NoAnggota" value="{{ $jemaat->NoAnggota }}" readonly=true>
            </div>

            <div class="mb-3" id="div_Nama">
                <label for="inputNama" class="form-label">Nama Jemaat</label>
                <input type="text" class="form-control" id="inputNama" name="Nama" value="{{ $jemaat->Nama }}" readonly=true>
            </div>

            <div class="mb-3" id="div_Alamat">
                <label for="inputAlamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="inputAlamat" name="Alamat" readonly=true> {{ $jemaat->Alamat }} </textarea>
            </div>

            <div class="mb-3" id="div_Tlp">
                <label for="inputTlp" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="inputTlp" name="Tlp" value="{{ $jemaat->Tlp }}" readonly=true></input>
            </div>
                
            <div class="mb-3" id="div_Status">
                <label for="inputStatus" class="form-label">Status</label>
                <select name="Status" id="input_status" class="form-control" value="{{ $jemaat->Status }}" readonly=true>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                </select>
            </div>

            <div class="mb-3" id="div_NamaAyah">
                <label for="inputNamaAyah" class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" id="inputNamaAyah" name="NamaAyah" value="{{ $jemaat->NamaAyah }}" readonly=true>
            </div>

            <div class="mb-3" id="div_NamaIbu">
                <label for="inputNamaIbu" class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" id="inputNamaIbu" name="NamaIbu" value="{{ $jemaat->NamaIbu }}" readonly=true>
            </div>

            <div class="mb-3" id="div_TanggalBaptis">
                <label for="inputTanggalBaptis" class="form-label">Tanggal Baptis</label>
                <input type="date" class="form-control" id="inputTanggalBaptis" name="TanggalBaptis" value="{{ $jemaat->TanggalBaptis }}" readonly=true>
            </div>

            <div class="mb-3" id="div_PelaksanaBaptis">
                <label for="inputPelaksanaBaptis" class="form-label">Pelaksana Baptis</label>
                <input type="text" class="form-control" id="inputPelaksanaBaptis" name="PelaksanaBaptis" value="{{ $jemaat->PelaksanaBaptis }}" readonly=true>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Foto Jemaat</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="input_file" 
                    aria-describedby="inputGroupFileAddon01" name="FileName" onchange=loadFile() value="{{ $jemaat->ImageName }}" disabled=true>
                  <label class="custom-file-label" for="input_file" id="input_file_label">{{ $jemaat->ImageName }}</label>
                </div>
            </div>

            <div class="mb-3">
                <img id="gambar" src="{{ url('storage/images/', $jemaat->ImageName) }}"/>
            </div>
    </form>

    <style>
        #gambar {
            width: 5cm;
            height: 5cm;
            outline: none;
        }
    </style>

@endsection