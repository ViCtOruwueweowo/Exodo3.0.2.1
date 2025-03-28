<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class AuthController extends Controller
{
    public function show2faForm()
{
    $google2fa = new Google2FA();

    // Generar un secreto para el usuario
    $secret = $google2fa->generateSecretKey();

    // Almacenar el secreto en la base de datos
    auth()->user()->update([
        'google2fa_secret' => $secret,
    ]);

    // Generar un código QR para Google Authenticator
    $qrCodeUrl = $google2fa->getQRCodeUrl(
        'TuAplicacion', // Nombre de la aplicación
        auth()->user()->email, // El identificador único (normalmente el email)
        $secret
    );

    return view('auth.2fa', ['qrCodeUrl' => $qrCodeUrl]);
}



public function verify2fa(Request $request)
{
    $request->validate([
        'google2fa_code' => 'required|numeric',
    ]);

    $google2fa = new Google2FA();

    // Verificar el código ingresado con el secreto almacenado en la base de datos
    $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $request->input('google2fa_code'));

    if ($valid) {
        // Si el código es válido, proceder con el inicio de sesión
        auth()->user()->update(['google2fa_enabled' => true]);

        return redirect()->route('home');
    } else {
        return back()->withErrors(['google2fa_code' => 'El código de verificación es incorrecto.']);
    }
}


public function disable2fa()
{
    auth()->user()->update([
        'google2fa_secret' => null,
        'google2fa_enabled' => false,
    ]);

    return redirect()->route('home')->with('status', '2FA desactivado correctamente.');
}

}
