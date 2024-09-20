<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DevicesBoxSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path to the JSON file
        $filePath = database_path('data/devices_box_sizes.json');

        // Check if the file exists
        if (File::exists($filePath)) {
            // Read and decode the JSON file
            $contents = File::get($filePath);
            $box_sizes = json_decode($contents, true);

            $tabel_name = 'devices_box_sizes';

            // Insert each weight into the database
            foreach ($box_sizes as $box_size) {
                $article_exists = DB::table($tabel_name)->where('article', $box_size['article'])->exists();
                if(!$article_exists) {
                    DB::table($tabel_name)->insert($box_size);
                }
            }
        } else {
            $this->command->error("File not found: {$filePath}");
        }
    }
}
