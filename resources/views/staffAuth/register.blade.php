<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="container">
  <div class="login-box">
    <h1 class="login-logo">Registro Staff</h1>
    <form action="{{ route('staff.registerForm') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="first_name">Nombre(s)</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
        @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="last_name">Apellidos</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
        @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="address_id">Dirección</label>
        <select name="address_id" id="address_id" class="form-control" required>
          <option value="">Seleccione una dirección</option>
          @foreach($addresses as $address)
            <option value="{{ $address->address_id }}" {{ old('address_id') == $address->address_id ? 'selected' : '' }}>
              {{ $address->address_name }}
            </option>
          @endforeach
        </select>
        @error('address_id') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="store_id">Tienda</label>
        <select name="store_id" id="store_id" class="form-control" required>
          <option value="">Seleccione un # de tienda</option>
          @foreach($stores as $store)
            <option value="{{ $store->store_id }}" {{ old('store_id') == $store->store_id ? 'selected' : '' }}>
              {{ $store->store_id }}
            </option>
          @endforeach
        </select>
        @error('store_id') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="username">Nombre de usuario</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
        @error('username') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" required>
        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn btn-primary mt-3">Crear Staff</button>
    </form>
  </div>
</div>
