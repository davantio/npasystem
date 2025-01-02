<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\DetailBerkas;
use Illuminate\Support\Facades\Storage;

use DataTables;

class ResearchController extends Controller
{
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Research::with('detailBerkas')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-id="' . $row->id_research . '" class="editResearch btn btn-primary btn-sm">Edit</button>';
                    $btn .= ' <button data-id="' . $row->id_research . '" class="deleteResearch btn btn-danger btn-sm">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        try {
            $research = Research::with('detailBerkas')->findOrFail($id);

            return response()->json(['success' => true, 'data' => $research]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }



    public function edit($id)
    {
        try {
            $research = Research::with('detailBerkas')->findOrFail($id);
            return response()->json(['success' => true, 'data' => $research]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }



    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_produk' => 'required',
                'nama_produk' => 'required|string|max:255',
                'bahan_baku' => 'required',
                'proses_produksi' => 'required',
                'hpp' => 'required',
                'kemasan' => 'required',
                'foto_produk' => 'nullable|image',
                'files.*' => 'nullable|file',
            ]);

            $fotoPath = $request->file('foto_produk')->store('photos', 'public');

            $research = Research::create([
                'kode_produk' => $validated['kode_produk'],
                'nama_produk' => $validated['nama_produk'],
                'bahan_baku' => $validated['bahan_baku'],
                'proses_produksi' => $validated['proses_produksi'],
                'hpp' => $validated['hpp'],
                'foto_produk' => $fotoPath,
                'kemasan' => $validated['kemasan'],
            ]);

            if ($request->has('files')) {
                foreach ($request->file('files') as $file) {
                    $filePath = $file->store('documents', 'public');
                    DetailBerkas::create([
                        'id_research' => $research->id_research,
                        'file' => $filePath,
                    ]);
                }
            }

            return response()->json(['success' => true, 'data' => $research]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $research = Research::findOrFail($id);

            $validated = $request->validate([
                'kode_produk' => 'required|string|max:255',
                'nama_produk' => 'required|string|max:255',
                'bahan_baku' => 'required',
                'proses_produksi' => 'required',
                'hpp' => 'required|numeric',
                'kemasan' => 'required|string',
                'foto_produk' => 'nullable|image',
                'files.*' => 'nullable|file',
            ]);

            if ($request->hasFile('foto_produk')) {
                if ($research->foto_produk) {
                    Storage::disk('public')->delete($research->foto_produk);
                }
                $fotoPath = $request->file('foto_produk')->store('photos', 'public');
                $research->foto_produk = $fotoPath;
            }

            $research->kode_produk = $validated['kode_produk'];
            $research->nama_produk = $validated['nama_produk'];
            $research->bahan_baku = $validated['bahan_baku'];
            $research->proses_produksi = $validated['proses_produksi'];
            $research->hpp = $validated['hpp'];
            $research->kemasan = $validated['kemasan'];
            $research->save();

            if ($request->has('files')) {
                foreach ($research->detailBerkas as $berkas) {
                    Storage::disk('public')->delete($berkas->file);
                    $berkas->delete();
                }

                foreach ($request->file('files') as $file) {
                    $filePath = $file->store('documents', 'public');
                    $research->detailBerkas()->create([
                        'file' => $filePath,
                    ]);
                }
            }

            return response()->json(['success' => true, 'data' => $research]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $research = Research::findOrFail($id);
            Storage::disk('public')->delete($research->foto_produk);
            foreach ($research->detailBerkas as $berkas) {
                Storage::disk('public')->delete($berkas->file);
                $berkas->delete();
            }
            $research->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
