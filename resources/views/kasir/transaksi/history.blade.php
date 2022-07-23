@extends('template.layouts')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-clipboard-list mr-2"></i>Tabel Penjualan Harian</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pr-3">
            <div class="col mb-3">
                <a href="{{ route('download_rekap') }}" target="_blank" class="btn btn-success"><i
                        class="fas fa-file-download mr-2"></i> Download PDF</a>
            </div>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penjualan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Admin</th>
                        <th>Tanggal</th>
                        <th>Jumlah Transaksi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history['detail'] as $dt)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $dt->kode_penjualan }}</td>
                            <td>{{ $dt->nama_pelanggan ?? '-' }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->tanggal_transaksi }}</td>
                            <td>Rp.{{ number_format($dt->grand_total, 0, ',', '.') }}</td>
                            <td>
                                {{-- infoice pelanggan --}}
                                <a href="{{ route('kasir.cetak-invoice', $dt->id) }}" class="btn btn-warning"><i
                                        class="fa fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- /.content -->
    </div>
@endsection
