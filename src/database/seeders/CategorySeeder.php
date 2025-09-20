<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => '商品に関するお問い合わせ']);
        Category::create(['name' => 'サービスに関するお問い合わせ']);
        Category::create(['name' => 'その他']);
    }
}
