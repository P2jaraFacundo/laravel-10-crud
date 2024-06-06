<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateParameterRequest;


class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addParameters() : View
    {
        return view('student.parameters');
    }

    /**
     * Edit parameters.
     */
    public function editParameters(UpdateParameterRequest $request) : RedirectResponse
    {
        
        $id = $request->input('id');
        $class_days = $request->input('class_days');
        $promotion_percentage = $request->input('promotion_percentage');
        $regular_percentage = $request->input('regular_percentage');
    
        // Busca el parámetro por ID
        $parameter = Parameter::find($id);
    
        if ($parameter) {
            $parameter->class_days = $class_days;
            $parameter->promotion_percentage = $promotion_percentage;
            $parameter->regular_percentage = $regular_percentage;
    
            $parameter->save();
    
            return redirect()->route('students.index')
                ->withSuccess('Parameter updated successfully');
        }
    

            return redirect()->route('students.index')
                ->withErrors('the parameter has not been modified successfully');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parameter $parameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parameter $parameter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parameter $parameter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parameter $parameter)
    {
        //
    }

}
