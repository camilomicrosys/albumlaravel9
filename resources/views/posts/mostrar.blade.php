@extends('layout/app')
@section('titu')
Mostrar Post
@endsection
<!-- esto es para llamr un scrupt solo aca en la app.php puse el nombre de esto ya tengo la docu en word para llamar solo donde nececitamos -->
@push('editor')
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
@endpush
@section('contendio')






<div class="container">
  <div class="row">
    <div class="col-4">

      <form action="{{route('comentario.crear',['post'=>$info_post[0]->id_post])}}" method="POST">
        @csrf
        <br><strong>Comment</strong><textarea class="form-control" name="comentario" id="comentario" cols="30"
          rows="10"></textarea>
        @error('comentario')
        {{$message}}
        @enderror
        <br>
        <input class="btn btn-info" type="submit" value="Comment">
      </form>
      <br>
    </div>
    <div class="col-4">
      <img height="100" src="{{ asset('uploads').'/'.$info_post[0]->imagen}}" alt="">


      <div>
        <!--Likess es el nombre del componente liweire -->
        @livewire('likess',['idpost'=>$info_post[0]->id_post])

      </div>

      <div>
        <h5>Owner of the Post: <a href="{{route('muro', $info_post[0]->dueno_post)}}">{{$info_post[0]->dueno_post}}</a>
        </h5>
      </div>
      <div>{{\Carbon\Carbon::parse($info_post[0]->f_creacion_post)->diffForHumans()}}</div>

      <div>

      </div>
    </div>
    <div class="col-2">

      <h4 class="text-center"><strong>Title of Post:</strong>* {{$info_post[0]->titulo}} </h4><br>
      <h6>Description of the post:</h6>
      <p>{{$info_post[0]->descricion}}</p>

    </div>
    <div class="col-2">

    </div>
  </div>
</div>

<div class="container">
  @if(session('mensaje'))
  <div class="alert alert-success" role="alert">
    {{session('mensaje')}}
  </div>
  @endif
  <div class="alert alert-info" role="alert">
    <strong>Comments of the Post</strong>
  </div>
  @php
  //este $tiene comentarios viene desde el controlador postcontroller en data array asociativo en variable
  @endphp
  @if($tiene_comentarios=="si")

  @foreach($info_post as $comentario)

  <p>{{$comentario->comentario }}</p><strong>Fecha:
    {{\Carbon\Carbon::parse($comentario->f_creacion_comentario)->diffForHumans() }}</strong>
  <p>Creador {{$comentario->dueno_comentario}}</p>
  @if(auth()->user()->id==$comentario->comentario_user_id)
  @auth
  <form method="POST" action="{{route('eliminar.comentario',['id'=>$comentario->identificador_comentario])}}">
    @csrf
    @method('DELETE')

    <button class="btn btn-danger"><svg style="height:30px;border-radius:5px;" xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>DeleteComent</button>
  </form>
  @endauth
  @endif

  <br>
  ------------------------------------------------------------
  @endforeach
  @endif
  <div>
  </div>
</div>
<!-- este es el inicializador de el editor bonito -->
<script>
  ClassicEditor
      .create( document.querySelector( '#comentario' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
@endsection