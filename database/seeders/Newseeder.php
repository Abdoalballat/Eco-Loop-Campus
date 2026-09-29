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
        login::create([
                    'id' => (string) \Illuminate\Support\Str::orderedUuid(),
                'name' => 'adel_student',
                'email' => 'adel_student@gmail.com',
                'university_id'=>'000000',
                'password' => Hash::make('adel_student@gmail.com'),
                'role' => 'student',
                ]);
    }
}
