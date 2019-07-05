<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Article::class,30)->create();

//        DB::table('articles')->insert([
//            'title' =>'Title : '.Str::random(10),
//            'description' => 'Lorem Ipsum is back '.Str::random(10),
//            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
//            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
//            //'password' => bcrypt('secret'),
//        ]);
    }
}
