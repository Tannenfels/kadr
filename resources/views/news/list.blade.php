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
            <th>Заголовок</th>
            <th>Описание</th>
        </tr>

        @foreach ($news as $n)
            <tr>
                <td>{{ $n->title }}</td>
                <td>{{ $n->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('show',$n->id) }}">Show</a>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $news->links() !!}

@endsection
