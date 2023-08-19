<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('backend.profile.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        try {
            $user = Auth::User();
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->has('password') && $request->password != "") {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return back()->with(['success' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}
