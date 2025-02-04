<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mcqSubject;
use App\Models\mcqTopic;
use File;
use Toastr;

class mcqTopicController extends Controller
{
    public function index(Request $request)
    {
        $data = mcqTopic::orderBy('id','DESC')->with('subject')->get();
        return view('backEnd.mcqtopic.index',compact('data'));
    }
    public function create()
    {
        $subject = mcqSubject::where('status',1)->orderBy('id','DESC')->get();
        return view('backEnd.mcqtopic.create', compact('subject'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);
       
        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        mcqTopic::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('mcqTopic.index');
    }
    
    public function edit($id)
    {
        $edit_data = mcqTopic::find($id);
        $subject = mcqSubject::where('status',1)->select('id','name')->get();
        return view('backEnd.mcqtopic.edit',compact('edit_data','subject'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $update_data = mcqTopic::find($request->id);
        $input = $request->all();
        
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status?1:0;
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('mcqTopic.index');
    }
 
    public function inactive(Request $request)
    {
        $inactive = mcqTopic::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = mcqTopic::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $category = mcqTopic::find($request->hidden_id);
        $category->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }

}
