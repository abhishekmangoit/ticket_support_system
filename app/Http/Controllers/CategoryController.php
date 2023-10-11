<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalRecords = Category::count();
        $limit = 5;
        $totalPages = ceil($totalRecords / $limit);

        $page = $request->query('page', 1);
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $limit;

        $category = Category::offset($offset)
            ->limit($limit)
            ->get();
        return view('admin.category.index', [
            'category' => $category,
            'page' => $page,
            'recordsPerPage' => $limit,
            'totalRecords' => $totalRecords,
            'totalPages' => $totalPages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'status' => 'required',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'status' => 'required',
        ]);

        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        } else {
            return redirect()->back()->with('warning', 'category not found');
        }

        return redirect()->back()->with('success', 'Category deleted successfully !');
    }
}
