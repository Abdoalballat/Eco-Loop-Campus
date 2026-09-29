<?php

namespace Database\Seeders;

use App\Models\catalog;
use App\Models\containers;
use App\Models\login;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        login::factory()->count(3)->sequence(
            [
                'id' => (string) \Illuminate\Support\Str::orderedUuid(),
                'name' => 'abderhman',
                'email' => 'abdoalballat3@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ] ,
            [
                'id' => (string) \Illuminate\Support\Str::orderedUuid(),
                'name' => 'adel',
                'email' => 'abdoalballat86@gmail.com',
                'password' => Hash::make('abdoalballat86@gmail.com'),
                'role' => 'employee',
            ] ,
            [
                'id' => (string) \Illuminate\Support\Str::orderedUuid(),
                'name' => 'student',
                'email' => 'abdelrhmanarfatwork@gmail.com',
                'password' => Hash::make('abdelrhmanarfatwork@gmail.com'),
                'role' => 'student',
            ]
        )->create();

        catalog::factory()->count(3)->sequence(
            [
                'id' => '1',
                'type' => 'metal',
                'points' => '2',
                'total_weight' => '50.000',
            ],
            [
                'id' => '2',
                'type' => 'wood',
                'points' => '1',
                'total_weight' => '0.000',
            ],
            [
                'id' => '3',
                'type' => 'new type',
                'points' => '5',
                'total_weight' => '0.000',
            ],
            )->create();

            containers::factory()->count(2)->sequence(
                [
                    'id' => '1',
                    'latitude' => '31.44756569',
                    'longitude' => '31.48767050',
                    'fill_level' => '50',
                    'status' => 'active',
                    'serial_number' => '5e-6f-4d-8a',
                    'location_name' => 'behind cs',
                ],
                [
                    'id' => '2',
                    'latitude' => '31.44062400',
                    'longitude' => '31.49428800',
                    'fill_level' => '0',
                    'status' => 'active',
                    'serial_number' => 'c5-a4-x9-b80',
                    'location_name' => 'قدام كلية حقوق',
                ],
                )->create();
    }
}
