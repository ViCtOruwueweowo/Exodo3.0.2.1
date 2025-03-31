<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h1 class="login-logo">Iniciar Sesion</h1>
      
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('staff1.login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Usuario</label>
          <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <div class="input-group">
            <input type="password" name="password" id="login-pass" class="form-control" required>
            <button class="btn btn-outline-secondary" type="button" id="toggle-password">
              <i class="ri-eye-off-line"></i>
            </button>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <a href="{{ route('staff.showRecoveryForm') }}" class="text-decoration-none">¿Olvidaste La Contraseña?</a>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ingresar</button>
      </form>

      <p class="login-footer mt-3">
        ¿Sin Cuenta?, Registrate <a href="{{ route('staff.register') }}">aqui</a>
      </p>
    </div>
  </div>

  <script>
    document.getElementById("toggle-password").addEventListener("click", function () {
      let passInput = document.getElementById("login-pass");
      let icon = this.querySelector("i");

      if (passInput.type === "password") {
        passInput.type = "text";
        icon.classList.replace("ri-eye-off-line", "ri-eye-line");
      } else {
        passInput.type = "password";
        icon.classList.replace("ri-eye-line", "ri-eye-off-line");
      }
    });
  </script>
</body>
</html>
