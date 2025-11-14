@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background: red">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">All Buses</h4>
            <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Bus
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Bus Name</th>
                            <th>Bus Number</th>
                            <th>Type</th>
                            <th>Layout</th>
                            <th>Total Seats</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($buses as $bus)
                            <tr class="bus-row">
                                <td>{{ $bus->id }}</td>
                                <td>
                                    @if ($bus->bus_img)
                                        <img src="{{ asset('storage/' . $bus->bus_img) }}" alt="Bus" width="60"
                                            height="40" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $bus->bus_name }}</td>
                                <td>{{ $bus->bus_number }}</td>
                                <td>{{ $bus->type->type_name ?? 'N/A' }}</td>
                                <td>{{ $bus->seatLayout->layout_name ?? 'N/A' }}</td>
                                <td>{{ $bus->total_seats }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $bus->status == 'active' ? 'success' : ($bus->status == 'inactive' ? 'danger' : 'warning') }}">

                                        {{ ucfirst($bus->status) }}
                                    </span>
                                </td>
                                <td class="position-relative">
                                    <div class="actions-overlay">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.buses.show', $bus->id) }}"
                                            class="btn btn-sm btn-primary">View</a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.buses.edit', $bus->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete this bus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No buses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
