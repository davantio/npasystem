<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\POController;
use App\Http\Controllers\SOController;
use App\Http\Controllers\MRController;
use App\Http\Controllers\SJController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DetailPOController;
use App\Http\Controllers\DetailMRController;
use App\Http\Controllers\DetailSOController;
use App\Http\Controllers\DetailSJController;
use App\Http\Controllers\DetailInvController;
use App\Http\Controllers\DetailLaporanController;
use App\Http\Controllers\RekananController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DetailKasController;
use App\Http\Controllers\HppController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LapMarketingController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogSistemController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PlanMarketingController;
use App\Http\Controllers\DB_marketingController;
use App\Http\Controllers\Aksi_dbmarketingController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\Target_MarketingController;
use App\Http\Controllers\Target_OmsetController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\InstansiTenderController;
use App\Http\Controllers\PejabatTenderController;
use App\Http\Controllers\KodeAkuntansiController;

use App\Http\Controllers\TenderInstansiController;
use App\Http\Controllers\SubinstansiTenderController;
use App\Http\Controllers\BaranginController;
use App\Http\Controllers\BarangoutController;

//Grand Royal
use App\Http\Controllers\RoyalController;
use App\Http\Controllers\TenderSubnstansiController;
use Illuminate\Support\Facades\Route;



use App\Models\karyawan;
use App\Models\gudang;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Test login
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->middleware(('auth'));
    Route::get('/login', 'index')->name('login');

    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['CekUserLogin:admin']], function () {
        Route::get('admin', [AdminController::class, 'index'])->middleware('auth');
    });
    Route::group(['middleware' => ['CekUserLogin:marketing']], function () {
        Route::resource('/marketing', MarketingController::class);
    });
});
Route::get('/inv-herbivor/{inv}', [LayoutController::class, 'inv_hsn'])->middleware('auth');
Route::get('/test', function () {
    return view('test');
});
// End Test Login
Route::get('/', function () {
    return view('login');
});
Route::get('/info', function () {
    return view('info');
});
Route::get('/absensi', function () {
    return view('absensi');
});
Route::get('/cek-lokasi', [KaryawanController::class, 'cek_lokasi']);
//GRAND ROYAL
Route::get('/grandroyal', function () {
    return view('grandroyal/index');
});
Route::get('/grandroyal/home', [LayoutController::class, 'grandroyal_home'])->middleware('auth');
Route::get('/grandroyal/data-master', [LayoutController::class, 'grandroyal_datamaster'])->middleware('auth');
Route::get('/grandroyal/data-member', [LayoutController::class, 'grandroyal_datamember'])->middleware('auth');
Route::get('/grandroyal/penjualan', [LayoutController::class, 'grandroyal_penjualan'])->middleware('auth');
Route::get('/grandroyal/pembelian', [LayoutController::class, 'grandroyal_pembelian'])->middleware('auth');
Route::get('/grandroyal/jadwal', [LayoutController::class, 'grandroyal_jadwal'])->middleware('auth');
//Login
Route::post('/grandroyal/login', [RoyalController::class, 'login']);
Route::get('/grandroyal/logout', [RoyalController::class, 'logout']);

//END of GRAND ROYAL
//Halaman
Route::get('/home', [LayoutController::class, 'index'])->middleware('auth');

