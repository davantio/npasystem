<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstansiTender;

class TenderInstansiController extends Controller
{
    public function store(Request $request)
    {
        $instansiTender = InstansiTender::create([
            'nama_instansi' => $request->nama_instansi,
            'warna' => $request->warna
        ]);

        return response()->json(['success' => 'Instansi Tender created successfully.', 'data' => $instansiTender]);
    }

    public function update(Request $request, $id)
    {
        $instansiTender = InstansiTender::find($id);
        $instansiTender->update([
            'nama_instansi' => $request->nama_instansi,
            'warna' => $request->warna
        ]);

        return response()->json(['success' => 'Instansi Tender updated successfully.', 'data' => $instansiTender]);
    }

    public function destroy($id)
    {
        InstansiTender::find($id)->delete();
        return response()->json(['success' => 'Instansi Tender deleted successfully.']);
    }
}
