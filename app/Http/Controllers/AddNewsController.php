<?php

namespace App\Http\Controllers;

use App\Models\addNews;
use Illuminate\Http\Request;

class AddNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $news = addNews::all();
        // return response()->json($news);
        try {
            $news = addNews::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $news
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
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            //$request->all() untuk mngambil semua input dalam request body
            $news = addNews::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $news
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
            $news = addNews::find($id);

            if (!$news) throw new \Exception("news tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $news
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
            $news = addNews::find($id);

            if (!$news) throw new \Exception("news tidak ditemukan");

            $news->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil update data',
                "data" => $news
            ], 200); //status code 200 = success
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    public function updateLokasi(Request $request, $id)
    {
        try {
            $request->validate([
                'lokasi' => 'required|max:60',
            ]);
            $news = addNews::find($id);

            if (!$news) throw new \Exception("news tidak ditemukan");

            $news->update([
                'lokasi' => $request->lokasi,
            ]);

            return response()->json([
                "status" => true,
                "message" => 'Berhasil update data',
                "data" => $news
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
            $news = addNews::find($id);

            if (!$news) throw new \Exception("news tidak ditemukan");

            $news->delete();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil delete data',
                "data" => $news
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
