@extends('template.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-users mr-2"></i>Tabel User</h1>
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
                    <i class="fas fa-folder-plus mr-2"></i> Tambah User
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form action="{{ route('store_tabel_user') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" name="name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">No Hp</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" name="no_hp" required>
                                        @error('no_hp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                                            id="exampleInputPassword1" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                        <select class="form-control @error('role') is-invalid @enderror" id=""
                                            name="role" required>
                                            <option value="">--Pilih--</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Direktur">Direktur</option>
                                            <option value="Sekretaris">Sekretaris</option>
                                            <option value="Keuangan">Keuangan</option>
                                            <option value="Staff Gudang">Staff Gudang</option>
                                            <option value="Kasir">Kasir</option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <stron>{{ $message }}</stron g>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="" name="alamat" cols="30"
                                            rows="10" required></textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                        <th>Nama Lengkap</th>
                        <th>No Hp</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $dt->name }}</td>
                            <td>{{ $dt->No_hp }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>{{ $dt->role }}</td>
                            <td>{{ $dt->alamat }}</td>
                            <td>
                                <!-- Action -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="col mb-3">

                                                <!-- Button trigger modal detail -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModaldetail{{ $dt->id }}">
                                                    Detail
                                                </button>



                                            </div>
                                        </li>
                                        <li>
                                            <div class="col mb-3">

                                                <!-- Button trigger modal edit -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $dt->id }}">
                                                    Edit
                                                </button>


                                            </div>
                                        </li>
                                        <li>
                                            {{-- button trigger modal hapus --}}
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
            <div class="modal fade" id="exampleModal{{ $dtedit->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form action="{{ route('update_tabel_user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
                                        value="{{ $dtedit->email }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                        value="{{ $dtedit->name }}" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">No Hp</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                        value="{{ $dtedit->No_hp }}" name="no_hp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                                        id="exampleInputPassword1" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                    <select class="form-control @error('role') is-invalid @enderror" id=""
                                        name="role" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Admin "{{ $dtedit->role == 'Admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="Direktur"{{ $dtedit->role == 'Direktur' ? 'selected' : '' }}>
                                            Direktur</option>
                                        <option value="Sekretaris"{{ $dtedit->role == 'Sekretaris' ? 'selected' : '' }}>
                                            Sekretaris</option>
                                        <option value="Keuangan"{{ $dtedit->role == 'Keuangan' ? 'selected' : '' }}>
                                            Keuangan</option>
                                        <option
                                            value="Staff Gudang"{{ $dtedit->role == 'Staff Gudang' ? 'selected' : '' }}>
                                            Staff Gudang</option>
                                        <option value="Kasir" {{ $dtedit->role == 'Kasir' ? 'selected' : '' }}>Kasir
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="" name="alamat" cols="30"
                                        rows="10" required>{{ $dtedit->alamat }}</textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Apakah Yang Anda Input Sudah
                                        Benar?</label>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="" class="btn btn-primary">Tambah</button>
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
                            Apakah Anda Yakin Hapus Data User {{ $dtedit->email }}?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('destroy_tabel_user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal detail --}}
        @endforeach

        {{-- perulangan modal detail --}}
        @foreach ($data as $dtdetail)
            <!-- Modal -->
            <div class="modal fade" id="exampleModaldetail{{ $dtdetail->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                User
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form pengisian data barang -->
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="{{ $dtdetail->name }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">No Hp</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->No_hp }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->email }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->role }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="{{ $dtdetail->alamat }}" disabled>
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
