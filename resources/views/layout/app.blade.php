<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devstagram- @yield('titu')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <!-- esto es lo que se hace para solo llamar donde nececitemos en este caso en mostrar comentarios alla montare el editor-->
    @stack('editor')
    <style>
        #img-logo {
            height: 400px;
            width: 300px;
        }

        #form-crear-usuario {
            margin-left: 400px;
            margin-right: 30px;
            margin-top: -440px;
            padding: 15px;
            border: solid 3px rgb(255, 102, 0);
        }

        footer {
            margin-top: 20px;
            text-align: center;
        }

        #btn-regresar {
            margin-left: 570px;
            margin-top: -55px;
        }

        img {
            border-radius: 8px;
        }
    </style>
    @livewireStyles
</head>


@if(auth()->user())
<nav style="background-color:brown" class="navbar navbar-light bg-light">
    <h3 style="color:darkblue" class=" class=" navbar-brand"><a href="{{route('inicioApp')}}">Devgram</a></h3>
    <strong><a href="{{route('muro',auth()->user()->username)}}">MyProfile</a></strong>

    <a href="{{route('post.crear')}}"><svg style="height:30px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>NewPost</a>
    <h1 style="margin-left: 400px;"><svg style="height:30px" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
            viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
        </svg>Profile: {{auth()->user()->username }}</h1>
    <form action="{{route('cerrar-sesion')}}" method="post">
        @csrf
        <button title="Cerrar sesion" style="border-radius: 5px;margin-left:-10px;" type="submit">Logout<svg
                style="height:30px" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg></button>
    </form>
    <nav>

        @else
        <div class="container">
            <a class="text-rigth " href="{{route('crear-cuenta')}}">Create Account<svg style="height:15px; color:green"
                    xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg></a>
            <a style="margin:5px;" class="text-rigth" href="{{route('login')}}">Login<svg
                    style="height:15px; color:green;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg></a>
        </div>
        @endif

    </nav>

</nav>
<main>
    <h2 class="text-center">@yield('titulopagina')</h2>
    @yield('contendio')

</main>

<script>
    Dropzone.autoDiscover=false;

    Dropzone.autoDiscover=false;

const dropzone = new Dropzone('#dropzone',{
dictDefaultMessage:"Carga aca imagenes",
acceptedFiles:".png,.jpg,.jpeg,.gif",
addRemoveLinks:true,
dictRemoveFile:"EliminarArchivo",
maxFiles:1,
uploadMultiple:false,
init:function(){
 if(document.querySelector('[name="imagen"]').value.trim()){
   const imagenPublicada={};
   imagenPublicada.size=1234;
   imagenPublicada.name=document.querySelector('[name="imagen"]').value;

   this.options.addedfile.call(this,imagenPublicada);
   
   this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

   imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
 }
},
}) ;
//indicar que vamos a cargar un archivo
dropzone.on('sending',function(file,xhr,formData){
 console.log(file)
});

//obtener respuesta de cargue exitoso
dropzone.on('success',function(file,response){

 
 document.querySelector('[name="imagen"]').value=response.imagenes;
});
//en caso de que alla un error y no me suba el archivo
dropzone.on('error',function(file,message){

 console.log(message);
 
});
//cuando subi un archivo y le doy eliminar que me diga archivo eliminado
dropzone.on('removedfile',function(file,message){
    document.querySelector('[name="imagen"]').value="";
});
</script>
<footer>
    <strong> Devstegram camilo © {{date('Y')}}</strong>
</footer>
@livewireScripts
</body>

</html>