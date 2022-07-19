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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-calendar mr-2"></i>Pilih Bulan
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#exampleModaldownload">
                    <i class="fas fa-file-download mr-2"></i>Download PDF
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModaldownload" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Bulan Tahun ini</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form action="{{ route('download_labarugi') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Pilih Bulan</label>
                                            <select name="bulan" id="bulan" class="form-control">
                                                @php
                                                    $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                    $date = date('F');
                                                @endphp
                                                @foreach ($bulan as $bln)
                                                    <option
                                                        value="@if (@$_GET['bulan']) {{ @$_GET['bulan'] }} @else {{ $bln }} @endif ">
                                                        {{ $bln }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Download</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Bulan Tahun ini</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- form pengisian data barang -->
                                <form action="{{ route('laba_rugi') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Pilih Bulan</label>
                                            <select name="bulan" id="bulan" class="form-control">
                                                @php
                                                    $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                    $date = date('F');
                                                @endphp
                                                @foreach ($bulan as $bln)
                                                    <option value="{{ $bln }}">{{ $bln }}</option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Apakah Yang Anda Input Sudah
                                                Benar?</label>
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

                    {{-- <form action="{{ route('laba_rugi') }}" method="GET">
                    <div class="row">
                        <div class="mb-3">
                            <label for="" class="form-label">Pilih Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                @php
                                    $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                    $date = date('F');
                                @endphp
                                @foreach ($bulan as $bln)
                                    <option value="{{ $bln == $bulan ? $bulan : $bln }}">{{ $bln }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form> --}}
                </div>


                <div id="laporan">
                    <table class="table" align="center"
                        style="border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

                    </table>

                    <table border="0" align="center" style=margin-top:5px;margin-bottom:0px;">
                        <tr>
                            <td colspan="2" style="padding-left:20px;">
                                <center>
                                    <h4>LAPORAN LABA / RUGI </h4>
                                </center><br />
                            </td>
                        </tr>

                    </table>

                    <table class="table" border="2" align="center">
                        <tr>
                            <th style="text-align:left"></th>
                        </tr>
                    </table>

                    <table border="1" align="center" class="table" style="margin-bottom:20px;">
                        <thead>
                            <tr>
                                <th colspan="11" style="text-align:left;">Bulan : {{ @$_GET['bulan'] }}</th>
                            </tr>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Harga Pokok</th>
                                <th>Harga Jual</th>
                                <th>Keuntungan Per Unit</th>
                                <th>Item Terjual</th>
                                <th>Diskon</th>
                                <th>Untung Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($result['data'] as $dt)
                                @php
                                    $getBarang = DB::table('barangs')
                                        ->where('id', $dt->barang_id)
                                        ->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $dt->jual_tanggal }}</td>
                                    <td>{{ $getBarang->barcode }} - {{ $getBarang->nama_barang }}</td>
                                    <td>{{ $getBarang->satuan }}</td>
                                    <td>{{ 'Rp ' . number_format($dt->harga_pokok) }}</td>
                                    <td>{{ 'Rp ' . number_format($dt->harga_jual) }}</td>
                                    <td>{{ 'Rp ' . number_format($dt->keunt) }}</td>
                                    <td>{{ $dt->jumlah }}</td>
                                    <td>{{ 'Rp ' . number_format($dt->jual_diskon) }}</td>
                                    <td>{{ 'Rp ' . number_format($dt->untung_bersih) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align:center">Data tidak ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="9" style="text-align:center;"><b>Total Keuntungan</b></td>
                                <td style="text-align:right;">
                                    <b>{{ 'Rp ' . number_format($result['jumlah'][0]->total) }}</b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <table class="table" align="center"
                        style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
                        <tr>
                            <td></td>
                    </table> --}}
                    {{-- <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
                        <tr>
                            <td align="right">Palembang, {{ date('d-F-Y') }}</td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                        </tr>

                        <tr>
                            <td><br /><br /><br /><br /></td>
                        </tr>
                        <tr>
                            <td align="right">( {{ Auth::user()->name }} )</td>
                        </tr>
                        <tr>
                            <td align="center"></td>
                        </tr>
                    </table>
                    <table align="center" class="table"
                        style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
                        <tr>
                            <th><br /><br /></th>
                        </tr>
                        <tr>
                            <th align="left"></th>
                        </tr>
                    </table> --}}
                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