Route::get('/marketing', [LayoutController::class, 'laporan_marketing'])->middleware('auth');
Route::get('/laporan-harian-marketing', [LayoutController::class, 'laporan_harian_marketing'])->middleware('auth');
Route::get('/laporan-marketing', [LayoutController::class, 'laporan_marketing'])->middleware('auth');
Route::get('/master-karyawan', [LayoutController::class, 'data_karyawan'])->middleware('auth');
Route::get('/master-rekanan', [LayoutController::class, 'data_rekanan'])->middleware('auth');
Route::get('/cetak-po', [LayoutController::class, 'cetak_po'])->middleware('auth');
Route::get('/cetak-so', [LayoutController::class, 'cetak_so'])->middleware('auth');
Route::get('/cetak-sj', [LayoutController::class, 'cetak_sj'])->middleware('auth');
Route::get('/cetak-mr', [LayoutController::class, 'cetak_mr'])->middleware('auth');
Route::get('/cetak-invoice', [LayoutController::class, 'cetak_invoice'])->middleware('auth');
Route::get('/master-barang', [LayoutController::class, 'data_barang'])->middleware('auth');
Route::get('/master-akuntansi', [LayoutController::class, 'data_akuntansi'])->middleware('auth');
Route::get('/master-asset', [LayoutController::class, 'data_asset'])->middleware('auth');
Route::get('/master-gudang', [LayoutController::class, 'data_gudang'])->middleware('auth');
Route::get('/purchase-order', [LayoutController::class, 'purchaseorder'])->middleware('auth');
Route::get('/material-receive', [LayoutController::class, 'materialreceive'])->middleware('auth');
Route::get('/sales-order', [LayoutController::class, 'salesorder'])->middleware('auth');
Route::get('/newsales-order', [LayoutController::class, 'newsalesorder'])->middleware('auth');
Route::get('/invoice', [LayoutController::class, 'invoice'])->middleware('auth');
Route::get('/master-bank', [LayoutController::class, 'data_bank'])->middleware('auth');
Route::get('/surat-jalan', [LayoutController::class, 'suratjalan'])->middleware('auth');
Route::get('/planning-mingguan', [LayoutController::class, 'plan_marketing'])->middleware(('auth'));
Route::get('/laporan-penjualan ', [LayoutController::class, 'laporan_penjualan'])->middleware(('auth'));
Route::get('/lpj-marketing ', [LayoutController::class, 'lpj_marketing'])->middleware(('auth'));
Route::get('/stock-gudang', [LayoutController::class, 'stock_gudang'])->middleware(('auth'));
Route::get('/kartu-stock-gudang', [LayoutController::class, 'kartu_stock_gudang'])->middleware(('auth'));
Route::get('/barang-keluar', [LayoutController::class, 'barang_keluar'])->middleware(('auth'));
Route::get('/barang-masuk', [LayoutController::class, 'barang_masuk'])->middleware(('auth'));
Route::get('/kas', [LayoutController::class, 'kas'])->middleware(('auth'));
Route::get('/jurnal-kas', [LayoutController::class, 'jurnal_kas'])->middleware(('auth'));
Route::get('/jurnal-akuntansi', [LayoutController::class, 'jurnal_akuntansi'])->middleware(('auth'));
Route::get('/laporan-kas', [LayoutController::class, 'laporan_kas'])->middleware(('auth'));
Route::get('/laporan-bukubesar', [LayoutController::class, 'laporan_bukubesar'])->middleware(('auth'));
Route::get('/search-jurnal', [LayoutController::class, 'search_jurnal'])->middleware(('auth'));
Route::get('/database-marketing', [LayoutController::class, 'database_marketing'])->middleware(('auth'));
Route::get('/aksi-dbmarketing', [LayoutController::class, 'aksi_dbmarketing'])->middleware(('auth'));
Route::get('/riwayat-penjualan', [LayoutController::class, 'riwayatpenjualan'])->middleware(('auth'));
Route::get('/log-sistem', [LayoutController::class, 'logsistem'])->middleware(('auth'));
Route::get('/penjualan-marketing', [LayoutController::class, 'penjualanmarketing'])->middleware(('auth'));
Route::get('/master-aset', [LayoutController::class, 'aset'])->middleware(('auth'));
Route::get('/tipe-aset/{tipe}', [LayoutController::class, 'aset_tipe'])->middleware(('auth'));

Route::get('/aksi-target-penjualan', [LayoutController::class, 'target_penjualan'])->middleware(('auth'));
Route::get('/aksi-db-marketing', [LayoutController::class, 'aksi_dbmarketing'])->middleware(('auth'));
Route::get('/aktifitas-marketing', [LayoutController::class, 'aktifitas_marketing'])->middleware('auth');
Route::get('/jurnal-umum', [LayoutController::class, 'jurnalumum'])->middleware('auth');
Route::get('/pengiriman', [LayoutController::class, 'pengiriman'])->middleware('auth');
Route::get('/laporan-pembelian', [LayoutController::class, 'lap_pembelian'])->middleware('auth');
Route::get('/library-image', [LayoutController::class, 'library_image'])->middleware('auth');
Route::get('/laporan-piutangusaha', [LayoutController::class, 'laporanpiutang'])->middleware('auth');
Route::get('/vendor', [LayoutController::class, 'vendor'])->middleware('auth');


