<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class OutOfStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'low:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prompts Current User that theres low product';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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


                $prod_name = "The product {$product->product_name} is running out of stock!\n";

                echo $prod_name;

                // return redirect()->route('stock.control', $prod_name);





            }
        }

        // Prompt the user that the check is complete
        // echo "Stock check complete!\n";


    }
}
