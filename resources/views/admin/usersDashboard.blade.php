@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Список пользователей</h2>
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
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>e-mail</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('admin.user.edit',$user->id) }}">Edit</a>
                        @csrf
                </td>
            </tr>
        @endforeach
    </table>

    {!! $users->links() !!}


@endsection
