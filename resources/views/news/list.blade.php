@extends('layouts.app')



@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>25-kadr.com</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($news as $n)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $n->name }}</td>
                <td>{{ $n->detail }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('articles.show',$n->id) }}">Show</a>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $news->links() !!}

@endsection
