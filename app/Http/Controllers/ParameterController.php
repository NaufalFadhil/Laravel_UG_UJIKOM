<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = Parameter::all();

        return view('pages.parameter.index', ['parameters' => $parameters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
                'position' => 'required|max:10|unique:parameters|in:MANAGER,SUPERVISOR,STAFF',
                'bonus_percentage' => 'required|numeric',
                'pph_percentage' => 'required|numeric',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('payroll-configuration.index')->with('error', $validator->errors()->first());
            }
    
            Parameter::create($request->all());
    
            return redirect()->route('payroll-configuration.index')->with('success', 'Parameter added successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('payroll-configuration.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $parameter = Parameter::findOrFail($id);

            return view('pages.parameter.edit', ['parameter' => $parameter]);
        } catch (\Throwable $th) {
            return redirect()->route('payroll-configuration.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Parameter::findOrFail($id)->update($request->all());

            return redirect()->route('payroll-configuration.index')->with('success', 'Parameter updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('payroll-configuration.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Parameter::destroy($id);

            return redirect()->route('payroll-configuration.index')->with('success', 'Parameter deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('payroll-configuration.index')->with('error', $th->getMessage());
        }
    }
}
