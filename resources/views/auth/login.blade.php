@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2 z-depth-2">
            <h3 class="center">Code Financeiro ADMIN</h3>
            <form method="POST" action="{{ env('URL_ADMIN_LOGIN') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <?php $messageErrorMail = $errors->has('email') ? "data-error='{$errors->first('email')}'" : null ?>
                        <input id="email" type="email" class="validate {{ $messageErrorMail ? 'invalid': $messageErrorMail}}"
                               name="email" value="{{ old('email') }}" required autofocus>
                        <label for="email" {!! $messageErrorMail !!}>E-Mail</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <?php $messageErrorPassword = $errors->has('password') ? "data-error='{$errors->first('password')}'" : null ?>
                        <input id="password" type="password" class="validate {{ $messageErrorPassword ? 'invalid': $messageErrorPassword}}"
                               name="password" value="{{ old('password') }}" required>
                        <label for="password" {!! $messageErrorPassword !!}> Senha </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 
                        <label for="remember"> Lembrar-me</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn">Login</button>
                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            Esqueceu-se da password?
                        </a>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection
