<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        /*$search = request('search');
        if($search){
            $posts = Post::where('title','like',"%$search%")->simplePaginate(2);
        }else{
            $post = Post::simplePaginate(2);
        }
        return view('blog.index',[
            'tags' => Tag::all(),
            'categories' => Category::all(),
            'posts' => Post::simplePaginate(2)
        ]);*/
        return view('blog.index',[
            'tags' => Tag::all(),
            'categories' => Category::all(),
            'posts' => Post::search()->published()->simplePaginate(2)
        ]);
    }

    public function show(Post $post){
        $tags = Tag::all();
        $categories = Category::all();
        return view('blog.post', compact([
            'post',
            'tags',
            'categories' 
        ]));
    }

    public function category(Category $category){
        return view('blog.index',[
            'tags' => Tag::all(),
            'categories' => Category::all(),
            'posts' => $category->posts()->search()->published()->simplePaginate(2)
        ]);
    }

    public function tag(Tag $tag){
        return view('blog.index',[
            'tags' => Tag::all(),
            'categories' => Category::all(),
            'posts' => $tag->posts()->search()->published()->simplePaginate(2)
        ]);
    }
}
