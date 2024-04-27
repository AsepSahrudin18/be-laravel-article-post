<?php

namespace Database\Seeders\Articles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class TableArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        $articles = [
            [
                "id" => 1,
                "title" => "Business Development",
                "category" => "Education",
                "content" => "lorem ipsum dolor sit amet",
                "status" => "draft",
                'created_date' => Carbon::now(), 
                'updated_date' => Carbon::now()
            ],
            [
                "id" => 2,
                "title" => "Business Development",
                "category" => "Education",
                "content" => "lorem ipsum dolor sit amet",
                "status" => "draft",
                'created_date' => Carbon::now(), 
                'updated_date' => Carbon::now()
            ],
            [
                "id" => 3,
                "title" => "Business Development",
                "category" => "Education",
                "content" => "lorem ipsum dolor sit amet",
                "status" => "draft",
                'created_date' => Carbon::now(), 
                'updated_date' => Carbon::now()
            ],
            [
                "id" => 4,
                "title" => "Business Development",
                "category" => "Education",
                "content" => "lorem ipsum dolor sit amet",
                "status" => "draft",
                'created_date' => Carbon::now(), 
                'updated_date' => Carbon::now()
            ],
            [
                "id" => 5,
                "title" => "Business Development",
                "category" => "Education",
                "content" => "lorem ipsum dolor sit amet",
                "status" => "draft",
                'created_date' => Carbon::now(), 
                'updated_date' => Carbon::now()
            ],
            [
                "id" => 6,
                "title" => "Business Development",
                "category" => "Education",
                "content" => "lorem ipsum dolor sit amet",
                "status" => "draft",
                'created_date' => Carbon::now(), 
                'updated_date' => Carbon::now()
            ],

        ];
        DB::table('posts')->insert($articles);
    }
}
