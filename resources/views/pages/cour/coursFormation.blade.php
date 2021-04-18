@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Cour</h2>
                    </div>
                </div>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <form action="{{url('/cour/searchCourFormation')}}" method="post" role="search">
                @csrf
                <div class="row">
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Intitule:</strong>
                            <input class="form-control" type="text" name="intitule" value="{{$searchData['intitule']}}">
                        </div>
                    </div>

                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Recherche par enseignant:</strong>
                            <select
                                name="user_id" class="form-control">
                                <option value="">
                                    Choisissez l'enseignant
                                </option>
                                @foreach (\App\Models\User::orderBy('created_at')->where('type','=','enseignant')->get() as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->nom }}
                                    </option>
                                @endforeach
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

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Intitule</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($cours as $cour)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $cour->intitule }}</td>
                        <td>
                            @if(!\Illuminate\Support\Facades\Auth::user()->cours->contains('intitule', $cour->intitule))
                                <form action="{{ route('cour.inscription',$cour->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-primary">Incription</button>
                                </form>
                            
                            @else
                            <form action="{{ route('cour.desinscription',$cour->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger">Desinscription</button>
                            </form>
                            @endif                      
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
