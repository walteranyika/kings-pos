<?php

namespace App\Http\Controllers;

use App\Damage;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDamageList()
    {
        $damaged_products = Damage::all();
        return view('damages.index', compact('damaged_products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDamageItem()
    {
        $products = Product::orderBy('name', 'asc')->where('status', 1)->select('id','name','cost_price', 'mrp','minimum_retail_price','quantity', 'tax_id', 'code')->get();
        return view('damages.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postDamageItem(Request $request)
    {
        $sells = $request->get('sells');
        $date =  $request->get('date');

        foreach ($sells as $sell_item) {
            $product = Product::findOrFail($sell_item['product_id']);
                $product->quantity = $product->quantity - $sell_item['quantity'];
            $product->save();

            $damage = new Damage;
                $damage->product_id = $sell_item['product_id'];
                $damage->quantity = $sell_item['quantity'];
                $damage->date = Carbon::parse($date);
                $damage->note = $sell_item['note'];
            $damage->save();
        }

        return response(['message' => 'Damage item saved succeessfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
