<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animation Login Form</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="login">
    <form action="{{ route('staff1.login') }}" method="POST" class="login__form">
      @csrf
      <h1 class="login__title">Login</h1>

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
        <div class="login__box">
          <i class="bx bx-lock-alt"></i>
          
          <div class="login__box-input">
            <input type="text" name="username" required class="login__input" placeholder="">
            <label for="username" class="login__label">Username</label>
          </div>
        </div>

        <div class="login__box">
          <i class="ri-lock-2-line login__icon"></i>

          <div class="login__box-input">
            <input type="password" name="password" required class="login__input" id="login-pas" placeholder="">
            <label for="password" class="login__label">Password</label>
            <i class="ri-eye-off-line login__eye"></i>
          </div>
        </div>
      </div>

      <div class="login__check">
        <a href="{{ route('staff.showRecoveryForm') }}" class="login__forgot">Forgot Password?</a>
      </div>

      <button type="submit" class="login__button">Login</button>

      <p class="login__register">
        Don't have an account? <a href="{{ route('staff.register') }}" class="login__forgot">Register</a>
      </p>
    </form>
  </div>

  <!--<============ Main Js ============-->

  <script>
    /*--================== Show Hidden - Password =================*/
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

    showHiddenPass('login-pass',' login-eye')
  </script>
</body>
</html>