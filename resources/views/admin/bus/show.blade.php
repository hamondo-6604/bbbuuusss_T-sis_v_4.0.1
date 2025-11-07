@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Bus Details — {{ $bus->bus_name }}</h4>

        <div>
            <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-sm btn-info">
                <i class="bi bi-pencil-square"></i> Edit
            </a>

            <a href="{{ route('admin.buses.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>

            <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this bus?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-5 text-center">
                    @if($bus->bus_img)
                        <img src="{{ asset('storage/' . $bus->bus_img) }}" alt="{{ $bus->bus_name }}" class="img-fluid rounded" style="max-height:420px; object-fit:cover;">
                    @else
                        <div class="border rounded p-5 text-muted">
                            <i class="bi bi-image" style="font-size:48px"></i>
                            <div class="mt-2">No image available</div>
                        </div>
                    @endif
                </div>

                <div class="col-md-7">
                    <h3 class="mb-2">{{ $bus->bus_name }}</h3>
                    <p class="mb-1"><strong>Bus Number:</strong> {{ $bus->bus_number }}</p>
                    <p class="mb-1">
                        <strong>Type:</strong>
                        {{ $bus->type->type_name ?? 'N/A' }}
                    </p>
                    <p class="mb-1">
                        <strong>Seat Layout:</strong>
                        {{ $bus->seatLayout->layout_name ?? 'N/A' }}
                        @if($bus->seatLayout)
                            <small class="text-muted"> — Capacity: {{ $bus->seatLayout->capacity ?? $bus->total_seats }}</small>
                        @endif
                    </p>

                    <p class="mb-1"><strong>Total Seats:</strong> {{ $bus->total_seats }}</p>

                    <p class="mb-1">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $bus->status == 'active' ? 'success' : ($bus->status == 'inactive' ? 'danger' : 'warning') }}">
                            {{ ucfirst($bus->status) }}
                        </span>
                    </p>

                    <div class="mt-3">
                        <h6 class="mb-2">Description</h6>
                        <p class="text-muted">{{ $bus->description ?? 'No additional details.' }}</p>
                    </div>

                    <div class="mt-4 text-muted small">
                        <div>Created at: {{ $bus->created_at ? $bus->created_at->format('Y-m-d H:i') : '-' }}</div>
                        <div>Last updated: {{ $bus->updated_at ? $bus->updated_at->format('Y-m-d H:i') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional: Seat layout map preview if JSON exists --}}
    @if($bus->seatLayout && $bus->seatLayout->layout_map)
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Seat Layout Preview — {{ $bus->seatLayout->layout_name }}</h5>

                @php
                    // try to decode safely
                    $map = is_array($bus->seatLayout->layout_map) ? $bus->seatLayout->layout_map : json_decode($bus->seatLayout->layout_map, true);
                @endphp

                @if($map && isset($map['rows']) && isset($map['cols']) && isset($map['seats']))
                    <div class="seat-map d-inline-block" style="font-family: monospace;">
                        @for($r = 0; $r < $map['rows']; $r++)
                            <div class="mb-1">
                                @for($c = 0; $c < $map['cols']; $c++)
                                    @php
                                        $seatKey = "{$r}-{$c}";
                                        $label = $map['seats'][$seatKey] ?? ' ';
                                    @endphp
                                    <span class="d-inline-block text-center border rounded me-1" style="width:36px;height:28px;line-height:28px;">
                                        {{ $label }}
                                    </span>
                                @endfor
                            </div>
                        @endfor
                    </div>
                @else
                    <p class="text-muted">No structured layout_map available for preview.</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
