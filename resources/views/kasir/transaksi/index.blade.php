@extends('template.layouts')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="nav-icon fas fa-cash-register mr-2"></i>Transaksi dasda</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
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
        <div class="row justify-content-around ml-3">
            <div class="col-4">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header">Form Input Penjual</h3>
                    <div class="card-body">
                        <form action="{{ route('kasir.store-transaksi') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Nama Pelanggan</label>
                                <select name="pelanggan_id" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($pelanggan as $pl)
                                        <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Nama Barang</label>
                                <select name="barang_id" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($barang as $br)
                                        <option value="{{ $br->id_barang }}">{{ $br->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Harga Satuan</label>
                                <input type="text" class="form-control" style="width:30% ;" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Total Harga</label>
                                <input type="text" class="form-control" style="width:30% ;" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
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
                                        // untuk mengambil data urutan terakhir pd tabel pembelian_barangs berdasarkan id barang yang di foreach
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
                    <div class="d-flex flex-row card-footer pt-2">
                        <h4 class="card-title mr-1 pt-1">Total Harga Belanjaan : </h4>
                        <h4>Rp.{{ number_format($totBelanja) }}</h4>
                        <form action="{{ route('kasir.store-penjualan') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary ml-auto"> Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
