@extends('layouts.app')

@section('content')

<style>
.container-flex {
    display: flex;
    width: 100%;
    gap: 30%;
    margin: 40px auto;
    flex-wrap: wrap;
    padding: 20px;
}

.column {
    flex: 1;
    min-width: 400px;
}

.login-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: 1px solid #f1f5f9;
}

.form-group {
    margin-bottom: 16px;
}

.form-row {
    display: flex;
    gap: 16px;
}

.form-row .form-group {
    flex: 1;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    color: #1e293b;
    font-family: inherit;
    outline: none;
    transition: all 0.2s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #6366F1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}

.error-message {
    color: #dc2626;
    font-size: 12px;
    margin-top: 2px;
}

.login-btn {
    width: 100%;
    background: #6366F1;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.login-btn:hover {
    background: #4f46e5;
}

/* Responsive */
@media (max-width: 900px) {
    .container-flex {
        flex-direction: column;
    }
}
</style>

<div class="container-flex">

    <!-- Left Column: Create New User Form -->
    <div class="column">
        <div class="login-card">
            <h3 style="margin-bottom:16px;">Add New User</h3>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <!-- Name & Email -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="userName">Full Name</label>
                        <input type="text" name="name" id="userName" value="{{ old('name') }}" required>
                        @error('name')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" name="email" id="userEmail" value="{{ old('email') }}" required>
                        @error('email')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Phone & Role -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="userPhone">Phone</label>
                        <input type="text" name="phone" id="userPhone" value="{{ old('phone') }}" required>
                        @error('phone')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="userRole">Role</label>
                        <select name="role" id="userRole" required>
                            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Passenger</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                        </select>
                        @error('role')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Password & Confirm Password -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="userPassword">Password</label>
                        <input type="password" name="password" id="userPassword" required>
                        @error('password')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="userPasswordConfirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="userPasswordConfirmation" required>
                    </div>
                </div>

                <button type="submit" class="login-btn">Add User</button>
            </form>
        </div>
    </div>

    <!-- Right Column: Live Preview -->
    <div class="column">
        <div class="login-card">
            <h3 style="margin-bottom:16px;">User Details Preview</h3>
            <p><strong>Full Name:</strong> <span id="previewName">—</span></p>
            <p><strong>Email:</strong> <span id="previewEmail">—</span></p>
            <p><strong>Phone:</strong> <span id="previewPhone">—</span></p>
            <p><strong>Role:</strong> <span id="previewRole">—</span></p>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');
    const userPhone = document.getElementById('userPhone');
    const userRole = document.getElementById('userRole');

    const previewName = document.getElementById('previewName');
    const previewEmail = document.getElementById('previewEmail');
    const previewPhone = document.getElementById('previewPhone');
    const previewRole = document.getElementById('previewRole');

    const mirror = (input, target) => {
        input.addEventListener('input', () => target.textContent = input.value.trim() || '—');
    };

    mirror(userName, previewName);
    mirror(userEmail, previewEmail);
    mirror(userPhone, previewPhone);

    userRole.addEventListener('change', function () {
        previewRole.textContent = this.options[this.selectedIndex].text;
    });

    if (userRole.value) userRole.dispatchEvent(new Event('change'));
});
</script>
@endpush
