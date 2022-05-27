<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dept as Dept;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depts;
        if(Auth::user()->hasRole('Admin') === true)
        {
            $depts = Dept::all()->with('user');
        }
        elseif( isset(Auth::user()->dept_id) )
        {
            $depts = Dept::where('id',Auth::user()->dept_id)->with('user')->get();
        } 
        else 
        {
            $data = [
                'page-title'=>'You must be an Admin or have an active login to view this resource.', 
                'error' => 'You must be an Admin or have an active login to view this resource.'
            ];

            return view('failedpermissions', compact('data'));
        }
        
        return view('dept.index',compact('depts'));       
        /*return view('forms.submissions', ['submissions' => $submissions]);*/
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
