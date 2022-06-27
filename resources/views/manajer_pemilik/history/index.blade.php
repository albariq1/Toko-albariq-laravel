 @extends('template.layouts')
 @section('content')
     <div class="content-wrapper">
         <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1 class="m-0"><i class="fas fa-history mr-2"></i>History Login</h1>
                     </div>
                 </div><!-- /.row -->
             </div><!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->

         <!-- Main content -->
         <section class="content pr-3">
             <div class="col mb-3">
                 <!-- button Download -->
                 <button type="button" class="btn btn-info">
                     Download
                 </button>
             </div>
             <table id="example" class="table table-striped" style="width:100%">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama Lengkap</th>
                         <th>Login Terakhir</th>
                         <th>IP Login Terakhir</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($history as $ht)
                         <tr>
                             <td>{{ $loop->index + 1 }}</td>
                             <td>{{ $ht->name }}</td>
                             <td>{{ $ht->last_login_at }}</td>
                             <td>{{ $ht->last_login_ip }}</td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </section>
     </div>
 @endsection
