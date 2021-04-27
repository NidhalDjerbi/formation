@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
            <form action="{{url('/user/search')}}" method="post" role="search">
                @csrf
                <div class="row">
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Nom:</strong>
                            <input class="form-control" type="text" name="nom" value="{{$searchData['nom']}}">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Prenom:</strong>
                            <input class="form-control" type="text" name="prenom" value="{{$searchData['prenom']}}">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Login:</strong>
                            <input class="form-control" type="text" name="login" value="{{$searchData['login']}}">
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <select
                                name="type" class="form-control">
                                <option value="">
                                    Choose type
                                </option>
                                @if($searchData['type'] == 'enseignant')
                                    <option value="etudiant">
                                        Etudiant
                                    </option>
                                    <option value="enseignant">
                                        Enseignant
                                    </option>
                                @elseif($searchData['type']  == 'etudiant')
                                    <option value="etudiant">
                                        Etudiant
                                    </option>
                                    <option value="enseignant">
                                        Enseignant
                                    </option>                                    
                                @else
                                    <option value="etudiant">
                                        Etudiant
                                    </option>
                                    <option value="enseignant">
                                        Enseignant
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <button style="margin-top: 6%;" title="Recheche" type="submit"
                                    class="margin pull-right tooltips btn btn-info">
                                <span class="glyphicon glyphicon-search"></span> Recherche
                            </button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        <div class="card" style="margin: 2%;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Users</h2>
                        </div>
                        <div style="text-align: end" class="pull-right">
                            <a class="btn btn-success" href="{{ route('user.create') }}"> Create New user</a>
                        </div>
                    </div>
                </div>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Login</th>
                        <th>Type</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->type }}</td>
                            <td>
                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">

                                    @if($user->type != 'admin')
                                        @if ($user->type == null)
                                            <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Accepter</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning">Refus</button>
                                        @else
                                        <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        @endif
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection
