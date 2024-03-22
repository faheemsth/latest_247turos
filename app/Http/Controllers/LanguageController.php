<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    function index(){
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $Languages=Language::get();
        return view('super-admin.Language.index',compact('Languages'));
    }
    public function store(Request $request)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:subjects'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject = new Language();
        $subject->name = $request->name;
        $subject->save();

        $ActivityLogs = new ActivityLog;
        $ActivityLogs->user_id = Auth::id();
        $ActivityLogs->title = "Language Created ";
        $ActivityLogs->description = $subject->name." Language Created By  ".Auth::user()->first_name."  ".Auth::user()->last_name;
        $ActivityLogs->save();

        return redirect()->back()->with('success', 'Your Language has been successfully created.');
    }


    public function delete($id)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
       $Language = Language::find($id);

       $ActivityLogs = new ActivityLog;
       $ActivityLogs->user_id = Auth::id();
       $ActivityLogs->title = "Deleted Language ";
       $ActivityLogs->description = $Language->name." Deleted Language By  ".Auth::user()->first_name."  ".Auth::user()->last_name;
       $ActivityLogs->save();

    //    $Language->bookings()->delete();
       if ($Language->delete()) {
          return back()->with('success', 'Your Language has been successfully Deleted.');
       } else {
          return back()->with('failed', 'Failed to delete the subject.');
       }
    }
    public function update_post(Request $request,$id)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:subjects,name,'.$id
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       $subject=Language::find($id);
       $subject->name=$request->name;
       $subject->save();


       $ActivityLogs = new ActivityLog;
       $ActivityLogs->user_id = Auth::id();
       $ActivityLogs->title = "Updated Language ";
       $ActivityLogs->description = $subject->name." Updated Language By  ".Auth::user()->first_name."  ".Auth::user()->last_name;
       $ActivityLogs->save();

       return back()->with('success', 'Your Language has been successfully updated.');
    }
}
