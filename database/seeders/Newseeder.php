<?php

namespace Database\Seeders;

use App\Models\catalog;
use App\Models\containers;
use App\Models\login;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Newseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        containers::create([
                                                    'id' => '2',
                    'latitude' => '31.44756569',
                    'longitude' => '31.48767050',
                    'fill_level' => '50',
                    'status' => 'active',
                    'serial_number' => '5e-6f-4d-8a',
                    'location_name' => 'قدام كلية حقوق',
                ]);
    }
}
