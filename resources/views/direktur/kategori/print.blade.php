<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Tabel Kategori</title>

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
    <h1>Report Data Kategori</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datakategori as $data)
                @php
                    $getLast = App\Models\Kategori::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->nama_katagori }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
