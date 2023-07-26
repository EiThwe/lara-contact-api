<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "contact_id" => "required|exists:contacts,id"
        ]);
        $isExist = Favourite::where("contact_id",$request->contact_id)->where("user_id",Auth::id());

       if(!$isExist){
        $favourite = Favourite::create([
            "contact_id" => $request->contact_id,
            "user_id" => Auth::id()
        ]);
       }else{
        return response()->json([
            "message" => "Contact is already in favourites",
        ]);
       }

        return response()->json([
            "message" => "Contact is added in favourites",
        ]);
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
        //
    }
}
