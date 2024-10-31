<?php

namespace App\Http\Controllers;

use App\Models\SubinstansiTender;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubinstansiTenderController extends Controller
{
    public function getData($id_subinstansi)
    {
        $data = SubinstansiTender::where('id_subinstansi', $id_subinstansi)
            ->orderBy('tanggal_pengajuan', 'desc')
            ->orderBy('pengadaan', 'asc')
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item detailSubinstansi" href="javascript:void(0)" data-id="' . $row->id_pengadaan . '">Detail</a>
                                <a class="dropdown-item editSubinstansi" href="javascript:void(0)" data-id="' . $row->id_pengadaan . '">Edit</a>
                                <a class="dropdown-item deleteSubinstansi" href="javascript:void(0)" data-id="' . $row->id_pengadaan . '">Delete</a>
                                <a class="dropdown-item statusKalah text-red" href="javascript:void(0)" data-id="' . $row->id_pengadaan . '">ubah Kalah</a>
                                <a class="dropdown-item statusMenang text-green" href="javascript:void(0)" data-id="' . $row->id_pengadaan . '">ubah Menang</a>
                                <a class="dropdown-item statusDiproses text-yellow" href="javascript:void(0)" data-id="' . $row->id_pengadaan . '">ubah Diproses</a>
                            </div>
                        </div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Jika ada file yang di-upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename); // Simpan di folder 'uploads'
            $data['file_upload'] = $filename; // Simpan nama file ke database
        }

        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = '<p>-</p>';
            }
        }

        $subinstansi = SubinstansiTender::updateOrCreate(
            ['id_pengadaan' => $request->id_pengadaan],
            $data
        );
        return response()->json(['success' => 'Subinstansi saved successfully.', 'reload' => true]);
    }

    public function edit($id)
    {
        $subinstansi = SubinstansiTender::find($id);
        return response()->json($subinstansi);
    }

    public function update(Request $request, $id)
    {
        $subinstansi = SubinstansiTender::find($id);
        $data = $request->all();

        // Jika ada file yang di-upload
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename); // Simpan di folder 'uploads'
            $data['file_upload'] = $filename; // Simpan nama file ke database
        }

        $subinstansi->update($data);
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
