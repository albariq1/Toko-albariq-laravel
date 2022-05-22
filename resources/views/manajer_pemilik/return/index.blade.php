 @extends('template.layouts')
 @section('content')
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1 class="m-0"><i class="fas fa-exchange-alt mr-2"></i>Tabel Return</h1>
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
                                 <form>
                                     <div class="row">
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Nama Barang
                                                 Return</label>
                                             <input type="text" class="form-control" id="exampleInputEmail1"
                                                 aria-describedby="emailHelp">
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputEmail1" class="form-label">Barcode</label>
                                             <input type="text" class="form-control" id="exampleInputEmail1"
                                                 aria-describedby="emailHelp">
                                         </div>
                                         <div class="mb-3">
                                             <label for="exampleInputPassword1" class="form-label">Nama Pemasok</label>
                                             <input type="text" class="form-control" id="exampleInputPassword1">
                                         </div>
                                     </div>
                                     <div class="mb-3">
                                         <label for="exampleInputPassword1" class="form-label">Jumlah Return</label>
                                         <input type="text" class="form-control" id="exampleInputPassword1">
                                     </div>
                                     <div class="mb-3">
                                         <label for="exampleInputPassword1" class="form-label">Alasan</label>
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
                 </div>
                 <button type="button" class="btn btn-info">
                     Print
                 </button>
             </div>
             <table id="example" class="table table-striped" style="width:100%">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama Barang</th>
                         <th>Barcode</th>
                         <th>Nama Pemasok</th>
                         <th>Jumlah Return</th>
                         <th>Alasan</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>1</td>
                         <td>Bimoli</td>
                         <td>061930800802</td>
                         <td>Indofood</td>
                         <td>8</td>
                         <td>Barang Expired</td>
                         <td>
                             <a href=""><i class="fas fa-check"></i></a>
                             <!-- <a href="" class="btn btn-primary">Detail</a>
                                    <a href="" class="btn btn-warning">Ubah</a>
                                    <a href="" class="btn btn-danger">Hapus</a> -->
                         </td>
                     </tr>
                 </tbody>
             </table>
         </section>
         <!-- /.content -->
     </div>
 @endsection
