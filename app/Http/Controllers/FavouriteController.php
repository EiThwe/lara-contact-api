<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\ContactResource;
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
       $favourites= Favourite::latest("id")->paginate(10)->withQueryString();
       $data = [];
       foreach($favourites as $favourite){
        array_push($data,["contact"=> new ContactResource($favourite->contact)]);
       }
       return response()->json([
        'data'=>$data
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "contact_id" => "required|exists:contacts,id"
        ]);
        $isExist = Favourite::where("contact_id", $request->contact_id)->where("user_id", Auth::id())->first();

        if ($isExist) {
            return response()->json([
                "message" => "Contact is already in favourites",
            ]);
        }
        $favourite = Favourite::create([
            "contact_id" => $request->contact_id,
            "user_id" => Auth::id()
        ]);

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
       $favourite_contact = Favourite::find($id);
       if(is_null($favourite_contact)){
        return response()->json([
            // "success" => false,
            "message" => "Contact not found",
            // "error" =>"content not found"
        ], 404);
       }
       $favourite_contact->delete();
       // return response()->json([], 204);

       return response()->json([
           "message" => "Contact is deleted",
       ]);
    }
}
