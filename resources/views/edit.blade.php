@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')
    <h1>Input Jemaat Baru</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <a class="btn btn-secondary mb-3 mt-3" href="{{ route('jemaat_index') }}"> Kembali </a>

    <form action="{{ route('jemaat_update', $jemaat->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
            <div class="mb-3" id="div_noAnggota">
              <label for="inputNoAnggota" class="form-label">Nomor Anggota</label>
              <input type="text" class="form-control" id="inputNoAnggota" name="NoAnggota" value="{{ old('NoAnggota', $jemaat->NoAnggota) }}">
            </div>

            <div class="mb-3" id="div_Nama">
                <label for="inputNama" class="form-label">Nama Jemaat</label>
                <input type="text" class="form-control" id="inputNama" name="Nama" value="{{ old('Nama', $jemaat->Nama) }}">
            </div>

            <div class="mb-3" id="div_JenisKelamin">
                <label for="input_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="JenisKelamin" id="input_jenis_kelamin" class="form-control" value="{{ old('JenisKelamin', $jemaat->JenisKelamin) }}">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>

            <div class="mb-3" id="div_Alamat">
                <label for="inputAlamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="inputAlamat" name="Alamat"> {{ old('Alamat', $jemaat->Alamat) }} </textarea>
            </div>

            <div class="mb-3" id="div_Tlp">
                <label for="inputTlp" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control" id="inputTlp" name="Tlp" value="{{ old('Tlp', $jemaat->Tlp) }}"></input>
            </div>
                            
            <div class="mb-3" id="div_NamaAyah">
                <label for="inputNamaAyah" class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" id="inputNamaAyah" name="NamaAyah" value="{{ old('NamaAyah', $jemaat->NamaAyah) }}">
            </div>
            
            <div class="mb-3" id="div_NamaIbu">
                <label for="inputNamaIbu" class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" id="inputNamaIbu" name="NamaIbu" value="{{ old('NamaIbu', $jemaat->NamaIbu) }}">
            </div>
            
            <div class="mb-3" id="div_StatusBaptis">
                <label for="input_status_Baptis" class="form-label">Sudah Baptis</label>
                <select name="StatusBaptis" id="input_status_Baptis" class="form-control" value="{{ old('Status', $jemaat->StatusBaptis) }}">
                    <option value="Sudah">Sudah</option>
                    <option value="Belum">Belum</option>
                </select>
            </div>
            
            <div class="mb-3" id="div_TanggalBaptis">
                <label for="inputTanggalBaptis" class="form-label">Tanggal Baptis</label>
                <input type="date" class="form-control" id="inputTanggalBaptis" name="TanggalBaptis" value="{{ old('TanggalBaptis', $jemaat->TanggalBaptis) }}">
            </div>
            
            <div class="mb-3" id="div_PelaksanaBaptis">
                <label for="inputPelaksanaBaptis" class="form-label">Pelaksana Baptis</label>
                <input type="text" class="form-control" id="inputPelaksanaBaptis" name="PelaksanaBaptis" value="{{ old('PelaksanaBaptis', $jemaat->PelaksanaBaptis) }}">
            </div>
            
            <div class="mb-3" id="div_Segment">
                <label for="input_segment" class="form-label">Segment</label>
                <select name="Segment" id="input_segment" class="form-control" value="{{ old('Status', $jemaat->Segment) }}">
                    <option value="Anak">Anak</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                    <option value="Lansia">Lansia</option>
                </select>
            </div>
            
            <div class="mb-3" id="div_Status">
                <label for="inputStatus" class="form-label">Status</label>
                <select name="Status" id="input_status" class="form-control" value="{{ old('Status', $jemaat->Status) }}">
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                </select>
            </div>

            {{-- DATA PERNIKAHAN BEGIN --}}
            <div id="group-pernikahan" class="form-group border" style="padding: 20px; border-radius:10px;" hidden=true>
                <div class="mb-3" id="div_NamaSuami">
                    <label for="inputNamaSuami" class="form-label">Nama Suami</label>
                    <input type="text" class="form-control" id="inputNamaSuami" name="NamaSuami" value="{{ old('NamaSuami', $jemaat->NamaSuami) }}"></input>
                </div>

                <div class="mb-3" id="div_NamaIstri">
                    <label for="inputNamaIstri" class="form-label">Nama Istri</label>
                    <input type="text" class="form-control" id="inputNamaIstri" name="NamaIstri" value="{{ old('NamaIstri', $jemaat->NamaIstri) }}"></input>
                </div>

                <div class="mb-3" id="div_TanggalPernikahan">
                    <label for="inputTanggalPernikahan" class="form-label">Tanggal Pernikahan</label>
                    <input type="date" class="form-control" id="inputTanggalPernikahan" name="TanggalPernikahan" value="{{ old('TanggalPernikahan', $jemaat->TanggalPernikahan) }}">
                </div>

                <div class="mb-3" id="div_PelaksanaPemberkatan">
                    <label for="inputPelaksanaPemberkatan" class="form-label">Pelaksana Pemberkatan</label>
                    <input type="text" class="form-control" id="inputPelaksanaPemberkatan" name="PelaksanaPemberkatan" value="{{ old('PelaksanaPemberkatan', $jemaat->PelaksanaPemberkatan) }}"></input>
                </div>
            </div>
            {{-- DATA PERNIKAHAN END --}}

            <div class="mb-3" id="div_StatusKematian">
                <label for="input_status_kematian" class="form-label">Status Kematian</label>
                <select name="StatusKematian" id="input_status_kematian" class="form-control" value="{{ old('StatusKematian', $jemaat->StatusKematian) }}" onchange="StatusKematianChange(this);">
                    <?php
                        $val = array('Ya', 'Tidak');
                    ?>
                    
                    @foreach ($val as $item)
                        <option value="{{ $jemaat->StatusKematian }}" {{$jemaat->StatusKematian == $item  ? 'selected' : ''}}>{{ $item}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" id="div_TanggalKematian">
                <label for="inputTanggalKematian" class="form-label">Tanggal Kematian</label>
                <input type="date" class="form-control" id="inputTanggalKematian" name="TanggalKematian" value="{{ old('TanggalKematian', $jemaat->TanggalKematian) }}">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Foto Jemaat</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="input_file" 
                    aria-describedby="inputGroupFileAddon01" name="FileName" onchange=loadFile() value="{{ $jemaat->ImageName }}">
                  <label class="custom-file-label" for="input_file" id="input_file_label">{{ $jemaat->ImageName }}</label>
                </div>
            </div>

            <div class="mb-3">
                <img id="gambar" src="{{ url('storage/images/', $jemaat->ImageName) }}"/>
            </div>

            <button type="submit" class="btn btn-primary mt-2 mb-3">Submit</button>
    </form>

    <style>
        #gambar {
            width: 5cm;
            height: 5cm;
            outline: none;
        }
    </style>

