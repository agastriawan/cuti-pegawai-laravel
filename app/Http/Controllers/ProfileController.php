<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function profile()
    {
        return view('profile');
    }


    public function _edit_profile(Request $request)
    {
        $profile = Admin::findOrFail($request->id);

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:admins,email,' . $request->id,
            'birth_date' => 'required|date',
            'gender'     => 'required|in:L,P',
            'password'   => 'nullable|confirmed|min:6',
        ]);

        $profile->first_name = $request->first_name;
        $profile->last_name  = $request->last_name;
        $profile->email      = $request->email;
        $profile->birth_date = $request->birth_date;
        $profile->gender     = $request->gender;

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }

        $profile->save();

        session()->flash('success', 'Data profile berhasil diperbarui.');
        return redirect('profile');
    }
}
