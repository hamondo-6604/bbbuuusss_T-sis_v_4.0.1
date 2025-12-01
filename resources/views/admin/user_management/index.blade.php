@extends('layouts.app')

@section('title', 'Users')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Users</h5>

        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
          <i class="bi bi-plus-circle"></i> Add User
        </button>
      </div>

      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td>{{ $user->userType->type_name ?? 'N/A' }}</td>

                <td>
                <span class="badge
                  @if($user->status == 'active') bg-success
                  @elseif($user->status == 'inactive') bg-secondary
                  @else bg-danger @endif">
                  {{ ucfirst($user->status) }}
                </span>
                </td>

                <td>
                  <!-- Edit -->
                  <button class="btn btn-warning btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#editUserModal{{ $user->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete -->
                  <button class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#deleteUserModal{{ $user->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-muted">No users found.</td>
              </tr>
            @endforelse
            </tbody>

          </table>
        </div>

        <div class="mt-3">
          {{ $users->links() }}
        </div>

      </div>
    </div>

  </div>

  @include('admin.user_management.modal.users.create_user_modal')
  @include('admin.user_management.modal.users.edit_user_modal')
  @include('admin.user_management.modal.users.delete_user_modal')

@endsection
