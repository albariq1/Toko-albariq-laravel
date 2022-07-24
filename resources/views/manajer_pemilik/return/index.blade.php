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
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBarang">
                     Tambah Barang Return
                 </button>

                 <!-- Modal -->
                 <div class="modal hide fade" id="modalBarang" tabindex="-1" aria-labelledby="modalBarangLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="modalBarangLabel">Tambah Barang Return</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <!-- form pengisian data barang -->
                                 <form action="{{ route('store_tabel_return') }}" method="POST">
                                     @csrf
                                     <div class="row">
                                         <div class="mb-3">
                                             <label for="" class="form-label">Nama Barang
                                                 Return</label>
                                             <select class="form-control barang-select" name="barang_id" id="barang-select"
                                                 required>
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
                 <a href="{{ route('download_return') }}" target="_blank" class="btn btn-success"><i
                         class="fas fa-file-download mr-2"></i> Download PDF</a>
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
                                                     data-bs-target="#exampleModaldetail{{ $dt->id }}">
                                                     Detail
                                                 </button>
                                             </div>
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
             <!-- Modal delete -->
             <div class="modal fade" id="deleteModal{{ $dtedit->id }}" tabindex="-1"
                 aria-labelledby="deleteModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             Yakin Hapus Data {{ $dtedit->nama_barang }}
                         </div>
                         <div class="modal-footer">
                             <form action="{{ route('destroy_tabel_return') }}" method="POST">
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

         @foreach ($data as $dtdetail)
             <!-- Modal -->
             <div class="modal fade" id="exampleModaldetail{{ $dtdetail->id }}" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Detail
                                 Return</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
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
