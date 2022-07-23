@extends('template.layouts')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-clipboard-list mr-2"></i>Tabel Penjualan</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pr-3">
            <div class="col mb-3">
                <button type="button" class="btn btn-info">
                    Print
                </button>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Data Penjualan Harian</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Penjualan</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Admin</th>
                                <th>Tanggal</th>
                                {{-- <th>Jumlah Item yang Dibeli</th> --}}
                                <th>Jumlah Transaksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataharian['detail'] as $dt)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $dt->kode_penjualan }}</td>
                                    <td>{{ $dt->nama_pelanggan ?? '-' }}</td>
                                    <td>{{ $dt->name }}</td>
                                    <td>{{ $dt->tanggal_transaksi }}</td>
                                    <td>Rp.{{ number_format($dt->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('kasir.cetak-invoice', $dt->id) }}" class="btn btn-warning"><i
                                                class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Data Penjualan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Penjualan</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Admin</th>
                                <th>Tanggal</th>
                                {{-- <th>Jumlah Item yang Dibeli</th> --}}
                                <th>Jumlah Transaksi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['detail'] as $dt)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $dt->kode_penjualan }}</td>
                                    <td>{{ $dt->nama_pelanggan ?? '-' }}</td>
                                    <td>{{ $dt->name }}</td>
                                    <td>{{ $dt->tanggal_transaksi }}</td>
                                    <td>Rp.{{ number_format($dt->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('kasir.cetak-invoice', $dt->id) }}" class="btn btn-warning"><i
                                                class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
