@extends('layout/app')
@section('contendio')
<section>
   <h3 class="text-center"><strong>Posts...</strong></h3>
   <div class="container">

      <div class="row row-cols-4 ">

         @if($posts->count()>0)
         @foreach($posts as $post)

         <div class="card" style="width: 18rem;">
            <a href="{{route('post.mostrar',$post->id)}}">
               <img class="mx-auto d-block mt-2" height="100" src="{{ asset('uploads').'/'. $post->imagen}}"
                  aria-multiline="Imagen del post {{$post->titulo}}">
            </a>
            <div class="card-body">
               <div class="alert alert-primary" role="alert">
                  <p class="card-text text-center">{{$post->descricion}}</p>
               </div>
            </div>
         </div>

         @endforeach

         <br>
      </div>
      <br>
      {{$posts->links('pagination::bootstrap-4')}}
      @else
      <p>
         No posts to show...</p>
      @endif
   </div>
   </div>
   </div>
   </div>
</section>
@endsection