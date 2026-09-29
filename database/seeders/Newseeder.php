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
                'name' => 'student',
                'university_id'=>'123456',
                'email' => 'abdelrhmanarfatwork@gmail.com',
                'password' => Hash::make('abdelrhmanarfatwork@gmail.com'),
                'role' => 'student',
                ]);
    }
}
