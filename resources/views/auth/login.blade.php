@extends('layouts/guest')

@section('title', 'Rendez-vous')


@section('contentLogin')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <div class="brand-logo">
                                    <a class="text-center" href="#">
                                        <h1>Quixlab</h1>
                                        <!-- <b class="logo-abbr"><img src="{{ asset('images/logo.png') }}" alt=""> </b>
                                        <span class="logo-compact"><img src="{{ asset('images/logo-compact.png') }}" alt=""></span>
                                        <span class="brand-title">
                                            <img src="{{ asset('images/logo-text.png') }}" alt="">
                                        </span> -->
                                    </a>
                                </div>
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                                <form class="mt-5 mb-5 login-input" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <!-- <input type="email" class="form-control" placeholder="Email"> -->
                                        <input id="email" class="form-control" type="email" placeholder="Adresse email" name="email" :value="old('email')" required autofocus />
                                    </div>

                                    <div class="form-group">
                                        <!-- <input type="password" class="form-control" placeholder="Password"> -->
                                        <input id="password" class="form-control"
                                            type="password"
                                            name="password" placeholder="Mot de passe"
                                            required autocomplete="current-password" />
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="block mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Se Rappeler de moi') }}</span>
                                        </label>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                {{ __('Mot de passe oublier?') }}
                                            </a>
                                        @endif

                                        <button class="btn login-form__btn submit w-100">
                                            {{ __('Connecter') }}
                                        </button>
                                    </div>

                                    <!-- <button class="btn login-form__btn submit w-100">Sign In</button> -->
                                </form>
                                <p class="mt-5 login-form__footer">Pas de compte? <a href="#" class="text-primary">Contacter l'administrateur</a> maintenant</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    