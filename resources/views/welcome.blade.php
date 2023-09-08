<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <style>
        .login,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('img/logo.jpg');
            background-size: cover;
            background-position: center center;
        }
    </style>

    <script>
        function onCabangChange(e) {
            if (e.value !== '') {
                document.getElementById('inputUsername').disabled = false;
                document.getElementById('inputPassword').disabled = false;
            } else {
                document.getElementById('inputUsername').disabled = true;
                document.getElementById('inputPassword').disabled = true;
            }
        }

    </script>

    <title>Login</title>
</head>

<body>
    @if (session('Failed'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('Failed') }}
        </div>
    @endif

    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex bg-image"></div>


            <!-- The content half -->
            <div class="col-md-6 bg-light" style="background-image: linear-gradient(to right, yellow, #00adef);">
                <div class="login d-flex align-items-center py-5">

                    <!-- Demo content-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-4">Login</h3>
                                <p class="text-muted mb-4">GPPS Agape Bandung</p>
                                <form action="{{ route('user_login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3" id="div_Cabang">
                                        <select name="cabang_id" id="input_cabang"
                                            class="form-control rounded-pill border-0 shadow-sm px-4" onchange="onCabangChange(this)">
                                            <option value="">== CABANG ==</option>
                                            @foreach ($cabangs as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->NamaCabang }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="div_username" disabled="true">
                                        <input id="inputUsername" type="text" placeholder="Username" required=""
                                            autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4"
                                            name="username" disabled=true>
                                    </div>

                                    <div class="form-group mb-3" id="div_password">
                                        <input id="inputPassword" type="password" placeholder="Password" required=""
                                            class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"
                                            name="password" disabled=true>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-danger btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign
                                        in</button>
                                </form>
                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->

        </div>
    </div>


</body>

</html>
