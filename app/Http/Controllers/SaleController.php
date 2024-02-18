<?php


namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class SaleController extends Controller
{

    // CRUD methods for sales and sales line items
     
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    public function openSale(Request $request)
    {
        $sale = Sale::create([
            'date' => now()
        ]);
        return Redirect::to('/sales/' . $sale->id);
    }

    




}