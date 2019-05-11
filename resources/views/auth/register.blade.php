@extends('layouts.master')

@section('content')
<section class="section">

    <div class="box column mx-auto my-auto is-4-desktop">
        <h1 class="title">Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="field">
                <p class="control">
                    <input name="name" id="name" type="text" placeholder="Name" class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </p>
                @if ($errors->has('name'))
                    <p class="error-message help" role="alert">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>
            <div class="field">
                <p class="control">
                    <input name="email" class="input" type="email" placeholder="Email">
                </p>
                @if ($errors->has('email'))
                    <p class="error-message help" role="alert">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>
            <div class="field">
                <p class="control">
                    <input name="password" class="input" type="password" placeholder="Password">
                </p>
                @if ($errors->has('password'))
                    <p class="error-message help" role="alert">
                        {{ $errors->first('password') }}
                    </p>
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
