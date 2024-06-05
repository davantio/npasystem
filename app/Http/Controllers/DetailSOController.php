<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\salesorder;
use App\Models\detail_so;
use App\Models\jurnal;
use App\Models\karyawan;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\rekanan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;
use Exception;

class DetailSOController extends Controller
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
            $kode = detail_so::orderBy('kode','desc')->first();
            if($kode == null){
                $nkode = 1;
            } else {
                $nkode = $kode->kode + 1 ;
            }
            $detail = new detail_so();
            $detail->kode = $nkode;
            $detail->kode_so = $request->so;
            $detail->kode_brg = $request->kode;
            $detail->nama_request = $request->nama;
            $detail->harga = $request->harga;
            $detail->qty = $request->qty;
            $detail->vat = $request->vat;
                $harga = $request->harga;
                $qty = $request->qty;
            $jumlah = $harga*$qty;
            $jumlah = sprintf("%.3f",$jumlah);
            $vat = ($request->harga*$detail->vat)/100;
            $vat = sprintf("%.3f",$vat);
            $VAT = $vat*$request->qty;
            $VAT = sprintf("%.3f",$VAT);
            $detail->dpp = $jumlah;
            $detail->hpp = $request->hpp;
            $detail->total = $jumlah+$VAT;
            $detail->keterangan = $request->keterangan;
            $detail->debit = $request->debit;
            $detail->kredit = $request->kredit;
            $detail->save();

            $log = new log_sistem();
            $log->transaksi = $request->so.".".$nkode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Detail SO";
            $log->save();


            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
            // Jurnal
            
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
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
            $total = 0;
            $data = detail_so::select('detail_so.*', 'barang.nama', 'barang.satuan')
            ->join('barang','detail_so.kode_brg','=','barang.kode')
            ->where('detail_so.kode_so',$id)->get();
            foreach($data as $A){
                $total = $total+$A->total;
                $D = kode_akuntansi::select('nama_perkiraan')->where('kode',$A->debit)->first();
                $K = kode_akuntansi::select('nama_perkiraan')->where('kode',$A->kredit)->first();
                $A['nama_debit'] = $D->nama_perkiraan;
                $A['nama_kredit'] = $K->nama_perkiraan;
            }
            
            return response()->json(['success'=>true,'data'=>$data,'total'=>$total]);
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
    public function detailbarang(Request $request,$kode)
    {
        try{
            $data = detail_so::select('detail_so.*','barang.nama','barang.satuan')
                    -> join('barang', 'detail_so.kode_brg','=','barang.kode')
                    ->where('detail_so.kode_so',$kode)
                    ->where('detail_so.kode_brg',$request->barang)
                    ->first();
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $data->nama_debit = $debit->nama_perkiraan;
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data->nama_kredit = $kredit->nama_perkiraan;
            return response()->json(['success'=>true,'data'=>$data]);
        }catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function edit($id)
    {
        //
        try{
            
            $data = detail_so::select('detail_so.*', 'barang.nama', 'barang.satuan')
                ->join ('barang','detail_so.kode_brg','=','barang.kode')
                ->where('detail_so.kode',$id)->first();
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data['nama_debit'] = $debit->nama_perkiraan;
            $data['nama_kredit'] = $kredit->nama_perkiraan;
            
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
    public function editvat(Request $request)
    {
        DB::table('salesorder')
        ->where('kode',$request->so)
        ->update(['vat'=>$request->vat]);
        $detail = detail_so::where('kode_so',$request->so)->get();
        foreach ($detail as $detail) {
            $vat = $request->vat;
            $VAT = ($detail->harga*$vat)/100;
            $VAT = sprintf("%.3f",$VAT);
            $VAT = $VAT*$detail->qty;
            $VAT = sprintf("%.3f",$VAT);
            $total = $detail->dpp+$VAT;

            DB::table('detail_so')
            ->where('kode',$detail->kode)
            ->update(['vat'=>$vat,'total'=>$total]);
        }
    }
    public function update(Request $request, $id)
    {
        //
        try{
            $data = detail_so::where('kode',$id)->first();
            $dpp = $request->harga*$request->qty;
            $vat = ($request->harga*$data->vat)/100;
            $vat = sprintf("%.3f",$vat);
            $VAT = $vat*$request->qty;
            $VAT = sprintf("%.3f",$VAT);
            $total = $dpp+$VAT;


            DB::table('detail_so')
            ->where('kode', $id)
            ->update([
                'harga' =>$request->harga,
                'nama_request'=> $request->nama,
                'qty' => $request->qty,
                'dpp' => $dpp,
                'total' => $total,
                'keterangan' => $request->keterangan,
                'debit'=>$request->debit,
                'kredit'=>$request->kredit]);

            $log = new log_sistem();
            $log->transaksi = $data->kode_so.".".$id;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail SO";
            $log->save();
           
            
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hpsdetailso(Request $request, $so){
        try {
            // Validate the value...
            DB::table('detail_so')
            ->where('kode_so',$so)
            ->whereBetween('created_at',[$request->start,$request->end])
            ->delete();
           
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]) ;;
        }
    }
    public function destroy(Request $request,$id)
    {
        //
        try{
            $data = detail_so::where('kode',$id)->first();
            detail_so::where('kode',$id)->delete();
            $log = new log_sistem();
            $log->transaksi = $data->kode_so.".".$id;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail SO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
