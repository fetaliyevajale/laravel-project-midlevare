<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $otp = Otp::where('user_id', Auth::id())
                   ->where('otp', $request->otp)
                   ->first();

        if ($otp) {
            return redirect('/dashboard');
        } else {
            return back()->with('error', 'Yanlış OTP');
        }
    }
}
