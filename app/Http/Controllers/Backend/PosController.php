<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Product;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function Pos()
    {
        $product = Product::latest()->get();
        $customer = Customer::latest()->get();

        return view('backend.pos.pos_page', compact('product', 'customer'));
    }

    public function AddCart(Request $request)
    {

        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'options' => ['size' => 'large']
        ]);


        $notification = array(
            'message' => 'Product Carted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function AllItem(){
        $product_item = Cart::content();

        return view('backend.pos.text_item', compact('product_item'));
    }

    public function CartUpdate(Request $request, $rowId){
        $qty = $request->qty01;

        Cart::update($rowId, $qty);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CartRemove($rowId){
        $remove = Cart::remove($rowId);

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function CreateInvoice(Request $request){

        $contents = Cart::content();
        $todaysDate = Carbon::now()->toDateString();
        $cust_id = $request->customer_id;
        $customer = Customer::where('id',$cust_id)->first();
        return view('backend.invoice.product_invoice',compact('contents', 'todaysDate', 'customer'));

   } // End Method 
}
