<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profe Online</title>
    <!-- styles -->
    <link rel="stylesheet" href="{{url('assets/vendor/bootstrap-3.1.1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

    <!-- scrips -->
    <script src="{{url('assets/vendor/jquery-1.11.0.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap-3.1.1/js/bootstrap.min.js')}}"></script>
</head>
<body>
    <!-- Header -->
    <div class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::to('/')}}">ProfeOnline</a>
            </div>
            <div class="collapse navbar-collapse">
                {{--los elementos a la izquierda--}}
                <ul class="nav navbar-nav">
                    {{-- rutas publicas --}}
                    <li class=""><a href="{{URL::to('/')}}">Inicio</a></li>
                    <li class=""><a href="{{URL::to('/buscar')}}">Buscar</a></li>

                    @if (Auth::check()==true)
                        {{-- rutas solo para usuarios logeados --}}
                        <li class=""><a href="{{URL::to('/asignaturas_suscritas')}}">Suscritas</a></li>

                        @if( Auth::user()->esAdministrador() )
                            <li class=""><a href="{{URL::to('/')}}">Administracion</a></li>
                        @elseif( Auth::user()->esDocente() )
                            <li class=""><a href="{{URL::to('/docente/misAsignaturas')}}">MisAsignaturas</a></li>
                        @endif
                    @endif
                </ul>
                {{-- login o logout dependiendo del estado de la sesion --}}
                <ul class="nav navbar-nav pull-right">
                    @if (Auth::check()==true)
                        <li><a href="#">Bienvenido {{Auth::user()->nombre}}</a></li>
                        <li><a href="{{URL::to('logout')}}">Desconectar</a></li>
                    @else
                        <li><a href="{{URL::to('registro')}}">Registrar</a></li>
                        <li><a href="{{URL::to('login')}}">Ingresar</a></li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <!-- Content -->
    <div class="container bg-blanco">
        @yield('content')
    </div>
    @yield('footer')
</body>
</html>