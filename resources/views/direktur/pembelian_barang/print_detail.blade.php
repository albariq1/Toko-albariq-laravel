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
    <h1>Report Data Tebel Detail Pembelian</h1>
    <table width="100%" border="2">
        <thead>
            <tr>
                <th>No</th>
                {{-- <th>Aksi</th> --}}
                <th>Barcode</th>
                <th>Nama barang</th>
                <th>Pemasok</th>
                <th>Satuan</th>
                <th>Tgl. Pembelian</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dt)
                @php
                    $getLast = App\Models\Pembelian::where('id', $dt->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                @endphp
                <tr>
                    <td>{{ $dt->barcode }}</td>
                    <td>{{ $dt->nama_barang }}</td>
                    <td>{{ $dt->nama_pemasok }}</td>
                    <td>{{ $dt->satuan }}</td>
                    <td>{{ $dt->tanggal_pembelian }}</td>
                    <td>Rp.{{ number_format($dt->harga_beli) }}</td>
                    <td>Rp.{{ number_format($dt->harga_jual) }}</td>
                    <td>{{ $dt->jumlah_beli }}</td>
                </tr>
            @endforeach
            {{-- <tr>
                <th colspan="8">Jumlah Pembelian</th>
                <th>{{ $getJumlah->stok }}</th>
            </tr>
            <tr>
                <th colspan="8">Jumlah Terjual</th>
                <th>{{ $getJumlahTerjual->jumlah_terjual ?? 0 }}</th>
            </tr>
            <tr>
                <th colspan="8">Jumlah Return</th>
                <th>{{ $getJumlahReturn->jumlah_return ?? 0 }}</th>
            </tr>
            <tr>
                <th colspan="8">Jumlah Hilang</th>
                <th>{{ $getJumlahHilang->jumlah_hilang ?? 0 }}</th>
            </tr>
            <tr>
                <th colspan="8">Sisa Stok</th>
                <th>{{ $sisaStok }}</th>
            </tr>
            <tr>
                <th colspan="8">Harga Beli Akhir</th>
                <th>Rp.{{ number_format($getLast->harga_beli) }}</th>
            </tr>
            <tr>
                <th colspan="8">Harga Jual Akhir</th>
                <th>Rp.{{ number_format($getLast->harga_jual) }}</th>
            </tr> --}}
        </tbody>

    </table>


</body>

</html>
