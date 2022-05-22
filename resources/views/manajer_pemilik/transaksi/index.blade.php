@extends('template.layouts')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="nav-icon fas fa-cash-register mr-2"></i>Transaksi</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row justify-content-around ml-3">
            <div class="col-4">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header">Form Input Penjual</h3>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Nama Pelanggan</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Nama Barang</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Jumlah</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Harga Satuan</label>
                                <input type="text" class="form-control" style="width:30% ;" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="font-weight: normal ;">Total Harga</label>
                                <input type="text" class="form-control" style="width:30% ;" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card" style="width: 100%;">
                    <h3 class="card-header">Daftar Barang Penjualan</h3>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga Satuan</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Bimoli</td>
                                    <td>5</td>
                                    <td>Rp.10.000</td>
                                    <td>Rp.50.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row card-footer pt-2">
                        <h4 class="card-title mr-1 pt-1">Total Harga Belanjaan : </h4>
                        <h4>Rp.50.000</h4>
                        <button class="btn btn-primary ml-auto"> Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
