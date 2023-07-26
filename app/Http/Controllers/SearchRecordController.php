<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchRecordResource;
use App\Models\SearchRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keywords = SearchRecord::where("user_id", Auth::id())->get();
        return SearchRecordResource::collection($keywords);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keyword = SearchRecord::find($id);
        if (is_null($keyword)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",
                // "error" =>"content not found"
            ], 404);
        }

        $this->authorize("delete", $keyword);

        $keyword->delete();
        // return response()->json([], 204);

        return response()->json([
            "message" => "Keyword is deleted",
        ]);
    }
}
