@extends('layouts.app')

@section('title', 'Users')

@section('content')
  @include('message')

  <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Users</h5>
        <!-- Trigger Create User Modal -->
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
              <th style="width:120px;">Actions</th>
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
                  @if($user->status === 'active')
                    <span class="badge bg-success">Active</span>
                  @elseif($user->status === 'inactive')
                    <span class="badge bg-secondary">Inactive</span>
                  @else
                    <span class="badge bg-danger">Banned</span>
                  @endif
                </td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning edit-user-btn"
                          data-id="{{ $user->id }}"
                          data-name="{{ $user->name }}"
                          data-email="{{ $user->email }}"
                          data-phone="{{ $user->phone }}"
                          data-type="{{ $user->user_type_id }}"
                          data-status="{{ $user->status }}"
                          data-bs-toggle="modal"
                          data-bs-target="#editUserModal">
                    <i class="bi bi-pencil-square"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger delete-user-btn"
                          data-id="{{ $user->id }}"
                          data-name="{{ $user->name }}"
                          data-bs-toggle="modal"
                          data-bs-target="#deleteUserModal">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-muted text-center">No users found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Include User Modals -->
  @include('admin.user_management.modal.users.create_user_modal')
  @include('admin.user_management.modal.users.edit_user_modal')
  @include('admin.user_management.modal.users.delete_user_modal')

@endsection
