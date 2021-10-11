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
    <div class="row">
        <div class="col">
            <div class="card-behind" id="card-behind">
                <div class="card" style="width: 22rem; height: 33rem;" id="card_front">
                    <div class="card-img-top text-center mt-3">
                        {{ $qrcode }}
                    </div>
                    <div class="card-body" style="color: white;">
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
            <div class="card-front">
                <div class="card" style="width: 22rem; height: 33rem;">
                    <h2 class="card-title text-center mt-2" style="color: white;">Kartu Keanggotaan Jemaat</h2>
                    <img src="{{ asset('img/logo.jpg') }}" class="card-img-top" width="1cm" height="150">
                    <div class="card-body" style="color: white;">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
				anchorTag.download = "filename.jpg";
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
</style>