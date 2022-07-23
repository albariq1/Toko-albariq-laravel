<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('template/./assest/LOGO ALBARIQ.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TOKO ALBARIQ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->foto == '' || Auth::user()->foto == null)
                    <img class="img-circle elevation-2" src="http://bootdey.com/img/Content/avatar/avatar1.png"
                        alt="User Image">
                @else
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('home') }}" class="nav-link {{ set_active('home') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kasir.transaksi') }}" class="nav-link {{ set_active('kasir.transaksi') }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Transaksi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ set_active(['tabel_pemasok', 'tabel_kategori', 'tabel_barang', 'tabel_return', 'tabel_kehilangan']) }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Data Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tabel_pemasok') }}"
                                class="nav-link {{ set_active('tabel_pemasok') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Pemasok</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tabel_kategori') }}"
                                class="nav-link {{ set_active('tabel_kategori') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tabel_barang') }}"
                                class="nav-link {{ set_active('tabel_barang') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tabel_return') }}"
                                class="nav-link {{ set_active('tabel_return') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Return</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tabel_kehilangan') }}"
                                class="nav-link {{ set_active('tabel_kehilangan') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Kehilangan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ set_active(['tabel_penjualan', 'tabel_pembelian_barang']) }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Data Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tabel_penjualan') }}"
                                class="nav-link {{ set_active('tabel_penjualan') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Penjualan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tabel_pembelian_barang') }}"
                                class="nav-link {{ set_active('tabel_pembelian_barang') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Pembelian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tabel_pelanggan') }}" class="nav-link {{ set_active('tabel_pelanggan') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Pelanggan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laba_rugi') }}" class="nav-link {{ set_active('laba_rugi') }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Laporan Laba Rugi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ set_active(['tabel_user', 'tabel_history']) }}">
                        <i class="nav-icon fas far fa-user"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('tabel_user') }}" class="nav-link {{ set_active('tabel_user') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tabel_history') }}"
                                class="nav-link {{ set_active('tabel_history') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel History</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting') }}" class="nav-link {{ set_active('setting') }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
