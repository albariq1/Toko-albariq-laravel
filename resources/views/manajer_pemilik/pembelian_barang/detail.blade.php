@extends('template.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-layer-group mr-2"></i>Detail Tabel Pembelian Barang</h1>
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
                <a href="{{ route('tabel_pembelian_barang') }}" class="btn btn-primary">
                    <i class="fas fa-angle-left mr-2"></i>Kembali
                </a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembelian Barang</h5>
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
                                            <select class="form-control" name="barang_id" id="" required>
                                                <option value="">--Pilih--</option>

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tgl. Pembelian</label>
                                            <input type="date" name="tanggal_pembelian" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Jumlah</label>
                                            <input type="number" min="1" name="jumlah_beli" class="form-control"
                                                id="" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Harga Beli</label>
                                            <input type="text" name="harga_beli" class="form-control" id=""
                                                required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Harga Jual</label>
                                        <input type="text" name="harga_jual" class="form-control" id=""
                                            required>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Apakah Yang Anda Input Sudah
                                            Benar?</label>
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
                <button type="button" class="btn btn-info">
                    Print
                </button>
            </div>

            <table id="" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Barcode</th>
                        <th>Nama barang</th>
                        <th>Pemasok</th>
                        <th>Satuan</th>
                        <th>Tgl. Pembelian</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Jumlah</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <!-- Action -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="col mb-3">
                                                <!-- button tambah barang -->
                                                <!-- Button trigger modal -->
                                                <a href="{{ route('detail_tabel_pembelian_barang', $dt->id_barang) }}"
                                                    class="btn btn-primary">
                                                    Detail
                                                </a>


                                            </div>
                                        </li>
                                        <li>
                                            <div class="col mb-3">
                                                <!-- button tambah barang -->
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $dt->id }}">
                                                    Edit
                                                </button>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="col mb-3">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $dt->id }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- <a href="" class="btn btn-primary">Detail</a>
                                                                        <a href="" class="btn btn-warning">Ubah</a>
                                                                        <a href="" class="btn btn-danger">Hapus</a> -->
                            </td>
                            <td>{{ $dt->barcode }}</td>
                            <td>{{ $dt->nama_barang }}</td>
                            <td>{{ $dt->nama_pemasok }}</td>
                            <td>{{ $dt->satuan }}</td>
                            <td>{{ $dt->tanggal_pembelian }}</td>
                            <td>Rp.{{ number_format($dt->harga_beli) }}</td>
                            <td>Rp.{{ number_format($dt->harga_jual) }}</td>
                            <td>{{ $dt->jumlah_beli }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="9">Jumlah Pembelian</th>
                        <th>{{ $getJumlah->stok }}</th>
                    </tr>
                    <tr>
                        <th colspan="9">Jumlah Terjual</th>
                        <th>{{ $getJumlahTerjual->jumlah_terjual ?? 0 }}</th>
                    </tr>
                    <tr>
                        <th colspan="9">Jumlah Return</th>
                        <th>{{ $getJumlahReturn->jumlah_return ?? 0 }}</th>
                    </tr>
                    <tr>
                        <th colspan="9">Sisa Stok</th>
                        <th>{{ $sisaStok }}</th>
                    </tr>
                    <tr>
                        <th colspan="9">Harga Beli Akhir</th>
                        <th>Rp.{{ number_format($getLast->harga_beli) }}</th>
                    </tr>
                    <tr>
                        <th colspan="9">Harga Jual Akhir</th>
                        <th>Rp.{{ number_format($getLast->harga_jual) }}</th>
                    </tr>
                </tbody>
            </table>
        </section>
        <!-- /.content -->

    </div>
@endsection
