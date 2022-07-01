<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Template Faktur Untuk Kasir HTML</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 44mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: .9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 40px;
            width: 150px;
            background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
            background-size: 150px 40px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: .5em;
            background: #EEE;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: 10px;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>

    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>


</head>

<body translate="no">
    <div id="invoice-POS">
        <center id="top">
            <div class="info">
                <h2>Toko AL BARIQ</h2>
                <p>
                    Alamat : Jl. Talang Kelapa<br>
                    Email : xxxxxx@gmail.com<br>
                    Telephone : 08521361xxxx<br>
                </p>
            </div>
            <!--End Info-->
        </center>
        <!--End InvoiceTop-->
        <hr>
        <div id="mid">
            <div class="info">
                <table class="table">
                    <tr>
                        <td class="itemtext">No. Struk</td>
                        <td class="itemtext">{{ $penjualan->kode_penjualan }}</td>
                    </tr>
                    <tr>
                        <td class="itemtext">Nama Kasir</td>
                        <td class="itemtext">{{ $penjualan->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="itemtext">Waktu</td>
                        <td class="itemtext">{{ date('d-M-Y H:i:s', strtotime($penjualan->created_at)) }}</td>
                    </tr>
                    <tr>
                        <td class="itemtext">Nama Pelanggan</td>
                        <td class="itemtext">{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <!--End Invoice Mid-->

        {{-- <div id="bot"> --}}

        <div id="table">
            <table class="table">
                @foreach ($data as $dt)
                    @php
                        $getLast = App\Models\PembelianBarang::where('barang_id', $dt->barang_id)
                            ->orderBy('id', 'DESC')
                            ->first(); // utk mengambil dta barang yg terakhir, utk ambil harga dsb
                        // dd($getLast->harga_jual);
                    @endphp
                    <tr>
                        <td colspan="2" class="itemtext">{{ $dt->nama_barang }}</td>
                    </tr>
                    <tr>
                        <td class="itemtext">Rp. {{ number_format($getLast->harga_jual, 0, ',', '.') }} x
                            {{ $dt->jumlah }}</td>
                        <td class="itemtext" style="float: right;">Rp.
                            {{ number_format($dt->totalharga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </table>
            <hr>
            <table class="table">
                <tr>
                    <td colspan="2" class="itemtext">Total</td>
                    <td></td>
                    <td class="itemtext" style="float: right;">Rp.
                        {{ number_format($penjualan->grand_total, 0, ',', '.') }}</td>
                </tr>
            </table>
            <hr>
            <table class="table">
                <tr>
                    <td colspan="2" class="itemtext">Bayar</td>
                    <td class="itemtext" style="float: right;">Rp.
                        {{ number_format($penjualan->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="itemtext">Kembalian</td>
                    <td class="itemtext" style="float: right;">Rp.
                        {{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
                </tr>
            </table>

        </div>
        <!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong> Barang yang sudah dibeli tidak
                dapat
                dikembalikan. Jangan lupa berkunjung kembali
            </p>
        </div>

        {{-- </div> --}}
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->

</body>

</html>
