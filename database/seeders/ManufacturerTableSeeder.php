<?php

namespace Database\Seeders;

use League\Csv\Reader;
use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturerTableSeeder extends Seeder
{
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('seeders/csv/manufacturers.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            Manufacturer::firstOrCreate(['name' => $record['Manufacturer']]);
        }
    }
}
