<?php

namespace App\Http\Controllers;

use Carbon\Carbon; //they're models or dependencies or packages; carbon is for time 
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\ExpiryNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class ExpiryNotificationController extends Controller
{
  static  public function sendExpiryNotification()
    {
        // Retrieve all products with an expiry date
        $products = Product::whereNotNull('expire_date')->get();

        // Get the current date and time using Carbon \
        $currentDate = Carbon::now();

        // Initialize an empty array to store products expiring soon
        $expiringSoon = [];

        // Loop through each product in the $products array
        foreach ($products as $product) {
            // Parse the expiry date of the product using Carbon

            $expiryDate = Carbon::parse($product->expire_date);

            // Calculate the date two weeks from the current date
            $twoWeeksFromNow = $currentDate->copy()->addWeeks(2); 

            // Check if the expiry date is greater than or equal to two weeks from now

            if ($expiryDate->greaterThanOrEqualTo($twoWeeksFromNow)) {
                // Add the product name to the $expiringSoon array
                $expiringSoon[] = $product->product_name . ' Expiry Date:  ' . $expiryDate . '. Check Now)';; 
            }
        }


        // Send notification for products expiring soon
        if (!empty($expiringSoon)) {
            $message = implode("\n", $expiringSoon);
            $data = ['message' => $message];

            $to = Auth::user()->email; // Replace with actual email address

            // Send email with mail markdown
            Mail::to($to)->send(new ExpiryNotification($data));
        }
    }
}
