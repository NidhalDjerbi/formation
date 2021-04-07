@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>{{$user->nom}}</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Retour</a>
                    </div>
                </div>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.update',$user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Nom:</strong>
                            <input value="{{ $user->nom }}" required type="text" name="nom" class="form-control"
                                   placeholder="Votre nom">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Prenom:</strong>
                            <input value="{{ $user->prenom }}" required type="text" name="prenom" class="form-control"
                                   placeholder="Votre prenom">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Login:</strong>
                            <input value="{{ $user->login }}" required type="text"
                                   name="login" class="form-control" placeholder="Enter Login">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Mot de passe:</strong>
                            <input type="password" name="mdp" class="form-control"
                                   placeholder="********">
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Type:</strong>
                                <select required
                                        name="type" class="form-control">
                                    @if($user->type == 'admin')
                                        <option selected value="admin">
                                            Admin
                                        </option>
                                        <option value="enseignant">
                                            Enseignant
                                        </option>
                                        <option value="etudiant">
                                            Etudiant
                                        </option>
                                    @elseif($user->type == 'admin')
                                        <option value="admin">
                                            Admin
                                        </option>
                                        <option selected value="enseignant">
                                            Enseignant
                                        </option>
                                        <option selected value="etudiant">
                                            Etudiant
                                        </option>
                                    @else
                                        <option value="admin">
                                            Admin
                                        </option>
                                        <option value="enseignant">
                                            Enseignant
                                        </option>
                                        <option value="etudiant">
                                            Etudiant
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
