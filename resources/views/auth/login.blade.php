@extends('layouts.master')

@section('content')

<section class="section">

    <div class="box column mx-auto my-auto is-4-desktop">
        <h1 class="title">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <p class="control">
                    <input name="email" id="email" class="input" type="email" placeholder="Email" autofocus>
                </p>
                @if ($errors->has('email'))
                    <p class="error-message help" role="alert">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>
            <div class="field">
                <p class="control">
                    <input name="password" id="password" class="input" type="password" placeholder="Password">
                </p>
                @if ($errors->has('password'))
                    <p class="error-message help" role="alert">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
            <div class="field">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            <div class="field">
                <p class="control">
                    <button class="button is-primary">
                        Submit
                    </button>
                </p>
            </div>
        </form>
    </div>

</section>


@endsection
