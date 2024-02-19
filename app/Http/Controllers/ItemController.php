<?php

namespace App\Http\Controllers;

# Controllers that CRUD Items
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public static function get_available_items()
    {
        return Item::where('stock', '>', 0)->get();
    }
    public function create_item(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'stock.required' => 'Stock is required',
            'stock.numeric' => 'Stock must be a number',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->id = Item::all()->count() + 1;
        $item->save();

        return redirect()->route('items');

    }

    public function update_item(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ], [
            'price.numeric' => 'Price must be a number',
            'stock.numeric' => 'Quantity must be a number',
        ]);

        $item = Item::find($request->id)->first();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();

        return redirect()->route('items');
    }

    public function delete_item(Request $request)
    {
        // delete and reset id
        $item = Item::find($request->id);
        $item->delete();
        $items = Item::all();
        $i = 1;
        foreach ($items as $item) {
            $item->id = $i;
            $item->save();
            $i++;
        }
        return redirect()->route('items');

    }




}
