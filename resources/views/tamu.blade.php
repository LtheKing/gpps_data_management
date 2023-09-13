@extends('layout')

@section('section_menu')
    @parent
@endsection

@section('content')
    <h1>Data Tamu</h1>

    {{-- <div id="img_qrcode">
        {{ $qrcode }}
    </div> --}}

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
  Show QR
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">QR Tamu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
        {{ $qrcode }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <table class="display table" id="table_tamu">
        <thead class="table-borderless">
            <th class="text-center">Alias</th>
            <th class="text-center" id="thead_nama">Nama Tamu</th>
            <th class="text-center">Action</th>
        </thead>
        <tfoot>
            <tr>
                <th class="text-center">Alias</th>
                <th class="text-center">Nama Tamu</th>
                <th class="text-center">Action</th>
            </tr>
        </tfoot>
    </table>

    <script>
        var localhost = window.origin + '/';
        $(document).ready(function() {
            var table = $('#table_tamu').DataTable({
                "ajax": 'tamu/array',
                "columns": [{
                        "data": "Alias"
                    },
                    {
                        "data": "NamaTamu"
                    },
                    {
                        "defaultContent": "<button class='btn btn-warning btnEdit' type='button'>Edit</button>" +
                            "&nbsp;&nbsp;" +
                            "<button class='btn btn-secondary btnDetail' type='button'>Detail</button>" +
                            "&nbsp;&nbsp;" +
                            "<button class='btn btn-danger btnDelete' type='button'>Delete</button>"
                    }
                ],
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }]
            });

            $('#table_tamu tbody').on('click', 'button', function() {
                //debugger;
                var action = this.className;
                var data = table.row($(this).parents('tr')).data();

                if (action.includes('btnEdit')) {
                    window.location.href = localhost + 'jemaat/tamu/edit/' + data.id;
                }

                if (action.includes('btnDelete')) {
                    document.getElementById('id01').style.display = 'block'
                    $('#btnYes').on('click', function() {
                        deleteRecord(data.id);
                        alert('Data Jemaat Berhasil Dihapus');
                    })
                }

                if (action.includes('btnDetail')) {
                    window.location.href = localhost + 'jemaat/detail/' + data.id;
                }
            });
        });

        async function deleteRecord(id) {
            token = await getToken();
            const response = await fetch(localhost + "api/jemaat/delete/" + id, {
                method: 'DELETE',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-Token': token
                }
            });

            if (response.status != 200) {
                alert('Gagal Menghapus data');
                console.log(response.text());
                return;
            }

            // Awaiting for the resource to be deleted
            const resData = 'resource deleted...';

            location.reload();
            // Return response data 
            return resData;
        }

        async function getToken() {
            const response = await fetch(localhost + 'api/token');
            const token = await response.text();
            return token;
        }
    </script>
@endsection
