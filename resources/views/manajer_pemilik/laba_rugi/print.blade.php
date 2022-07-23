<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Laba/rugi</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
{{-- <body onload="window.print()"> --}}

<body>
    <div>
        <div id="laporan">
            <table align="center"
                style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

            </table>

            <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
                <tr>
                    <td colspan="2" style="width:800px;paddin-left:20px;">
                        <center>
                            <h4>LAPORAN LABA / RUGI </h4>
                        </center><br />
                    </td>
                </tr>
            </table>

            <table border="0" align="center" style="width:900px;border:none;">
                <tr>
                    <th style="text-align:left"></th>
                </tr>
            </table>

            <table border="1" align="center" style="width:900px;margin-bottom:20px;">
                <thead>
                    <tr>
                        <th colspan="10" style="text-align:left;">Bulan : {{ @$_GET['bulan'] }}</th>
                    </tr>
                    <tr>
                        <th style="width:20px;">No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga Pokok</th>
                        <th>Harga Jual</th>
                        <th>Keuntungan Per Unit</th>
                        <th>Item Terjual</th>
                        <th>Diskon</th>
                        <th>Untung Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($result['data'] as $dt)
                        @php
                            $getBarang = DB::table('barangs')
                                ->where('id', $dt->barang_id)
                                ->first();
                        @endphp
                        <tr>
                            <td align="center">{{ $loop->index + 1 }}</td>
                            <td>{{ $dt->jual_tanggal }}</td>
                            <td>{{ $getBarang->barcode }} - {{ $getBarang->nama_barang }}</td>
                            <td>{{ $getBarang->satuan }}</td>
                            <td>{{ 'Rp ' . number_format($dt->harga_pokok) }}</td>
                            <td>{{ 'Rp ' . number_format($dt->harga_jual) }}</td>
                            <td>{{ 'Rp ' . number_format($dt->keunt) }}</td>
                            <td align="center">{{ $dt->jumlah }}</td>
                            <td>{{ 'Rp ' . number_format($dt->jual_diskon) }}</td>
                            <td>{{ 'Rp ' . number_format($dt->untung_bersih) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center">Data tidak ada</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>

                    <tr>
                        <td colspan="9" style="text-align:center;"><b>Total Keuntungan</b></td>
                        <td style="text-align:right;"><b>{{ 'Rp ' . number_format($result['jumlah'][0]->total) }}</b>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
                <tr>
                    <td></td>
            </table>
            <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
                <tr>
                    <td align="right">Palembang, {{ date('d-F-Y') }}</td>
                </tr>
                <tr>
                    <td align="right"></td>
                </tr>

                <tr>
                    <td><br /><br /><br /><br /></td>
                </tr>
                <tr>
                    <td align="right">( {{ Auth::user()->name }} )</td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
            </table>
            <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
                <tr>
                    <th><br /><br /></th>
                </tr>
                <tr>
                    <th align="left"></th>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
