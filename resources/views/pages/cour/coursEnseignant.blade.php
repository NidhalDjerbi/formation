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

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Intitule</th>
                </tr>
                @foreach ($cours as $cour)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $cour->intitule }}</td>
                    </tr>

                @endforeach
            </table>
            {!! $cours->links() !!}
        </div>
    </div>
@endsection
