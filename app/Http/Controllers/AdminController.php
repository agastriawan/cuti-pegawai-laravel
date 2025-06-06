<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/list');
    }

    public function tambah_admin()
    {
        return view('admin/add');
    }

    public function edit_admin($id)
    {
        $admin = Admin::findOrFail($id);
        $data = [
            "admin" => $admin
        ];

        return view('admin/edit', $data);
    }

    public function _list_admin()
    {
        $admins = Admin::all();

        return response()->json([
            'data' => $admins
        ]);
    }

    public function _tambah_admin(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email|unique:admins,email',
            'birth_date'    => 'required|date',
            'gender'        => 'required|in:L,P',
            'password'      => 'required|confirmed|min:6',
        ]);

        Admin::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'birth_date' => $request->birth_date,
            'gender'     => $request->gender,
            'password'   => Hash::make($request->password),
        ]);

        session()->flash('success', 'Admin berhasil ditambahkan.');

        return redirect('admin');
    }

    public function _edit_admin(Request $request)
    {
        $admin = Admin::findOrFail($request->id);

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:admins,email,' . $request->id,
            'birth_date' => 'required|date',
            'gender'     => 'required|in:L,P',
            'password'   => 'nullable|confirmed|min:6',
        ]);

        $admin->first_name = $request->first_name;
        $admin->last_name  = $request->last_name;
        $admin->email      = $request->email;
        $admin->birth_date = $request->birth_date;
        $admin->gender     = $request->gender;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        session()->flash('success', 'Data admin berhasil diperbarui.');
        return redirect('admin');
    }

    public function _delete_admin($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();   

            return response()->json([
                'message' => 'Data berhasil dihapus.'
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
