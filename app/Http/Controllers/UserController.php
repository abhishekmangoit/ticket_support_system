<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                         if($row->status){
                            return 'Active';
                         }else{
                            return 'Inactive';
                         }
                    })
                    ->addColumn('role', function($row){
                        if($row->role == '3'){
                           return 'Regular User';
                        }elseif($row->role == '2'){
                            return 'Agent';
                         }else{
                           return 'Admin';
                        }
                   })
                   ->addColumn('action', function ($row) {
                    return '<a href="' . route('user.edit', $row->id) . '"><button class="btn btn-primary">Edit</button></a>';
                })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status') == '0' || $request->get('status') == '1') {
                            $instance->where('status', $request->get('status'));
                        }
                        if ($request->get('role') == '1' || $request->get('role') == '2' || $request->get('role') == '3') {
                            $instance->where('role', $request->get('role'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['status','role', 'action'])
                    ->make(true);
        }
        return view('admin.user.index');
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
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'status' => 'required',
            'role' => 'required',
        ]);

        $newuser = new User();
        $newuser->name = $request->input('name');
        $newuser->email = $request->input('email');
        $newuser->password = $request->input('password');
        $newuser->status = $request->input('status');
        $newuser->role = $request->input('role');
        $newuser->save();

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
