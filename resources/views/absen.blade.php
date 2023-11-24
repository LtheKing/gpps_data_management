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

                    <div class="col">
                        <form action="{{ route('jemaat_absensi_export') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" hidden="true" name="input_filter" id="input_filter">
                            <input type="text" hidden="true" name="input_year_from" id="input_year_from">
                            <input type="text" hidden="true" name="input_year_to" id="input_year_to">
                            <input type="text" hidden="true" name="input_year_month" id="input_year_month">
                            <div id="div_input_jk" hidden=true>
                                <select name="filter_jk" id="selectFilter_jk" class="form-control mb-3">
                                    <option value="">== Hanya Untuk Print Filter</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>

                            <div id="div_input_baptis" hidden=true>
                                <select name="filter_baptis" id="selectFilter_baptis" class="form-control mb-3">
                                    <option value="">== Hanya Untuk Print Filter</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </div>

                            <div id="div_input_pernikahan" hidden=true>
                                <select name="filter_pernikahan" id="selectFilter_pernikahan" class="form-control mb-3">
                                    <option value="">== Hanya Untuk Print Filter</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                </select>
                            </div>

                            <div id="div_input_kematian" hidden=true>
                                <select name="filter_kematian" id="selectFilter_kematian" class="form-control mb-3">
                                    <option value="">== Hanya Untuk Print Filter</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>

                            <div id="div_input_segment" hidden=true>
                                <select name="filter_segment" id="selectFilter_segment" class="form-control mb-3">
                                    <option value="">== Hanya Untuk Print Filter</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Remaja">Remaja</option>
                                    <option value="Dewasa">Dewasa</option>
                                    <option value="Lansia">Lansia</option>
                                </select>
                            </div>

                            <div id="div_input_tahun" class="col" hidden=true>
                                <input id="inputYearFrom" name="inputYearFrom" type="number" min="2000" max="2099"
                                    step="1" value="2016" class="form-control mb-3" placeholder="from" />
                                <input id="inputYearTo" name="inputYearTo" type="number" min="2000" max="2099"
                                    step="1" value="2016" class="form-control" placeholder="to" />
                            </div>

                            <div id="div_input_bulanan" class="col" hidden=true>
                                <input class="form-control date-year" placeholder="Pilih Tahun" value="2023"
                                    name="inputYearMonth" id="inputYearMonth">
                            </div>
                            <button class="btn btn-warning" type="submit" hidden=true id="btnPrint">
                                Print Absen</button>
                        </form>
                    </div>
                </div>

                <button id="">button hidden submit</button>
            </form>
            <input type="submit" class="btn btn-info" id="btnSubmit" value="Submit" disabled
                onclick="onSubmitClick()">
            <button class="btn btn-warning" type="button" onclick="triggerBtnPrint()">Print Absen</button>
        </div>
        <div id="div_cart">
            {!! $chart->container() !!}
        </div>
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
            var div_inputJk = document.getElementById('div_input_jk');
            var div_inputBaptis = document.getElementById('div_input_baptis');
            var div_inputPernikahan = document.getElementById('div_input_pernikahan');
            var div_inputKematian = document.getElementById('div_input_kematian');
            var div_inputSegment = document.getElementById('div_input_segment');

            switch (e.value) {
                case 'tahun':
                    div_inputBulan.hidden = true;
                    div_inputTahun.hidden = false;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'bulan':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = false;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'baptis':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = false;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'jk':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = false;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'pernikahan':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = false;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'kematian':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = false;
                    div_inputSegment.hidden = true;
                    break;

                case 'segment':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = false;
                    break;

                case 'ibadah1':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'ibadah2':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                case 'ibadah3':
                    div_inputTahun.hidden = true;
                    div_inputBulan.hidden = true;
                    div_inputJk.hidden = true;
                    div_inputBaptis.hidden = true;
                    div_inputPernikahan.hidden = true;
                    div_inputKematian.hidden = true;
                    div_inputSegment.hidden = true;
                    break;

                default:
                    break;
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
