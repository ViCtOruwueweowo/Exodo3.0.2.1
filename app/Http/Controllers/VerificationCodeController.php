<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Staff;

class VerificationCodeController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $verificationCode = Str::random(6);

        $staff = Staff::where('email', $email)->first();
        if ($staff) {
            $staff->staff_code = $verificationCode;
            $staff->save();
        } else {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo electrónico.']);
        }

        Mail::raw("Tu código de verificación es: $verificationCode", function ($message) use ($email) {
            $message->to($email)
                    ->subject('Código de Verificación');
        });

        return back()->with([
            'status' => 'success',
            'message' => 'El código de verificación ha sido enviado a tu correo electrónico.',
        ]);
    }
}
