@extends('template.layouts')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.css') }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="nav-icon fas fa-cash-register mr-2"></i>Transaksi</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('failed') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="row justify-content-around ml-3">
            <div class="col-4">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header">Form Input Penjual</h3>
                    <div class="card-body">
                        <form method="get" action="{{ url('kasir/transaksi') }}" id="cari">
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Nama Barang</label>
                                <select name="id_barang" class="form-control barang-select" id="barang"
                                    onchange="document.getElementById('cari').submit();" required>
                                    <option value="">--Pilih--</option>
                                    @foreach ($barang as $br)
                                        <option
                                            @isset($id_barang) {{ $id_barang == $br->id_barang ? 'selected' : '' }} @endisset
                                            value="{{ $br->id_barang }} ">{{ $br->barcode }} |
                                            {{ $br->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <form action="{{ route('kasir.store-transaksi') }}" method="POST">
                            @csrf
                            @if (isset($_GET['id_barang']))
                                <input type="hidden" name="barang_id" class="form-control" value="{{ $id_barang }}">
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Harga Satuan</label>
                                <input type="text" class="form-control" style="width:100% ;" value="{{ $harga }}"
                                    disabled>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Total Harga</label>
                                <input type="text" class="form-control" style="width:30% ;" disabled>
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <h3 class="card-header">Daftar Barang Penjualan</h3>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $dt)
                                        @php
                                            // untuk mengambil data urutan terakhir pd tabel pembelian_barangs berdasarkan id barang yg di foreach
                                            // untuk mengambil harga_jual yg urutan akhir
                                            $getLastBarang = \App\Models\PembelianBarang::where('barang_id', $dt->id_barang)
                                                ->orderBy('id', 'DESC')
                                                ->first();
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $dt->nama_barang }}</td>
                                            <td>{{ $dt->jumlah }}</td>
                                            <td>Rp.{{ number_format($getLastBarang->harga_jual) }}</td>
                                            <td>Rp.{{ number_format($dt->totalharga) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        @if ($detail->count() > 0)
                            <div class="d-flex flex-row card-footer pt-2">
                                <h4 class="card-title mr-1 pt-1">Total Harga Belanjaan : </h4>
                                <h4>Rp.{{ number_format($totBelanja) }}</h4>
                                <input type="hidden" id="total" value="{{ $totBelanja }}">
                            </div>
                            <br>
                            <table>
                                <form action="{{ route('kasir.store-penjualan') }}" method="post">
                                    @csrf
                                    <tr>
                                        <td>Nama Pelanggan</td>
                                        <td>:</td>
                                        <td>
                                            <select name="pelanggan_id" class="form-control js-example-basic-single">
                                                <option value="">--Pilih--</option>
                                                @foreach ($pelanggan as $pl)
                                                    <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Bayar</td>
                                        <td>:</td>
                                        <td>
                                            <input type="number" class="form-control" placeholder="Jumlah Bayar"
                                                id="jumlahBayar" required name="jumlah_bayar" onkeyup="parsing();">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kembalian</td>
                                        <td>:</td>
                                        <td>
                                            <input type="number" class="form-control" readonly name="kembalian"
                                                placeholder="Kembalian" id="kembalian">
                                        </td>
                                    </tr>
                            </table>
                            <button type="submit" class="btn btn-primary ml-auto"> Submit</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.barang-select').select2({
                    theme: 'bootstrap4',
                });
            });
        </script>
        <script>
            function parsing() {
                var total = document.getElementById('total').value;
                var jumlahBayar = document.getElementById('jumlahBayar').value;
                var result = parseInt(jumlahBayar) - parseInt(total);
                //document.getElementById('jumlah_masuk').value = total;
                if (jumlahBayar == '') {
                    document.getElementById('kembalian').value = "";
                    exit;
                }
                if (!isNaN(result)) {
                    document.getElementById('kembalian').value = result;
                    if (document.getElementById('jumlahBayar').value < 0) {
                        window.alert('Nilai tidak boleh lebih besar dari Jumlah barang masuk');
                        // document.getElementById('kondisi_baik').value = "";
                        document.getElementById('kembalian').value = "";
                    }
                    exit;
                }
            }
        </script>
    @endpush

@endsection
