<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalRecords = User::count();
        $limit = 5;
        $totalPages = ceil($totalRecords / $limit);

        $page = $request->query('page', 1);
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $limit;

        $user = User::offset($offset)
            ->limit($limit)
            ->get();
        return view('admin.user.index', [
            'user' => $user,
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
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'confirmPassword' => 'required',
            'status' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => $request->input('status'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('user.index')->with('success', 'user registered successfully !');
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
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email,'.$id,
            'status' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('user.index')->with('success', 'user updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        } else {
            return redirect()->back()->with('warning', 'user not found');
        }

        return redirect()->back()->with('success', 'user deleted successfully !');
    }
}
