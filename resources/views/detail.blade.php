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

    <div class="row" style="margin: auto;">
        <div class="col">
            <div class="card-behind" id="card-behind">
                <div class="card" style="width: 22rem; height: 33rem; border-radius: 5%" id="card_front">
                    <div class="penampung-qrcode">
                        <div class="card-img-top text-center mt-3">
                            {{ $qrcode }}
                        </div>
                    </div>
                    <div class="card-body" style="color: white; font-size: 15px;">
                        <ul>
                            <li>Pemegang kartu ini adalah jemaat Gereja Pantekosta Pusat Surabaya Agape</li>
                            <li>Bila menemukan kartu ini, mohon kesediaannya untuk mengembalikan ke alamat : Jalan Pagarsih 136, Bandung</li>
                            <li>Pemegang kartu ini berhak menerima beragam benefit yang berlaku di GPPS Agape.</li>
                        </ul>
        
                        <p class="card-text text-center">
                            Jl. Pagarsih 136, Bandung <br>
                            Tel. 022-6018528 <br>
                            Email: contact@gpps-agape.com <br>
                            Website: gppsagapebandung.com
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card-front" id="card-front">
                <div class="card" style="width: 22rem; height: 33rem; border-radius: 5%">
                    <h2 class="card-title text-center mt-3" style="color: white;">Kartu Keanggotaan Jemaat</h2>
                    <img src="{{ asset('img/logo.jpg') }}" style="width: 280px; height: auto; margin: auto;">
                    <div class="card-body" style="color: white; position: relative;">
                        <img src="{{ url('storage/images/', $jemaat->ImageName) }}" class="foto-jemaat"> 
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <p style="color: white; font-family: Lucida Sans Typewriter; font-size: 20px;" id="no_anggota">{{ $jemaat->NoAnggota }}</p> <br>
                        </div>
                        <div class="row justify-content-end">
                            <p style="color: white; font-family: Calibri; font-size: 25px;" id="nama_jemaat">{{ $jemaat->Nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #gambar {
            width: 5cm;
            height: 5cm;
            outline: none;
        }

        .card {
            background-image: url("../../img/background_card.jpg");
        }

        .foto-jemaat {
            width: 125px; 
            height: auto;
            position: absolute; 
            top: 15%; 
            left: 60%;
            border: 1px solid #ddd;
            border-radius: 7px;
            padding: 5px;
            background-color: white;
        }

        .penampung-qrcode {
            height: 160px;
            width: 160px;
            background-color: white;
            margin: auto;
            margin-top: 10px;
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