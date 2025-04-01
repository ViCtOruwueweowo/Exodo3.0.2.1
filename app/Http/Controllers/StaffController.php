<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Staff;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::join('address', 'staff.address_id', '=', 'address.address_id')
            ->select(
                'staff.staff_id',
                'staff.first_name',
                'staff.last_name',
                'address.address as address_name',
                'staff.email',
                'staff.store_id',
                'staff.active',
                'staff.username',
                'staff.password',
                'staff.picture'
            )
            ->get();

        return view('staffs.index', compact('staffs'));
    }

    public function create()
    {
        $addresses = Address::select(
            'address_id',
            'address as address_name'
        )->get();

        $stores = Store::select('store_id')->get();
        
        return view('staffs.create', compact('addresses', 'stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_id' => 'required|integer',
            'picture' => 'nullable|image',
            'email' => 'required|email',
            'store_id' => 'required|integer',
            'active' => 'required|boolean',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staff = new Staff();
        $staff->first_name = $validated['first_name'];
        $staff->last_name = $validated['last_name'];
        $staff->address_id = $validated['address_id'];
        $staff->email = $validated['email'];
        $staff->store_id = $validated['store_id'];
        $staff->active = $validated['active'];
        $staff->username = $validated['username'];
        $staff->password = $validated['password'];
        $staff->last_update = now();

        if ($request->hasFile('picture')) {
            $staff->picture = $request->file('picture')->store('staff');
        }

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    public function edit($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        $addresses = Address::select('address_id', 'address as address_name')->get();
        $stores = Store::select('store_id')->get();

        return view('staffs.edit', compact('staff', 'addresses', 'stores'));
    }

    public function update(Request $request, $staffId)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_id' => 'required|integer',
            'picture' => 'nullable|image',
            'email' => 'required|email',
            'store_id' => 'required|integer',
            'active' => 'required|boolean',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staff = Staff::findOrFail($staffId);
        $staff->first_name = $validated['first_name'];
        $staff->last_name = $validated['last_name'];
        $staff->address_id = $validated['address_id'];
        $staff->email = $validated['email'];
        $staff->store_id = $validated['store_id'];
        $staff->active = $validated['active'];
        $staff->username = $validated['username'];
        $staff->password = $validated['password'];
        $staff->last_update = now();

        if ($request->hasFile('picture')) {
            $staff->picture = $request->file('picture')->store('staff');
        }

        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy($staffId)
    {
        try {
            $staff = Staff::findOrFail($staffId);
            $staff->delete();
    
            return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('staff.index')->with('error', 'No se puede eliminar, otro registro interfiere con el proceso.');
            }
    
            throw $e;
        }
    }

    public function showRegisterForm()
    {
        $addresses = Address::select('address_id', 'address as address_name')->get();
        $stores = Store::select('store_id')->get();
        
        return view('staffAuth.register', compact('addresses', 'stores'));
    }

    public function registerForm(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_id' => 'required|integer',
            'picture' => 'nullable|image',
            'email' => 'required|email',
            'store_id' => 'required|integer',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $staff = new Staff();
        $staff->first_name = $validated['first_name'];
        $staff->last_name = $validated['last_name'];
        $staff->address_id = $validated['address_id'];
        $staff->email = $validated['email'];
        $staff->store_id = $validated['store_id'];
        $staff->active = 0;
        $staff->username = $validated['username'];
        $staff->password = Hash::make($validated['password']);
        $staff->last_update = now();
        $staff->role_id = 2;

        if ($request->hasFile('picture')) {
            $staff->picture = $request->file('picture')->store('staff');
        }

        $staff->save();

        return view('staffAuth.login');
    }

    public function show2faForm(Staff $staff)
    {
        $staff = Staff::where('staff_id', $staff->staff_id)->first();
        $google2fa = app('pragmarx.google2fa');
        $secret = $staff->google2fa_secret;
        
        if (!$staff->google2fa_secret) {
            $secret = $google2fa->generateSecretKey();
            $staff->google2fa_secret = $secret;
            $staff->google2fa_enabled = 1;
            $staff->save();
        }

        $QR_Image = $google2fa->getQRCodeInline(
            config('Laravel'),
            $staff->email,
            $staff->google2fa_secret
        );

        return view('auth.codegoogle', [
            'QR_Image' => $QR_Image,
            'secret' => $secret,
            'staff' => $staff,
        ]);
    }

    public function verify2fa(Request $request, $staffId)
    {
        $request->validate([
            '2fa_code' => 'required|numeric|digits:6',
        ]);

        $staff = Staff::where('staff_id', $staffId)->first();

        if (!$staff) {
            return redirect()->route('staff.index')->withErrors(['staff' => 'El personal no se encuentra.']);
        }

        $google2fa = app('pragmarx.google2fa');
        $secret = $staff->google2fa_secret;

        $valid = $google2fa->verifyKey($secret, $request->input('2fa_code'));

        if ($valid) {
            $staff->active = 1;
            $staff->save();
            return redirect()->route('staff.index')->with('success', 'Inicio de sesión exitoso.');
        } else {
            return redirect()->route('staff.login')->withErrors(['2fa_code' => 'El código de 2FA es incorrecto. Intenta nuevamente.']);
        }
    }

    public function showLoginForm()
    {
        return view('staffAuth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $username = $request->input('username');
        $password = $request->input('password');
    
        $staff = Staff::where('username', $username)->first();
    
        // Verificar si el staff existe y si la contraseña es correcta
        if ($staff && Hash::check($password, $staff->password)) {
            // Generar el token JWT
            $token = JWTAuth::fromUser($staff);
    
            // Guardar el token en el backend (base de datos, por ejemplo)
            $staff->jwt_token = $token;
            $staff->save();
    
            // Obtener la vista del formulario de 2FA y envolverla en una respuesta HTTP
            $view = $this->show2faForm($staff);
            $response = response($view);
            
            // Agregar el token a la cookie en la respuesta
            return $response->cookie('jwt_token', $token, 60); // Cookie válida 60 minutos
        } else {
            return back()->withErrors(['username' => 'Las credenciales no coinciden con nuestros registros.']);
        }
    }
    
    
    

    public function showRecoveryForm()
    {
        return view('staffAuth.recoveryEmail');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $verificationCode = Str::random(6);
        $encryptedCode = bcrypt($verificationCode);

        $staff = Staff::where('email', $email)->first();
        if ($staff) {
            $staff->staff_code = $encryptedCode;
            $staff->save();
        } else {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo electrónico.']);
        }

        Mail::raw("Tu código de verificación es: $verificationCode", function ($message) use ($email) {
            $message->to($email)->subject('Código de Verificación');
        });

        return redirect()->route('staff.recovery')->with([
            'status' => 'success',
            'email' => $email,
            'message' => 'El código de verificación ha sido enviado a tu correo electrónico.',
        ]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|string',
        ]);

        $email = $request->input('email');
        $verificationCode = $request->input('verification_code');
        $staff = Staff::where('email', $email)->first();

        if ($staff && Hash::check($verificationCode, $staff->staff_code)) {
            return redirect()->route('staff.resetPasswordForm')->with([
                'status' => 'success',
                'email' => $email,
                'message' => 'Código verificado correctamente. Por favor, restablece tu contraseña.',
            ]);
        } else {
            return back()->withErrors(['verification_code' => 'El código de verificación es incorrecto.']);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $staff = Staff::where('email', $email)->first();

        if ($staff) {
            $staff->password = Hash::make($password);
            $staff->staff_code = null; // Clear the verification code
            $staff->save();

            return redirect()->route('staff.login')->with('success', 'Contraseña restablecida correctamente. Ahora puedes iniciar sesión.');
        } else {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo electrónico.']);
        }
    }


    public function logout(Request $request)
{
    // Obtener el token desde la cookie
    $token = $request->cookie('jwt_token');

    if ($token) {
        try {
            // Invalidar el token en el backend (opcional)
            $staff = JWTAuth::setToken($token)->authenticate();
            if ($staff) {
                $staff->jwt_token = null;
                $staff->save();
            }

            // Invalidar el token en JWTAuth
            JWTAuth::invalidate($token);
        } catch (\Exception $e) {
            // Manejo de errores (puede ser un token inválido o expirado)
        }
    }

    // Eliminar la cookie y redirigir al login
    return redirect('/')->withCookie(Cookie::forget('jwt_token'));
}
    
}


    
    

