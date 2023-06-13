<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\ExpiryNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class ExpiryNotificationController extends Controller
{
    public function sendExpiryNotification()
    {
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
        if (!empty($expiringSoon)) {
            $message = 'The following products are expiring soon: ' . implode(', ', $expiringSoon);
            $data = ['message' => $message];

            $to = Auth::user()->email; // Replace with actual email address
            
            // Send email with mail markdown
            Mail::to($to)->send(new ExpiryNotification($data));
        }
    }
}
