@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $article->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {!! html_entity_decode($article->text) !!}
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Имя</th>
            <th>Текст</th>
        </tr>

        @foreach ($article->comments as $comment)
            <tr>
                <td>{{ $comment->user_id }}</td>
                <td>{{ $comment->text }}</td>
            </tr>
        @endforeach
    </table>

@endsection
