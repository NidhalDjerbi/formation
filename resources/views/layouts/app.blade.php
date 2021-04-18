<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">

    <script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
</head>

<body class="hold-transition login-page">
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
            <a style="margin-left: 1%" class="navbar-brand" href="{{ url('/user') }}">
                Liste des utilisateurs 
            </a>
            <a style="margin-left: 1%" class="navbar-brand" href="{{ url('/cour') }}">
                Liste des cours 
            </a>
            <a class="navbar-brand" href="{{ url('/formation') }}">
                Liste des formations
            </a>
        @endif
        <a class="navbar-brand" href="{{ route('user.edit',\Illuminate\Support\Facades\Auth::user()->id) }}">
            Profile
        </a>
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'etudiant')
            <a class="navbar-brand" href="{{ url('/cour/formation') }}">
                Liste des cours
            </a>
            <a class="navbar-brand" href="{{ url('/cour/etudiant') }}">
                Mes cours
            </a>
            <a class="navbar-brand" href="{{ url('/cour/planning') }}">
                Mes plannings
            </a>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'enseignant')
            <a class="navbar-brand" href="{{ url('/cour/enseignant') }}">
                Liste des cours
            </a>
    
            <a class="navbar-brand" href="{{ url('/cour/planning') }}">
                Mes plannings
            </a>


            <a class="navbar-brand" href="{{ url('/cour/planning') }}">
                Gestion des plannings
            </a>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nom }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('logout_user') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ url('logout_user') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
</div>
<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>