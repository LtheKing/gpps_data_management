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
            <div class="front_content_foto_jemaat">
                <img src="../../img/Darling.png" alt="" id="foto_jemaat"> 
                <p id="nama_jemaat">Leonaldi Nata Gunawan</p> 
                <p id="no_anggota">2022.3948.009.90</p> 
            </div>

            <div class="front_content_qrcode">
                <img src="../../img/contoh_qrcode.png" alt="" id="img_qrcode">  
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

    .back {
        /* border-style: solid;
        border-color: red;
        border-radius: 10px; */
        width: 35rem;
        height: 22rem;
        background-image: url("../../img/FINAL-belakang.jpg");
        background-size: cover;
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

</html>