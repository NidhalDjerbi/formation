@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Formation</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-success" href="{{ route('formation.create') }}"> Creer une nouvelle formation</a>
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
                    <th>Intitule</th>
                    <!-- <th>Enseignant</th> -->
                    <th width="280px">Action</th>
                </tr>
                @foreach ($formations as $formation)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $formation->intitule }}</td>
                        <td>
                            <form action="{{ route('formation.destroy',$formation->id) }}" method="POST">

                              {{--  <a class="btn btn-info" href="{{ route('formation.show',$formation->id) }}">Show</a>--}}

                                <a class="btn btn-primary" href="{{ route('formation.edit',$formation->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $formations->links() !!}
        </div>
    </div>
@endsection
