@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')
    <h1>Detail Jemaat</h1>
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

    <div class="front" id="card-front">
        <div class="front_content">
            <div class="front_content_foto_jemaat">
                <img src="{{ url('storage/images/', $jemaat->ImageName) }}" alt="" id="foto_jemaat"> 
                <p id="nama_jemaat">{{ $jemaat->Nama }}</p> 
                <p id="no_anggota">{{ $jemaat->NoAnggota }}</p> 
            </div>

            <div class="front_content_qrcode">
                <img src="../../img/contoh_qrcode.png" alt="" id="img_qrcode">  
            </div>
        </div>
    </div>

    <div class="back" id="card-behind"></div>

    <style>
    .front {
        /* border-style: solid;
        border-color: red;
        border-radius: 10px; */
        width: 35rem;
        height: 22rem;
        background-image: url("../../img/FINAL-depan.jpg");
        background-size: contain;
    }

    .back {
        /* border-style: solid;
        border-color: red;
        border-radius: 10px; */
        width: 35rem;
        height: 22rem;
        background-image: url("../../img/FINAL-belakang.jpg");
        background-size: contain;
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
    }

    /* .front_content_foto_jemaat > div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 20px 0;
        font-size: 30px;
    } */

    .front_content_qrcode {
        /* border-style: solid;
        border-color: purple; */
        width: auto;
        height: 200px;
        text-align: center;
    }

    #foto_jemaat {
        width: 120px;
        height: auto;
        grid-area: foto_area;
        vertical-align: middle;
        /* border-style: solid;
        border-color: orange; */
    }

    #nama_jemaat {
        grid-area : nama_area;
        width: auto;
        height: auto;
        font-family: Calibri; 
        font-size: 20px;
        /* border-style: solid;
        border-color: black; */
    }

    #no_anggota {
        grid-area : noanggota_area;
        width: auto;
        height: auto;
        font-family: Lucida Sans Typewriter; 
        font-size: 18px;
        /* border-style: solid;
        border-color: greenyellow; */
    }
    
    #img_qrcode {
        width: 180px;
        height: auto;
        margin-top: 15px;
    }
    </style>

<script>
    var nama = document.getElementById('inputNama').value;
    document.getElementById("btnDownload").addEventListener("click", function() {
		html2canvas(document.getElementById("card-behind"),
			{
				allowTaint: true,
				useCORS: true
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
				useCORS: true
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