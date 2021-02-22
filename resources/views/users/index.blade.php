@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('register')}}" class="btn btn-primary">Add User</a>
    </div>
    <div class="card">
        <div class="card-header">Users</div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Post Count</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{\Thomaswelton\LaravelGravatar\Facades\Gravatar::src($user->email)}}" alt="">
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>

                            </td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-danger">Make Admin</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   
    
@endsection




