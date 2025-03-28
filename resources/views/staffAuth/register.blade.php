<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animation Login Form </title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
      <div class="login">
        <form action="{{ route('staff.registerForm') }}" method="POST" class="login__form">
        @csrf
        <h1 class="login__title">Registro de Staff</h1>

        <div class="login__content">
            <div class="login__box">
            <label for="first_name">Nombre(s):</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="login__box">
            <label for="last_name">Apellidos:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="login__box">
            <label for="address_id">Dirección:</label>
            <select name="address_id" id="address_id" class="form-control" required>
                <option value="">Seleccione una dirección</option>
                @foreach($addresses as $address)
                <option value="{{ $address->address_id }}" {{ old('address_id') == $address->address_id ? 'selected' : '' }}>
                    {{ $address->address_name }}
                </option>
                @endforeach
            </select>
            @error('address_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="login__box">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="login__box">
            <label for="store_id">Tienda:</label>
            <select name="store_id" id="store_id" class="form-control" required>
                <option value="">Seleccione un # de tienda</option>
                @foreach($stores as $store)
                <option value="{{ $store->store_id }}" {{ old('store_id') == $store->store_id ? 'selected' : '' }}>
                    {{ $store->store_id }}
                </option>
                @endforeach
            </select>
            @error('store_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="login__box">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="login__box">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Crear Staff</button>
        </div>
        </form>
      </div>

      <!--<============ Main Js ============-->

      <script>/*--================== Show Hidden - Password =================*/
        const showHiddenPass = (loginPass, LoginEye) =>{
        const input = document.getElementById(loginPass),
        iconEye = document.getElementById(LoginEye)

        iconEye.addEventListener('click', () =>{
          //change password to text 
          if(input.type === 'password'){
            //switch to text 
            input.type = 'text'

            //Icon chnage
            iconEye.classList.add('ri-eye-line')
            iconEye.classList.remove('ri-eye-off-line')
          } else{

            //change to password
            input.type ='password'


            //Icon change 
            iconEye.classList.remove('ri-eye-line')
            iconEye.classList.add('ri-eye-off-line')

          }
        })
      }

      showHiddenPass('login-pass',' login-eye')</script>
</body>
</html>