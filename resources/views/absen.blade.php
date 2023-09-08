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
                            <option value="tahun">Year to year</option>
                            <option value="bulan">Month to month</option>
                        </select>
                    </div>

                    <div id="div_input_tahun" class="col">
                        <input id="inputYearFrom" name="inputYearFrom" type="number" min="2000" max="2099" step="1" value="2016"
                            class="form-control mb-3" placeholder="from"/>
                        <input id="inputYearTo" name="inputYearTo" type="number" min="2000" max="2099" step="1" value="2016"
                            class="form-control" placeholder="to"/>
                    </div>

                    <div id="div_input_bulanan" class="col" hidden=true>
                        <input class="form-control date-year" placeholder="Pilih Tahun" value="2016" name="inputYearMonth"
                            id="inputYearMonth">
                    </div>

                    <div class="col">
                        <input type="submit" class="btn btn-info" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="div_cart">
        {!! $chart->container() !!}
    </div>

    <script src="{{ asset('js/render.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <script>
        //functions
        function onAbsenFilterChange(e) {
            if (e.value == 'tahun') {
                document.getElementById('div_input_tahun').hidden = false;
                document.getElementById('div_input_bulanan').hidden = true;
            } else {
                document.getElementById('div_input_tahun').hidden = true;
                document.getElementById('div_input_bulanan').hidden = false;
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

            console.log(data);

            // const response = await fetch(localhost + 'api/jemaat/filter/' + field + '/' + value);
            // const result = await response.text();

            var myHeaders = new Headers();
            myHeaders.append("X-CSRF-TOKEN", "lbQp9w3YGn8oF7xprxCKrRjTgJ3AAZjF4XaJ5qum");
            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: data,
                redirect: 'follow'
            };

            fetch("http://127.0.0.1:8000/api/jemaat/absensi/filter", requestOptions)
                .then(response => response.text())
                .then(result => console.log(result))
                .catch(error => console.log('error', error));
        }
    </script>
@endsection
