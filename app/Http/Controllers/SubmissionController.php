<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission as Submission;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;
use Mail;


class SubmissionController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:submission-list|submission-create|submission-edit|submission-delete', ['only' => ['index','show']]);
         $this->middleware('permission:submission-create', ['only' => ['create','store']]);
         //try:
         /*$this->middleware(['role:Admin','permission:update submissions|edit submissions']);*/
         $this->middleware('permission:submission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:submission-delete', ['only' => ['destroy']]);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //where('dept_id', '=', 1)->get();
        $submission = new Submission;
        $submissions = $submission->recent(5);
        return view('submission.list',compact('submissions'));       
        /*return view('forms.submissions', ['submissions' => $submissions]);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $submission = Submission::where('id', $id)->with('dept', 'form')->first();
        
        /*if( Auth::user()->id !== $submission['owner_id'] || 
            Auth::user()->hasAnyRole('Admin|Head') !== true )
        {
            $data = [
                'page-title'=>'Insufficient User Permissions', 
                'error' => 'You must be either the owner of Requisition ID # '.
                $submission['id'].' or an Admin User in order to Edit this version of the "'.
                $submission['vendor'].'" form'];

            return view('failedpermissions', compact('data'));
        }
        */
                
        return view('submission.edit', compact('submission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($form_id)
    {
       /*
       'data',
        'dept_id',
        'form_id',
        'owner_id',
        'vendor',
        'dept_name',
        'completed'
        */
        $form = Form::findOrFail($form_id);       
        return view('submission.create', ['form'=>$form]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $submission = new Submission;  
        
        $data = $request->except('_token','_method','dept_id','form_id','owner_id','dept_name','vendor','fax','name','description');               
        $submission['data'] = $data;            
        foreach(['dept_id','form_id','owner_id','dept_name','vendor'] as $name)
        {
            $submission[$name] = $request->input($name);
        }
        $submission['owner_id'] = Auth::user()->id;

        $submission->save();    
     
        return back()->with('success','Requisition Form Successfully Created and Emailed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sid)
    {   
        $subm = new Submission;
        $submission = $subm->find($sid);
        return view('submission.show',compact('submission'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)   {

        $data = $request->except('_token','_method','dept_id','form_id','owner_id','dept_name','vendor','fax','name','description');               
        $submission['data'] = $data;            
        foreach(['dept_id','form_id','owner_id','dept_name','vendor'] as $name)
        {
            $submission[$name] = $request->input($name);
        }
       /* $submission['owner_id'] = Auth::user()->id;*/

        
        $submission->save();
    
        return redirect()->route('requisitions')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();
    
        return redirect()->route('forms.submissions')
                        ->with('success','Product deleted successfully');
    }

    // Generate PDF
    
    public function downloadPDF($sid){
      $submission = Submission::find($sid);

      $pdf = PDF::loadView('submission.pdf', compact('submission'));
      return $pdf->download('po_'.str_replace(' ', '-', $submission['vendor']).
        '_'.$submission['id'].'.pdf');

    }
    public function sendMail(Request $request){
           $submission = Submission::find($request->input('submission_id'));

            $pdf = PDF::loadView('submission.pdf', compact('submission'));
            $filename = 'po_'.str_replace(' ', '-', $submission['vendor']).
                        '_'.$submission['id'].'.pdf';
            /*return $pdf->download($filename);*/
     

            /*
                Sending to multiple recipients? 
                foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
                    Mail::to($recipient)->send(new OrderShipped($order));
                }
             */
            try{
                Mail::send('submission.pdf', compact('submission'), function($message)use($request,$pdf) {
                    $filename = 'po_'.str_replace(' ', '-', $request->input('vendor')).
                        '_'.$request->input('submission_id').'.pdf';
                $message->to($request->input('email'))
                ->subject($request->input('subj'))
                ->attachData($pdf->output(), $filename);
                });
            }catch(JWTException $exception){
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            /*if (Mail::failures()) {
                 $this->statusdesc  =   "Error sending mail";
                 $this->statuscode  =   "0";
     
            }else{
     
               $this->statusdesc  =   "Message sent Succesfully";
               $this->statuscode  =   "1";
            }*/
            return redirect()->back()->with(compact('submission'));
     }
        
}

