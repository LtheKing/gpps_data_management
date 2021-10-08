@extends('layout')

@section('section_menu')
    @parent

@endsection

@section('content')
    <h1>Data Jemaat</h1>

    @if(session('Success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('Success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('jemaat_create') }}" class="btn btn-info mb-3 mt-3">Jemaat Baru</a>

        <table class="display" id="table_jemaat">
            <thead class="table-borderless">
                <th class="text-center">No Anggota</th>
                <th class="text-center" id="thead_nama">Nama</th>
                <th class="text-center">Action</th>
            </thead>
            <tfoot>
                <tr>
                    <th class="text-center">NoAnggota</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Action</th>
                </tr>
            </tfoot>
        </table>
    </table>

    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
        <form class="modal-content" action="/action_page.php">
          <div class="container">
            <h1>Delete Account</h1>
            <p>Are you sure you want to delete your account?</p>
          
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn btnModal" id="btnCancel">Cancel</button>
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="deletebtn btnModal" id="btnYes">Delete</button>
            </div>
          </div>
        </form>
    </div>

    <script>
        var modal = document.getElementById('id01');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        var localhost = 'http://127.0.0.1:8000/';
        $(document).ready(function() {
            var table = $('#table_jemaat').DataTable({
                "ajax": 'array',
                "columns": [
                    { "data": "NoAnggota"},
                    { "data": "Nama" },
                    { "defaultContent": 
                        "<button class='btn btn-warning btnEdit' type='button'>Edit</button>" +
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

            $('#table_jemaat tbody').on( 'click', 'button', function () {
                //debugger;
                var action = this.className;
                var data = table.row( $(this).parents('tr') ).data();

                if (action.includes('btnEdit'))
                {
                    window.location.href = localhost + 'jemaat/edit/' + data.id;
                }

                if(action.includes('btnDelete'))
                {
                    document.getElementById('id01').style.display='block'
                    $('#btnYes').on('click', function() {
                        deleteRecord(data.id);
                        alert('Data Jemaat Berhasil Dihapus');
                    })
                }
            });
        });

        async function deleteRecord(id)
        {   
            token = await getToken();
            const response = await fetch(localhost + "api/jemaat/delete/" + id, {
                method: 'DELETE',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-Token': token
                }
            });

            if (response.status != 200)
            {
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

    <style>
        td {
            text-align: center;
        }

        /* Set a style for all buttons */
        .btnModal {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        }

        .btnModal:hover {
        opacity:1;
        }

        /* Float cancel and delete buttons and add an equal width */
        .cancelbtn, .deletebtn {
        float: left;
        width: 50%;
        }

        /* Add a color to the cancel button */
        .cancelbtn {
        background-color: #ccc;
        color: black;
        }

        /* Add a color to the delete button */
        .deletebtn {
        background-color: #f44336;
        }

        /* Add padding and center-align text to the container */
        .container {
        padding: 16px;
        text-align: center;
        }

        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: #474e5d;
        padding-top: 50px;
        }

        /* Modal Content/Box */
        .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Style the horizontal ruler */
        hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
        }
        
        /* The Modal Close Button (x) */
        .close {
        position: absolute;
        right: 35px;
        top: 15px;
        font-size: 40px;
        font-weight: bold;
        color: #f1f1f1;
        }

        .close:hover,
        .close:focus {
        color: #f44336;
        cursor: pointer;
        }

        /* Clear floats */
        .clearfix::after {
        content: "";
        clear: both;
        display: table;
        }

        /* Change styles for cancel button and delete button on extra small screens */
        @media screen and (max-width: 300px) {
        .cancelbtn, .deletebtn {
            width: 100%;
        }
        }
    </style>
@endsection