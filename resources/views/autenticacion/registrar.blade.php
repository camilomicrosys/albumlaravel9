@extends('layout/app')
@section('titulopagina')
@endsection
@section('contendio')

<img id="img-logo" src="{{asset('img/registrar.jpg')}}" alt="Imagen registro usuarios">
<br>
<form id="form-crear-usuario" method="POST" action="{{route('agregarUsuario')}}">

  <div class="form-group">
    @csrf
    <strong>name</strong><br><input value="{{old('name')}}" type="text" name="name" id="name" class="form-control"><br>
    @error('name')
    <p style="color:aqua">{{ $message }} </p>
    @enderror
    <strong>Usario</strong><br><input type="text" name="username" id="usuario" class="form-control"><br>
    @error('username')
    <p style="color:aqua">{{ $message }} </p>
    @enderror
    <strong>Email</strong><br><input type="text" name="email" id="email" class="form-control"><br>
    <strong>Pass</strong><br><input type="password" name="password" id="password" class="form-control"><br>
    @error('password')
    <p style="color:aqua">{{ $message }} </p>
    @enderror
    <strong>Confirm pass</strong><br><input type="password" name="password_confirmation" id="password_confirmation"
      class="form-control"><br>

  </div><button class="btn btn-success " style="border-radius: 5px; padding:5px;"><svg style="height:30px;"
      xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd"
        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
        clip-rule="evenodd" />
    </svg>Create account</button>


</form>
<div style="margin-top:-60px;" id="btn-regresar"><a href="{{route('inicioApp')}}"><button class="btn btn-warning"><svg
        style="height:30px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z" />
      </svg>Back</button></a></div>
@endsection