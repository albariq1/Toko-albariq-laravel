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
                <th>Nama Pemasok</th>
                <th>Alamat</th>
                <th>No Hp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datapemasok as $data)
                @php
                    $getLast = App\Models\Pemasok::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->nama_pemasok }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->no_hp }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
