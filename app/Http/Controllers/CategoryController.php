<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //index 
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $categories = Category::where('category_name', 'like', '%' . $keyword . '%')
        ->latest()
        ->paginate(10);

        return view('category.index', compact('categories'));
    }

    //user create
    public function create()
    {

        return view('category.create');
    }

    //user store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories,category_name',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }

            Category::create([
                'category_name' => $request->category_name,
                'description' => $request->description,
            ]);
            return redirect()->route('category.index')->with('success', 'category added successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.update', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput(); // mengembalikan input
        };

        $category = category::findORFail($id);

            $category -> update([
                'category_name' => $request->category_name,
                'description' => $request->description,
            ]);

        return redirect()->route('category.index')->with('success', 'category berhasil diperbarui');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category.index')->with('success', 'category berhasil dihapus');
    }
}