Route::get('/neraca', [LayoutController::class, 'neraca'])->middleware(('auth'));
Route::get('data-neraca', [JurnalController::class, 'data_neraca'])->middleware('auth');

Route::get('/laporan-labarugi', [LayoutController::class, 'laporan_labarugi'])->middleware(('auth'));
Route::get('data-labarugi', [JurnalController::class, 'data_labarugi'])->middleware('auth');

//route data master
Route::post('datakaryawan/{kode}', [KaryawanController::class, 'ubah'])->middleware('auth');
Route::get('ubah-status-karyawan/{kode}', [KaryawanController::class, 'ubah_status'])->middleware('auth');
Route::resource('data-karyawan', KaryawanController::class)->middleware('auth');
Route::resource('data-gudang', GudangController::class)->middleware('auth');
Route::resource('data-barang', BarangController::class)->middleware('auth');
Route::resource('data-rekanan', RekananController::class)->middleware('auth');
Route::resource('data-bank', BankController::class)->middleware('auth');
Route::resource('data-po', POController::class)->middleware('auth');
Route::resource('data-detailpo', DetailPOController::class)->middleware('auth');
Route::resource('data-author', AuthorController::class)->middleware('auth');
Route::resource('data-mr', MRController::class)->middleware('auth');
Route::resource('data-detailmr', DetailMRController::class)->middleware('auth');
Route::resource('data-so', SOController::class)->middleware('auth');
Route::resource('data-detailso', DetailSOController::class)->middleware('auth');
Route::resource('data-sj', SJController::class)->middleware('auth');
Route::resource('data-detailsj', DetailSJController::class)->middleware('auth');
Route::resource('data-inv', InvoiceController::class)->middleware('auth');
Route::resource('data-detailinv', DetailInvController::class)->middleware('auth');
Route::resource('data-akuntansi', KodeAkuntansiController::class)->middleware('auth');
Route::resource('data-lapmarketing', LapMarketingController::class);
Route::resource('data-detail-laporan', DetailLaporanController::class)->middleware('auth');
Route::resource('data-detailkas', DetailKasController::class)->middleware('auth');
Route::resource('jurnal', JurnalController::class)->middleware('auth');
Route::resource('data-kas', KasController::class)->middleware('auth');
Route::resource('data-hpp', HppController::class)->middleware('auth');
Route::resource('data-dbmarketing', DB_marketingController::class)->middleware('auth');
Route::resource('data-aksidbmarketing', Aksi_dbmarketingController::class)->middleware('auth');
Route::resource('data-planmarketing', PlanMarketingController::class)->middleware('auth');
Route::resource('data-logsistem', LogSistemController::class)->middleware('auth');
Route::resource('data-aset', AsetController::class)->middleware(('auth'));
Route::get('aset-tipe/{kode}', [AsetController::class, 'detail_aset'])->middleware(('auth'));

Route::post('update-aset/{id}', [AsetController::class, 'ubah'])->middleware(('auth'));
Route::resource('data-pengiriman', PengirimanController::class)->middleware(('auth'));
Route::resource('data-target-marketing', Target_MarketingController::class)->middleware('auth');
Route::resource('data-target-omset', Target_OmsetController::class)->middleware('auth');
Route::resource('data-library-image', ImageController::class)->middleware('auth');
Route::resource('data-vendor', VendorController::class)->middleware('auth');
Route::resource('data-tender', TenderController::class)->middleware('auth');
Route::resource('data-instansitender', InstansiTenderController::class)->middleware('auth');
Route::resource('data-pejabattender', PejabatTenderController::class)->middleware('auth');
Route::get('data-lapmarketing/{data_lapmarketing}', [LapMarketingController::class, 'show'])->middleware('auth');
Route::get('lap-marketing/{tanggal}', [LapMarketingController::class, 'lap_marketing'])->middleware('auth');
Route::get('test', [JurnalController::class, 'test'])->middleware('auth');

Route::post('input-laporan', [LapMarketingController::class, 'input'])->middleware('auth');
Route::put('konfirmasi-laporan/{kode}', [LapMarketingController::class, 'konfirmasi'])->middleware('auth');

