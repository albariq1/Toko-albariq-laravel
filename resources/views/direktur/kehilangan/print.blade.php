<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Tabel Kehilangan</title>

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
    <h1>Report Data Kehilangan</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Pemasok</th>
                <th>Jumlah Hilang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datakehilangan as $data)
                @php
                    if ($data->status == '0') {
                        $sts = 'Hilang';
                    } else {
                        $sts = 'Ketemu';
                    }
                    $getLast = App\Models\KehilanganBarang::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->barcode }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->nama_pemasok }}</td>
                    <td>{{ $data->jumlah_hilang }}</td>
                    <td>
                        @if ($data->status == '0')
                            {{ $sts }}
                        @else
                            {{ $sts }}
                        @endif
                    </td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
