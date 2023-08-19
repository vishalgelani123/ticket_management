<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technical Support',
            'Billing Inquiry',
            'Account Help',
            'General Inquiry',
            'Feedback'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
