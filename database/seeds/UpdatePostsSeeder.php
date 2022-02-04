<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class UpdatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach($posts as $post){
            $data = [
                'category_id' => Category::inRandomOrder()->first()->id
            ];
            $post->update($data);
        }
    }
}
