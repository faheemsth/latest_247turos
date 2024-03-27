<?php

namespace App\Http\Controllers;

use App\Models\EarningPercentage;
use Illuminate\Http\Request;

class EarnController extends Controller
{
    public function index()
    {
        $EarningPercentage=EarningPercentage::first();
        return view('super-admin.earnings.create',compact('EarningPercentage'));
    }

    public function create(Request $request)
    {
        $earningPercentage = EarningPercentage::firstOrNew();
        $earningPercentage->percentage = $request->percentage;
        $message = $earningPercentage->save() ? 'Update' : 'Add';
        return back()->with('success', $message . ' Earning Percentage Successfully');
    }

}
