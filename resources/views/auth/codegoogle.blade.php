<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Habilitar 2FA</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: "Poppins", sans-serif;
    }
    .login-box {
      width: 360px;
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .login-title {
      font-size: 1.5rem;
      font-weight: 500;
      margin-bottom: 1rem;
    }
    .qr-code {
      width: 100%;
      max-width: 200px;
      margin: 1rem auto;
      display: block;
    }
    .alert-info {
      font-size: 0.9rem;
    }
    .btn-primary {
      width: 100%;
      padding: 0.75rem;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2 class="login-title">Habilitar 2FA</h2>
    <p class="text-muted">Escanea el código QR con Google Authenticator</p>

    <!-- Imagen QR -->
    <img class="qr-code" src="data:image/svg+xml;base64,{{ base64_encode($QR_Image) }}" alt="Código QR 2FA">

    <div class="alert alert-info">
      <strong>Clave Secreta:</strong>
      <p class="mb-0"><strong>{{ $secret }}</strong></p>
    </div>

    <!-- Formulario -->
    <form action="{{ route('staff.verify2fa', ['staffId' => $staff->staff_id]) }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="2fa_code" class="form-label">Código de Autenticación</label>
        <input type="text" id="2fa_code" name="2fa_code" class="form-control text-center" required>
        @error('2fa_code')
          <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Verificar Código</button>
    </form>
  </div>

</body>
</html>
