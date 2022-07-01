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
                                <a href="" class="btn btn-warning"><i class="fa fa-print"></i></a>
                                <a href="" class="btn btn-info"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- /.content -->
    </div>
@endsection
