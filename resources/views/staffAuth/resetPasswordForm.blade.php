<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecer Contraseña</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="login">
    <form action="{{ route('staff.resetPassword') }}" method="POST" class="login__form">
      @csrf
      <h1 class="login__title">Restablecer Contraseña</h1>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="login__content">
        <input type="hidden" name="email" value="{{ session('email') }}">

        <div class="login__box">
          <i class="bx bx-lock-alt"></i>
          
          <div class="login__box-input">
            <input type="password" name="password" required class="login__input" placeholder="">
            <label for="password" class="login__label">Nueva Contraseña</label>
          </div>
        </div>

        <div class="login__box">
          <i class="bx bx-lock-alt"></i>
          
          <div class="login__box-input">
            <input type="password" name="password_confirmation" required class="login__input" placeholder="">
            <label for="password_confirmation" class="login__label">Confirmar Contraseña</label>
          </div>
        </div>
      </div>

      <button type="submit" class="login__button">Restablecer Contraseña</button>
    </form>
  </div>
</body>
</html>