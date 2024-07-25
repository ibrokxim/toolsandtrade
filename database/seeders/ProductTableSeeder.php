<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class ProductTableSeeder extends Seeder
{

    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('database/seeders/csv/products.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $manufacturer = Manufacturer::firstOrCreate(
                ['name' => $record['manufacturer']]
            );

            $category = Category::firstOrCreate(
                ['name' => $record['category']]
            );

            Product::firstOrCreate(
                [
                    'name' => $record['name'],
                    'slug' => $record['slug'],
                ],
                [
                    'image' => $record['image'],
                    'short_description' => $record['short_description'],
                    'description' => $record['description'],
                    'characteristics' => $record['characteristics'],
                    'manufacturer_id' => $manufacturer->id,
                    'category_id' => $category->id,
                ]
            );
        }
    }
}
