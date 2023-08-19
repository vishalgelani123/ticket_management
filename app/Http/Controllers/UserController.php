<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('backend.user.index');
    }

    public function create()
    {
        $roles = Role::all();

        return view('backend.user.create', compact('roles'));
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->syncRoles($request->role);


//            Mail::send('admin.emails.users.create', compact('user'), function ($message) use ($user) {
//                $message->to($user->email)->subject('Welcome to ' . config('app.name'));
//            });
            return redirect()->route('users.index')->with(['success' => 'User created successfully']);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('backend.user.edit', compact('roles', 'user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->has('password') && $request->password != "") {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user->syncRoles($request->role);
            return redirect()->route('users.index')->with('success', "User updated successfully");
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', $e->getMessage());
        }
    }


    public function delete(User $user)
    {
        try {
            if ($user->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'User deleted successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "User not found!"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
