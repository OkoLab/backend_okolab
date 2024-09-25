<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PackingBoxSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $filePath = database_path('data/packing_box_sizes.json');

        // Check if the file exists
        if (File::exists($filePath)) {
            // Read and decode the JSON file
            $contents = File::get($filePath);
            $box_sizes = json_decode($contents, true);
        
            $tabel_name = 'packing_box_sizes';
        
            // Insert each weight into the database
            foreach ($box_sizes as $box_size) {
                $name_exists = DB::table($tabel_name)->where('name', $box_size['name'])->exists();
                if(!$name_exists) {
                    DB::table($tabel_name)->insert($box_size);
                } else {
                    $this->command->error("File not found: {$filePath}");
                }
            }
        }
    }
}
