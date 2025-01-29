<?php

namespace App\Services\Dimension\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $filePath = $filename = __DIR__.'/Data/products.json';

        // Check if the file exists
        if (File::exists($filePath)) {
            // Read and decode the JSON file
            $contents = File::get($filePath);
            $products = json_decode($contents, true);

            // Insert each weight into the database
            foreach ($products as $product) {
                $article_exists = DB::table('products')->where('article', $product['article'])->exists();
                if(!$article_exists) {
                    DB::table('products')->insert($product);
                }
            }
        } else {
            $this->command->error("File not found: {$filePath}");
        }
    }
}
