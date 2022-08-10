@extends('template.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-layer-group mr-2"></i>Tabel Barang</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pr-3">
            <div class="col mb-3">

                <a href="{{ route('download_barang') }}" target="_blank" class="btn btn-success"><i
                        class="fas fa-file-download mr-2"></i> Download PDF</a>
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
                        <th>Nama barang</th>
                        <th>Kategori</th>
                        <th>Pemasok</th>
                        <th>Diskon</th>
                        <th>Diskon Aktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $dt->barcode }}</td>
                            <td>{{ $dt->nama_barang }}</td>
                            <td>{{ $dt->nama_katagori }}</td>
                            <td>{{ $dt->nama_pemasok }}</td>
                            <td>{{ $dt->diskon }}</td>
                            <td>{{ $dt->diskon_aktif == '1' ? 'Aktif' : 'Tidak Aktif' }} </td>
                            <td>
                                <div class="col mb-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModaldetail{{ $dt->id }}">
                                        <i class="fas fa-info"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#exampleModaldiskon{{ $dt->id }}">
                                        <i class="fas fa-percent"></i>
                                    </button>
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
        @foreach ($data as $dtdetail)
            <!-- Modal -->
            <div class="modal fade" id="exampleModaldetail{{ $dtdetail->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama
                                            Pemasok</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="{{ $dtdetail->nama_pemasok }}"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            placeholder="{{ $dtdetail->barcode }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">No hp</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->nama_barang }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">No hp</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->nama_katagori }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">No hp</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->nama_pemasok }}" disabled>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($data as $dtdiskon)
            <!-- Modal -->
            <div class="modal fade" id="exampleModaldiskon{{ $dtdiskon->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Discount
                                Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form action="{{ route('update_tabel_barang') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="{{ $dtdiskon->id }}">
                                        <label for="exampleInputPassword1" class="form-label">Pemasok</label>
                                        <select class="form-control" name="pemasok_id" id="" readonly>
                                            <option value="">--Pilih--</option>
                                            @foreach ($pemasok as $pm)
                                                <option value="{{ $pm->id }}"
                                                    {{ $pm->id == $dtdiskon->pemasok_id ? 'selected' : '' }}>
                                                    {{ $pm->nama_pemasok }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Kategori</label>
                                        <select class="form-control" name="kategori_id" id="" readonly>
                                            <option value="">--Pilih--</option>
                                            @foreach ($kategori as $kt)
                                                <option value="{{ $kt->id }}"
                                                    {{ $kt->id == $dtdiskon->kategori_id ? 'selected' : '' }}>
                                                    {{ $kt->nama_katagori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            value="{{ $dtdiskon->nama_barang }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Barcode</label>
                                        <input type="text" name="barcode" class="form-control"
                                            id="exampleInputPassword1" value="{{ $dtdiskon->barcode }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Satuan</label>
                                        <select class="form-control" name="satuan" id="" readonly>
                                            <option value="">--Pilih--</option>
                                            <option value="Pcs" <?= $dtdiskon->satuan === 'Pcs' ? 'Selected' : '' ?>>Pcs
                                            </option>
                                            <option value="Kg" <?= $dtdiskon->satuan === 'Kg' ? 'Selected' : '' ?>>kg
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Diskon</label>
                                        <input type="text" name="diskon" class="form-control"
                                            id="exampleInputPassword1" value="{{ $dtdiskon->diskon }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Diskon Aktif</label>
                                        <select class="form-control" name="diskon_aktif" id="">
                                            <option value="">--Pilih--</option>
                                            <option value="1"
                                                <?= $dtdiskon->diskon_aktif === '1' ? 'selected' : '' ?>>
                                                Ya
                                                {{-- <option value="{{ $dtdiskon->diskon_aktif == '1' ? 'selected' : '' }}">Ya --}}
                                            </option>
                                            <option value="0"
                                                <?= $dtdiskon->diskon_aktif === '0' ? 'selected' : '' ?>>
                                                Tidak
                                                {{-- <option value="{{ $dtdiskon->diskon_aktif == '0' ? 'selected' : '' }}">Tidak --}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
