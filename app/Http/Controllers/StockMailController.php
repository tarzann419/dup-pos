<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\StockControlMail;
use App\Models\Product;



class StockMailController extends Controller
{
    public function stockMail()
    {
        // Define the test value to compare with
        $testValue = 20;

        // Get all products from the database
        $products = Product::all();

        // Loop through each product
        foreach ($products as $product) {
            // Get the product's store amount from the database
            $productStore = $product->product_store;

            // Check if the product's store amount is equal to the test value
            if ($productStore >= $testValue) {
                // Prompt the user that the product is running out of stock

                $prod_name = "{$product->product_name}";

                Mail::to('kingxb7@gmail.com')->send(new StockControlMail($prod_name));

                // echo "The product {$product->product_name} is running out of stock!\n";

            }
        }
    }
}
