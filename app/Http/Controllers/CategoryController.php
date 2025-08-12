<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('categories.index')->with('message', 'Create category success');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $this->authorize('update', $category);

        return view('admin.categories.edit', compact('category'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        $this->authorize('view', $category);

        return view('admin.categories.show', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->authorize('update', $category);

        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('categories.index')->with('message', 'Update category success');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Deleted category success');
    }
}
