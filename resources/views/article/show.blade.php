@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $article->title }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! html_entity_decode($article->text) !!}
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Имя</th>
            <th>Текст</th>
        </tr>

        @foreach ($article->commentThreads as $commentThread)
            <tr>
                <td>{{ $commentThread->user->name }}</td>
                <td>{{ $commentThread->text }}</td>
            </tr>
            @if(!empty($commentThread->comments))
                @foreach($commentThread->comments as $comment)
                    <tr>
                        <td></td>
                        <td>{{ $comment->user_id }}</td>
                        <td>{{ $comment->text }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </table>

    @if(Auth::check())
        <form action="{{ route('commentThreads.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="text">Введите текст комментария</label>
                <textarea class="form-control" id="text" name="text" rows="2"></textarea>
                <input type="hidden" value="{{ $article->id }}" name="article_id">
            </div>

            <button type="submit" class="btn btn-primary">ОК</button>
        </form>
    @endif

@endsection
