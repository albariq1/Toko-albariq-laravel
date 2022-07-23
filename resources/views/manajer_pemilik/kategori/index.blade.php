@extends('template.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-table mr-2"></i>Tabel Kategori</h1>
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
                    <i class="fas fa-folder-plus mr-2"></i> Tambah Kategori
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form action="{{ route('store_tabel_kategori') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Katagori</label>
                                        <input type="text"
                                            class="form-control @error('nama_katagori') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_katagori"
                                            value="{{ old('nama_katagori') }}" required>
                                        @error('nama_katagori')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('download_kategori') }}" target="_blank" class="btn btn-success"><i
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
                        <th>Nama Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $dt->nama_katagori }}</td>
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
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModaldetail{{ $dt->id }}">
                                                    Detail
                                                </button>


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
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </section>

        @foreach ($data as $dtedit)
            <!-- Modal Edit -->
            <div class="modal fade" id="exampleModal{{ $dtedit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form action="{{ route('update_tabel_kategori') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Katagori</label>
                                    <input type="text"
                                        class="form-control @error('nama_katagori') is-invalid @enderror"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
                                        value="{{ $dtedit->nama_katagori }}">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal delete --}}
            <!-- Modal -->
            <div class="modal fade" id="deleteModal{{ $dtedit->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda Yakin Hapus Data Kategori {{ $dtedit->nama_katagori }}?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('destroy_tabel_kategori') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($data as $dtdetail)
            <!-- Modal -->
            <div class="modal fade" id="exampleModaldetail{{ $dtdetail->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                kategori
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $dtdetail->nama_katagori }}"
                                        disabled>
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
    </div>
@endsection
