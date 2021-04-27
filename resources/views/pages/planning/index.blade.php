
@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
            <form action="{{url('/planning/search')}}" method="post" role="search">
            @csrf
                <div class="row">
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Intitule:</strong>
                            <input class="form-control" type="text" name="intitule" value="{{$searchData['intitule']}}">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Date début:</strong>
                            <input class="form-control" type="date" name="date_debut" value="{{$searchData['date_debut']}}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Date fin:</strong>
                            <input class="form-control" type="date" name="date_fin" value="{{$searchData['date_fin']}}">
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
                            <h2>Plannnings</h2>
                        </div>
                        <div style="text-align: end" class="pull-right">
                            <a class="btn btn-success" href="{{ route('admin.planning.create') }}"> Créer un nouveau planning</a>
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
                    <th>Cour</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($plannings as $planning)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{$planning->intitule}}</td>
                        <td>{{ $planning->date_debut }}</td>
                        <td>{{ $planning->date_fin }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.planning.edit',$planning->id) }}">Mise à jour</a>
                            <a class="btn btn-danger" href="{{ route('admin.planning.destroy',$planning->id) }}">Suppression</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
        </div>
    </div>
@endsection
