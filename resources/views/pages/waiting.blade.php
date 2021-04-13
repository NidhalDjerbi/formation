@extends('layouts.app-auth')
@section('content')
    <main role="main" class="container">

        <div style="    text-align: center;
    margin-top: 10%;" class="starter-template">
            <h1>Ouups</h1>
            <p class="lead">Merci de patientez jusqu'a l'admin accepte votre inscription</p>
        </div>

    <div >
        


        <form action="{{ url('logout_user') }}" method="POST">
            @csrf
            <div class="social-auth-links text-center mb-3">
                <button type="submit"
                        class="btn btn-primary btn-block">Logout</button>
            </div>
        </form>
    </div>

    </main>
@endsection