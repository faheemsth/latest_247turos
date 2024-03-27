<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\coupon as ModelsCoupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use PHPMailer\PHPMailer\PHPMailer;
use Stripe\Coupon;

class CouponController extends Controller
{

    public function index()
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        $coupons = ModelsCoupon::with('user')->get();

        foreach ($coupons as $coupon) {
            $diffInSeconds = strtotime($coupon->valid_from) - strtotime('now');
            $diffInDays = floor($diffInSeconds / (60 * 60 * 24));

            if (strtotime($coupon->valid_to) < strtotime($coupon->valid_from) || strtotime($coupon->valid_to) == strtotime($coupon->valid_from) || $diffInDays > 0) {
                $coupon->isExpired = true;
                if ($diffInDays > 0) {
                    $coupon->expireMessage = "Future";
                } else {
                    $coupon->expireMessage = "Expired";
                }
            } else {
                $coupon->isExpired = false;
                $coupon->expireMessage = "Valid";
            }
        }


        return view('super-admin.coupon.index', compact('coupons'));
    }
    public function create_coupon(Request $request)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $couponCode = '';
        $length = 8;
        for ($i = 0; $i < $length; $i++) {
            $couponCode .= $characters[rand(0, strlen($characters) - 1)];
        }

        ModelsCoupon::create([
            'code' => $couponCode,
            'description' => $request->post('description'),
            'discount_type' => $request->post('discount_type'),
            'price' => $request->post('price'),
            'valid_from' => $request->post('valid_from'),
            'valid_to' => $request->post('valid_to'),
            'from_user' => Auth::id(),
            'to_user' => null,
            'usage_limit' => $request->post('usage_limit'),
        ]);
        $student = User::find($request->id);

        $ActivityLogs = new ActivityLog;
        $ActivityLogs->user_id = Auth::id();
        $ActivityLogs->title = "Create Coupon";
        $ActivityLogs->description = "Create Coupon By ".Auth::user()->first_name."  ".Auth::user()->last_name;
        $ActivityLogs->save();

        $data = [
            'student' => $student,
            'copoun' => $couponCode,
        ];
        if (!empty($student)) {
            Mail::send('pages.mails.copoun', $data, function ($message) use ($student, $couponCode) {
                $message->to($student->email, $student->first_name . ' ' . $student->last_name)
                    ->subject(Auth::user()->first_name . ' ' . Auth::user()->last_name . ' Assign Token ' . $couponCode);
                $message->from(Auth::user()->email, Auth::user()->first_name . ' ' . Auth::user()->last_name);
            });

        }

        return back()->with('success', 'Successfully created the coupon: ' . $couponCode);
    }


    public function get_coupon(Request $request)
    {
        $coupon = ModelsCoupon::where('code', $request->post('coupon'))
            ->first();

            $diffInSeconds=strtotime($coupon->valid_from) - strtotime('now');

            $diffInDays = floor($diffInSeconds / (60 * 60 * 24));

        if (!$coupon) {
            throw ValidationException::withMessages(['coupon' => 'Coupon not found.']);
        }

        if ($coupon->usage_limit <= 0) {
            throw ValidationException::withMessages(['coupon' => 'Coupon has reached its usage limit.']);
        }

        if (strtotime($coupon->valid_to) < strtotime($coupon->valid_from) || strtotime($coupon->valid_to) == strtotime($coupon->valid_from) || $diffInDays > '0') {
            throw ValidationException::withMessages(['coupon' => 'Coupon has expired.']);
        }

        return $coupon;
    }


    public function delete($id)
    {
        if (Auth::user()->role_id != 1) { return redirect('dashboard'); }
        ModelsCoupon::find($id)->delete();
        return back()->with('success', 'Successfully Delete the coupon');
    }


}
