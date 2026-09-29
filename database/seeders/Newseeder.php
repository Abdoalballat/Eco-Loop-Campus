<?php

namespace Database\Seeders;

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
        login::create(['id' => (string) \Illuminate\Support\Str::orderedUuid(),
                'name' => 'abderhman',
                'email' => 'abdoalballat3@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin']);
    }
}
