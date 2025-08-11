<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->status = $request->input('status');

        $category->save();

        return redirect()->route('categories.index')->with('message', 'create category succsess');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('categories.index')->with('message', 'create category succsess');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            die("category not found");
        }
        $category->delete();
        return redirect()->route(('categories.index'))->with('message', 'Deleted Category Sucsess');
    }
}
