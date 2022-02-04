<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{

    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public static function createSlug($title){

        $slug = Str::slug($title);
        $base_slug = $slug;

        $slug_dataBase = Post::where('slug', $slug)->first();
        $c = 2;

        while($slug_dataBase){
            $slug = $base_slug . '-' . $c;
            $c++;
            $slug_dataBase = Post::where('slug', $slug)->first();
        }

        return $slug;
    }

}
