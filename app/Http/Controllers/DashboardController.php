<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function ControlNotifier()
    {

        // Out of stock Notifier
        // Define the test value to compare with
        $testValue = 20;

        // Get all products from the database
        $products = Product::all();

        $out_of_stock = [];
        // Loop through each product
        foreach ($products as $product) {
            // Get the product's store amount from the database
            $productStore = $product->product_store;

            // Check if the product's store amount is equal to the test value
            if ($productStore <= $testValue) {
                // Prompt the user that the product is running out of stock

                $out_of_stock[] = "$product->product_name";
            }
        }



        // Expiring soon Notifier


            // Retrieve all products with an expiry date
            $products = Product::whereNotNull('expire_date')->get();
            
            // Get the date two weeks before today
            $twoWeeksBefore = Carbon::now()->subWeeks(2)->format('Y-m-d');
            
            // Loop through the products to check for upcoming expiries
            $expiringSoon = [];
            
            foreach ($products as $product) {
                $expiryDate = Carbon::parse($product->expire_date)->format('Y-m-d');
    
                if ($expiryDate >= $twoWeeksBefore && $expiryDate <= date('Y-m-d')) {
    
                    $expiringSoon[] = $product->product_name;
    
                }
            }
            
            // Send notification for products expiring soon
            // if (!empty($expiringSoon)) {
            //     $message = 'The following products are expiring soon: ' . implode(', ', $expiringSoon);
            //     $data = ['message' => $message];
    
            //     $to = Auth::user()->email; // Replace with actual email address
                
            //     // Send email with mail markdown
            //     Mail::to($to)->send(new ExpiryNotification($data));
            // }
        

        return view('index', compact('out_of_stock', 'expiringSoon'));
    }
}
