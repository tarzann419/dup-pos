<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function StockConfigure(){
        $product = Product::latest()->get();
        return view('backend.stock.configure_stock', compact('product'));
    }



    public function UpdateStock(Request $request)
    {
        $product_id = $request->id;


            Product::findOrFail($product_id)->update([

                
                'product_store' => $request->product_store,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Product Stock Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


        }
}
