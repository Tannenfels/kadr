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

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->title }}</td>
                <td>{{ $user->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('show',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('admin.editNews',$user->id) }}">Edit</a>
                        @csrf
                </td>
            </tr>
        @endforeach
    </table>

    {!! $news->links() !!}


@endsection
