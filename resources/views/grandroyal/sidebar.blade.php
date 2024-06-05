<!-- MAIN content sidebar -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        <img src="https://image.pngaaa.com/108/5561108-middle.png"  class="brand-image" style="opacity: .8">
        <span class=""><h6>Grand Royal Hall Harmoni</h6></span>
        
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
            <a href="#" class="d-block"><b>{{$detail->nama}} AS {{$user->level}}</b></a>
        </div>
        </div>
    
        <!-- SidebarSearch Form -->
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            @if($user->level == 'adminroyal')
            <div class="adminroyal">
                <li class="nav-item ">
                    <a href="grandroyal/home" class="nav-link " >
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a href="grandroyal/penjualan" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="grandroyal/pembelian" class="nav-link">
                        <i class="nav-icon fas fa-cart"></i>
                        <p>
                            Pembelian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="grandroyal/data-master" class="nav-link">
                        <i class="nav-icon far fa-database"></i>
                        <p>
                            Data Master
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="grandroyal/data-member" class="nav-link">
                        <i class="nav-icon fab fa-users"></i>
                        <p>
                            Data Member
                        </p>
                    </a>
                </li>
            </div>
            @elseif($user->level == 'superadmin')
            <div class="superadmin">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                    <a href="penjualan" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pembelian" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pembelian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="data-master" class="nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Data Master
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="data-member" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Member
                        </p>
                    </a>
                </li>
                <li class="nav-header">Tools</li>
                <li class="nav-item">
                    <a href="log-sistem" class="nav-link">
                        <i class="fas fa-history nav-icon"> </i>
                        <p>Log Sistem</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"> </i>
                        <p>Log Out</p>
                    </a>
                </li>
            </div>
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