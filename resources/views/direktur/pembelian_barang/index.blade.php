@extends('template.layouts')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-shopping-cart mr-2"></i>Tabel Pembelian Barang</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pr-3">
            <div class="col mb-3">
                <a href="{{ route('download_stok') }}" target="_blank" class="btn btn-success"><i
                        class="fas fa-file-download mr-2"></i> Download PDF</a>

                <a href="{{ route('barcode_barang') }}" target="_blank" class="btn btn-success"><i
                        class="fas fa-barcode mr-2"></i> Print Barcode</a>
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
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Nama Barang</th>
                        <th>Nama Pemasok</th>
                        <th>Stock/jumlah</th>
                        <th>Satuan</th>
                        {{-- <th>Harga beli</th>
                        <th>Harga jual</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        @php
                            // ambil jumlah_beli dari tabel pembelian_barangs berdasarkan id barang yang diforeach
                            $getJumlah = DB::table('pembelian_barangs')
                                ->select(DB::raw('SUM(jumlah_beli) as stok'))
                                ->where('barang_id', $dt->barang_id)
                                ->first();
                            
                            // ambil jumlah dari tabel penjualan_barangs berdasarkan id barang yang diforeach
                            $getJumlahTerjual = DB::table('detail_penjualans')
                                ->select(DB::raw('SUM(jumlah) as jumlah_terjual'))
                                ->where('barang_id', $dt->barang_id)
                                ->first();
                            $getJumlahReturn = DB::table('return_barangs')
                                ->select(DB::raw('SUM(jumlah_return) as jumlah_return'))
                                ->where('barang_id', $dt->barang_id)
                                ->where('status', '0')
                                ->first();
                            
                            $getJumlahHilang = DB::table('kehilangan_barangs')
                                ->select(DB::raw('SUM(jumlah_hilang) as jumlah_hilang'))
                                ->where('barang_id', $dt->barang_id)
                                ->where('status', '0')
                                ->first();
                            // hitung sisa stok
                            // $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return;
                            $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual - $getJumlahReturn->jumlah_return - $getJumlahHilang->jumlah_hilang;
                        @endphp
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $dt->barcode }}</td>
                            <td>{{ $dt->nama_barang }}</td>
                            <td>{{ $dt->nama_pemasok }}</td>
                            <td>{{ $sisaStok }}</td>
                            <td>{{ $dt->satuan }}</td>
                            {{-- <td>{{ $dt->harga_beli }}</td>
                            <td>{{ $dt->harga_jual }}</td> --}}
                            <td>
                                <a href="{{ route('detail_tabel_pembelian_barang', $dt->barang_id) }}"
                                    class="btn btn-primary">
                                    Detail
                                </a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- /.content -->


    </div>
@endsection
