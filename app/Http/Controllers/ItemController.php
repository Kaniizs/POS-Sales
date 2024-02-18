<?php

namespace App\Http\Controllers;

# Controllers that CRUD Items
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function createItem(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:items,name|max:255',
            'description' => 'required|max:1000',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Please enter a name for the item.',
            'name.unique' => 'That name is already taken. Please choose another.',
            'description.required' => 'Please provide a description for the item.',
            'price.required' => 'Please enter the price of the item.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price cannot be negative.',
        ]);

        $item = Item::create($request->validated());

        return response()->json([
            'message' => 'Item created successfully!',
            'data' => $item,
        ], 201);


    }

    public function removeItem(Request $request, Item $item)
    {
        $item->delete();

        return response()->json([
            'message' => 'Item removed successfully!',
        ], 200);
    }

    public function updateItem(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|unique:items,name,' . $item->id . '|max:255',
            'description' => 'required|max:1000',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Please enter a name for the item.',
            'name.unique' => 'That name is already taken. Please choose another.',
            'description.required' => 'Please provide a description for the item.',
            'price.required' => 'Please enter the price of the item.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price cannot be negative.',
        ]);

        $item->update($request->validated());

        return response()->json([
            'message' => 'Item updated successfully!',
            'data' => $item,
        ], 200);
    }


}
