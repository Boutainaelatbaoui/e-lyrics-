<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Lyrics;

class LyricsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lyrics = Lyrics::select('lyrics.*', 'songs.name as song')
        ->join('songs', 'songs.id', '=', 'lyrics.song_id')
        ->get();
        return response()->json([
        "success" => true,
        "message" => "Lyrics List",
        "data" => $lyrics
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'song_id' => 'required',
            'lyrics' => 'required | string',

        ]);
            
        $lyrics = new Lyrics;
        $lyrics->song_id = $request->song_id;
        $lyrics->lyrics = $request->lyrics;
        $lyrics->save();
        return response()->json([
        "success" => true,
        "message" => "Product created successfully.",
        "data" => $lyrics
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lyrics = Lyrics::find($id);
        if (is_null($lyrics)) {
        return response()->json([
            "success" => false,
            "message" => "Lyrics not found.",
            ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Lyrics retrieved successfully.",
        "data" => $lyrics
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'song_id' => 'required',
            'lyrics' => 'required | string',

        ]);
        
        $lyrics = Lyrics::find($id); 
        if (is_null($lyrics)) {
            return response()->json([
            "success" => false,
            "message" => "Lyrics not found.",
            ]);
        }  
        $lyrics->song_id = $request->song_id;
        $lyrics->lyrics = $request->lyrics;
        $lyrics->save();
        return response()->json([
        "success" => true,
        "message" => "Product updated successfully.",
        "data" => $lyrics
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lyrics = Lyrics::find($id);
        if (is_null($lyrics)) {
            return response()->json([
            "success" => false,
            "message" => "Lyrics not found.",
            ]);
        }
        $lyrics->delete();
        return response()->json([
            "success" => true,
            "message" => "Product deleted successfully.",
            "data" => $lyrics
        ]);
    }
}
