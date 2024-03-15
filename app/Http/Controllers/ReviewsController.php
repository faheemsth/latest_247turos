<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Auth;
class ReviewsController extends Controller
{

    public function ReviewStudent()
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $reviewStudents = Booking::with('student')->whereNotNull('student_rating')->get();
        return view('super-admin.Pages.reviews.student',compact('reviewStudents'));

    }

    public function ReviewTutor()
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $ReviewTutor = Booking::with('tutor')->whereNotNull('tutor_rating')->get();
        return view('super-admin.Pages.reviews.tutor',compact('ReviewTutor'));
    }

    public function ReviewParent()
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $reviewParents = Booking::with('parent')->whereNotNull('parent_rating')->get();
        return view('super-admin.Pages.reviews.parent',compact('reviewParents'));
    }
    public function TutorReviewDelete($id)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $tutor = Booking::find($id)->with('tutor')->whereNotNull('tutor_rating')->first();
        $tutor->tutor_rating=null;
        $tutor->save();

        return back();

    }


    public function ParentReviewDelete($id)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $parent = Booking::find($id)->with('parent')->whereNotNull('parent_rating')->first();
        $parent->parent_rating=null;
        $parent->save();

        return back();
    }

    public function StudentDelete($id)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $student = Booking::find($id)->with('student')->whereNotNull('student_rating')->first();
        $student->student_rating=null;
        $student->save();

        return back();
    }


}
