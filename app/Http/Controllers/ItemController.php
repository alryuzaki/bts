<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Checklist;

class ItemController extends Controller
{
    public function __construct()
    {

        //MIDDLEWARE
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function getItem($id)
    {
        $item = Checklist::with('items')->find($id);

        if(is_null($item))
        {
            return response()->json([
                "status" => 0,
                "message" => "Item not exists.",
                ], 404);
        } else {
            return response()->json([
                "success" => true,
                "message" => "List Item",
                "data" => $item,
                ], 200);
        }
    }

    public function store(Request $request, $checklist_id)
    {
        $item = new Item;
        $item->checklist_id = $checklist_id;
        $item->item_name = $request->itemName;

        $item->save();

        return response()->json([
            'message'   => 'Item successfully added.',
            'data'      => $item,
        ], 201);
    }

    public function show($checklist_id, $item_id)
    {
        $item = Item::with('checklist')->find($item_id);

        return response()->json([
            "success" => true,
            "message" => "List Item",
            "data" => $item,
            ], 200);
    }

    public function store_status(Request $request, $checklist_id, $item_id) {
        $item = new Item;
        $item->checklist_id = $checklist_id;
        $item->item_name = $request->itemName;

        $item->save();

        return response()->json([
            'message'   => 'Item successfully added.',
            'data'      => $item,
        ], 201);
    }

    public function destroy($checklist_id)
    {
        $item = Checklist::with('items')->find($checklist_id);

        if(is_null($item))
        {
            return response()->json([
                "success" => false,
                "message" => "Checklist does not exists.",
                ], 404);
        } else {
            Item::destroy($item['checklist_id']);

            return response()->json([
                "success" => true,
                "message" => "Checklist has been deleted.",
                ], 201);
        }
    }

    public function rename(Request $request, $item_id) {
        $item = Checklist::with('items')->find($item_id);

        $input = $request->all();

        $item->item_name = $input['itemName'];

        $item->save();

        return response()->json([
            "success" => true,
            "message" => "User Data has been updated.",
            "data" => $item,
            ], 202);
    }
}
