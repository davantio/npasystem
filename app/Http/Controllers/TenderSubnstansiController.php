<?php

namespace App\Http\Controllers;

use App\Models\Subinstansi;
use Illuminate\Http\Request;

class TenderSubnstansiController extends Controller
{
    public function store(Request $request)
    {
        $tendersubinstansi = Subinstansi::create([
            'nama_subinstansi' => $request->nama_subinstansi,
            'warna' => $request->warna,
            'id_instansi' => $request->id_instansi
        ]);

        return response()->json(['success' => 'Instansi Tender created successfully.', 'data' => $tendersubinstansi]);
    }

    public function updateStatus($id_subinstansi, $status_priority)
    {
        $subinstansi = Subinstansi::find($id_subinstansi);

        if ($subinstansi) {
            $subinstansi->status_priority = $status_priority;
            $subinstansi->save();

            return redirect()->back()->with('success', 'Status updated successfully.');
        }

        return redirect()->back()->with('error', 'Subinstansi not found.');
    }
}
