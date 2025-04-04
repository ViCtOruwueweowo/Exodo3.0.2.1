<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperación de Contraseña</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="login">
    <form action="{{ route('staff.sendVerificationCode') }}" method="POST" class="login__form">
      @csrf
      <h1 class="login__title">Recuperación de Contraseña</h1>

      <div class="login__content">
        <div class="login__box">
          <i class="bx bx-lock-alt"></i>
          
          <div class="login__box-input">
            <input type="email" name="email" required class="login__input" placeholder="">
            <label for="email" class="login__label">Correo Electrónico</label>
          </div>
        </div>
      </div>

      <button type="submit" class="login__button">Enviar Código</button>
    </form>
  </div>
</body>
</html>