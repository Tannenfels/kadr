@extends('layouts.common')

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

        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('show',$article->id) }}">Show</a>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $articles->links() !!}

@endsection
