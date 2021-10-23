@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')
    <h1>Detail Jemaat</h1>
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
    <a class="btn btn-secondary mb-3 mt-3" href="{{ route('jemaat_index') }}"> Kembali </a>
    <button id="btnDownload" type="button" class="btn btn-warning">Download Kartu Jemaat</button>

    <form action="#" method="post" enctype="multipart/form-data">
            <div class="mb-3" id="div_noAnggota">
              <label for="inputNoAnggota" class="form-label">Nomor Anggota</label>
              <input type="text" class="form-control" id="inputNoAnggota" name="NoAnggota" value="{{ $jemaat->NoAnggota }}" readonly=true>
            </div>

            <div class="mb-3" id="div_Nama">
                <label for="inputNama" class="form-label">Nama Jemaat</label>
                <input type="text" class="form-control" id="inputNama" name="Nama" value="{{ $jemaat->Nama }}" readonly=true>
            </div>

            <div class="mb-3" id="div_JenisKelamin">
                <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control" id="inputJenisKelamin" name="JenisKelamin" value="{{ $jemaat->JenisKelamin }}" readonly=true>
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
                <label for="inputNamaAyah" class="form-label">Nama Ayah</label> <br>
                {{-- <input type="text" class="form-control" id="inputNamaAyah" name="NamaAyah" value="{{ $jemaat->NamaAyah }}" readonly=true> --}}
                <a href="{{ route('jemaat_get_ayah', $jemaat->NamaAyah) }}">{{ $jemaat->NamaAyah }}</a>
            </div>

            <div class="mb-3" id="div_NamaIbu">
                <label for="inputNamaIbu" class="form-label">Nama Ibu</label> <br>
                {{-- <input type="text" class="form-control" id="inputNamaIbu" name="NamaIbu" value="{{ $jemaat->NamaIbu }}" readonly=true> --}}
                <a href="{{ route('jemaat_get_ibu', $jemaat->NamaIbu) }}">{{ $jemaat->NamaIbu }}</a>
            </div>

            <div class="mb-3" id="div_StatusBaptis">
                <label for="inputStatusBaptis" class="form-label">Sudah Baptis</label>
                <input type="text" class="form-control" id="inputStatusBaptis" name="StatusBaptis" value="{{ $jemaat->StatusBaptis }}" readonly=true>
            </div>

            <div class="mb-3" id="div_TanggalBaptis">
                <label for="inputTanggalBaptis" class="form-label">Tanggal Baptis</label>
                <input type="date" class="form-control" id="inputTanggalBaptis" name="TanggalBaptis" value="{{ $jemaat->TanggalBaptis }}" readonly=true>
            </div>

            <div class="mb-3" id="div_PelaksanaBaptis">
                <label for="inputPelaksanaBaptis" class="form-label">Pelaksana Baptis</label>
                <input type="text" class="form-control" id="inputPelaksanaBaptis" name="PelaksanaBaptis" value="{{ $jemaat->PelaksanaBaptis }}" readonly=true>
            </div>

            <div class="mb-3" id="div_Segment">
                <label for="inputSegment" class="form-label">Segment</label>
                <input type="text" class="form-control" id="inputSegment" name="Segment" value="{{ $jemaat->Segment }}" readonly=true>
            </div>

            <div class="mb-3" id="div_StatusKematian">
                <label for="inputStatusKematian" class="form-label">Status Kematian</label>
                <input type="text" class="form-control" id="inputStatusKematian" name="StatusKematian" value="{{ $jemaat->StatusKematian }}" readonly=true>
            </div>

            <div class="mb-3" id="div_TanggalKematian">
                <label for="inputTanggalKematian" class="form-label">Tanggal Kematian</label>
                <input type="text" class="form-control" id="inputTanggalKematian" name="TanggalKematian" value="{{ $jemaat->TanggalKematian }}" readonly=true>
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

    <hr>
    <p class="h2 mt-3 mb-3">Kartu Jemaat</p>

    <div class="front" id="card-front">
        <div class="front_content">
            <div class="front_content_foto_jemaat">
                <img src="{{ url('storage/images/', $jemaat->ImageName) }}" id="foto_jemaat"> 
                <p id="nama_jemaat">{{ $jemaat->Nama }}</p> 
                <p id="no_anggota">{{ $jemaat->NoAnggota }}</p> 
            </div>
            <hr>
            <div class="front_content_qrcode">
                {{-- <img src="../../img/contoh_qrcode.png" id="img_qrcode">   --}}
                <div id="img_qrcode">
                    {{$qrcode}}
                </div>
            </div>
        </div>
    </div>

    <div class="back" id="card-behind"></div>

    <style>
    html,
    body {
        margin: 0;
        padding: 0;
    }
    .front {
        /* border-style: solid;
        border-color: red; */
        border-radius: 10px; 
        width: 35rem;
        height: 22rem;
        background-image: url("../../img/FINAL-depan.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .back {
        /* border-style: solid;
        border-color: red;
        border-radius: 10px; */
        width: 35rem;
        height: 22rem;
        background-image: url("../../img/FINAL-belakang.jpg");
        background-size: contain;
        background-repeat: no-repeat;
    }

    .front_content {
        /* border-style: solid;
        border-color: blue; */
        border-radius: 10px;
        width: 20rem;
        height: 22rem;
        float: right;
    }

    .front_content_foto_jemaat {
        /* border-style: solid;
        border-color: yellow; */
        width: auto;
        height: 150px;
        display: grid;
        grid-template-areas:
            'foto_area nama_area'
            'foto_area noanggota_area';
        grid-gap: 10px;
        padding: 10px;
        grid-template-columns: auto 50%;
        grid-template-rows: 75% 25%;
    }

    .front_content_qrcode {
        /* border-style: solid;
        border-color: purple; */
        width: auto;
        height: 200px;
        text-align: center;
    }

    #foto_jemaat {
        width: 140px;
        height: auto;
        grid-area: foto_area;
        margin-top: 30px;
        /* border-style: solid;
        border-color: orange; */
    }

    #nama_jemaat {
        grid-area : nama_area;
        width: auto;
        height: auto;
        font-family: Calibri; 
        font-size: 20px;
        margin-top: 58px;
        padding: 0px;
        /* border-style: solid;
        border-color: black; */
    }

    #no_anggota {
        grid-area : noanggota_area;
        width: auto;
        height: auto;
        font-family: Lucida Sans Typewriter; 
        font-size: 15px;
        border-top: 1px inset black;
        /* border-style: solid;
        border-color: greenyellow; */
    }
    
    #img_qrcode {
        width: 180px;
        height: auto;
        /* margin-top: 60px;
        margin-left: 60px; */
        margin: auto;
    }

    #gambar {
            width: 5cm;
            height: 5cm;
            outline: none;
    }
    </style>

