<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center
        }

    </style>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($dataproduk as $produk)
                @php
                    $getLast = App\Models\PembelianBarang::where('barang_id', $produk->barang_id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <td class="text-center" style="border: 1px solid #333;">
                    <p>{{ $produk->nama_barang }} - Rp. {{ number_format($getLast->harga_jual, 0, ',', '.') }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk->barcode, 'C39') }}"
                        alt="{{ $produk->barcode }}" width="180" height="60">
                    <br>
                    {{ $produk->barcode }}
                </td>
                @if ($no++ % 3 == 0)
        <tr></tr>
        @endif
        @endforeach
        </tr>
    </table>


</body>

</html>
