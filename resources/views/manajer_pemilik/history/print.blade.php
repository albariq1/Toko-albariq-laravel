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
    <h1>Report Data Pemasok</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Login Terakhir</th>
                <th>IP Login Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datahistory as $data)
                @php
                    $getLast = App\Models\RiwayatLogin::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->last_login_at }}</td>
                    <td>{{ $data->last_login_ip }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
