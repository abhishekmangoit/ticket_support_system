<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
         $category = Category::all();
         
        if ($request->ajax()) {
            $data = Category::select('id','name','status');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                })
                ->addColumn('action', function ($row) { 
                    return '<a href="'.route('category.edit', $row->id).'" class="btn btn-primary">Edit</a>
                        <form method="POST" action="'.route('category.destroy', $row->id).'" style="display: inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this category?\')" style="width: 70px;">Delete</button>
                    </form>';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('category'))) {
                        $instance->where('id', $request->get('category'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.category.index', ['data' => $category]);
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
        if ($category->tickets()->count() > 0) {
            return redirect()->back()->with('warning', 'Category cannot be deleted as it has open tickets !');
        } elseif ($category) {
            $category->delete();
        } else {
            return redirect()->back()->with('warning', 'category not found');
        }

        return redirect()->back()->with('success', 'Category deleted successfully !');
    }
}