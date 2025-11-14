@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit User</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Full Name" class="w-full p-2 border rounded" required>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" class="w-full p-2 border rounded" required>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Phone" class="w-full p-2 border rounded">
        <select name="role" class="w-full p-2 border rounded" required>
            <option value="passenger" {{ $user->role == 'passenger' ? 'selected' : '' }}>Passenger</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
        </select>
        <select name="status" class="w-full p-2 border rounded" required>
            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="blocked" {{ $user->status == 'blocked' ? 'selected' : '' }}>Blocked</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update User</button>
    </form>
</div>
@endsection
