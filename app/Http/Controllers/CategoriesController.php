<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact([
            'categories'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        //1. validate data
        /**
         * CreateCategoryRequest is extending FormRequest and FormRequest is extending Request so basically CreateCategoryRequest is child of Request class
         * So we have validated data through CreateCategoryRequest
         */

        //2. store data in database
        Category::create([
            'name'=>$request->name
        ]);
        //3. Session set something and then return a view
        session()->flash('success','Category Added Successfully!');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact([
            'category'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
        // $category->update(['name'=>$request->name]);
        session()->flash('success',"Category Updated Successfully!");
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->posts->count()>0)
        {
            session()->flash('error',"Category cannot be Deleted as is it associated with some post!");
            return redirect()->back();

        }
        $category->delete();
        session()->flash('success',"Category Deleted Successfully!");
        return redirect(route('categories.index'));
    }
}
