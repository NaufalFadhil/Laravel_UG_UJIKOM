<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('pages.employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nip' => 'required|numeric|unique:employees',
                'name' => 'required|max:50',
                'position' => 'required|in:MANAGER,SUPERVISOR,STAFF',
                'gender' => 'required|in:MALE,FEMALE',
                'email' => 'required|email|unique:employees',
                'address' => 'max:100',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('employee.index')->with('error', $validator->errors()->first());
            }
    
            Employee::create($request->all());
    
            return redirect()->route('employee.index')->with('success', 'Employee added successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('employee.index')->with('error', 'Failed to add employee! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $employee = Employee::where('nip', $id)->firstOrFail();
            return view('pages.employee.edit', ['employee' => $employee]);
        } catch (\Throwable $th) {
            return redirect()->route('employee.index')->with('error', 'Failed to edit employee! ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $nip_validation = 'required|numeric|unique:employees';
            $email_validation = 'required|email|unique:employees';
            $employee = Employee::where('nip', $id)->firstOrFail();
            
            if ($request->nip == $id) {
                $nip_validation = 'required|numeric';
            }

            if ($request->email == $employee->email) {
                $email_validation = 'required|email';
            }

            $validator = Validator::make($request->all(), [
                'nip' => $nip_validation,
                'name' => 'required|max:50',
                'position' => 'required|in:MANAGER,SUPERVISOR,STAFF',
                'gender' => 'required|in:MALE,FEMALE',
                'email' => $email_validation,
                'address' => 'max:100',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('employee.index')->with('error', $validator->errors()->first());
            }

            Employee::where('nip', $id)->update([
                'nip' => $request->nip,
                'name' => $request->name,
                'position' => $request->position,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            Salary::where('employee_nip', $id)->update([
                'employee_nip' => $request->nip,
            ]);

            return redirect()->route('employee.index')->with('success', 'Employee updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('employee.index')->with('error', 'Failed to update employee! ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Employee::where('nip', $id)->delete();
            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully!');
        } catch (\Throwable $th) {
            if ($th->getCode() == 23000) {
                return redirect()->route('employee.index')->with('error', 'Failed to delete employee! Employee has salary data!');
            }
            return redirect()->route('employee.index')->with('error', 'Failed to delete employee! ' . $th->getMessage());
        }
    }
}
