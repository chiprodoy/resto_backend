<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'uuid'=>'-',
            'title'=>'Promo 1',
            'slug'=>'',
            'cover'=>'promo1.jpg',
            'content'=>'Coba Content',
            'author_id'=>1
        ]);
        Blog::create([
            'uuid'=>'-',
            'title'=>'Promo 2',
            'slug'=>'',
            'cover'=>'promo2.jpg',
            'content'=>'Coba Content',
            'author_id'=>1
        ]);
        Blog::create([
            'uuid'=>'-',
            'title'=>'Promo 3',
            'slug'=>'',
            'cover'=>'promo3.jpg',
            'content'=>'Coba Content',
            'author_id'=>1
        ]);
    }
}
