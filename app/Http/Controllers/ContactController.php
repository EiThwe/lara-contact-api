<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\SearchRecord;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $contacts = Contact::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;
                $builder->where("name", "like", "%" . $keyword . "%");
                $builder->orWhere("phone_number", "like", "%" . $keyword . "%");

                $isExist = SearchRecord::where("keyword", $keyword)->get();

                if (!$isExist) {
                    SearchRecord::create([
                        "keyword" => $keyword,
                        "user_id" => Auth::id()
                    ]);
                }
            });
        })->latest("id")->paginate(5)->withQueryString();
        return ContactResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "country_code" => "required|min:1|max:249",
            "phone_number" => "required|min:6"
        ]);
        $contact = Contact::create([
            "name" => $request->name,
            "country_code" => $request->country_code,
            "phone_number" => $request->phone_number,
            "user_id" => Auth::id()
        ]);



        return new ContactDetailResource($contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",
                // "error" =>"content not found"
            ], 404);
        }

        $this->authorize("view", $contact);

        return new ContactDetailResource($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "nullable|min:3|max:20",
            "country_code" => "nullable|integer|min:1|max:265",
            "phone_number" => "nullable|min:7|max:15"
        ]);

        $contact = Contact::find($id);

        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",
                // "error" =>"content not found"
            ], 404);
        }
        $this->authorize("update", $contact);
        // $contact->update([
        //     "name" => $request->name,
        //     "country_code" => $request->country_code,
        //     "phone_number" => $request->phone_number
        // ]);

        if ($request->has("name")) {
            $contact->name = $request->name;
        }
        if ($request->has("country_code")) {
            $contact->country_code = $request->country_code;
        }
        if ($request->has("phone_number")) {
            $contact->phone_number = $request->phone_number;
        }

        $contact->update();

        return new ContactDetailResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",
                // "error" =>"content not found"
            ], 404);
        }
        $this->authorize("delete", $contact);

        $contact->delete();
        // return response()->json([], 204);

        return response()->json([
            "message" => "Contact is deleted",
        ]);
    }

    public function trash()
    {
        $trash = Contact::onlyTrashed()->get();

        return ContactResource::collection($trash);
    }

    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->find($id);

        if (is_null($contact)) {
            return response()->json([

                "message" => "Contact not found in trash",

            ], 404);
        }

        $contact->restore();

        return response()->json([

            "message" => "Contact has been restored",

        ], 200);
    }

    public function restoreAll()
    {
        $contacts = Contact::onlyTrashed()->restore();

        // if (is_null($contacts)) {
        //     return response()->json([
        //         // "success" => false,
        //         "message" => "There is no contact in trash",
        //         // "error" =>"content not found"
        //     ], 404);
        // }

        // $contacts->restore();

        return response()->json([

            "message" => "Contacts have been restored",

        ], 200);
    }

    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->find($id);

        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found in trash",
                // "error" =>"content not found"
            ], 404);
        }

        $contact->forceDelete();

        return response()->json([

            "message" => "Contact is permanently deleted",

        ], 200);
    }
}
