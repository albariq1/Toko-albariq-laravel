<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Tabel Barang</title>

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
    <h1>Report Data Barang</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Pemasok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($databarang as $data)
                @php
                    $getLast = App\Models\Barang::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->barcode }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->nama_katagori }}</td>
                    <td>{{ $data->nama_pemasok }}</td>
                    <td>{{ $data->satuan }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
