
@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Modifier une formation</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('formation.index') }}"> Back</a>
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
            <form action="{{ route('formation.update',$formation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Intitule:</strong>
                            <input type="text" name="intitule" value="{{ $formation->intitule }}" class="form-control"
                                   placeholder="Intitule">
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
