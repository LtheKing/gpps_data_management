@extends('layout')

@section('section_menu')
    @parent
@endsection

@section('content')
    <div class="container" id="div_filter">
        <div class="form-group mt-3">
            <form action="{{ route('jemaat_absensi_filter') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col">
                        <select name="filter" id="selectFilter" onchange="onAbsenFilterChange(this);"
                            class="form-control mb-3">
                            {{-- <option value="tahun">Year to Year</option>
                            <option value="bulan">Month to Month</option>
                            <option value="sudahBaptis">Sudah baptis</option>
                            <option value="belumBaptis">Belum baptis</option>
                            <option value="pria">Jemaat Pria</option>
                            <option value="wanita">Jemaat Wanita</option>
                            <option value="belumMenikah">Belum Menikah</option>
                            <option value="sudahMenikah">Sudah Menikah</option>
                            <option value="sudahMati">Sudah Meninggal</option>
                            <option value="belumMati">Belum Meninggal</option>
                            <option value="segment">Segment</option> --}}

                            <option value="" selected>=== Pilih Filter ===</option>
                            <option value="tahun">Year to Year</option>
                            <option value="bulan">Month to Month</option>
                            <option value="baptis">Status Baptis</option>
                            <option value="jk">Jenis Kelamin</option>
                            <option value="pernikahan">Status Pernikahan</option>
                            <option value="kematian">Status Kematian</option>
                            <option value="segment">Segment</option>
                            <option value="ibadah1">Ibadah 1</option>
                            <option value="ibadah2">Ibadah 2</option>
                            <option value="ibadah3">Ibadah 3</option>
                        </select>
                    </div>

                    <div id="div_input_jk" hidden=true>
                        <select name="filter" id="selectFilter"  class="form-control mb-3">
                            <option value="">== Hanya Untuk Print Filter</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>

                    <div id="div_input_tahun" class="col" hidden=true>
                        <input id="inputYearFrom" name="inputYearFrom" type="number" min="2000" max="2099"
                            step="1" value="2016" class="form-control mb-3" placeholder="from" />
                        <input id="inputYearTo" name="inputYearTo" type="number" min="2000" max="2099"
                            step="1" value="2016" class="form-control" placeholder="to" />
                    </div>

                    <div id="div_input_bulanan" class="col" hidden=true>
                        <input class="form-control date-year" placeholder="Pilih Tahun" value="2023" name="inputYearMonth"
                            id="inputYearMonth">
                    </div>

                    <div class="col">
                        <input type="submit" class="btn btn-info" id="btnSubmit" value="Submit" disabled onclick="onSubmitClick()">
                        <button class="btn btn-warning" type="button" onclick="triggerBtnPrint()">Print Absen</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="div_cart">
            {!! $chart->container() !!}
        </div>

        <form action="{{ route('jemaat_absensi_export') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" hidden="true" name="input_filter" id="input_filter">
            <input type="text" hidden="true" name="input_year_from" id="input_year_from">
            <input type="text" hidden="true" name="input_year_to" id="input_year_to">
            <input type="text" hidden="true" name="input_year_month" id="input_year_month">
            <button class="btn btn-warning" type="submit" hidden=true id="btnPrint">
                Print Absen</button>
        </form>

    </div>

    <script src="{{ asset('js/render.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <script>
        //functions
        function onAbsenFilterChange(e) {
            if (e.value !== '') {
                document.getElementById('btnSubmit').disabled = false;
            } else {
                document.getElementById('btnSubmit').disabled = true;
            }

            var div_inputTahun = document.getElementById('div_input_tahun');
            var div_inputBulan = document.getElementById('div_input_bulanan');

            if (e.value == 'tahun') {
                div_inputTahun.hidden = false;
                div_inputBulan.hidden = true;
            } else if (e.value == 'bulan') {
                div_inputTahun.hidden = true;
                div_inputBulan.hidden = false;
            } else {
                div_inputTahun.hidden = true;
                div_inputBulan.hidden = true;
            }
        }

        function onSubmitClick() {
            var inputFilter = document.getElementById('selectFilter');
            var inputYearFrom = document.getElementById('inputYearFrom');
            var inputYearTo = document.getElementById('inputYearTo');
            var inputYearMonth = document.getElementById('inputYearMonth');

            if (inputYearFrom.value > 2099 || inputYearTo.value > 2099 || inputYearMonth.value > 2099 ||
                inputYearFrom.value < 2000 || inputYearTo.value < 2000 || inputYearMonth.value < 2000
            ) {
                return alert('input tahun harus lebih dari tahun 1999 dan kurang dari 2099');
            }

            var data = {
                'filter': inputFilter.value,
                'yearFrom': inputYearFrom.value,
                'yearTo': inputYearTo.value,
                'yearMonth': inputYearMonth.value
            };

            // const response = await fetch(localhost + 'api/jemaat/filter/' + field + '/' + value);
            // const result = await response.text();

            // var myHeaders = new Headers();
            // myHeaders.append("X-CSRF-TOKEN", "lbQp9w3YGn8oF7xprxCKrRjTgJ3AAZjF4XaJ5qum");
            // var requestOptions = {
            //     method: 'POST',
            //     headers: myHeaders,
            //     body: data,
            //     redirect: 'follow'
            // };

            // fetch("http://127.0.0.1:8000/api/jemaat/absensi/filter", requestOptions)
            //     .then(response => response.text())
            //     .then(result => console.log(result))
            //     .catch(error => console.log('error', error));
        }

        function triggerBtnPrint() {
            //fill data for print

            var inputFilter = document.getElementById('selectFilter');
            var inputYearFrom = document.getElementById('inputYearFrom');
            var inputYearTo = document.getElementById('inputYearTo');
            var inputYearMonth = document.getElementById('inputYearMonth');

            document.getElementById('input_filter').value = inputFilter.value;
            document.getElementById('input_year_from').value = inputYearFrom.value;
            document.getElementById('input_year_to').value = inputYearTo.value;
            document.getElementById('input_year_month').value = inputYearMonth.value;
            
            document.getElementById('btnPrint').click();
        }
    </script>
@endsection