@endsection

<script>
    window.onload = function() {
        var statKematian = document.getElementById('input_status_kematian').value;
        var jk = document.getElementById('input_jenis_kelamin').value;
        var statBaptis = document.getElementById('input_status_Baptis').value;
        var stat = document.getElementById('input_status').value;
        
        if (stat == 'Menikah') {
            document.getElementById('group-pernikahan').hidden = false;
            if (document.getElementById('input_jenis_kelamin').value == 'Pria') {
                document.getElementById('div_NamaIstri').hidden = false;
                document.getElementById('div_NamaSuami').hidden = true;
            } else {
                document.getElementById('div_NamaIstri').hidden = true;
                document.getElementById('div_NamaSuami').hidden = false;
            }
        } else {
            document.getElementById('group-pernikahan').hidden = true;
        }

        if (statBaptis == 'Sudah') {
            document.getElementById('div_TanggalBaptis').hidden=false;
        } else {
            document.getElementById('div_TanggalBaptis').hidden=true;
        }

        if (statKematian == 'Tidak') {
            document.getElementById('div_TanggalKematian').hidden = true;
        } else {
            document.getElementById('div_TanggalKematian').hidden = false;
        }
    }

    function loadFile(){
        var fullPath = document.getElementById('input_file').value;
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                document.getElementById('input_file_label').innerHTML = filename
            }

        const file = document.getElementById('input_file').files
        if (file) {
            document.getElementById('gambar').src = URL.createObjectURL(file[0]);
        }
    };

    function StatusKematianChange(e) {
        if (e.value == 'Tidak') {
            document.getElementById('div_TanggalKematian').hidden = true;
        } else {
            document.getElementById('div_TanggalKematian').hidden = false;
        }
    } 

    function onStatusChange() {
        var stat = document.getElementById('input_status').value;
        
        if (stat == 'Menikah') {
            document.getElementById('group-pernikahan').hidden = false;
            if (document.getElementById('input_jenis_kelamin').value == 'Pria') {
                document.getElementById('div_NamaIstri').hidden = false;
                document.getElementById('div_NamaSuami').hidden = true;
            } else {
                document.getElementById('div_NamaIstri').hidden = true;
                document.getElementById('div_NamaSuami').hidden = false;
            }
        } else {
            document.getElementById('group-pernikahan').hidden = true;
        }
    }

    function onJKChange() {
        var jk = document.getElementById('input_jenis_kelamin').value;

        if (jk == 'Pria') {
            document.getElementById('div_NamaSuami').hidden = true;
            document.getElementById('div_NamaIstri').hidden = false;
        } else {
            document.getElementById('div_NamaSuami').hidden = false;
            document.getElementById('div_NamaIstri').hidden = true;
        }
    }

    function StatusBaptisOnChange() {
        var stat = document.getElementById('input_status_Baptis').value;

        if (stat == 'Sudah') {
            document.getElementById('div_TanggalBaptis').hidden=false;
        } else {
            document.getElementById('div_TanggalBaptis').hidden=true;
        }
    }
</script>