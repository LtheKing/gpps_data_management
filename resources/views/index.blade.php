<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Login Succeed</h1>

    <table class="table">
        <thead class="table-borderless">
            <th>Kode Kain</th>
            <th>Nama Kain</th>
            <th>Jenis Kain</th>
            <th>Harga</th>
            <th>Action</th>
        </thead>

        @foreach ($kains as $kain)
            <tbody>
                    <td>{{ $kain->KodeKain }}</td>
                    <td>{{ $kain->NamaKain }}</td>
                    <td>{{ $kain->JenisKain }}</td>
                    <td>{{ $kain->Harga }}</td>
                    <td>
                        <form action="#" method="POST">
                        
                        <a class="btn btn-primary btn-sm btn-block mb-3" href="#">Edit</a> 
                        
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                      
                    </td>
            </tbody>
        @endforeach
    </table>
</body>
</html>