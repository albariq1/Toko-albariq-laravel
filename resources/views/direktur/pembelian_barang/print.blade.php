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
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Nama Pemasok</th>
                <th>Stock/jumlah</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataproduk as $data)
                @php
                    $getLast = App\Models\PembelianBarang::where('id', $data->id)
                        ->orderBy('id', 'DESC')
                        ->first(); //untuk mengambil data barang yang terakhir
                    
                    // ambil jumlah_beli dari tabel pembelian_barangs berdasarkan id barang yang diforeach
                    $getJumlah = DB::table('pembelian_barangs')
                        ->select(DB::raw('SUM(jumlah_beli) as stok'))
                        ->where('barang_id', $data->barang_id)
                        ->first();
                    
                    // ambil jumlah dari tabel penjualan_barangs berdasarkan id barang yang diforeach
                    $getJumlahTerjual = DB::table('detail_penjualans')
                        ->select(DB::raw('SUM(jumlah) as jumlah_terjual'))
                        ->where('barang_id', $data->barang_id)
                        ->first();
                    $getJumlahReturn = DB::table('return_barangs')
                        ->select(DB::raw('SUM(jumlah_return) as jumlah_return'))
                        ->where('barang_id', $data->barang_id)
                        ->where('status', '0')
                        ->first();
                    
                    $getJumlahHilang = DB::table('kehilangan_barangs')
                        ->select(DB::raw('SUM(jumlah_hilang) as jumlah_hilang'))
                        ->where('barang_id', $data->barang_id)
                        ->where('status', '0')
                        ->first();
                    // hitung sisa stok
                    // $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return;
                    $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return - $getJumlahHilang->jumlah_hilang;
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $data->barcode }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->nama_pemasok }}</td>
                    <td>{{ $sisaStok }}</td>
                    <td>{{ $data->satuan }}</td>
                </tr>
        </tbody>
        @endforeach

    </table>


</body>

</html>
