<?php

namespace App\Http\Controllers;

# Controllers that CRUD Items
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create_item(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity must be a number',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->route('items');

    }

    public function update_item(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity must be a number',
        ]);

        $item = Item::find($request->id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->route('items');
    }

    public function delete_item(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();

        return redirect()->route('items');
    }

    public function get_all_items(Request $request)
    {
        $items = Item::all();
        return view('items', ['items' => $items]);
    }


}
