<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="{{ asset('css/testing_pdf.css') }}" />
    <title>Document</title>
</head>
<body>
    <div class="card-behind" id="card-behind">
        <div class="item1">GPPS AGAPE BANDUNG</div>
        <div class="item2">
            <p style="margin-bottom: 10px;">gpps_01</p>
            <p>Leonaldi Nata Gunawan</p>
        </div>
        <div class="item3">
            {{-- {!! QrCode::size(250)->generate('ItSolutionStuff.com'); !!} --}}
            {!! $qrcode !!}
        </div>
    </div>

    <div class="card-front">

    </div>

    <button id="btnDownload" onclick="download();">download</button>
</body>
</html>