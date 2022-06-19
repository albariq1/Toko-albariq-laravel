@extends('template.layouts')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-dollar-sign mr-2"></i>Laporan Laba rugi</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pr-3">
            <div class="col mb-3">
                <button type="button" class="btn btn-info">
                    Print
                </button>
            </div>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Penjualan</th>
                        <th>Jumlah Modal</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>14-06-2022</td>
                        <td>Rp.100.000.000</td>
                        <td>Rp.90.000.000</td>
                        <td>Rp.10.000.000</td>
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
                                                data-bs-target="#exampleModal">
                                                Detail
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                Penjualan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form pengisian data barang -->
                                                            <form>
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Code</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="bimoli" disabled>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputPassword1"
                                                                            class="form-label">Nama Pelanggan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputPassword1">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Nama Admin</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Jam</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Tanggal</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Jumlah Item yang
                                                                        Dibeli</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Jumlah Transaksi</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Tambah</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col mb-3">
                                            <!-- button tambah barang -->
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                Pelanggan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form pengisian data barang -->
                                                            <form>
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Nama Pelanggan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="bimoli">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputPassword1"
                                                                            class="form-label">Alamat</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputPassword1">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">No Hp</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Tambah</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col mb-3">
                                            <button type="button" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!-- /.content -->
    </div>
@endsection
