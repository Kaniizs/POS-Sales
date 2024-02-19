<?php


namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class SaleController extends Controller
{

    public function open_sale(Request $request)
    {
        // create a new sale with date and time
        $sale = new Sale();
        $sale->save();

        // redirect to the sale page
        return Redirect::route('sale', ['id' => $sale->id]);

        
    }

    




}