Route::get('DATA-kas/{dk}', [KasController::class, 'data_kas'])->middleware('auth');
Route::get('data-jurnalkas', [KasController::class, 'jurnal_kas'])->middleware('auth');

Route::get('list-db-marketing', [DB_marketingController::class, 'list_db'])->middleware('auth');


Route::resource('instansi-tender', TenderInstansiController::class);
Route::resource('subinstansi-tender', TenderSubnstansiController::class);
Route::get('tender/status/{id_subinstansi}/{status_priority}', [TenderSubnstansiController::class, 'updateStatus']);

// Tender
Route::get('/tender', [LayoutController::class, 'tender'])->middleware('auth');
Route::get('/tender/{id_instansi}', [LayoutController::class, 'tender_subinstansi'])->middleware('auth');
Route::get('/instansi/{id_subinstansi}/subinstansi', [LayoutController::class, 'subtender'])->name('subinstansi');
Route::get('/instansi/{id_subinstansi}/subinstansi/data', [SubinstansiTenderController::class, 'getData'])->name('subinstansi.data');

Route::post('/subinstansi/store', [SubinstansiTenderController::class, 'store'])->name('subinstansi.store');
Route::get('/subinstansi/{id_pengadaan}/edit', [SubinstansiTenderController::class, 'edit'])->name('subinstansi.edit');
Route::get('/subinstansi/{id_pengadaan}', [SubinstansiTenderController::class, 'show'])->name('subinstansi.show');
Route::put('/subinstansi/{id_pengadaan}', [SubinstansiTenderController::class, 'update'])->name('subinstansi.update');
Route::delete('/subinstansi/{id_pengadaan}', [SubinstansiTenderController::class, 'destroy'])->name('subinstansi.destroy');


//ImageController
// Route::get('data-library-image',[ImageController::class,'index'])->middleware('auth');
// Route::post('post-library-image',[ImageController::class,'store'])->middleware('auth');
// Route::get('edit-library-image/{id}',[ImageController::class,'edit'])->middleware('auth');
// Route::put('update-library-image/{id}',[ImageController::class,'update'])->middleware('auth');

//Jurnal Umum
Route::get('filter-jurnal', [JurnalController::class, 'filter_jurnal'])->middleware('auth');


//HPP
Route::get('update-hpp', [HppController::class, 'updatehpp'])->middleware('auth');

//Reclass
Route::put('reclass-po/{kode}', [POController::class, 'reclass'])->middleware('auth');
Route::get('reclass-mr/{kode}', [MRController::class, 'reclass'])->middleware('auth');
Route::put('reclass-so/{kode}', [SOController::class, 'reclass'])->middleware('auth');
Route::put('reclass-inv/{kode}', [InvoiceController::class, 'reclass'])->middleware('auth');
Route::put('reclass-sj/{kode}', [SJController::class, 'reclass'])->middleware('auth');
Route::put('reclass-kas/{kode}', [KasController::class, 'reclass'])->middleware('auth');
Route::put('reclass-laporanmarketing/{kode}', [LapMarketingController::class, 'reclass'])->middleware('auth');

//selesai
Route::get('data-po-selesai/{kode}', [POController::class, 'selesai'])->middleware('auth');
Route::put('data-mr-selesai/{kode}', [MRController::class, 'selesai'])->middleware('auth');
Route::put('data-so-selesai/{kode}', [SOController::class, 'selesai'])->middleware('auth');
Route::put('data-sj-selesai/{kode}', [SJController::class, 'selesai'])->middleware('auth');
Route::put('data-inv-selesai/{kode}', [InvoiceController::class, 'selesai'])->middleware('auth');
Route::put('data-kas-selesai/{kode}', [KasController::class, 'selesai'])->middleware('auth');

Route::get('databarang-detailinv/{inv}', [DetailInvController::class, 'databarang_detail'])->middleware('auth');
Route::get('databarang-detailpo/{po}', [DetailPOController::class, 'databarang_detail'])->middleware('auth');

Route::get('kodeakun', [KodeAkuntansiController::class, 'akun'])->middleware('auth');

