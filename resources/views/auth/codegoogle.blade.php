<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Habilitar 2FA</title>
</head>
<body>
  <h1>Escanea el siguiente código QR con Google Authenticator</h1>
  <!-- Mostrar la imagen QR generada -->
  <img src="data:image/svg+xml;base64,{{ base64_encode($QR_Image) }}" alt="Escanea el código QR con Google Authenticator" />
  
  <h3>Clave secreta (guárdala para futuras referencias):</h3>
  <p>{{ $secret }}</p>

<form action="{{ route('staff.verify2fa', ['staffId' => $staff->staff_id]) }}" method="POST">
    @csrf
    <label for="google2fa_token">Ingresa el código de Google Authenticator:</label>
    <input type="text" id="2fa_code" name="2fa_code" required>

    @error('2fa_code')
        <div>{{ $message }}</div>
    @enderror

    <button type="submit">Completar Registro</button>
  </form>
</body>
</html>
