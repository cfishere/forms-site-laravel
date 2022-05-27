<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form as Form;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{

    function __construct()
    {
         /*$this->middleware('permission:form-list|form-create|form-edit|form-delete', ['only' => ['index','show']]);
         $this->middleware('permission:form-create', ['only' => ['create','store']]);
         
         $this->middleware('permission:form-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:form-delete', ['only' => ['destroy']]);*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dept_id = null)
    {       
        $forms;
        $form = new Form;

        
        
        if( Auth::user()->hasRole('Admin') )
        {
            //all forms for all depts
            $forms = $form->with('submission', 'dept')->get();
        } 
        elseif( Auth::user()->hasRole('Head') )
        {
            //forms limited to user's dept
            $forms = $form->where('dept_id', Auth::user()->dept_id)->with('submission', 'dept')->get();            
        }

        if(null===$forms){
            // either not a logged user or user role permissions are insufficient to view
            return view('forms.list');
        }
        return view('forms.list', ['forms'=>$forms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified form for creating a new submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Form::findOrFail($id);
        /*print_r($form->products);exit();*/
        return view('forms.form', ['f'=>$form]);
    }

    /**
     * Show the form for editing its product items.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fid)
    {
        $form = Form::find($fid);
        /*dd($form);*/
        /*print_r($form->products);exit();*/
        return view('forms.edit', ['form'=>$form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            
            $form = Form::find($id);
            //separate all input related to the vendor's items for the 'products' field:   
            $products = $request->except('_token','_method','name','dept_id','fax','description');
            $list = [];
         
            foreach($products as $key=>$value){                
                    $list[] = ['PN'=>$value[0], 'DESC'=>$value[1]];              
            }
            $form['products'] = $list;            
            foreach(['name','dept_id','fax','description'] as $name){
                $form[$name] = $request->input($name);
            }
            
            // store
            $form->save();
            // redirect
            $request->session()->flash('status', 'Successfully updated form!');
            return Redirect::to('forms');       
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
