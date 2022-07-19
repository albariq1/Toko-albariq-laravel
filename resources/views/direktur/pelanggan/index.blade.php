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

                 <a href="{{ route('download_pelanggan') }}" target="_blank" class="btn btn-success"><i
                         class="fas fa-barcode mr-2"></i> Download PDF</a>
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
                                 <div class="col mb-3">
                                     <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                         data-bs-target="#exampleModaldetail{{ $dt->id }}">
                                         Detail
                                     </button>
                                 </div>
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </section>


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
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
