@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $key) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" value="{{$user['name']}}" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" value="{{$user['email']}}" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" value="{{$user['password']}}" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
