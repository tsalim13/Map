<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>S-Mapper login</title>
  <script src="{{URL::to('/')}}/js/modernizr.js"></script>
  
<link rel="stylesheet" href="{{URL::to('/')}}/css/logincss/gubja.css">
<link rel="stylesheet" href="{{URL::to('/')}}/css/logincss/yaozl.css">
<link rel="stylesheet" href="{{URL::to('/')}}/css/logincss/style.css">

</head>

<body class="bg" style="background-image: url('{{URL::to('/')}}/images/back.jpg');">

  <div class="container">
<div id="login" class="signin-card">
  <div class="logo-image">
  <img src="500.png" alt="Logo" title="Logo" width="138">
  </div>
  <h1 class="display1">S-Mapper</h1>

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div id="form-login-username" class="form-group">
      <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required />
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </span>
        @endif
      <span class="form-highlight"></span>
      <span class="form-bar"></span>
      <label class="float-label">Email</label>
    </div>

    <div id="form-login-password" class="form-group">
      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </span>
        @endif
      <span class="form-highlight"></span>
      <span class="form-bar"></span>
      <label for="password" class="float-label">password</label>
    </div>

    <div>
      <button class="btn btn-block btn-info ripple-effect" type="submit" name="Submit" alt="Connexion">
        {{ __('Connexion')}}
      </button>  
    </div>

      <div>
          <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Mot de passe oublié?') }}
          </a>
      </div>

    </div>
  </form>
</div>
</div>
 

</body>

<script src="{{URL::to('/')}}/js/jquery-3.3.1.js"></script>
<script src="{{URL::to('/')}}/js/loginjs/gubja.js"></script>
<script src="{{URL::to('/')}}/js/loginjs/yaozl.js"></script>
<script src="{{URL::to('/')}}/js/loginjs/index.js"></script>
</html>