Route::get('dropdown-supplier', [RekananController::class, 'dropdownsupplier'])->middleware('auth');
Route::get('dropdown-konsumen', [RekananController::class, 'dropdownkonsumen'])->middleware('auth');
Route::get('dropdown-po-mr', [MRController::class, 'dropdownpo'])->middleware('auth');
Route::get('dropdown-mr', [MRController::class, 'dropdownmr'])->middleware('auth');
Route::get('dropdown-bank', [BankController::class, 'dropdownbank'])->middleware('auth');
Route::get('dropdown-so-sj', [SJController::class, 'dropdownso'])->middleware('auth');
Route::get('dropdown-so-inv', [InvoiceController::class, 'dropdownso'])->middleware('auth');
Route::get('dropdown-gudang', [GudangController::class, 'dropdown'])->middleware('auth');
Route::get('dropdown-marketing', [KaryawanController::class, 'dropdownmarketing'])->middleware('auth');
Route::get('dropdown-sales/{data}', [KaryawanController::class, 'dropdownsales'])->middleware('auth');
Route::get('dropdown-barangso/{so}', [SJController::class, 'dropdownbarangso'])->middleware('auth');
Route::get('dropdown-barangmr/{gudang}', [DetailMRController::class, 'dropdownbarang'])->middleware('auth');
Route::get('dropdown-barangpo/{po}', [DetailPOController::class, 'dropdownbarangpo'])->middleware('auth');
Route::get('dropdown-barangsj/{sj}', [DetailSJController::class, 'dropdownbarangsj'])->middleware('auth');
Route::get('dropdown-baranginv/{inv}', [DetailInvController::class, 'dropdownbaranginv'])->middleware('auth');
Route::get('dropdown-sj/{jenis}', [SJController::class, 'dropdownsj'])->middleware('auth');
Route::get('dropdown-sjinv/{so}', [InvoiceController::class, 'dropdownsj'])->middleware('auth');
Route::get('dropdown-akuntansi', [KodeAkuntansiController::class, 'dropdownakun'])->middleware('auth');
Route::get('dropdown-akundebit', [KodeAkuntansiController::class, 'akundebit'])->middleware('auth');
Route::get('dropdown-akunkredit', [KodeAkuntansiController::class, 'akunkredit'])->middleware('auth');
Route::get('dropdown-kas', [KodeAkuntansiController::class, 'dropdownkas'])->middleware('auth');
Route::get('dropdown-inv', [InvoiceController::class, 'dropdowninv'])->middleware('auth');
Route::get('dropdown-invsd', [InvoiceController::class, 'dropdowninvsd'])->middleware('auth');
Route::get('dropdown-inv/{rekanan}', [InvoiceController::class, 'dropdowninvrekanan'])->middleware('auth');
Route::get('dropdown-uangmasuk', [KodeAkuntansiController::class, 'dropdownuangmasuk'])->middleware('auth');
Route::get('dropdown-uangkeluar', [KodeAkuntansiController::class, 'dropdownuangkeluar'])->middleware('auth');
Route::get('dropdown-kodeaset', [KodeAkuntansiController::class, 'dropdownkodeaset'])->middleware('auth');
Route::get('dropdown-keperluan', [KodeAkuntansiController::class, 'dropdownkeperluan'])->middleware('auth');
Route::get('dropdown-kategori', [DB_marketingController::class, 'dropdownkategori'])->middleware('auth');
Route::get('dropdown-perusahaan/{marketing}', [DB_marketingController::class, 'dropdownperusahaan'])->middleware('auth');
Route::get('dropdown-tipe-aset', [AsetController::class, 'dropdowntipe'])->middleware(('auth'));
Route::get('dropdown-POsupplier', [POController::class, 'dropdownsupplier'])->middleware('auth');
Route::get('dropdown-aset/{tipe}', [AsetController::class, 'dropdownaset'])->middleware('auth');

Route::get('dropdown-provinsi', [WilayahController::class, 'dropdownprovinsi'])->middleware('auth');
Route::get('dropdown-kota', [WilayahController::class, 'dropdownkotakota'])->middleware('auth');
Route::get('dropdown-kota/{prov}', [WilayahController::class, 'dropdownkota'])->middleware('auth');
Route::get('dropdown-kecamatan/{kota}', [WilayahController::class, 'dropdownkecamatan'])->middleware('auth');

