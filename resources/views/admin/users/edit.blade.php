@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<header>
    <h2>Edit User</h2>
</header>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <label>
        Name:
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    </label>
    <br>

    <label>
        Email:
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    </label>
    <br>

    <label>
        Role:
        <input type="text" name="role" value="{{ old('role', $user->role) }}">
    </label>
    <br>

    <button type="submit">Update User</button>
</form>
@endsection
