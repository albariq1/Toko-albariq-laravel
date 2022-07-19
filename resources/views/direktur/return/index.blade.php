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

                 <a href="{{ route('download_return') }}" target="_blank" class="btn btn-success"><i
                         class="fas fa-barcode mr-2"></i> Download PDF</a>
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
                         <th>Status</th>
                         <th>Alasan</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($data as $dt)
                         @php
                             if ($dt->status == '0') {
                                 $sts = 'Masih Return';
                                 $class = 'badge badge-warning';
                             } else {
                                 $sts = 'Telah balik lagi';
                                 $class = 'badge badge-success';
                             }
                         @endphp
                         <tr>
                             <td>{{ $loop->index + 1 }}</td>
                             <td>{{ $dt->barcode }}</td>
                             <td>{{ $dt->nama_barang }}</td>
                             <td>{{ $dt->nama_pemasok }}</td>
                             <td>{{ $dt->jumlah_return }}</td>
                             <td>
                                 @if ($dt->status == '0')
                                     <a href="{{ route('update_status_return', $dt->id) }}"
                                         onclick="return confirm('Yakin update statusnya? Update data hanya bisa 1x')"><span
                                             class="{{ $class }}">{{ $sts }}</span></a>
                                 @else
                                     <span class="{{ $class }}">{{ $sts }}</span>
                                 @endif


                             </td>
                             <td>{{ $dt->alasan }}</td>
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


         @foreach ($data as $dtdetail)
             <!-- Modal -->
             <div class="modal fade" id="exampleModaldetail{{ $dtdetail->id }}" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Detail
                                 Return</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <!-- form pengisian data barang -->
                             <form>
                                 <div class="row">
                                     <div class="mb-3">
                                         <label for="exampleInputEmail1" class="form-label">Barcode</label>
                                         <input type="text" class="form-control" id="exampleInputEmail1"
                                             aria-describedby="emailHelp" placeholder="{{ $dtdetail->barcode }}"
                                             disabled>
                                     </div>
                                     <div class="mb-3">
                                         <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                                         <input type="text" class="form-control" id="exampleInputPassword1"
                                             placeholder="{{ $dtdetail->nama_barang }}" disabled>
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Nama Pemasok</label>
                                     <input type="text" class="form-control" id="exampleInputPassword1"
                                         placeholder="{{ $dtdetail->nama_pemasok }}" disabled>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleInputPassword1" class="form-label">Jumlah Retrun</label>
                                     <input type="text" class="form-control" id="exampleInputPassword1"
                                         placeholder="{{ $dtdetail->jumlah_return }}" disabled>
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
