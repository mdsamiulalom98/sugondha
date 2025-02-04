<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mcqSubject;
use App\Models\mcqTopic;
use App\Models\MCQ;
use File;
use Toastr;
use DB;

class MCQcontroller extends Controller
{
    public function getTopic(Request $request)
    {
        $topic = DB::table("mcq_topics")
            ->where("subject_id", $request->subject_id)
            ->pluck('name', 'id');
        return response()->json($topic);
    }

    public function index(Request $request)
    {
        $data = MCQ::orderBy('id','DESC')->with('subject','topic')->get();
        // return $data;
        return view('backEnd.mcq.index',compact('data'));
    }
    public function create()
    {
        $subject = mcqSubject::where('status',1)->orderBy('id','DESC')->get();
        return view('backEnd.mcq.create', compact('subject'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'status' => 'required',
        ]);
       
        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->question));
        $input['slug'] = str_replace('/', '', $input['slug']);
        MCQ::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('mcq.index');
    }
    
    public function edit($id)
    {
        $edit_data = MCQ::find($id);
        $subject = mcqSubject::where('status',1)->select('id','name')->get();
        $topics = mcqTopic::where('status',1)->select('id','name')->get();
        return view('backEnd.mcq.edit',compact('edit_data','subject','topics'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
        ]);

        $update_data = MCQ::find($request->id);
        $input = $request->all();
        
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->question));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status?1:0;
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('mcq.index');
    }
 
    public function inactive(Request $request)
    {
        $inactive = MCQ::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = MCQ::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $category = MCQ::find($request->hidden_id);
        $category->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
