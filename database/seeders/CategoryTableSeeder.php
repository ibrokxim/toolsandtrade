<?php

namespace Database\Seeders;

use League\Csv\Reader;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('seeders/csv/category.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            Category::firstOrCreate(['name' => $record['category']]);
        }
    }
}
