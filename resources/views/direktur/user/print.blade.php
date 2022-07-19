<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Tabel Pemasok</title>

    <style>
        h1 {
            text-align: center
        }

        .text-center {
            text-align: center
        }
    </style>
</head>

<body>
    <h1>Report Data User/Pengguna</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>No Hp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datauser as $data)
                @php
                    $getLast = App\Models\User::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->role }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->No_hp }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
