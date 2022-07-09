 @extends('template.layouts')
 @section('content')
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1 class="m-0"><i class="fas fa-exchange-alt mr-2"></i>Tabel Return Barang</h1>
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
                     Tambah Barang Return
                 </button>

                 <!-- Modal -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Return</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <!-- form pengisian data barang -->
                                 <form action="{{ route('store_tabel_return') }}" method="POST">
                                     @csrf
                                     <div class="row">
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Nama Barang
                                                 Return</label>
                                             <select class="form-control" name="barang_id" id="" required>
                                                 <option value="">--Pilih--</option>
                                                 @foreach ($barang as $br)
                                                     <option value="{{ $br->id }}">{{ $br->barcode }} -
                                                         {{ $br->nama_barang }} - {{ $br->nama_pemasok }}</option>
                                                 @endforeach
                                             </select>
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Jumlah Return</label>
                                             <input type="number" class="form-control" id="exampleInputEmail1"
                                                 aria-describedby="emailHelp" name="jumlah_return" required>
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputPassword1" class="form-label">Alasan</label>
                                             <textarea name="alasan" class="form-control" id="exampleInputPassword1" cols="30" rows="10"></textarea>
                                         </div>
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
             </div>
             <table id="example" class="table table-striped" style="width:100%">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Barcode</th>
                         <th>Nama Barang</th>
                         {{-- <th>Nama Pemasok</th> --}}
                         <th>Pemasok</th>
                         <th>Jumlah Return</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($data as $dt)
                         <tr>
                             <td>{{ $loop->index + 1 }}</td>
                             <td>{{ $dt->barcode }}</td>
                             <td>{{ $dt->nama_barang }}</td>
                             <td>{{ $dt->nama_pemasok }}</td>
                             <td>{{ $dt->jumlah_return }}</td>
                             <td>Barang Expired</td>
                             <td>
                                 <div class="btn-group">
                                     <button type="button" class="btn btn-primary dropdown-toggle"
                                         data-bs-toggle="dropdown" aria-expanded="false">
                                         Action
                                     </button>
                                     <ul class="dropdown-menu">
                                         <li>
                                             <div class="col mb-3">
                                                 <!-- button tambah barang -->
                                                 <!-- Button trigger modal -->
                                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                     data-bs-target="#exampleModal">
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


         {{-- Modal Edit --}}
         @foreach ($data as $dtedit)
             <div class="modal fade" id="exampleModal{{ $dtedit->id }}" tabindex="-1"
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
                                 <input type="hidden" name="id" value="{{ $dtedit->id }}">
                                 div class="row">
                                 <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Barang</label>
                                     <select class="form-control" name="barang_id" id="" required>
                                         <option value="">--Pilih--</option>
                                         @foreach ($barang as $br)
                                             <option value="{{ $br->id }}">{{ $br->barcode }} -
                                                 {{ $br->nama_barang }} - {{ $br->nama_pemasok }} </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleInputEmail1" class="form-label">Jumlah Return</label>
                                     <input type="number" name="jumlah_return" class="form-control"
                                         id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Alasan</label>
                                     <textarea name="alasan" class="form-control" id="" cols="30" rows="10"></textarea>
                                 </div>
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


     <!-- Modal delete -->
     <div class="modal fade" id="deleteModal{{ $dtedit->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     Yakin Hapus Data {{ $dtedit->nama_barang }}
                 </div>
                 <div class="modal-footer">
                     <form action="{{ route('destroy_tabel_barang') }}" method="POST">
                         @csrf
                         <input type="hidden" name="id" value="{{ $dtedit->id }}">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-primary">Ya</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     @endforeach
     </div>
 @endsection
