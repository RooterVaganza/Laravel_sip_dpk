<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::pluck('name', 'id');
        $category = $request->input('category');
        $search = $request->input('search');

        $products = Product::query()->with('category');

        if (!empty($category)) {
            $products->where('category_id', $category);
        }

        if (!empty($search)) {
            $products->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }

        $products = $products->paginate(3)->appends([
            'category' => $category,
            'search' => $search
        ]);

        return view('admin.products.index', compact('products', 'categories', 'category', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required|min:10',
            'sku' => 'required|size:6',
            'price' => 'required|numeric',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Field Nama minimal 10 karakter',
            'category_id.required' => 'Category tidak boleh kosong',
            'sku.required' => 'SKU tidak boleh kosong',
            'sku.size' => 'Panjang SKU harus 6 karakter',
            'price.required' => 'Harga tidak boleh kosong',
            'image.required' => 'Gambar tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $image = $request->file('image')->store('products', 'public');

        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        $product->image = $image;
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('products.index')
            ->with('message', 'Create Product Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required|min:10',
            'sku' => 'required|size:6',
            'price' => 'required|numeric',
            'status' => 'required',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Field Nama minimal 10 karakter',
            'category_id.required' => 'Category tidak boleh kosong',
            'sku.required' => 'SKU tidak boleh kosong',
            'sku.size' => 'Panjang SKU harus 6 karakter',
            'price.required' => 'Harga tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $id)
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $product = Product::find($id);
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }

            $image = $request->file('image')->store('products', 'public');
            $product->image = $image;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with('message', 'Update Product Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            die('data not found');
        }

        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('message', 'deleted product succsess');
    }

}
