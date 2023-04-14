<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome - Login</title>

        <!-- Styles -->
       <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="main-login">
            <div class="left-login">
                <h1>Let's Park<br>Rotativo inteligente</h1>
                <img src="{{ asset('img/parking-not-css.svg') }}" class="left-login-image" alt="Parking">
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="right-login">
                    <div class="card-login">
                        <h1>LOGIN</h1>

                        <!-- Email Address -->
                        <div class="textfield">
                            <x-input-label for="email" :value="__('Usuário')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            <!--
                            <label for="usuario">Usuário</label>
                            <input type="text" name="usuario" placeholder="Usuário">
                            -->
                        </div>

                        <!-- Password -->
                        <div class="textfield">
                            <x-input-label for="password" :value="__('Senha')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            <!--
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" placeholder="Senha">
                            -->
                        </div>

                        <!-- Remember Me -->
                        <div class="rememberme">
                            <label for="remember_me">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <!-- Button Login -->
                        <x-primary-button class="btn-login">
                            {{ __('Log in') }}
                        </x-primary-button>

                        <div class="forgot-password">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Button -->
                        <!-- <button class="btn-login">Login</button> -->
                    </div>
                </div>
            </form>

        </div>
    </body>
</html>
