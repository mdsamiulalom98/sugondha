<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mcqSubject;
use File;
use Toastr;

class mcqSubjectController extends Controller
{
   public function index(Request $request)
    {
        $data = mcqSubject::orderBy('id','DESC')->get();
        return view('backEnd.mcqsubject.index',compact('data'));
    }
    public function create()
    {
        return view('backEnd.mcqsubject.create');
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
        mcqSubject::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('mcqSubject.index');
    }
    
    public function edit($id)
    {
        $edit_data = mcqSubject::find($id);
        return view('backEnd.mcqsubject.edit',compact('edit_data'));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $update_data = mcqSubject::find($request->id);
        $input = $request->all();
        
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status?1:0;
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('mcqSubject.index');
    }
 
    public function inactive(Request $request)
    {
        $inactive = mcqSubject::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = mcqSubject::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $category = mcqSubject::find($request->hidden_id);
        $category->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
