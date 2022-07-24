@extends('layout/app')
@section('titulopagina')
<strong>Login</strong>
@endsection
@section('contendio')

@if(session('mensaje'))
<p>{{session('mensaje')}}</p>
@endif
<div class="container">
    <div class="card border-info" style="border-radius: 30px;">
        <div class="card-body">
            <form action="{{route('procesar-login')}}" method="POST">
                @csrf
                <strong>Email</strong><input type="text" name="email" class="form-control"><br>
                @error('email')
                <p style="color:aqua">{{ $message }} </p>
                @enderror
                <strong>Pasword</strong><input class="form-control" type="password" name="password"><br>
                @error('password')
                <p style="color:aqua">{{ $message }} </p>
                @enderror
                <input style="margin-left:5px;" type="checkbox" class="form-check-input" name="remember"><strong
                    style="margin-left:20px;">Sesion Active</strong><br>
                <button style="border-radius: 5px;" class="btn btn-success"><svg style="height:20px"
                        xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" strokeWidth={2}>
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>Login</button>
            </form>
        </div>
    </div>
</div>

@endsection