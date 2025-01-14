<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matrix;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
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
            $data = (Object) [
                'length' => $matrix->length,
                'height' => $matrix->height,
                'randomized_matrix' => $randomized_matrix
            ];
            
            return response()->json([
                'message' => 'Data Berhasil Ditemukan',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan',
                'data' => $request->all()
            ], 400);
        }
    }
    public function creating(Request $request) {
        try {
            $combination = $request->length.'|'.$request->height;
            $check = Matrix::where('combination', $combination)->first();
            if($check) {
                return response()->json([
                    'message' => 'Nilai Panjang dan Tinggi Sudah Ada',
                    'data' => $request->all()
                ], 400);
            }
            Matrix::create([
                'length' => $request->length,
                'height' => $request->height,
                'combination' => $combination
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
    public function updating(Request $request, $id) {
        try {
            $combination = $request->length.'|'.$request->height;
            $check = Matrix::where('combination', $combination)->where('id', '!=', $id)->first();
            if($check) {
                return response()->json([
                    'message' => 'Nilai Panjang dan Tinggi Sudah Ada',
                    'data' => $request->all()
                ], 400);
            }
            Matrix::where('id', $id)->update([
                'length' => $request->length,
                'height' => $request->height,
                'combination' => $combination
            ]);
            return response()
                ->json(['message' => 'Data Berhasil Disimpan', 'data' => $request->all()])
                ->withCallback($request->input('callback'));
        } catch (\Throwable $th) {
            return response()
                ->json(['message' => 'Data Gagal Disimpan '.$th->getMessage(), 'data' => $request->all()], 400)
                ->withCallback($request->input('callback'));
        }
    }
    public function deleting(Request $request, $id) {
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
