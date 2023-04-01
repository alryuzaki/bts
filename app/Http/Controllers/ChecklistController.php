<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;

class ChecklistController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function index()
    {
        $items = Checklist::all();

        return response(['data' => $items, 'status' => 200]);
    }

    public function store(Request $request)
    {
        $checklist = new Checklist;
        $checklist->name = $request->name;

        $checklist->save();

        return response()->json([
            'message'   => 'Checklist successfully added.',
            'data'      => $checklist,
        ], 201);
    }

    public function destroy($id)
    {
        $checklist = Checklist::find($id);

        if(is_null($checklist))
        {
            return response()->json([
                "success" => false,
                "message" => "Checklist does not exists.",
                ], 404);
        } else {
            Checklist::destroy($id);

            return response()->json([
                "success" => true,
                "message" => "Checklist has been deleted.",
                ], 201);
        }
    }
}
