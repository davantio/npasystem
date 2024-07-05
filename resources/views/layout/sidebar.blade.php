<!-- MAIN content sidebar -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{!! url("home") !!}" class="brand-link">
        <img src="{{asset('img')}}/logo.png"  class="brand-image img-square elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><h6> CV. Nusa Pratama Anugerah</h6></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
            <a href="#" class="d-block"><b>{{$detail->nama}}</b></a>
        </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            @if($user->level == 'admin')
            <div class="admin">
                <li class="nav-item ">
                    <button type="button" class="btn btn-success" id="update-hpp">
                        <i class="nav-icon fas fa-dollar-sign"></i>&nbsp;&nbsp;Update HPP
                    </button>
                </li>
                <li class="nav-item">
                    <a id="link-home" href="{!! url("home") !!}" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                 <!-- Penjualan -->
                <li id="menu-penjualan" class="nav-item">
                    <a id="link-penjualan" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Penjualan
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-so" href="{!! url("sales-order") !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-inv" href="{!! url("invoice") !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-sj" href="{!! url("surat-jalan") !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-penjualanmarketing" href="{!! url("penjualan-marketing") !!}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                Penjualan Marketing
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Pembelian -->
                <li id="menu-pembelian" class="nav-item">
                    <a id="link-pembelian" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                        Pembelian
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a id="link-po" href="{!! url("purchase-order") !!}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchase Order</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a id="link-mr" href="{!! url("material-receive") !!}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Material Receive</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <!-- Accounting -->
                <li id="menu-accounting" class="nav-item">
                    <a id="link-accounting" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-kas" href="{!! url("kas") !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk/Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-jurnalkas" href="{!! url("jurnal-kas") !!}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jurnal Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a id="link-tender" href="{!! url("tender") !!}" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Tender
                        </p>
                    </a>
                </li>
                <li class="nav-header">INVENTORY</li>
                <li class="nav-item">
                    <a id="link-stockgudang" href="{!! url("stock-gudang") !!}" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-kartustock" href="{!! url("kartu-stock-gudang") !!}" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>

                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a id="link-laporanpenjualan" href="{!! url("laporan-penjualan") !!}" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-laporanpembelian" href="{!! url("laporan-pembelian") !!}" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-jurnalakuntansi" href="{!! url("jurnal-akuntansi") !!}" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-rekapjurnal" href="{!! url("search-jurnal") !!}" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Rekap Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-bukubesar" href="{!! url("laporan-bukubesar") !!}" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Buku Besar</p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                    <li class="nav-item">
                        <a id="link-karyawan" href="{!! url("master-karyawan") !!}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Karyawan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-rekanan" href="{!! url("master-rekanan") !!}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Data Rekanan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-barang" href="{!! url("master-barang") !!}" class="nav-link">
                            <i class="nav-icon fab fa-dropbox"></i>
                            <p>
                            Data Barang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-akuntansi" href="{!! url("master-akuntansi") !!}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Data Perkiraan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-gudang" href="{!! url("master-gudang") !!}" class="nav-link">
                            <i class="fas fa-warehouse nav-icon"></i>
                            <p>Data Gudang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-bank" href="{!! url("master-bank") !!}" class="nav-link">
                            <i class="fas fa-piggy-bank nav-icon"></i>
                            <p>Data Bank</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-aset" href="{{ url('master-aset') }}" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-vendor" href="{!! url("vendor") !!}" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Data Vendor
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-pengiriman" href="{!! url("pengiriman") !!}" class="nav-link">
                            <i class="fas fa-truck fa-beat nav-icon"></i>
                            <p>Harga Pengiriman</p>
                        </a>
                    </li>

                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! url("logout") !!}" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == 'purchasing')
            <div class="purchasing">
                <li class="nav-item ">
                    <button type="button" class="btn btn-success" id="update-hpp">
                        <i class="nav-icon fas fa-dollar-sign"></i>&nbsp;&nbsp;Update HPP
                    </button>
                </li>
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li id="menu-pembelian" class="nav-item">
                    <a id="link-pembelian" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                        Pembelian
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a id="link-po" href="purchase-order" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchase Order</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a id="link-mr" href="material-receive" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Material Receive</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li id="menu-accounting" class="nav-item">
                    <a id="link-accounting" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-kas" href="kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk/Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-jurnalkas" href="jurnal-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jurnal Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">INVENTORY</li>
                <li class="nav-item">
                    <a id="link-stockgudang" href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-kartustock" href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>

                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a id="link-laporanpembelian" href="laporan-pembelian" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Pembelian</p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                    <li class="nav-item">
                        <a id="link-rekanan" href="master-rekanan" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Data Rekanan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-barang" href="master-barang" class="nav-link">
                            <i class="nav-icon fab fa-dropbox"></i>
                            <p>
                            Data Barang
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-pengiriman" href="pengiriman" class="nav-link">
                            <i class="fas fa-truck fa-beat nav-icon"></i>
                            <p>Harga Pengiriman</p>
                        </a>
                    </li>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == 'accounting')
            <div class="accounting">
                <li class="nav-item ">
                    <button type="button" class="btn btn-success" id="update-hpp">
                        <i class="nav-icon fas fa-dollar-sign"></i>&nbsp;&nbsp;Update HPP
                    </button>
                </li>
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li id="menu-pembelian" class="nav-item">
                    <a id="link-pembelian" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                        Pembelian
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a id="link-po" href="purchase-order" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchase Order</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a id="link-mr" href="material-receive" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Material Receive</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li id="menu-accounting" class="nav-item">
                    <a id="link-accounting" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-kas" href="kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk/Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-jurnalkas" href="jurnal-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jurnal Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">INVENTORY</li>
                <li class="nav-item">
                    <a id="link-stockgudang" href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-kartustock" href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>

                <li class="nav-header">LAPORAN KEUANGAN</li>
                <li class="nav-item">
                    <a href="laporan-penjualan" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-jurnalakuntansi" href="jurnal-akuntansi" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-rekapjurnal" href="search-jurnal" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Rekap Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-bukubesar" href="laporan-bukubesar" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Buku Besar</p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                    <li class="nav-item">
                        <a id="link-aset" href="{{ url('master-aset') }}" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>
                                Data Aset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-bank" href="master-bank" class="nav-link">
                            <i class="fas fa-piggy-bank nav-icon"></i>
                            <p>Data Bank</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="link-akuntansi" href="master-akuntansi" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Data Perkiraan
                            </p>
                        </a>
                    </li>
                </li>

                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == 'superadmin' ||$user->level == 'ceo' || $user->level == 'manager-admin')
            <div class="superadmin">
                <li class="nav-item ">
                    <button type="button" class="btn btn-success" id="update-hpp">
                        <i class="nav-icon fas fa-dollar-sign"></i>&nbsp;&nbsp;Update HPP
                    </button>
                </li>
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <!-- Marketing -->
                <li id="menu-marketing" class="nav-item">
                    <a id="link-marketing" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                        Marketing
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a id="link-lapmarketing" href="laporan-harian-marketing" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Laporan harian Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-planmingguan" href="planning-mingguan" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Planning Mingguan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-dbmarketing" href="database-marketing" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Database Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-aksidbmarketing" href="aksi-dbmarketing" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Data Aksi DB Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-targetpenjualan" href="aksi-target-penjualan" class="nav-link">
                                <i class="nav-icon fas fa-bullseye"></i>
                                <p>
                                    Data Target Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-riwayatpenjualan" href="riwayat-penjualan" class="nav-link">
                                <i class="nav-icon  fas fa-history"></i>
                                <p>
                                Riwayat Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-penjualanmarketing" href="penjualan-marketing" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                Penjualan Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-aktifikasmarketing" href="aktifitas-marketing" class="nav-link">
                                <i class="nav-icon fas fa-burn	"></i>
                                <p>
                                Aktifitas Marketing
                                </p>
                            </a>
                        </li>

                    </ul>

                </li>
                <!-- Penjualan -->
                <li id="menu-penjualan" class="nav-item">
                    <a id="link-penjualan" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Penjualan
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-so" href="sales-order" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-inv" href="invoice" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-sj" href="surat-jalan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Pembelian -->
                <li id="menu-pembelian" class="nav-item">
                    <a id="link-pembelian" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                        Pembelian
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a id="link-po" href="purchase-order" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchase Order</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a id="link-mr" href="material-receive" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Material Receive</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <!-- Accounting -->
                <li id="menu-accounting" class="nav-item">
                    <a id="link-accounting" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-kas" href="kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk/Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-jurnalkas" href="jurnal-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jurnal Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a id="link-tender" href="tender" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Tender
                        </p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a id="link-aset" href="{{ url('master-aset') }}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Data Aset
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-karyawan" href="master-karyawan" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Karyawan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-rekanan" href="master-rekanan" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Data Rekanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-barang" href="master-barang" class="nav-link">
                        <i class="nav-icon fab fa-dropbox"></i>
                        <p>
                        Data Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                <a id="link-akuntansi" href="master-akuntansi" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Data Perkiraan
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a id="link-gudang" href="master-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p>Data Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-bank" href="master-bank" class="nav-link">
                        <i class="fas fa-piggy-bank nav-icon"></i>
                        <p>Data Bank</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-vendor" href="vendor" class="nav-link">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Data Vendor
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-pengiriman" href="pengiriman" class="nav-link">
                        <i class="fas fa-truck fa-beat nav-icon"></i>
                        <p>Harga Pengiriman</p>
                    </a>
                </li>
                <li class="nav-header">INVENTORY</li>
                <li class="nav-item">
                    <a id="link-stockgudang" href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-kartustock" href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-header">LAPORAN KEUANGAN</li>
                <li class="nav-item">
                    <a id="link-jurnalumum" href="jurnal-umum" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Jurnal Umum</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-laporanpenjualan" href="laporan-penjualan" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-laporanpembelian" href="laporan-pembelian" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Pembelian</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="link-laporanpembelian" href="lpj-marketing" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Marketing</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a id="link-jurnalakuntansi" href="jurnal-akuntansi" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-rekapjurnal" href="search-jurnal" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Rekap Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-bukubesar" href="laporan-bukubesar" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Buku Besar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-piutangusaha" href="laporan-piutangusaha" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Piutang Usaha</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a id="link-neraca" href="neraca" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Neraca</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a id="link-labarugi" href="laporan-labarugi" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Laba Rugi</p>
                    </a>
                </li> --}}
                <li class="nav-header">Tools</li>
                <li class="nav-item">
                    <a id="link-image" href="library-image" class="nav-link">
                        <i class="fas fa-image nav-icon"> </i>
                        <p>Library-Image</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-log" href="log-sistem" class="nav-link">
                        <i class="fas fa-history nav-icon"> </i>
                        <p>Log Sistem</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == 'staff-gudang' || $user->level == 'manager-operasional')
            <div class="gudang">
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-mr" href="material-receive" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Material Receive</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-sj" href="surat-jalan" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Surat Jalan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-vendor" href="vendor" class="nav-link">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Data Vendor
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-aset" href="{{ url('master-aset') }}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Data Aset
                        </p>
                    </a>
                </li>
                <li class="nav-header">INVENTORY</li>
                <li class="nav-item">
                    <a id="link-stockgudang" href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-kartustock" href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == 'manager-marketing')
            <div class="manager-marketing">
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <!-- Marketing -->
                <li id="menu-marketing" class="nav-item">
                    <a id="link-marketing" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                        Marketing
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a id="link-tender" href="tender" class="nav-link">
                                <i class="nav-icon fas fa-balance-scale"></i>
                                <p>
                                    Tender
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-lapmarketing" href="laporan-harian-marketing" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Laporan harian Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-planmingguan" href="planning-mingguan" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Planning Mingguan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-dbmarketing" href="database-marketing" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Database Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-aksidbmarketing" href="aksi-dbmarketing" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Data Aksi DB Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-targetpenjualan" href="aksi-target-penjualan" class="nav-link">
                                <i class="nav-icon fas fa-bullseye"></i>
                                <p>
                                    Data Target Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-riwayatpenjualan" href="riwayat-penjualan" class="nav-link">
                                <i class="nav-icon  fas fa-history"></i>
                                <p>
                                Riwayat Penjualan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-penjualanmarketing" href="penjualan-marketing" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                Penjualan Marketing
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="link-aktifikasmarketing" href="aktifitas-marketing" class="nav-link">
                                <i class="nav-icon fas fa-burn	"></i>
                                <p>
                                Aktifitas Marketing
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == 'marketing')
            <div class="marketing">
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-lapmarketing" href="laporan-harian-marketing" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Laporan harian Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-planmingguan" href="planning-mingguan" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Planning Mingguan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-dbmarketing" href="database-marketing" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Database Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-tender" href="tender" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Tender
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="omset" class="nav-link">
                        <i class="nav-icon 	fas fa-dollar-sign"></i>
                        <p>
                        Omset Bulan ini
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-riwayatpenjualan" href="riwayat-penjualan" class="nav-link">
                        <i class="nav-icon  fas fa-history"></i>
                        <p>
                        Riwayat Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-pengiriman" href="pengiriman" class="nav-link">
                        <i class="fas fa-truck fa-beat nav-icon"></i>
                        <p>Harga Pengiriman</p>
                    </a>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @elseif($user->level == "admin-marketing")
            <div class="admin-marketing">
                <li class="nav-item">
                    <a id="link-home" href="home" class="nav-link" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-tender" href="tender" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Tender
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-so" href="sales-order" class="nav-link">
                        <i class="nav-icon 	fas fa-money-bill-wave"></i>
                        <p>Sales Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-lapmarketing" href="laporan-harian-marketing" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Laporan harian Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-planmingguan" href="planning-mingguan" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Planning Mingguan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-dbmarketing" href="database-marketing" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Database Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-aksidbmarketing" href="aksi-dbmarketing" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Data Aksi DB Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-targetpenjualan" href="aksi-target-penjualan" class="nav-link">
                        <i class="nav-icon fas fa-bullseye"></i>
                        <p>
                            Data Target Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-aktifikasmarketing" href="aktifitas-marketing" class="nav-link">
                        <i class="nav-icon fas fa-burn	"></i>
                        <p>
                        Aktifitas Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-penjualanmarketing" href="penjualan-marketing" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                        Penjualan Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-riwayatpenjualan" href="riwayat-penjualan" class="nav-link">
                        <i class="nav-icon  fas fa-history"></i>
                        <p>
                        Riwayat Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-rekanan" href="master-rekanan" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Data Rekanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-barang" href="master-barang" class="nav-link">
                        <i class="nav-icon fab fa-dropbox"></i>
                        <p>
                        Data Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="link-pengiriman" href="pengiriman" class="nav-link">
                        <i class="fas fa-truck fa-beat nav-icon"></i>
                        <p>Harga Pengiriman</p>
                    </a>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </div>
            @endif

            @include('layout/navlink')
            @if($user->level == 'superadmin' || $user->level == 'ceo' || $user->level == 'manager-admin' ||$user->level == 'admin' || $user->level == 'purchasing' || $user->level == 'accounting')

            <script>
            $(document).ready(function(){
                var currentURL = window.location.href;
                console.log(currentURL);
                var myButton = document.getElementById("update-hpp");
                if(currentURL == "https://nusasystem.com/home"){
                    $('#update-hpp').prop('disabled',false);
                    $('#update-hpp').show();
                    // Mengubah kelas dari btn-success ke btn-warning
                    myButton.classList.remove("btn-danger");
                    myButton.classList.add("btn-success");
                } else {
                    $('#update-hpp').prop('disabled',true);
                    // Mengubah kelas dari btn-success ke btn-warning
                    myButton.classList.remove("btn-success");
                    myButton.classList.add("btn-danger");
                    $('#update-hpp').hide();
                }
            });

            </script>
            @endif
            <!-- <li class="nav-item ">
                <a href="main" class="nav-link " >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard </p>
                </a>
            </li>
            <li class="nav-item">
            <a href="marketing" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Laporan Marketing

                </p>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Penjualan
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="sales-order" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sales Order</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="invoice" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Invoice</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="surat-jalan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Surat Jalan</p>
                </a>
                </li>

            </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="nav-icon fa fa-shopping-cart"></i>
                    <p>
                    Pembelian
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="purchase-order" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Purchase Order</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="material-receive" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Material Receive</p>
                    </a>
                    </li>


                </ul>
            </li>
            <li class="nav-header">DATA MASTER</li>
            <li class="nav-item">
            <a href="data-karyawan" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Data Karyawan

                </p>
            </a>
            </li>
            <li class="nav-item">
                <a href="data-rekanan" class="nav-link">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>
                    Data Rekanan

                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="data-barang" class="nav-link">
                    <i class="nav-icon fab fa-dropbox"></i>
                    <p>
                    Data Barang

                    </p>
                </a>
            </li>
            <li class="nav-item">
            <a href="data-kode-akuntasi" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                Data Perkiraan
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a  class="nav-link">
                <i class="nav-icon fa fa-plus"></i>
                <p>
                Data Tambahan
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="data-gudang" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Gudang</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="data-bank" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Bank</p>
                </a>
                </li>
            </ul>
            </li>

            <li class="nav-header">Laporan Keuangan</li>
            <li class="nav-item">
            <a href="iframe.html" class="nav-link">
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>Tabbed IFrame Plugin</p>
            </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                    Mailbox
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="pages/mailbox/mailbox.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inbox</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="pages/mailbox/compose.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Compose</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Read</p>
                    </a>
                    </li>
                </ul>
                </li>
            <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Documentation</p>
            </a>
            </li> -->

        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
