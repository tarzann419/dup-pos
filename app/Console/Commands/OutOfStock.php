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
        $test = Product::latest()->get()->value('product_store');
        // $newTest = Product::find($test);
        if ($test == 21) {
            $newTest = Product::find($test)->get()->value('product_name');
            echo 'yes there is' . $newTest;

            // echo $newTest->product_name . 'is running out of stock';
        } 
        else {
            $newTest = Product::find($test)->get()->value('product_name');
            echo 'there IS NOT' . $newTest;
            // echo $newTest->product_name . ' ' . 'is NOT out of stock';
        }


        // $test = Product::where('id', 3)->value('product_name');
        // echo $test;
    }
}
