<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_name = $request->search_name;

        $categories = Category::with('task')
                    ->when($search_name, function($q) use($search_name){
                        return $q->where('name', 'like', '%' . $search_name . '%');
                    })
                    ->paginate(5);
        
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100'
        ]);

        Category::create($validateData);

        return redirect()->route('categories.index')->with('session', 'Kategori pekerjaan berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Request $request)
    {
        return view('category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rule = [
            'name' => 'required|max:100'
        ];

        $validateData = $request->validate($rule);

        $category->update($validateData);

        return redirect()->route('categories.index')->with('session', 'Kategori pekerjaan berhasil ditambah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $countTask = count($category->task);

        if($countTask > 0){
            return back()->with('danger', 'Data gagal terhapus, karena kategori ini dipakai oleh data pekerjaan!');
        }

        $category->delete();

        return back()->with('success','Data Terhapus');
    }
}
