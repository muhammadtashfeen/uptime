@extends('layouts.master')

@section('content')
<section class="section">

    <div class="box column mx-auto my-auto is-4-desktop">
        <h1 class="title">Reset Password</h1>

        @if (session('status'))
            <article class="message is-primary">
                <div class="message-body">
                    {{ session('status') }}
                </div>
            </article>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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
                    <button type="submit" class="button is-primary">
                        Send Password Reset Link
                    </button>
                </p>
            </div>
        </form>
    </div>

</section>
@endsection
