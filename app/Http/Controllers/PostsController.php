<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware(['verifyCategoriesCount'])->only('create','store');
        $this->middleware(['validateAuthor'])->only('edit','update','destroy','trash');
    }
    
    public function index()
    {
        if(!auth()->user()->isAdmin()){
            $posts = Post::withoutTrashed()->where('user_id',auth()->id())->paginate(10);
        }
        else{
            $posts = Post::paginate(10);
        }
        return view('posts.index',compact([
            'posts'
        ]));
    }

    
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create',compact(['categories','tags']));
    }

   
    public function store(CreatePostRequest $request)
    {
        //1. Image upload and store name of image
        $image = $request->file('image')->store('posts');
        //run command: php artisan storage:link
        //2. Create Post
        $post = Post::create([
            'title'=>$request->title,
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'image'=>$image,
            'user_id'=>auth()->id(),
            'published_at'=>$request->published_at,
            'category_id'=>$request->category_id
        ]);
        $post->tags()->attach($request->tags);
        //3. Session storage
        session()->flash('success','Post Created Successfully!');
        //4. Redirect
        return redirect(route('posts.index'));
    }

    
    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        // return view('posts.edit')->with('post',$post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit',compact([
            'categories',
            'post',
            'tags'
        ]));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','excerpt','content','published_at','category_id']);
        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $data['image'] = $image;
        }
        $post->update($data);
        
        $post->tags()->sync($request->tags);
        
        session()->flash('success','Post Update Successfully!');
        return redirect(route('posts.index'));
    }

    
    public function destroy($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success','Post Deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Post $post)
    {
        $post->delete();
        session()->flash('success','Post trashed successfully!');
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        // $trashed = DB::table('posts')->whereNotNull('deleted_at');
        $trashed = Post::onlyTrashed()->paginate(10);
        return view('posts.trashed')->with('posts',$trashed);

        
    }
    public function restore($id)
    {
        $trashedPost = Post::onlyTrashed()->findOrFail($id);
        $trashedPost->restore();
        session()->flash('success','Post restored successfully!');
        return redirect(route('posts.index'));
    }



}
