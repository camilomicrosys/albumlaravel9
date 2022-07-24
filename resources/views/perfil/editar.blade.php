@extends('layout/app')
@section('titulopagina')
<strong>Edit User: *{{ auth()->user()->username}}*</strong>
@endsection
@section('contendio')
<div class="container" style=" border: black 3px solid; border-radius:5px;">
  <form action="{{route('usuario.catualizar')}}" enctype="multipart/form-data" method="post">
    @csrf
    <strong>Username</strong><br>
    <input class="form-control" type="text" name="username" value="{{ auth()->user()->username}}"><br>
    @error('username')
    {{$message}}
    @enderror
    <strong>PothoProfile</strong><br>
    <!-- en layout/app.php cree el css para este archivo personalizado  -->
    <input accept="image/*" type="file" name="imagen"><br><br>
    <strong>Email</strong><br><input value="{{auth()->user()->email}}" type="text" name="email" id="email"
      class="form-control"><br>
    @error('email')
    {{$message}}
    @enderror

    <button style="padding-top:10px;" title="edit user" class="btn btn-success"><svg
        style="height:30px ;padding:3px; margin-bottom:-3px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
      </svg>Update</button>
  </form>

</div>
@endsection