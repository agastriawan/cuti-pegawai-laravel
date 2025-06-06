<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee/list');
    }

    public function tambah_employee()
    {
        return view('employee/add');
    }

    public function edit_employee($id)
    {
        $employee = Employee::findOrFail($id);
        $data = [
            "employee" => $employee
        ];

        return view('employee/edit', $data);
    }

    public function _list_employee()
    {
        $employees = Employee::all();

        return response()->json([
            'data' => $employees
        ]);
    }

    public function _tambah_employee(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'required|email|unique:employees,email',
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string|max:255',
            'gender'       => 'required|in:L,P',
        ]);

        Employee::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'gender'       => $request->gender,
        ]);

        session()->flash('success', 'Pegawai berhasil ditambahkan.');
        return redirect('employee');
    }

    public function _edit_employee(Request $request)
    {
        $employee = Employee::findOrFail($request->id);

        $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'required|email|unique:employees,email,' . $request->id,
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string|max:255',
            'gender'       => 'required|in:L,P',
        ]);

        $employee->first_name   = $request->first_name;
        $employee->last_name    = $request->last_name;
        $employee->email        = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->address      = $request->address;
        $employee->gender       = $request->gender;
        $employee->save();

        session()->flash('success', 'Data Pegawai berhasil diperbarui.');
        return redirect('employee');
    }


    public function _delete_employee($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

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