<script>
    var nama = document.getElementById('inputNama').value;
    document.getElementById("btnDownload").addEventListener("click", function() {
		html2canvas(document.getElementById("card-behind"),
			{
				allowTaint: true,
				useCORS: true,
                scrollX: -window.scrollX,
                scrollY: -window.scrollY,
                windowWidth: document.documentElement.offsetWidth,
                windowHeight: document.documentElement.offsetHeight
			}).then(function (canvas) {
				var anchorTag = document.createElement("a");
				document.body.appendChild(anchorTag);
				// document.getElementById("previewImg").appendChild(canvas);
				anchorTag.download = nama + "_back" + ".jpg";
				anchorTag.href = canvas.toDataURL();
				anchorTag.target = '_blank';
				anchorTag.click();
			});

        html2canvas(document.getElementById("card-front"),
			{
				allowTaint: true,
				useCORS: true,
                scrollX: -window.scrollX,
                scrollY: -window.scrollY,
                windowWidth: document.documentElement.offsetWidth,
                windowHeight: document.documentElement.offsetHeight
			}).then(function (canvas) {
				var anchorTag = document.createElement("a");
				document.body.appendChild(anchorTag);
				// document.getElementById("previewImg").appendChild(canvas);
                anchorTag.download = nama + "_front" + ".jpg";
				anchorTag.href = canvas.toDataURL();
				anchorTag.target = '_blank';
				anchorTag.click();
			});
        });

</script>

@endsection