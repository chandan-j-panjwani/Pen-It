<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNews = \App\Category::create(['name'=>'News']);
        $categoryDesign = \App\Category::create(['name'=>'Design']);
        $categoryTechnology = \App\Category::create(['name'=>'Technology']);
        $categoryEngineering = \App\Category::create(['name'=>'Engineering']);

        $tagCustomers = \App\Tag::create(['name'=>'customers']);
        $tagDesign = \App\Tag::create(['name'=>'design']);
        $tagLaravel = \App\Tag::create(['name'=>'laravel']);
        $tagCoding = \App\Tag::create(['name'=>'coding']);

        $post1 = \App\Post::create([
            'title'=>'We relocated our office to Home!',
            'excerpt'=>Faker\Factory::create()->sentence(rand(10,18)),
            'content'=>Faker\Factory::create()->paragraphs(rand(3,7),true),
            'image'=>'posts/1.jpg',
            'category_id'=>$categoryNews->id,
            'user_id'=>1,
            'published_at'=>\Carbon\Carbon::now()->format('Y-m-d')
        ]);

        $post2 = \App\Post::create([
            'title'=>'The Boom Of Subtle Shapes',
            'excerpt'=>Faker\Factory::create()->sentence(rand(10,18)),
            'content'=>Faker\Factory::create()->paragraphs(rand(3,7),true),
            'image'=>'posts/2.jpg',
            'category_id'=>$categoryTechnology->id,
            'user_id'=>2,
            'published_at'=>\Carbon\Carbon::now()->format('Y-m-d')
        ]);

        $post3 = \App\Post::create([
            'title'=>'ES6 And Its Significance!',
            'excerpt'=>Faker\Factory::create()->sentence(rand(10,18)),
            'content'=>Faker\Factory::create()->paragraphs(rand(3,7),true),
            'image'=>'posts/3.jpg',
            'category_id'=>$categoryEngineering->id,
            'user_id'=>3,
            'published_at'=>\Carbon\Carbon::now()->format('Y-m-d')
        ]);

        $post4 = \App\Post::create([
            'title'=>'Fashion is meeting Tech-Designers!',
            'excerpt'=>Faker\Factory::create()->sentence(rand(10,18)),
            'content'=>Faker\Factory::create()->paragraphs(rand(3,7),true),
            'image'=>'posts/4.jpg',
            'category_id'=>$categoryNews->id,
            'user_id'=>2,
            'published_at'=>\Carbon\Carbon::now()->format('Y-m-d')
        ]);

        $post5 = \App\Post::create([
            'title'=>'Designs And Patterns!',
            'excerpt'=>Faker\Factory::create()->sentence(rand(10,18)),
            'content'=>Faker\Factory::create()->paragraphs(rand(3,7),true),
            'image'=>'posts/5.jpg',
            'category_id'=>$categoryDesign->id,
            'user_id'=>1,
            'published_at'=>\Carbon\Carbon::now()->format('Y-m-d')
        ]);
        
        
        $post1->tags()->attach([$tagCoding->id,$tagLaravel->id]);
        $post2->tags()->attach([$tagCoding->id,$tagCustomers->id]);
        $post3->tags()->attach([$tagDesign->id,$tagLaravel->id]);
        $post4->tags()->attach([$tagDesign->id,$tagCustomers->id]);
        $post5->tags()->attach([$tagLaravel->id]);

    }
}
