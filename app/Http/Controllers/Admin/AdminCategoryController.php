<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Category::all();
        return view ('admin.category.form' , compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->title = $data['title']; 
        $category->slug = $data['slug']; 
        $category->description = $data['description']; 
        $category->status = $data['status'];
        $category->save();

        return redirect()->back()->with('success','Successfully added a category'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $list = Category::all();
        return view ('admin.category.form' , compact('category','list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = Category::find($id);
        $category->title = $data['title']; 
        $category->slug = $data['slug']; 
        $category->description = $data['description']; 
        $category->status = $data['status'];
        $category->save();
        return redirect()->back()->with('success','Successfully edit '); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cate = Category::find($id);
        $cate->delete();
        return redirect()->back()->with('success','Successfully delete '); 
    }
}
