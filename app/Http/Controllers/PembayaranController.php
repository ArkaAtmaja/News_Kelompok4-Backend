<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $pembayaran = Pembayaran::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $pembayaran
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        try {
            //$request->all() untuk mngambil semua input dalam request body
            $pembayaran = Pembayaran::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $pembayaran
            ], 200); //status code 200 = success
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    public function show($id)
    {
        try {
            $pembayaran = Pembayaran::find($id);

            if (!$pembayaran) throw new \Exception("Pem$pembayaran tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $pembayaran
            ], 200); //status code 200 = success
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pembayaran = Pembayaran::find($id);

            if (!$pembayaran) throw new \Exception("pembayaran tidak ditemukan");

            $pembayaran->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil update data',
                "data" => $pembayaran
            ], 200); //status code 200 = success
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    public function destroy($id)
    {
        try {
            $pembayaran = Pembayaran::find($id);

            if (!$pembayaran) throw new \Exception("pembayaran tidak ditemukan");

            $pembayaran->delete();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil delete data',
                "data" => $pembayaran
            ], 200); //status code 200 = success
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }
}
