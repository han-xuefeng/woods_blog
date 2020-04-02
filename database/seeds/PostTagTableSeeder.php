<?php

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag_ids = Tag::all()->pluck('id')->toArray();
        $posts = Post::all();
        $posts->each(function ($post) use ($tag_ids) {
            $post->tags()->attach(collect($tag_ids)->random(3));
        });
    }
}
