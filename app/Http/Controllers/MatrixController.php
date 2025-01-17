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
    public function data(Request $request) {
        $perpage = $request->perpage ?? 5;
        $matrices = Matrix::orderBy('updated_at', 'DESC')->simplePaginate($perpage);
        return response()
            ->json(['message' => 'Data Ditemukan', $matrices])
            ->withCallback($request->input('callback'));
    }
    public function detail(Request $request, $id) {
        try {
            $matrix = Matrix::where('id', $id)->first();
            if(!$matrix) {
                return response()->json([
                    'message' => 'Data Tidak Ditemukan',
                    'data' => null
                ], 400);
            }

            $randomized_matrix = [];
            for ($length=0; $length < $matrix->length; $length++) {
                for ($height=0; $height < $matrix->height; $height++) {
                    $randomized_matrix[] = (Object) [
                        'x' => $length+1,
                        'y' => $height+1,
                        'value' => rand(1, 99)
                    ];
                }
            }
            $matrix->randomized_matrix = $randomized_matrix;
            
            return response()->json([
                'message' => 'Data Berhasil Ditemukan',
                'data' => $matrix
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan',
                'data' => $request->all()
            ], 400);
        }
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
            Matrix::create([
                'length' => $request->length,
                'height' => $request->height
            ]);
            return response()
                ->json(['message' => 'Data Berhasil Disimpan', 'data' => $request->all()])
                ->withCallback($request->input('callback'));
        } catch (\Throwable $th) {
            return response()
                ->json(['message' => 'Data Gagal Disimpan', 'data' => $request->all()], 400)
                ->withCallback($request->input('callback'));
        }
    }
    public function edit(Request $request, $id) {
        $matrix = Matrix::find($id);
        return view('matrix.edit', compact('matrix'));
    }
    public function update(Request $request, $id) {
        try {
            Matrix::where('id', $id)->update([
                'length' => $request->length,
                'height' => $request->height
            ]);
            return response()
                ->json(['message' => 'Data Berhasil Disimpan', 'data' => $request->all()])
                ->withCallback($request->input('callback'));
        } catch (\Throwable $th) {
            return response()
                ->json(['message' => 'Data Gagal Disimpan', 'data' => $request->all()], 400)
                ->withCallback($request->input('callback'));
        }
    }
    public function destroy(Request $request, $id) {
        try {
            $check = Matrix::where('id', $id)->first();
            if(!$check) {
                return response()->json([
                    'message' => 'Data Tidak Ditemukan',
                    'data' => $request->all()
                ], 400);
            }
            Matrix::where('id', $id)->delete();
            return response()
                ->json(['message' => 'Data Berhasil Dihapus', 'data' => null])
                ->withCallback($request->input('callback'));
        } catch (\Throwable $th) {
            return response()
                ->json(['message' => 'Data Gagal Dihapus', 'data' => null], 400)
                ->withCallback($request->input('callback'));
        }
    }
}
