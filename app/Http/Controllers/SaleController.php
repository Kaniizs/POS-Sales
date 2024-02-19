<?php


namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Payment;
use App\Models\SalesLineItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

// redirect to sale create page




class SaleController extends Controller
{
    public function index()
    {
        // Fetch all sales records from the database
        $sales = Sale::all();

        // Pass the sales data to the view
        return view('dashboard', ['sales' => $sales]);
    }

    public function make_payment(Request $request)
    {
        
        // Create a new payment for the sale
        $payment = new Payment();
        $payment->sale_id = $request->sale_id;
        $payment->amount = $request->amount;
        $payment->status = false;
        $payment->save();

        return Redirect::route('dashboard');

    }
    public function open_sale(Request $request)
    {
        // Create a new sale based from the last id
        $sale = new Sale();
        $sale->id = Sale::all()->count() + 1;
        $sale->save();

        return redirect()->route('dashboard')->with('sale', $sale)->with('status', 'Sale opened successfully.');

        
    }

    public function update_sale(Request $request)
    {
        $sale = Sale::find($request->id);
        $sale->total = $request->total;
        $sale->save();

        return Redirect::route('sale', ['id' => $sale->id]);
    }

    public function remove_sale(Request $request)
    { 
       // delete sale and reset the id
        $sale = Sale::find($request->id);
        $sale->delete();
        $sales = Sale::all();
        $i = 1;
        foreach ($sales as $sale) {
            $sale->id = $i;
            $sale->save();
            $i++;
        }

        return Redirect::route('dashboard');


        
    }


   

    public function process_payment(Request $request)
    {
        // process the payment after the sale is made
        $payment = Payment::find($request->id);
        $payment->status = true;
        $payment->save();

        return Redirect::route('dashboard');
    }


    public function create_sale_lines_item(Request $request)
    {
        // Create a new sale line item for the sale

        $sale_line = new SalesLineItem();
        $sale_line->sale_id = $request->sale_id;
        $sale_line->item_id = $request->item_id;
        $sale_line->quantity = $request->quantity;
        $sale_line->price = $request->price;
        $sale_line->save();

        return Redirect::route('dashboard');

    }

    public function remove_sale_lines_item(Request $request)
    {
        $sale_line = SalesLineItem::find($request->id);
        $sale_line->delete();

        return Redirect::route('dashboard');
    }







}