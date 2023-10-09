<?php

namespace Database\Seeders;

use App\Models\Galleries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        Galleries::factory(50)->create();
        
    }
}
