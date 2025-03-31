<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
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
                'staff.picture',
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

        $stores = Store::select(
            'store_id',
        )->get();
        
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

       //return $this->show2faForm($staff);
       return view('staffAuth.login');
    }

        public function show2faForm(Staff $staff)
        {
            // Obtén el staff usando el staff_id del request
            $staff = Staff::where('staff_id', $staff->staff_id)->first();
            // Inicializar Google2FA
            $google2fa = app('pragmarx.google2fa');
            $secret = $staff->google2fa_secret;
            
        // Verificar si el staff tiene un google2fa_secret. Si no lo tiene, generarlo.
        if (!$staff->google2fa_secret) {
            $secret = $google2fa->generateSecretKey();
            $staff->google2fa_secret = $secret;
            $staff->google2fa_enabled = 1;  // Activa la autenticación de 2FA
            $staff->save();
        }

        // Generar el código QR en formato base64
        $QR_Image = $google2fa->getQRCodeInline(
            config('Laravel'),       // Nombre de la aplicación
            $staff->email,            // El email del usuario
            $staff->google2fa_secret  // La clave secreta de 2FA
        );
            // Pasar la imagen QR y la clave secreta a la vista
            return view('auth.codegoogle', [
                'QR_Image' => $QR_Image,
                'secret' => $secret,
                'staff' => $staff, // Asegúrate de pasar el $staff a la vist
            ]);
        }


        public function verify2fa(Request $request, $staffId)
        {
            // Valida que el código 2FA esté presente
            $request->validate([
                '2fa_code' => 'required|numeric|digits:6',
            ]);
    
            $staff = Staff::where('staff_id', $staffId)->first();
    
            // Verificar si el código 2FA es válido
            $google2fa = app('pragmarx.google2fa');
            $secret = $staff->google2fa_secret;
            $valid = $google2fa->verifyKey($secret, $request->input('2fa_code'), 4);
    
            if ($valid) {
                // Si el código es válido, generar el token JWT
                $token = JWTAuth::attempt(['username' => $staff->username, 'password' => $request->input('password')]); 
    
                return response()->json([
                    'message' => 'Inicio de sesión exitoso.',
                    'token' => $token
                ]);
            } else {
                return back()->withErrors(['2fa_code' => 'El código 2FA es incorrecto. Intenta nuevamente.']);
            }
        }

    public function showLoginForm()
    {
        return view('staffAuth.login');
        
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
            $message->to($email)
                    ->subject('Código de Verificación');
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
            // Código verificado correctamente, redirigir a la siguiente vista
            return redirect()->route('staff.resetPasswordForm')->with([
                'status' => 'success',
                'email'=> $email,
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

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Intentar autenticar al usuario
        if (!$token = Auth::guard('staff')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        
        return redirect()->route('home')->with([
            'status' => 'success',
            'message' => 'Inicio de sesión exitoso.',
        ]);
    }

    public function logout(Request $request)
    {
        try {
            // Invalidar el token
            Auth::guard('staff')->logout();

            return response()->json([
                'status' => 'success',
                'message' => 'Sesión cerrada correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo cerrar sesión'
            ], 500);
        }
    }

    
}