<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert( [
            [
                'name' => 'upper',
            ],
            [
                'name' => 'lower',
            ],
            [
                'name' => 'gauntlet',
            ],
            [
                'name' => 'helmet',
            ],
            [
                'name' => 'shoes',
            ],
            [
                'name' => 'weapon',
            ],
            [
                'name' => 'shield',
            ],
            [
                'name' => 'upgrade',
            ],
            [
                'name' => 'jade',
            ],
            [
                'name' => 'charm',
            ],
            [
                'name' => 'jewery',
            ],
            [
                'name' => 'other',
            ],
        ]
        );
    }
}
