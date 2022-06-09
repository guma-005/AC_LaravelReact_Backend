<?php

namespace App\Http\Controllers;
use App\Models\studentGrades;
use Illuminate\Http\Request;

class gradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return studentGrades::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'maths'=>'required',
            'science'=>'required',
            'english'=>'required',
            'dutch'=>'required',
            'grade'=>'required'
        ]);
        return studentGrades::create($request->all());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $studentgrades = studentGrades::find($id);
        $studentgrades->update($request->all());
        return $studentgrades;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return studentGrades::destroy($id);
    }
}
