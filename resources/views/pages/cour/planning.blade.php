@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Planning</h2>
                    </div>
                </div>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{url('cour/planning/search')}}" method="post" role="search">
                @csrf
                <div class="row">
                    <div class="col-xs-8 col-sm-4 col-md-2">
                        <div class="form-group">
                            <strong>Intitule:</strong>
                            <input class="form-control" type="text" name="intitule" value="{{$searchData['intitule']}}">
                        </div>
                    </div>

                    <div class="col-xs-8 col-sm-4 col-md-2">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Date:</strong>
                            <input class="form-control" type="date" name="date_debut" value="{{$searchData['date_debut']}}">
                        </div>
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
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
                @foreach ($plannings as $planning)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $planning->date_debut }}</td>
                        <td>{{ $planning->date_fin }}</td>
                    </tr>
                @endforeach
            </table>
            {!! $plannings->links() !!}
        </div>
    </div>
@endsection
