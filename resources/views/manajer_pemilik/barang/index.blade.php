@extends('template.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-layer-group mr-2"></i>Tabel Barang</h1>
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
                    <i class="fas fa-folder-plus mr-2"></i>Tambah Barang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Barcode</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Pemasok</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Satuan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Harga Beli</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Harga Jual</label>
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
                        <th>Nama barang</th>
                        <th>Barcode</th>
                        <th>Pemasok</th>
                        <th>Stock</th>
                        <th>Return</th>
                        <th>Satuan</th>
                        <th>Harga Beli / Satuan</th>
                        <th>Harga Jual / Satuan</th>
                        <th>Jumlah Terjual</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Minyak Bimoli</td>
                        <td>Indofood</td>
                        <td>061930800802</td>
                        <td>30</td>
                        <td>0</td>
                        <td>PCS</td>
                        <td>Rp.10.000</td>
                        <td>Rp.12.000</td>
                        <td>800</td>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Barang
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form pengisian data barang -->
                                                            <form>
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Nama Barang</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="bimoli" disabled>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputPassword1"
                                                                            class="form-label">Barcode</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputPassword1">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Pemasok</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Satuan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Harga Beli</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Harga Jual</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3 form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="exampleCheck1">
                                                                    <label class="form-check-label"
                                                                        for="exampleCheck1">Apakah Yang Anda Input Sudah
                                                                        Benar?</label>
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Barang
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form pengisian data barang -->
                                                            <form>
                                                                <div class="row">
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1"
                                                                            class="form-label">Nama Barang</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            aria-describedby="emailHelp"
                                                                            placeholder="bimoli">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputPassword1"
                                                                            class="form-label">Barcode</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputPassword1">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Pemasok</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Satuan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Harga Beli</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1"
                                                                        class="form-label">Harga Jual</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleInputPassword1">
                                                                </div>
                                                                <div class="mb-3 form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="exampleCheck1">
                                                                    <label class="form-check-label"
                                                                        for="exampleCheck1">Apakah Yang Anda Input Sudah
                                                                        Benar?</label>
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
                                                Edit
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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
