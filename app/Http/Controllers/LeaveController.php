<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index()
    {
        return view('leave.list');
    }

    public function rekap_cuti()
    {
        return view('leave.rekap');
    }


    public function tambah_leave()
    {
        $employees = Employee::all();
        return view('leave.add', compact('employees'));
    }

    public function edit_leave($id)
    {
        $leave = Leave::findOrFail($id);
        $employees = Employee::all();
        return view('leave.edit', compact('leave', 'employees'));
    }

    public function _list_leave()
    {
        $leaves = Leave::with('employee:id,first_name,last_name')->get();

        $data = $leaves->map(function ($item) {
            return [
                'id' => $item->id,
                'employee_id' => $item->employee_id,
                'name' => $item->employee ? $item->employee->first_name . ' ' . $item->employee->last_name : null,
                'reason' => $item->reason,
                'start_date' => $item->start_date,
                'end_date' => $item->end_date,
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function _list_employee_leave_summary()
    {
        $employees = Employee::with('leaves')->get();

        $data = $employees->map(function ($employee) {
            $total_days = $employee->leaves->sum(function ($leave) {
                return \Carbon\Carbon::parse($leave->end_date)
                    ->diffInDays(\Carbon\Carbon::parse($leave->start_date)) + 1;
            });

            return [
                'id' => $employee->id,
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'total_leave_days' => $total_days,
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }


    public function _tambah_leave(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reason'      => 'required|string|max:255',
            'start_date'  => 'required|date',
        ]);

        $employeeId = $request->employee_id;
        $leaveDate = \Carbon\Carbon::parse($request->start_date);

        $totalLeavesThisYear = Leave::where('employee_id', $employeeId)
            ->whereYear('start_date', $leaveDate->year)
            ->count();

        if ($totalLeavesThisYear >= 12) {
            return back()->withErrors(['start_date' => 'Maksimal cuti dalam 1 tahun adalah 12 hari.'])->withInput();
        }

        $leaveInSameMonth = Leave::where('employee_id', $employeeId)
            ->whereYear('start_date', $leaveDate->year)
            ->whereMonth('start_date', $leaveDate->month)
            ->exists();

        if ($leaveInSameMonth) {
            return back()->withErrors(['start_date' => 'Pegawai hanya dapat cuti 1 hari di bulan yang sama.'])->withInput();
        }

        Leave::create([
            'employee_id' => $employeeId,
            'reason'      => $request->reason,
            'start_date'  => $request->start_date,
            'end_date'  => $request->start_date,
        ]);

        return redirect('leave')->with('success', 'Cuti berhasil ditambahkan.');
    }


    public function _edit_leave(Request $request)
    {
        $leave = Leave::findOrFail($request->id);

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reason'      => 'required|string|max:255',
            'start_date'  => 'required|date',
        ]);

        $leaveDate = \Carbon\Carbon::parse($request->start_date);

        $totalLeavesThisYear = Leave::where('employee_id', $request->employee_id)
            ->whereYear('start_date', $leaveDate->year)
            ->where('id', '!=', $leave->id)
            ->count();

        if ($totalLeavesThisYear >= 12) {
            return back()->withErrors(['start_date' => 'Maksimal cuti dalam 1 tahun adalah 12 hari.'])->withInput();
        }

        $leaveInSameMonth = Leave::where('employee_id', $request->employee_id)
            ->whereYear('start_date', $leaveDate->year)
            ->whereMonth('start_date', $leaveDate->month)
            ->where('id', '!=', $leave->id)
            ->exists();

        if ($leaveInSameMonth) {
            return back()->withErrors(['start_date' => 'Pegawai hanya dapat cuti 1 hari di bulan yang sama.'])->withInput();
        }

        $leave->update([
            'employee_id' => $request->employee_id,
            'reason'      => $request->reason,
            'start_date'  => $request->start_date,
        ]);

        return redirect('leave')->with('success', 'Data cuti berhasil diperbarui.');
    }


    public function _delete_leave($id)
    {
        try {
            $leave = Leave::findOrFail($id);
            $leave->delete();

            return response()->json([
                'message' => 'Data berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
