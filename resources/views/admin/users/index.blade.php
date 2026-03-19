@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<header>
    <h2>Users</h2>
    <p>Manage all registered users.</p>
</header>

<section>
    @forelse($users as $user)
        <article>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>

            <a href="{{ route('admin.users.edit', $user) }}">Edit</a>
        </article>
    @empty
        <p>No users found.</p>
    @endforelse
</section>
@endsection