Route::get('dropdown-namapengiriman', [PengirimanController::class, 'dropdownnama'])->middleware('auth');
Route::get('dropdown-instansitender', [InstansiTenderController::class, 'dropdown'])->middleware('auth');
Route::get('dropdown-pejabattender/{instansi}', [PejabatTenderController::class, 'dropdown'])->middleware('auth');
Route::get('dropdown-subinstansi/{nama}', [InstansiTenderController::class, 'dropdown_subinstansi'])->middleware('auth');
Route::get('data-subinstansi/{nama}', [InstansiTenderController::class, 'subinstansi'])->middleware('auth');

Route::get('hpp-barang/{barang}', [JurnalController::class, 'hpp_barang'])->middleware('auth');

//Data ASET
Route::get('aset/{kode}', [AsetController::class, 'dataaset'])->middleware('auth');


Route::get('lastkode-barang', [BarangController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-rekanan', [RekananController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-po/{data}', [POController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-so/', [SOController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-mr', [MRController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-sj', [SJController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-inv', [InvoiceController::class, 'lastkode'])->middleware('auth');
Route::get('lastkode-kas', [KasController::class, 'lastkode'])->middleware('auth');

Route::get('dropdown-barang', [BarangController::class, 'dropdownbarang'])->middleware('auth');
Route::delete('hapus-detailpo/{kode}', [DetailPOController::class, 'hpsdetailpo'])->middleware('auth');
Route::delete('hapus-kas/{kode}', [DetailKasController::class, 'hapuskas'])->middleware('auth');
Route::get('hapus-laporan', [LapMarketingController::class, 'hapus'])->middleware('auth');
Route::get('vat-detailso', [DetailSOController::class, 'editvat'])->middleware('auth');
Route::get('vat-detailpo', [DetailPOController::class, 'editvat'])->middleware('auth');
Route::delete('hps-detail-mr/{kode}', [DetailMRController::class, 'hpsdetailmr'])->middleware('auth');
Route::delete('hps-detail-so/{kode}', [DetailSOController::class, 'hpsdetailso'])->middleware('auth');
Route::delete('hps-detail-sj/{kode}', [DetailSJController::class, 'hpsdetailsj'])->middleware('auth');
Route::get('hps-edt-detail-sj/{kode}', [DetailSJController::class, 'hpsedtdetailsj'])->middleware('auth');
Route::delete('hps-detail-inv/{kode}', [DetailInvController::class, 'hpsdetailinv'])->middleware('auth');
Route::get('sjinvoice/{kode}', [SJController::class, 'suratjalaninv'])->middleware('auth');
// Route::get('gudangso/{kode}',[DetailMRController::class,'gudangso'])->middleware('auth');
Route::get('gudangbarang/{kode}', [JurnalController::class, 'gudangbarang'])->middleware('auth');
Route::get('data-detailsobarang/{kode}', [DetailSOController::class, 'detailbarang'])->middleware('auth');
Route::get('cek-username', [KaryawanController::class, 'cekusername'])->middleware('auth');
Route::get('kode-detail-sj', [DetailSJController::class, 'kodedetail'])->middleware('auth');
Route::get('datadetailsj/{sj}', [DetailSJController::class, 'datadetailsj'])->middleware('auth');
Route::put('status-kas/{kode}', [KasController::class, 'statuskas'])->middleware('auth');

//jurnal
Route::get('jurnal-detailpo/{kode}', [JurnalController::class, 'detail_po'])->middleware('auth');
Route::get('jurnal-detailmr/{kode}', [JurnalController::class, 'detail_mr'])->middleware('auth');
Route::get('jurnal-detailso/{kode}', [JurnalController::class, 'detail_so'])->middleware('auth');
Route::get('jurnal-detailsj/{kode}', [JurnalController::class, 'detail_sj'])->middleware('auth');
Route::get('jurnal-detailinvoice/{kode}', [JurnalController::class, 'detail_invoice'])->middleware('auth');
Route::get('jurnal-laporan-penjualan', [JurnalController::class, 'laporan_penjualan'])->middleware('auth');
Route::get('detail-penjualan/{kode}', [JurnalController::class, 'detail_penjualan'])->middleware('auth');
Route::get('rekap-jurnal', [JurnalController::class, 'rekap_jurnal'])->middleware('auth');
Route::get('jurnal-laporan-piutang', [JurnalController::class, 'laporanpiutang'])->middleware('auth');

//data Stock barang
Route::get('total-so', [JurnalController::class, 'total_so'])->middleware('auth');
Route::get('total-sj', [JurnalController::class, 'total_sj'])->middleware('auth');
Route::get('total-inv', [JurnalController::class, 'total_invoice'])->middleware('auth');
Route::get('total-po', [JurnalCOntroller::class, 'total_po'])->middleware('auth');
Route::get('data-stock-gudang', [JurnalController::class, 'stock_gudang'])->middleware('auth');
Route::get('data-kartu-stock-gudang', [JurnalController::class, 'kartu_stock_gudang'])->middleware('auth');

Route::resource('data-barang-keluar', BarangoutController::class)->middleware('auth');
Route::resource('data-barang-masuk', BaranginController::class)->middleware('auth');


Route::get('data-lap-bukubesar', [JurnalController::class, 'data_bukubesar'])->middleware('auth');

//Import Barang
Route::post('import-barang', [BarangController::class, 'importbarang'])->middleware('auth');
Route::post('upload-barang', [BarangController::class, 'uploadbarang'])->middleware('auth');
//Import Rekanan
Route::post('import-rekanan', [RekananController::class, 'importrekanan'])->middleware('auth');
Route::post('upload-rekanan', [RekananController::class, 'uploadrekanan'])->middleware('auth');
//Import Database Marketing
Route::post('import-dbmarketing', [RekananController::class, 'importdatabase'])->middleware('auth');
Route::post('upload-dbmarketing', [RekananController::class, 'uploaddatabase'])->middleware('auth');

// UPLOAD TTD PURCHASING
Route::post('upload-ttd-purchasing', [POController::class, 'uploadttdpurchasing'])->middleware('auth');

//EXPORT
Route::get('data-export-penjualan', [JurnalController::class, 'export'])->middleware('auth');
Route::get('export-penjualan', [ExportController::class, 'laporan_penjualan'])->middleware('auth');


Route::post('ubah-password', [KaryawanController::class, 'ubahpassword'])->middleware('auth');

// Route::get('stock-barangmr/{kode}',[DetailMRController::class,'stockbarang'])->middleware('auth');
Route::get('stock-barang/{kode}', [JurnalController::class, 'stockbarang'])->middleware('auth');
Route::get('cekinvoice-sj/{kode}', [SJController::class, 'cekinvoice'])->middleware('auth');

//FILTER DB MARKETING
Route::post('filter-dbmarketing', [DB_marketingController::class, 'FilterData'])->middleware('auth');

// UBAH PIC DATABASE
Route::put('ubah-pic-database/{kode}', [DB_marketingController::class, 'ubahpic'])->middleware('auth');
Route::put('ubah-status-database/{kode}', [DB_marketingController::class, 'ubahstatus'])->middleware('auth');

//CETAK
Route::get('cetak-invoice/{kode}', [InvoiceController::class, 'cetakinv'])->middleware('auth');
Route::get('cetak-dataso/{kode}', [SOController::class, 'cetakso'])->middleware('auth');
Route::get('cetakpodetail/{kode}', [POController::class, 'cetakpo'])->middleware('auth');
Route::get('cetaksjdetail/{kode}', [SJController::class, 'cetaksj'])->middleware('auth');
Route::get('cetakmr/{kode}', [MRController::class, 'cetakmr'])->middleware('auth');
Route::get('cetak-laporanpenjualan/{awal,akhir}', [JurnalController::class, 'cetakpenjualan'])->middleware('auth');

//CEK QTY TRANSAKSI
Route::get('cek-so', [JurnalController::class, 'cek_so'])->middleware('auth');
Route::get('cek-sj', [JurnalController::class, 'cek_sj'])->middleware('auth');
Route::get('cek-inv', [JurnalController::class, 'cek_inv'])->middleware('auth');
Route::get('cek-po', [JurnalController::class, 'cek_po'])->middleware('auth');


//OMSET MARKETING
Route::get('target-omset', [LayoutController::class, 'targetomset'])->middleware('auth');
Route::get('omset-marketing', [JurnalController::class, 'omsetmarketing'])->middleware('auth');

//TARGET MARKETING
Route::get('target-marketing', [JurnalController::class, 'targetmarketing'])->middleware('auth');

//Riwayat Penjualan
Route::get('data-riwayatpenjualan', [JurnalController::class, 'riwayatpenjualan'])->middleware('auth');

//Grafik
Route::get('grafik', [SOController::class, 'grafik'])->middleware('auth');
Route::get('grafik-bulanan', [SOController::class, 'grafikbulanan'])->middleware('auth');
Route::get('grafik-pie-bulanan', [SOController::class, 'grafikpiebulanan'])->middleware('auth');
Route::get('grafik-pie', [SOController::class, 'grafikpie'])->middleware('auth');

//Data Target Penjualan
Route::get('filter-data-target-marketing', [Target_MarketingController::class, 'filterdata'])->middleware('auth');

//Aksi DB Marketing
Route::get('filter-aksi-dbmarketing', [Aksi_dbmarketingController::class, 'filter_aksidb'])->middleware('auth');

//Filter Aktifitas Marketing
Route::get('data-aktifitas-marketing', [LapMarketingController::class, 'data_aktifitas'])->middleware('auth');

//Filter Export PO
Route::get('filter-po', [POController::class, 'filterExport'])->middleware('auth');

//Filter Export MR
Route::get('filter-mr', [MRController::class, 'filterExport'])->middleware('auth');

//Filter Barang Masuk
Route::get('filter-barang-masuk', [BaranginController::class, 'filterExport'])->middleware('auth');

//Filter Barang Masuk
Route::get('filter-barang-keluar', [BarangoutController::class, 'filterExport'])->middleware('auth');

//Filter Export SO
Route::get('filter-so', [SOController::class, 'filterExport'])->middleware('auth');

//Filter Export INV
Route::get('filter-inv', [InvoiceController::class, 'filterExport'])->middleware('auth');

//Filter Export SJ
Route::get('filter-sj', [SJController::class, 'filterExport'])->middleware('auth');

//Filter Export KAS
Route::get('filter-kas', [KASController::class, 'filterExport'])->middleware('auth');

//Filter Data Pengiriman
Route::get('filter-data-pengiriman', [PengirimanController::class, 'filter'])->middleware('auth');

//Export Penjualan
Route::get('exp-penjualan', [JurnalController::class, 'exportpenjualan'])->middleware('auth');

//Export Penjualan Marketing
Route::get('lpj-penjualan-marketing', [JurnalController::class, 'lpj_penjualan_marketing'])->middleware('auth');


//Export Pembelian
Route::get('exp-pembelian', [JurnalController::class, 'exportpembelian'])->middleware('auth');

//Export Piutang
Route::get('exp-piutang', [JurnalController::class, 'exportpiutang'])->middleware('auth');

// Absensi
Route::get('proses-absensi', [KaryawanController::class, 'prosesabsensi']);

//Last Update Pengiriman
Route::get('last-update-pengiriman', [PengirimanController::class, 'lastupdate'])->middleware('auth');

//Last Update Vendor
Route::get('last-update-vendor', [VendorController::class, 'lastupdate'])->middleware('auth');

//UPDATE DATA TARGET OMSET
// Route::get('update-data-target-omset',[Target_OmsetController::class,'tambahdata'])->middleware('auth');
Route::get('update-data-target-omset', [Target_OmsetController::class, 'updatedata'])->middleware('auth');

// INTAGRO

Route::get('/intagro', function () {
    return view('intagro');
});
Route::get('/macro-fertilizer', function () {
    return view('intagro/macro-fertilizer');
});
Route::get('/micro-fertilizer', function () {
    return view('intagro/micro-fertilizer');
});
Route::get('/natural-fertilizer', function () {
    return view('intagro/natural-fertilizer');
});
Route::get('/commodity', function () {
    return view('intagro/commodity');
});
Route::get('/about-us', function () {
    return view('intagro/about-us');
});
Route::get('/contact-us', function () {
    return view('intagro/contact-us');
});
Route::get('/intagro/admin', function () {
    return view('intagro/admin');
});
Route::get('intagro/barang', function () {
    return view('intagro/admin-barang');
});
