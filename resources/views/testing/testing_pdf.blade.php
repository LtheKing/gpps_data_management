<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    {{-- <link rel="stylesheet" href="{{ asset('css/testing_pdf.css') }}" /> --}}
    <script src="{{ asset('js/render.js') }}"></script>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
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
                        <img src="{{ asset('img/Darling.png') }}" class="foto-jemaat"> 
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <p style="color: white; font-family: Lucida Sans Typewriter; font-size: 20px;" id="no_anggota">2021.1521.021</p> <br>
                        </div>
                        <div class="row justify-content-end">
                            <p style="color: white; font-family: Calibri; font-size: 25px;" id="nama_jemaat">Leonaldi Nata Gunawan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button id="btnDownload" type="button" class="btn btn-secondary">download</button>
</body>
</html>

<script>
    document.getElementById("btnDownload").addEventListener("click", function() {
		html2canvas(document.getElementById("card-behind"),
			{
				allowTaint: true,
				useCORS: true
			}).then(function (canvas) {
				var anchorTag = document.createElement("a");
				document.body.appendChild(anchorTag);
				// document.getElementById("previewImg").appendChild(canvas);
				anchorTag.download = "kartu_belakang.jpg";
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
				anchorTag.download = "kartu_depan.jpg";
				anchorTag.href = canvas.toDataURL();
				anchorTag.target = '_blank';
				anchorTag.click();
			});
        });

</script>

<style>
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