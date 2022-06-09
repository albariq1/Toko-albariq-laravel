 @extends('template.layouts')
 @section('content')
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1 class="m-0"><i class="far fa-user mr-2"></i>Tabel Pelanggan</h1>
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
                     <i class="fas fa-folder-plus mr-2"></i> Tambah Pelanggan
                 </button>

                 <!-- Modal -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <!-- form pengisian data barang -->
                                 <form action="{{ route('store_tabel_pelanggan') }}" method="POST">
                                     @csrf
                                     <div class="row">
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                             <input type="text"
                                                 class="form-control @error('nama_langgan') is-invalid @enderror"
                                                 id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_pelanggan"
                                                 value="{{ old('nama_pelanggan') }}" required>
                                         </div>
                                         <div class=" mb-3">
                                             <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                             <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                 id="exampleInputPassword1" name="alamat" value="{{ old('alamat') }}"
                                                 required>
                                         </div>
                                     </div>
                                     <div class="mb-3">
                                         <label for="exampleInputPassword1" class="form-label">No Hp</label>
                                         <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                             id="exampleInputPassword1" value="{{ old('no_hp') }}" name="no_hp" required>
                                     </div>
                                     <div class="mb-3 form-check">
                                         <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                         <label class="form-check-label" for="exampleCheck1">Apakah Yang Anda Input Sudah
                                             Benar?</label>
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
                         <th>Nama Pelanggan</th>
                         <th>Alamat</th>
                         <th>No hp</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($data as $dt)
                         <tr>
                             <td>{{ $loop->index + 1 }}</td>
                             <td>{{ $dt->nama_pelanggan }}</td>
                             <td>{{ $dt->alamat }}</td>
                             <td>{{ $dt->no_hp }}</td>
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
             <!-- Modal Edit-->
             <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Edit
                                 Pelanggan</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <!-- form pengisian data barang -->
                             <form action="{{ route('update_tabel_pelanggan') }}" method="POST">
                                 @csrf
                                 <div class="row">
                                     <div class="mb-3">
                                         <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                         <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                         <input type="text"
                                             class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                             id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="bimoli"
                                             name="nama_pelanggan" value="{{ $dtedit->nama_pelanggan }}">
                                     </div>
                                     <div class="mb-3">
                                         <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                         <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                             id="exampleInputPassword1" name="alamat" value="{{ $dtedit->alamat }}">
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">No Hp</label>
                                     <input type="text" class="form-control" id="exampleInputPassword1" name="no_hp"
                                         value="{{ $dtedit->no_hp }}">
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-primary">Tambah</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>

             {{-- modal hapus --}}
             <div class="modal fade" id="deleteModal{{ $dtedit->id }}" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             Apakah Anda Yakin Hapus Data Kategori {{ $dtedit->nama_pelanggan }}?
                         </div>
                         <div class="modal-footer">
                             <form action="{{ route('destroy_tabel_pelanggan') }}" method="POST">
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

         {{-- perulangan detail --}}
         @foreach ($data as $dtdetail)
             <!-- Modal -->
             <div class="modal fade" id="exampleModaldetail{{ $dtdetail->id }}" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Detail
                                 Pelanggan</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <!-- form pengisian data barang -->
                             <form>
                                 <div class="row">
                                     <div class="mb-3">
                                         <label for="exampleInputEmail1" class="form-label">Nama
                                             Pelanggan</label>
                                         <input type="text" class="form-control" id="exampleInputEmail1"
                                             aria-describedby="emailHelp" placeholder="{{ $dtdetail->nama_pelanggan }}"
                                             disabled>
                                     </div>
                                     <div class="mb-3">
                                         <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                         <input type="text" class="form-control" id="exampleInputPassword1"
                                             placeholder="{{ $dtdetail->alamat }}" disabled>
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">No hp</label>
                                     <input type="text" class="form-control" id="exampleInputPassword1"
                                         placeholder="{{ $dtdetail->no_hp }}" disabled>
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
