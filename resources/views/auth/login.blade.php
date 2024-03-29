@extends('layouts.authBase')
@section('content')
      <div class="container mt-2">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/favicon/android-chrome-96x96.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}"
                    name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="{{ route('password.request') }}" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input class="form-control" type="password" placeholder="{{ __('Password') }}"  id="password"
                    name="password" tabindex="2" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target=".cd-load"
                    type="submit" minlength="6" id="botao" disabled>{{ __('auth.login') }}</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="{{ route('register') }}">Create One</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; DeskApps
            </div>
          </div>
        </div>

        <script> 
          $("#password").on("input", function() {
              $("#botao").prop('disabled', $(this).val().length < 6);
          });
      </script>

@endsection

@section('javascript')

@endsection
