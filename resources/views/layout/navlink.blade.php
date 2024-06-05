<script>
    $(document).ready(function(){
       let url = window.location.href;
       
       switch(url){
           case "https://nusasystem.com/home" :
               var side = document.getElementById("link-home");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-aset" :
               var side = document.getElementById("link-aset");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-karyawan" :
               var side = document.getElementById("link-karyawan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-rekanan" :
               var side = document.getElementById("link-rekanan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-barang" :
               var side = document.getElementById("link-barang");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-akuntansi" :
               var side = document.getElementById("link-akuntansi");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-aset" :
               var side = document.getElementById("link-aset");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-karyawan" :
               var side = document.getElementById("link-karyawan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-gudang" :
               var side = document.getElementById("link-gudang");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/master-bank" :
               var side = document.getElementById("link-bank");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/pengiriman" :
               var side = document.getElementById("link-pengiriman");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/stock-gudang" :
               var side = document.getElementById("link-stockgudang");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/kartu-stock-gudang" :
               var side = document.getElementById("link-kartustock");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/jurnal-umum" :
               var side = document.getElementById("link-jurnalumum");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/laporan-penjualan" :
               var side = document.getElementById("link-laporanpenjualan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/laporan-pembelian" :
               var side = document.getElementById("link-laporanpembelian");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/jurnal-akuntansi" :
               var side = document.getElementById("link-jurnalakuntansi");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/search-jurnal" :
               var side = document.getElementById("link-rekapjurnal");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/library-image" :
               var side = document.getElementById("link-image");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/log-sistem" :
               var side = document.getElementById("link-log");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/laporan-harian-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-lapmarketing");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/planning-mingguan" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-planmingguan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/database-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-dbmarketing");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/aksi-dbmarketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-aksidbmarketing");
               side.classList.add("active");
               break;
               
           case "https://nusasystem.com/aksi-target-penjualan" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-targetpenjualan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/riwayat-penjualan" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-riwayatpenjualan");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/penjualan-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-penjualanmarketing");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/aktifitas-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-aktifitasmarketing");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/sales-order" :
               var tree = document.getElementById("menu-penjualan");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-penjualan");
               menu.classList.add("active");
               var side = document.getElementById("link-so");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/invoice" :
               var tree = document.getElementById("menu-penjualan");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-penjualan");
               menu.classList.add("active");
               var side = document.getElementById("link-inv");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/surat-jalan" :
               var tree = document.getElementById("menu-penjualan");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-penjualan");
               menu.classList.add("active");
               var side = document.getElementById("link-sj");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/purchase-order" :
               var tree = document.getElementById("menu-pembelian");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-pembelian");
               menu.classList.add("active");
               var side = document.getElementById("link-po");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/material-receive" :
               var tree = document.getElementById("menu-pembelian");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-pembelian");
               menu.classList.add("active");
               var side = document.getElementById("link-mr");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/kas" :
               var tree = document.getElementById("menu-accounting");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-accounting");
               menu.classList.add("active");
               var side = document.getElementById("link-kas");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/jurnal-kas" :
               var tree = document.getElementById("menu-accounting");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-accounting");
               menu.classList.add("active");
               var side = document.getElementById("link-jurnalkas");
               side.classList.add("active");
               break;
           case "https://nusasystem.com/vendor" :
               var side = document.getElementById("link-vendor");
               side.classList.add("active");
               break;
               
           case "http://nusasystem.com/home" :
               var side = document.getElementById("link-home");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-aset" :
               var side = document.getElementById("link-aset");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-karyawan" :
               var side = document.getElementById("link-karyawan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-rekanan" :
               var side = document.getElementById("link-rekanan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-barang" :
               var side = document.getElementById("link-barang");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-akuntansi" :
               var side = document.getElementById("link-akuntansi");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-aset" :
               var side = document.getElementById("link-aset");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-karyawan" :
               var side = document.getElementById("link-karyawan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-gudang" :
               var side = document.getElementById("link-gudang");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/master-bank" :
               var side = document.getElementById("link-bank");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/pengiriman" :
               var side = document.getElementById("link-pengiriman");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/stock-gudang" :
               var side = document.getElementById("link-stockgudang");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/kartu-stock-gudang" :
               var side = document.getElementById("link-kartustock");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/jurnal-umum" :
               var side = document.getElementById("link-jurnalumum");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/laporan-penjualan" :
               var side = document.getElementById("link-laporanpenjualan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/laporan-pembelian" :
               var side = document.getElementById("link-laporanpembelian");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/jurnal-akuntansi" :
               var side = document.getElementById("link-jurnalakuntansi");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/search-jurnal" :
               var side = document.getElementById("link-rekapjurnal");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/library-image" :
               var side = document.getElementById("link-image");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/log-sistem" :
               var side = document.getElementById("link-log");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/laporan-harian-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-lapmarketing");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/planning-mingguan" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-planmingguan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/database-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-dbmarketing");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/aksi-dbmarketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-aksidbmarketing");
               side.classList.add("active");
               break;
               
           case "http://nusasystem.com/aksi-target-penjualan" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-targetpenjualan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/riwayat-penjualan" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-riwayatpenjualan");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/penjualan-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-penjualanmarketing");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/aktifitas-marketing" :
               var tree = document.getElementById("menu-marketing");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-marketing");
               menu.classList.add("active");
               var side = document.getElementById("link-aktifitasmarketing");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/sales-order" :
               var tree = document.getElementById("menu-penjualan");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-penjualan");
               menu.classList.add("active");
               var side = document.getElementById("link-so");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/invoice" :
               var tree = document.getElementById("menu-penjualan");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-penjualan");
               menu.classList.add("active");
               var side = document.getElementById("link-inv");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/surat-jalan" :
               var tree = document.getElementById("menu-penjualan");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-penjualan");
               menu.classList.add("active");
               var side = document.getElementById("link-sj");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/purchase-order" :
               var tree = document.getElementById("menu-pembelian");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-pembelian");
               menu.classList.add("active");
               var side = document.getElementById("link-po");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/material-receive" :
               var tree = document.getElementById("menu-pembelian");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-pembelian");
               menu.classList.add("active");
               var side = document.getElementById("link-mr");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/kas" :
               var tree = document.getElementById("menu-accounting");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-accounting");
               menu.classList.add("active");
               var side = document.getElementById("link-kas");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/jurnal-kas" :
               var tree = document.getElementById("menu-accounting");
               tree.classList.add("menu-open");
               var menu = document.getElementById("link-accounting");
               menu.classList.add("active");
               var side = document.getElementById("link-jurnalkas");
               side.classList.add("active");
               break;
           case "http://nusasystem.com/vendor" :
               var side = document.getElementById("link-vendor");
               side.classList.add("active");
               break;
       }
        
    });
</script>