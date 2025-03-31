<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecer Contraseñacasacas</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h1 class="login-logo">Restablecer Contraseña</h1>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('staff.resetPassword') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">

        <div class="mb-3">
          <label for="password" class="form-label">Nueva Contraseña</label>
          <div class="input-group">
            <input type="password" name="password" id="new-password" class="form-control" required>
            <button class="btn btn-outline-secondary" type="button" id="toggle-new-password">
              <i class="ri-eye-off-line"></i>
            </button>
          </div>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
          <div class="input-group">
            <input type="password" name="password_confirmation" id="confirm-password" class="form-control" required>
            <button class="btn btn-outline-secondary" type="button" id="toggle-confirm-password">
              <i class="ri-eye-off-line"></i>
            </button>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Restablecer Contraseña</button>
      </form>
    </div>
  </div>

  <script>
    function togglePassword(inputId, buttonId) {
      const input = document.getElementById(inputId);
      const button = document.getElementById(buttonId).querySelector("i");

      input.type = input.type === "password" ? "text" : "password";
      button.classList.toggle("ri-eye-off-line");
      button.classList.toggle("ri-eye-line");
    }

    document.getElementById("toggle-new-password").addEventListener("click", function() {
      togglePassword("new-password", "toggle-new-password");
    });

    document.getElementById("toggle-confirm-password").addEventListener("click", function() {
      togglePassword("confirm-password", "toggle-confirm-password");
    });
  </script>
</body>
</html>
