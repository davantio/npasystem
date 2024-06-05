<?php
namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenjualanExport;
use App\Models\jurnal;
use App\Models\bank;
use App\Exports\laporanpenjualan;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ExportController extends Controller
{
    public function laporan_penjualan(Request $request)
    {
        try{
            
            $data = DB::table('invoice')
                    ->where('status','Selesai')
                    ->whereBetween('tanggal',[$request->awal,$request->akhir])->get();
            $output = array();                    
            foreach($data AS $D){
                $n = 0;
                $detail = jurnal::where('kode_transaksi','LIKE',"$D->kode%D")->get();
                $totalharga = 0;
                foreach($detail AS $barang){
                    $total = jurnal::select(DB::raw('SUM(jumlah_debit)as total'))
                            ->where('kode_transaksi','LIKE',"$D->kode%D")->first();
                    $output[$n]['tanggal_invoice'] = $D->tanggal;
                    $output[$n]['invoice'] = $D->kode;
                    $output[$n]['SO'] = $D->kode_so;
                    $output[$n]['Customer'] = $barang->nama_rekanan;
                    $output[$n]['Marketing'] = $barang->nama_marketing;
                    $output[$n]['Barang'] = $barang->nama_brg;
                    $output[$n]['Qty'] = $barang->qty_debit;
                    $output[$n]['Satuan'] = $barang->satuan;
                    $output[$n]['Harga'] = $barang->harga_debit;
                    $output[$n]['DPP'] = $barang->qty_debit*$barang->harga_debit;
                    if($barang->vat == 0){
                        $output[$n]['PPN'] = 0;
                    } else {
                        $PPN = (($barang->qty_debit*$barang->harga_debit)*$barang->vat)/100;
                        $output[$n]['PPN'] = $PPN;
                    }
                    $output[$n]['Penjualan'] = $barang->jumlah_debit;
                    $output[$n]['Asal_Gudang'] = $barang->nama_gdg;
                    if($n == 0){
                        $s = 1;
                        $kas = jurnal::where('kode_transaksi','LIKE',"KAS%D")
                                ->where('keterangan',$D->kode)->where('status','Selesai')->get();
                        $totalbayar = 0;
                        foreach($kas AS $pembayaran){
                            $output[$n]['Pembayaran '.$s] = $pembayaran->jumlah_debit;
                            
                            $totalbayar = $totalbayar+$pembayaran->jumlah_debit;
                            $s++;
                        }
                        for($s=$s;$s<=5;$s++){
                            $output[$n]['Pembayaran '.$s] = "-";
                        }
                        
                    } else {
                        $totalbayar = 0;
                        for($s=1;$s<=5;$s++){
                            $output[$n]['Pembayaran '.$s] = "-";
                        }
                    }
                    if($D->kode_bank == 3){
                        $output[$n]['VIA'] = "Tunai";
                        $output[$n]['BANK'] = "-";
                    } else {
                        $bank = bank::where('kode',$D->kode_bank)->first();
                        $output[$n]['VIA'] = "TF";
                        $output[$n]['BANK'] = $bank->bank;
                    }
                    $sisa = $total->total - $totalbayar;
                    $output[$n]['Sisa_Piutang'] = $sisa;
                    if($sisa == 0){
                        $output[$n]['status'] = "LUNAS";
                    } else {
                        $output[$n]['status'] = "BELUM LUNAS";
                    }
                    $n++;
                }
                 
            }
            return Excel::download(new laporanpenjualan($output), 'data.xlsx');
            // return response()->json(['success'=>true,'data'=>$output, 'downloadUrl' => $file->getFile()]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->GetMessage()]);
        }

        // Export data dengan Maatwebsite
        return Excel::download(new UsersExport($users->get()), 'users.xlsx');
    }
}
