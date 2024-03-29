@extends('template.layouts')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.css') }}">
@endpush
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
                <!-- button tambah barang -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBarang">
                    <i class="fas fa-folder-plus mr-2"></i> Tambah Pembelian Barang
                </button>

                <!-- Modal -->
                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true"> --}}
                <div class="modal hide fade" id="modalBarang" tabindex="-1" role="dialog"
                    aria-labelledby="modalBarangLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalBarangLabel">Tambah Pembelian Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form action="{{ route('store_tabel_pembelian_barang') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Barang</label>
                                            <select class="form-control barang-select" name="barang_id" id="barang-select"
                                                required>
                                                <option value="">--Pilih--</option>
                                                @foreach ($barang as $br)
                                                    <option value="{{ $br->id }}">
                                                        {{ $br->barcode }} -
                                                        {{ $br->nama_barang }} - {{ $br->nama_pemasok }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tgl. Pembelian</label>
                                            <input type="date" name="tanggal_pembelian" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Jumlah</label>
                                        <input type="number" min="1" name="jumlah_beli" class="form-control"
                                            id="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Harga Beli</label>
                                        <input type="text" name="harga_beli" class="form-control" id="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">harga Jual</label>
                                        <input type="text" name="harga_jual" class="form-control" id="">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
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
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".barang-select").select2({
                dropdownParent: $("#modalBarang"),
                theme: 'bootstrap4'
            });
        });
    </script>
@endpush
