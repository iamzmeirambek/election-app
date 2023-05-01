<?php

namespace Database\Seeders;

use App\Models\Election;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Election::create([
            'email' => '201350@astanait.edu.kz'
        ]);
        Election::create([
            'email' => '201358@astanait.edu.kz'
        ]);
    }
}
