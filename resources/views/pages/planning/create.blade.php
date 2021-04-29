@extends('layouts.app')

@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Ajouter une séance de cour</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('formation.index') }}"> Retour</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('planning.store',$cour->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Cour:</strong>
                            <input disabled type="text"  name ="cours_id" class="form-control" placeholder="{{$cour->intitule}}" value = "{{$cour->id}}">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Date début:</strong>
                            <input class="form-control" type="datetime-local" name="date_debut" >
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Date fin:</strong>
                            <input class="form-control" type="datetime-local" name="date_fin">
                        </div>
                    </div>
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
