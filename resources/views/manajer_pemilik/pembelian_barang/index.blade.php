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
                <!-- button tambah barang -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-folder-plus mr-2"></i> Tambah Pembelian Barang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Pembelian Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form action="{{ route('store_tabel_pembelian_barang') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Barang</label>
                                            <select class="form-control" name="barang_id" id="" required>
                                                <option value="">--Pilih--</option>
                                                @foreach ($barang as $br)
                                                    <option value="{{ $br->id }}">{{ $br->barcode }} -
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
                                        <input type="number" min="1" name="jumlah_beli" class="form-control" id="">
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
                <button type="button" class="btn btn-info">
                    Print
                </button>
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
                            
                            // hitung sisa stok
                            $sisaStok = $getJumlah->stok - $getJumlahTerjual->jumlah_terjual;
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
                                <!-- Action -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="col mb-3">
                                                <!-- button tambah barang -->
                                                <!-- Button trigger modal -->
                                                <a href="{{ route('detail_tabel_pembelian_barang', $dt->barang_id) }}"
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
                                                    data-bs-target="#exampleModalEdit{{ $dt->id }}">
                                                    Edit
                                                </button>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="col mb-3">
                                                <button type="button" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <!-- /.content -->

        {{-- modal detail --}}
        <!-- Modal -->
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Barang
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- form pengisian data barang -->
                        <form>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="bimoli" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Barcode</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Pemasok</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Harga Beli</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Harga Jual</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Apakah Yang Anda Input Sudah
                                    Benar?</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- modal edit --}}
        <!-- Modal -->
        {{-- @foreach ($data as $dtedit)
            <div class="modal fade" id="exampleModalEdit{{ $dtedit->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form action="{{ route('update_tabel_barang') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                        <label for="exampleInputPassword1" class="form-label">Pemasok</label>
                                        <select class="form-control" name="pemasok_id" id="" required>
                                            <option value="">--Pilih--</option>
                                            @foreach ($pemasok as $pm)
                                                <option value="{{ $pm->id }}"
                                                    {{ $pm->id == $dtedit->pemasok_id ? 'selected' : '' }}>
                                                    {{ $pm->nama_pemasok }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Kategori</label>
                                        <select class="form-control" name="kategori_id" id="" required>
                                            <option value="">--Pilih--</option>
                                            @foreach ($kategori as $kt)
                                                <option value="{{ $kt->id }}"
                                                    {{ $kt->id == $dtedit->kategori_id ? 'selected' : '' }}>
                                                    {{ $kt->nama_katagori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $dtedit->nama_barang }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Barcode</label>
                                        <input type="text" name="barcode" class="form-control" id="exampleInputPassword1"
                                            value="{{ $dtedit->barcode }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Satuan</label>
                                    <select class="form-control" name="satuan" id="">
                                        <option value="">--Pilih--</option>
                                        <option value="{{ $dtedit->satuan == 'Pcs' ? 'selected' : '' }}">Pcs</option>
                                        <option value="{{ $dtedit->satuan == 'Kg' ? 'selected' : '' }}">Kg</option>
                                    </select>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Apakah Yang Anda Input Sudah
                                        Benar?</label>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach --}}

    </div>
@endsection
