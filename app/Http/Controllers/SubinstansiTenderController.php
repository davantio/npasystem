<?php

namespace App\Http\Controllers;

use App\Models\SubinstansiTender;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubinstansiTenderController extends Controller
{
    public function getData($id_instansi)
    {
        $subinstansi = SubinstansiTender::where('id_instansi', $id_instansi)->get();
        return DataTables::of($subinstansi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item detailSubinstansi" href="javascript:void(0)" data-id="' . $row->id_subinstansi . '">Detail</a>
                                <a class="dropdown-item editSubinstansi" href="javascript:void(0)" data-id="' . $row->id_subinstansi . '">Edit</a>
                                <a class="dropdown-item deleteSubinstansi" href="javascript:void(0)" data-id="' . $row->id_subinstansi . '">Delete</a>
                                <a class="dropdown-item statusKalah text-red" href="javascript:void(0)" data-id="' . $row->id_subinstansi . '">ubah Kalah</a>
                                <a class="dropdown-item statusMenang text-green" href="javascript:void(0)" data-id="' . $row->id_subinstansi . '">ubah Menang</a>
                                <a class="dropdown-item statusDiproses text-yellow" href="javascript:void(0)" data-id="' . $row->id_subinstansi . '">ubah Diproses</a>
                            </div>
                        </div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $subinstansi = SubinstansiTender::updateOrCreate(
            ['id_subinstansi' => $request->id_subinstansi],
            $request->all()
        );
        return response()->json(['success' => 'Subinstansi saved successfully.']);
    }

    public function edit($id)
    {
        $subinstansi = SubinstansiTender::find($id);
        return response()->json($subinstansi);
    }

    public function update(Request $request, $id)
    {
        $subinstansi = SubinstansiTender::find($id);
        $subinstansi->update($request->all());
        return response()->json(['success' => 'Subinstansi updated successfully.']);
    }

    public function show($id)
    {
        $subinstansi = SubinstansiTender::findOrFail($id);
        return response()->json($subinstansi);
    }

    public function destroy($id)
    {
        SubinstansiTender::find($id)->delete();
        return response()->json(['success' => 'Subinstansi deleted successfully.']);
    }
}
