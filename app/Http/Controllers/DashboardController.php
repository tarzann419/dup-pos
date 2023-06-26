<?php

namespace App\Http\Controllers;
use App\Models\Category;
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

        // loop through each product from db
        foreach ($products as $product) {
            // gt the products store amount from the database
            $productStore = $product->product_store;

            // heck if the product_store amount is equal to or less than the test value
            if ($productStore <= $testValue) {
                // prompt user that the following product is running out of stock
                $out_of_stock[] = [
                    'product_name' => $product->product_name,
                    'product_store' => $productStore
                ];
            }
        }




        // Expiring soon Notifier


        // Retrieve all products with an expiry date
        $products = Product::whereNotNull('expire_date')->get();

        $currentDate = Carbon::now();
        $expiringSoon = [];

        foreach ($products as $product) { //loops through all the products in db and gets all expiry dates for each product in the db
            $expiryDate = Carbon::parse($product->expire_date); //expire date is coming from database
            $twoWeeksFromNow = $currentDate->copy()->addWeeks(1);  // this copies current date and adds one week to it to get oneweek from now

            // if ($expiryDate->greaterThanOrEqualTo($twoWeeksFromNow)) {
            //     $expiringSoon[] = [
            //         'product_name' => $product->product_name,
            //         'expire_date' => $expiryDate
            //     ];
            //     // echo "Expiry Date: " . $expiryDate->format('Y-m-d') . PHP_EOL;
            // }

            if ($expiryDate->greaterThanOrEqualTo($twoWeeksFromNow)) { //means products are expiring in the next two weeks
                // Format the expiry date as "Y-m-d" (e.g., 2023-06-30)
                $formattedExpiryDate = $expiryDate->format('Y-m-d'); //save products >= two weeks from now
        
                // Add the product name and formatted expiry date to the $expiringSoon array after looping through
                $expiringSoon[] = [
                    'product_name' => $product->product_name,
                    'expire_date' => $formattedExpiryDate
                ];            }
        }

        $products = Product::all();
        $category = Category::all();
        return view('index', compact('out_of_stock', 'expiringSoon', 'category', 'products')); //
    }
}
