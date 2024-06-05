<?php

namespace App\Http\Controllers;
use App\Models\detail_po;
use App\Models\barang;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\purchaseorder;
use App\Models\rekanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class DetailPOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{

            $kode = detail_po::orderBy('kode','desc')->first();
            if($kode == null){
                $nkode = 1;
            } else {
                $nkode = $kode->kode + 1 ;
            }
            $detail = new detail_po();
            $detail->kode = $nkode;
            $detail->kode_po = $request->po;
            $detail->kode_brg = $request->kode;
            $detail->harga = $request->harga;
            $detail->ongkir = $request->ongkir;
            $detail->qty = $request->qty;
            
            $harga = $request->harga;
            $qty = $request->qty;
            $ongkir = $request->ongkir;
            $jumlah = $harga*$qty;
            $jumlah = sprintf("%.3f", $jumlah);

            $vat = ($request->vat*$request->harga)/100;
            $vat = sprintf("%.3f",$vat);
            $VAT = $vat*$request->qty;
            $VAT = sprintf("%.3f", $VAT);;
            
            $jumlah = $jumlah + $VAT + $ongkir;
            
            $detail->jumlah = $jumlah;
            $detail->keterangan = $request->keterangan;
            $detail->save();

            $log = new log_sistem();
            $log->transaksi = $request->po.".".$nkode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Detail PO";
            $log->save();
            
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }   
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            // $jurnal = jurnal::where('kode_transaksi',$id)->get();
            // foreach($jurnal as $jurnal){
            //     $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_debit)->first();
            //     $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_kredit)->first();
            //     $jurnal->nama_debit = $debit->nama_perkiraan;
            //     $jurnal->nama_kredit = $kredit->nama_perkiraan;
            //     $dat[] = $jurnal;
            // }
            $data = detail_po::select('detail_po.*', 'barang.nama', 'barang.satuan')
            ->join('barang','detail_po.kode_brg','=','barang.kode')
            ->where('detail_po.kode_po',$id)->get();
            $total = 0;
            $ongkir = 0;
           foreach($data AS $d){
               $total = $total+$d->jumlah;
               $ongkir = $ongkir+$d->ongkir;
           }
            return response()->json(['success'=> true,'data'=>$data,'total'=>$total,'ongkir'=>$ongkir]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editvat(Request $request)
    {
        DB::table('purchaseorder')
        ->where('kode',$request->po)
        ->update(['vat'=>$request->vat]);
        $detail = detail_po::where('kode_po',$request->po)->get();
        foreach ($detail as $detail) {
            $vat = $request->vat;
            $VAT = ($detail->harga*$vat)/100;
            $VAT = sprintf("%.3f",$VAT);
            $VAT = $VAT*$detail->qty;
            $VAT = sprintf("%.3f",$VAT);
            $dpp = $detail->harga*$detail->qty;
            
            $total = $dpp+$VAT+$detail->ongkir;

            DB::table('detail_po')
            ->where('kode',$detail->kode)
            ->update(['vat'=>$vat,'jumlah'=>$total]);
        }
    }
    public function edit($kode)
    {
        //
        try{
            $data = detail_po::where('kode',$kode)->first();
            $barang = barang::select('nama','satuan')->where('kode',$data->kode_brg)->first();
            $data->nama = $barang->nama;
            $data->satuan = $barang->satuan;
            return response()->json(['success'=>true,'result'=> $data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
    
    public function dropdownbarangpo (Request $request,$kode)
    {
            if($request->has('q')){
                $search = $request->q;
                $data = detail_po::select('detail_po.kode_brg','barang.nama as nama')
                        ->join('barang','detail_po.kode_brg','=','barang.kode')
                        ->where('detail_po.kode_po',$kode)
                        ->where('barang.nama','LIKE',"%$search")
                        ->get();
                
            } else {
                $data = detail_po::select('detail_po.kode_brg','barang.nama as nama')
                        ->join('barang','detail_po.kode_brg','=','barang.kode')
                        ->where('detail_po.kode_inv',$kode)
                        ->get();
                
            }
            return response()->json($data);
    }
    public function databarang_detail(Request $request, $kode)
    {
        try{   
            $data = detail_po::select('detail_po.*','barang.satuan as satuan')
                    ->join('barang','detail_po.kode_brg','=','barang.kode')
                    ->where('detail_po.kode_po',$kode)
                    ->where('detail_po.kode_brg',$request->barang)
                    ->first();
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data->nama_debit = $debit->nama_perkiraan;
            $data->nama_kredit = $kredit->nama_perkiraan;
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        //
        try{
            $data = detail_po::where('kode',$kode)->first();
            $PO = purchaseorder::where('kode',$data->kode_po)->first();
            
            
            $vat = sprintf("%.3f",($request->harga*$PO->vat)/100);
            
            
            // $data->qty = $request->qty;
            // $data->harga = $request->harga;
            // $data->keterangan = $request->keterangan;

            $harga = sprintf("%.3f", $request->harga);
            $qty = sprintf("%.3f",$request->qty);
            $jumlah = $harga*$qty;
            $VAT = $vat*$qty;
            $jumlah = sprintf("%.3f", $jumlah);
            $total = $VAT+$jumlah + sprintf("%.3f",$request->ongkir);
            
            $simpan = DB::table('detail_po')->where('kode',$kode)->update([
                'qty'=>$qty,
                'harga'=>$harga,
                'ongkir'=>$request->ongkir,
                'jumlah'=>$total,
                'keterangan'=>$request->keterangan,
            ]);
            // $data->jumlah = $total;
            // $simpan = $data->save();
            if($simpan){
                $transaksi = $data->kode_po.".".$kode;
                $log = new log_sistem();
                $log->transaksi = $transaksi;
                $log->user = $request->user;
                $log->keterangan = "Edit Data Detail PO";
                $savelog = $log->save();
                if($savelog){
                    return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);
                } else {
                    return response()->json(['success'=>false,'pesan'=>'Error Tambah Log Sistem']);
                }
            } else {
                return response()->json(['success'=>false,'pesan'=>"Error Update Data"]);
            }
            
            
            
            // DB::table('detail_po')
            // ->where('kode', $kode)
            // ->update([
            //     'qty'       =>$data->qty, 
            //     'harga'     => $data->harga,
            //     'ongkir'    => $request->ongkir,
            //     'jumlah'    => $data->jumlah,
            //     'keterangan' => $data->keterangan,
            // ]);
            
        } catch(\Exception $e){
            return response()->json(['success'=>false ,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function hpsdetailpo(Request $request,$kode){


        try {
            // Validate the value...

            detail_po::where('kode_po',$kode)
            ->whereBetween('created_at',[$request->start,$request->end])->delete();
            // jurnal::where('kode_transaksi','LIKE',"$kode%")
            // ->whereBetween('created_at',[$request->start,$request->end])->delete();
            // detail_po::
            //     where('kode_po',$kode)
            //     ->whereBetween('created_at', [$request->start, $request->end])
            //     ->delete();
            return response()->json(['success'=>true ,'pesan'=>'Data Berhasil Dihapus']); 
        } catch (Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
      
    }
    public function destroy(Request $request,$kode)
    {
        //
        try{
            $data = detail_po::where('kode',$kode)->first();
            detail_po::where('kode',$kode)->delete();
            // jurnal::where('kode_transaksi','LIKE',"$data->kode_po.".".$kode%")->delete();
            $log = new log_sistem();
            $log->transaksi = $data->kode_po.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail PO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
        
    }
}
