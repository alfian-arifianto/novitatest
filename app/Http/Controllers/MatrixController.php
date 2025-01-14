<?php

namespace App\Http\Controllers;

use App\Models\Matrix;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    public function index(Request $request) {
        $matrices = Matrix::all();
        return view('matrix.index', compact('matrices'));
    }
    public function show(Request $request, $id) {
        $matrix = Matrix::where('id', $id)->first();
        return view('matrix.show', compact('matrix'));
    }
    public function create(Request $request) {
        return view('matrix.create');
    }
    public function store(Request $request) {
        try {
            $combination = $request->length.'|'.$request->height;
            $check = Matrix::where('combination', $combination)->first();
            if($check) {
                alert()->error('Peringatan', 'Nilai Panjang dan Tinggi Sudah Ada');
                return redirect()->back();
            }

            Matrix::create([
                'length' => $request->length,
                'height' => $request->height,
                'combination' => $combination
            ]);
            alert()->success('Pemberitahuan','Berhasil Simpan Data');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Peringatan','Gagal Simpan Data');
            return redirect()->back();
        }
    }
    public function edit(Request $request, $id) {
        $matrix = Matrix::find($id);
        return view('matrix.edit', compact('matrix'));
    }
    public function update(Request $request, $id) {
        try {
            $combination = $request->length.'|'.$request->height;
            $check = Matrix::where('combination', $combination)->first();
            if($check) {
                alert()->error('Peringatan', 'Nilai Panjang dan Tinggi Sudah Ada');
                return redirect()->back();
            }

            Matrix::where('id', $id)->update([
                'length' => $request->length,
                'height' => $request->height,
                'combination' => $combination
            ]);
            alert()->success('Pemberitahuan', 'Berhasil Simpan Data');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Peringatan','Gagal Simpan Data');
            return redirect()->back();
        }
    }
    public function destroy(Request $request, $id) {
        try {
            $check = Matrix::where('id', $id)->first();
            if(!$check) {
                alert()->error('Peringatan','Data Tidak Ditemukan');
                return redirect()->back();
            }
            Matrix::where('id', $id)->delete();
            alert()->success('Pemberitahuan', 'Berhasil Hapus Data');
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->error('Peringatan','Gagal Hapus Data');
            return redirect()->back();
        }
    }
}
