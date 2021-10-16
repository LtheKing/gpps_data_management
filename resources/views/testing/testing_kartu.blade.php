<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="front">
        <div class="front_content">
            <div class="row">
                <div class="col" id="content_jemaat">
                    {{-- <img src="../../img/Darling.png" alt="" id="foto_jemaat"> 
                    <p>Ini Nama</p> 
                    <p>2022.3948.009.90</p>  --}}
                </div>
                <div class="col" id="content_qrcode">
                    {{-- <img src="../../img/contoh_qrcode.png" alt="" id="img_qrcode"> --}}
                </div>
            </div>
            
        </div>
    </div>

    <div class="back">

    </div>
</body>

<style>
    .front {
        /* border-style: solid;
        border-color: red;
        border-radius: 10px; */
        width: 35rem;
        height: 22rem;
        background-image: url("../../img/FINAL-depan.jpg");
        background-size: cover;
    }

    .front_content {
        /* border-style: solid;
        border-color: blue;
        border-radius: 10px; */
        width: 19.7rem;
        height: 22rem;
        float: right;
    }

    .content_jemaat {
        float: none;
        margin: auto;
    }

    #foto_jemaat {
        width: 150px;
        height: auto;
    }
    
    #img_qrcode {
        width: 150px;
        height: auto;
        float: right;
    }
</style>

</html>