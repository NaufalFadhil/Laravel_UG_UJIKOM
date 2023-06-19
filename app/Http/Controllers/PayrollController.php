<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Parameter;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;

use Dompdf\Dompdf;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        $payrolls = Employee::join('salaries', 'employees.nip', '=', 'salaries.employee_nip', 'right')
            ->select('employees.nip', 'employees.name', 'salaries.id as salary_id', 'salaries.salary', 'salaries.bonus', 'salaries.amount', 'salaries.date')
            ->get();

        return view('pages.payroll.index', ['payrolls' => $payrolls, 'employees' => $employees]);
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
            $employee = Employee::where('nip', $request->employee_nip)->first();
            $parameter = Parameter::where('position', $employee->position)->first();

            $bonus = $request->salary * ($parameter->bonus_percentage / 100);
            $salary_total_with_bonus = $request->salary + $bonus;
            $salary_total_With_pph = $salary_total_with_bonus - ($salary_total_with_bonus * ($parameter->pph_percentage / 100));

            Salary::create([
                'employee_nip' => $request->employee_nip,
                'salary' => $request->salary,
                'bonus' => $bonus,
                'amount' => $salary_total_With_pph,
                'date' => $request->date,
            ]);

            return redirect()->route('payroll.index')->with('success', 'Payroll added successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('payroll.index')->with('error', 'Payroll failed to add! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $employees = Employee::all();
            $payroll = Employee::join('salaries', 'employees.nip', '=', 'salaries.employee_nip', 'right')
                ->select('employees.nip', 'employees.name', 'salaries.id as salary_id', 'salaries.salary', 'salaries.bonus', 'salaries.amount')
                ->where('salaries.id', $id)
                ->get()->first();

            return view('pages.payroll.edit', ['payroll' => $payroll, 'employees' => $employees]);
        } catch (\Throwable $th) {
            return redirect()->route('payroll.index')->with('error', 'Payroll failed to edit! ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::where('nip', $request->employee_nip)->first();
            $parameter = Parameter::where('position', $employee->position)->first();

            $bonus = $request->salary * ($parameter->bonus_percentage / 100);
            $salary_total_with_bonus = $request->salary + $bonus;
            $salary_total_With_pph = $salary_total_with_bonus - ($salary_total_with_bonus * ($parameter->pph_percentage / 100));

            Salary::where('id', $id)->update([
                'employee_nip' => $request->employee_nip,
                'salary' => $request->salary,
                'bonus' => $bonus,
                'amount' => $salary_total_With_pph,
                'date' => '2023-06-01',
            ]);

            return redirect()->route('payroll.index')->with('success', 'Payroll updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('payroll.index')->with('error', 'Payroll updated failed!' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parameter  $parameter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Salary::destroy($id);

            return redirect()->route('payroll.index')->with('success', 'Payroll deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('payroll.index')->with('error', 'Payroll deleted failed!' . $th->getMessage());
        }
    }

    public function export(Request $request) {
        try {
            $payrolls = Employee::join('salaries', 'employees.nip', '=', 'salaries.employee_nip', 'right')
                ->select('employees.nip', 'employees.name', 'employees.position',  'salaries.id as salary_id', 'salaries.salary', 'salaries.bonus', 'salaries.amount', 'salaries.date')
                ->where('salaries.date', '>=', $request->date_start)
                ->where('salaries.date', '<=', $request->date_end)
                ->get();

            $pdf = new Dompdf();
            $pdf->loadHtml(view('pages.payroll.pdf', ['payrolls' => $payrolls, 'date_start' => $request->date_start, 'date_end' => $request->date_end]));
            $pdf->setPaper('A4', 'landscape');
            $pdf->render();
            $pdf->stream('payroll.pdf', ['Attachment' => false]);

            return $pdf->stream();
        } catch (\Throwable $th) {
            return redirect()->route('payroll.index')->with('error', 'Payroll export failed!' . $th->getMessage());
        }
    }
}
