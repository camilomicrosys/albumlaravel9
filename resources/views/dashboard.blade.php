@extends('layout/app')
@section('titu')
Tu cuenta
@endsection
@section('contendio')


<!-- aca validamos si el usuario autenticado tiene imagen sino le mostramos la foto de que no hay perfil-->
@php
if($user->imagen==null):
$foto_perfil="sinperfil.png";
else:
$foto_perfil=$user->imagen;
endif
@endphp
<div class="comtainer">
  <div class="row">
    <div class="col-7">

    </div>
    <div class="col-1">
      <img style="height:100px;" src="{{asset('foto_perfil').'/'.$foto_perfil}}" alt="">
    </div>
    <div class="alert alert-success" role="alert">
      <h1>Visited: {{ $user->username}}</h1>
    </div>

    <div class="col-3">

    </div>
    <div class="col-1">

    </div>
  </div>
</div>
@auth
@if ($user->id==auth()->user()->id)

<a style="margin-left:840px;" title="Editar user" href="{{route('usuario.editar',['id'=>auth()->user()->id])}}"><svg
    title="Editar user" style="height: 20px;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
    fill="currentColor">
    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
      clip-rule="evenodd" />
  </svg>Edit</a>

@endif

@endauth


<!-- boton de seguidores modal-->
<div style="margin-bottom: -55px;margin-left:809px;">
  <button title="Clic para ver seguidores" type="button" class="btn btn-primary" data-toggle="modal"
    data-target="#exampleModal">
    verSeguidores
  </button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info Seguidores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong class="align-center">Seguidores</strong><br>
        <!-- recorrecmos cada seguidor que viene de postController index y le ponemos el link del muro al cual se le pasa el usuario y ya vamos al muro del usuario que clikemos -->
        @foreach($seguidores as $seguidor)
        <!-- aca ponemos un condicional ya que mostramos la imagen de niestro seguidor pero si el seguidor no tiene imagen mostramos la imagen predeterminada que creamos en foto_perfil/sinPerfil-->
        @php
        if($seguidor->imagen==null):
        $foto_perfil='sinperfil.png';

        else:
        $foto_perfil=$seguidor->imagen;
        endif
        @endphp

        <a href="{{route('muro',$seguidor->username)}}">{{$seguidor->username}}</a> <img style="height: 40px;"
          src="{{ asset('foto_perfil').'/'. $foto_perfil}}" alt="">
        <br>
        --------------------------------
        <br>
        @endforeach

        <br>
        <strong class="align-center">Siguiendo</strong>
        <br>
        <!-- recorrecmos cada persona que seguimos que viene de postController index y le ponemos el link del muro al cual se le pasa el usuario y ya vamos al muro del usuario que clikemos -->
        @foreach($siguiendos as $siguiendo)

        <!-- aca ponemos un condicional ya que mostramos la imagen de los que seguimos pero si el seguidor no tiene imagen mostramos la imagen predeterminada que creamos en foto_perfil/sinPerfil-->
        @php
        if($siguiendo->imagen==null):
        $foto_perfil='sinperfil.png';

        else:
        $foto_perfil=$siguiendo->imagen;
        endif
        @endphp
        <a href="{{route('muro',$siguiendo->username)}}">{{$siguiendo->username}}</a><img style="height: 40px;"
          src="{{ asset('foto_perfil').'/'. $foto_perfil}}" alt="">
        <br>
        --------------------------------
        <br>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<p></p>
<div class="container" style="padding-left: 760px; margin-top:-0px;">
  <button type="button" class="btn btn-success md-4">
    Seguidores: <span class="badge badge-light"> {{$total_seguidores}}</span>
  </button>
  <button type="button" class="btn btn-info md-4">
    Siguiendo: <span class="badge badge-light">{{$total_siguiendo}}</span>
  </button>
</div>
<br>
<br>
@php
//si es mayor a cero es por que el use auth sigue a esta persona
if($usuario_auth_sigue_este_user>0):
$color="red";
$seguir="Dejar de Seguir";
else:
$color="none";
$seguir='Seguir';
endif
//ahora decimos que si el user->user es == al user autenticado no le muestre la opcion de seguir
@endphp

@if($user->username==auth()->user()->username)
<!-- si quien visita es user auth entonces no le mostramos el seguir-->
@else
<div class="container mx-auto d-block">
  <form action="{{route('usuario.seguir',['seguido'=>$user->id,'seguidor'=>auth()->user()->id])}}" method="post">
    @csrf
    <button class="btn btn-light"><svg style="height: 20px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
        fill="{{$color}}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
      </svg></button>
  </form>
  <!-- esta variable la cogemos arribita en el if para validar si la persona lo sigue le mostramos dejar de seguir y si no seguir -->
  <strong>{{$seguir}}</strong>
</div>
@endif



@if(session('mensaje'))
<div class="alert alert-success" role="alert">
  {{session('mensaje')}}
</div>
@endif

<section>
  <h3 class="text-center"><strong>Posts...</strong></h3>
  <div class="container">

    <div class="row row-cols-4 ">
      @if($posts->count()>0)
      @foreach($posts as $post)

      <div class="card" style="width: 18rem;">
        <a href="{{route('post.mostrar',$post)}}">
          <img class="mx-auto d-block mt-2" height="100" src="{{ asset('uploads').'/'. $post->imagen}}"
            aria-multiline="Imagen del post {{$post->titulo}}">
        </a>
        <div class="card-body">
          <div class="alert alert-primary" role="alert">
            @if(auth()->user()->id==$post->user_id)

            <form action="{{route('post.eliminar',$post->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" style="border-radius: 30px; margin-left:40px;">DeletePost<svg
                  style="height:30px" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg></button>
            </form>
            @endif
          </div>
        </div>
      </div>

      @endforeach

      <br>
    </div>
    <br>
    {{$posts->links('pagination::bootstrap-4')}}
    @else
    <p>No hay publicaciones para mostrar...</p>
    @endif
  </div>
  </div>
  </div>
  </div>





</section>
@endsection