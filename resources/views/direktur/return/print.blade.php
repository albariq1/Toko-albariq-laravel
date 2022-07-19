<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Tabel Return</title>

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
    <h1>Report Data Return</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Nama Pemasok</th>
                <th>Jumlah return</th>
                <th>Status</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datareturn as $data)
                @php
                    if ($data->status == '0') {
                        $sts = 'Masih Return';
                    } else {
                        $sts = 'Telah Balik Lagi';
                    }
                    $getLast = App\Models\ReturnBarang::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->barcode }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->nama_pemasok }}</td>
                    <td>{{ $data->jumlah_return }}</td>
                    <td>
                        @if ($data->status == '0')
                            {{ $sts }}
                        @else
                            {{ $sts }}
                        @endif
                    </td>
                    <td>{{ $data->alasan }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
