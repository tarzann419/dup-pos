<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\StockControlMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class StockMailController extends Controller
{
    public function stockMail()
    {
        // Define the test value to compare with
        $testValue = 20;

        // Get all products from the database
        $products = Product::all();

        $prod_name = [];
        // Loop through each product
        foreach ($products as $product) {
            // Get the product's store amount from the database
            $productStore = $product->product_store;

            // Check if the product's store amount is equal to the test value
            if ($productStore <= $testValue) {
                // Prompt the user that the product is running out of stock
                
                $prod_name[] = "$product->product_name";

                $message = 'The following products are expiring soon: ' . implode(', ', $prod_name);
                $data = ['message' => $message];
                $to = Auth::user()->email; 
                
                // Send email with mail markdown
                Mail::to($to)->send(new StockControlMail($data));






            }
        }
    }
}
