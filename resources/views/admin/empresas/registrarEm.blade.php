@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center"> <b> Registrar Empresa </b> </h5>
            <form class="form-signin" method="POST" action="{{ route('registrado') }}">
                @csrf

              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Username" required autocomplete="name" autofocus>
                <label for="inputUserame">{{ __('Nombre') }}</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="text" id="inputNitEmp" class="form-control @error('nit_empresa') is-invalid @enderror" name="nit_empresa" value="{{ old('nit_empresa') }}" placeholder="Usernit_empresa" required autocomplete="nit_empresa" autofocus>
                <label for="inputNitEmp">{{ __('NIT') }}</label>
                @error('nit_empresa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="text" id="inputNomEmp" class="form-control @error('nombre_empresa') is-invalid @enderror" name="nombre_empresa" value="{{ old('nombre_empresa') }}" placeholder="nombre_empresa" required autocomplete="nombre_empresa" autofocus>
                <label for="inputNomEmp">{{ __('Nombre Empresa..') }}</label>
                @error('nombre_empresa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="text" id="inputDirEmp" class="form-control @error('direccion_empresa') is-invalid @enderror" name="direccion_empresa" value="{{ old('direccion_empresa') }}" placeholder="direccion_empresa" required autocomplete="direccion_empresa" autofocus>
                <label for="inputDirEmp">{{ __('Direccion....') }}</label>
                @error('direccion_empresa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="text" id="inputRegEmp" class="form-control @error('registro_empresa') is-invalid @enderror" name="registro_empresa" value="{{ old('registro_empresa') }}" placeholder="registro_empresa" required autocomplete="registro_empresa" autofocus>
                <label for="inputRegEmp">{{ __('Registro Empresa..') }}</label>
                @error('registro_empresa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email">
                <label for="inputEmail">Email empresa</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <hr>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                <label for="inputPassword">Password</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" name="password_confirmation" placeholder="Password" required autocomplete="new-password">
                <label for="inputConfirmPassword">Confirm password</label>
              </div>

              <div class="form-label-group">
                <input type="json" id="inputTelefono" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Telefono" required autocomplete="telefono" autofocus>
                <label for="inputTelefono">{{ __('Telefono priv..') }}</label>
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
                <input type="text" id="inputTelEmp" class="form-control @error('telefono_empresa') is-invalid @enderror" name="telefono_empresa" value="{{ old('telefono_empresa') }}" placeholder="Fecha de nacimiento" required autocomplete="fecha_nac" autofocus>
                <label for="inputTelEmp">{{ __('Telefono empresa..') }}</label>
                @error('telefono_empresa')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
                <div class="form-label-group">
                    <input type="hidden" id="tipo_usuario"  name="tipo_usuario" value="2">
                </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
              <a class="d-block text-center mt-2 small" href="/login">Sign In</a>
              <hr class="my-4">
              <!--button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
