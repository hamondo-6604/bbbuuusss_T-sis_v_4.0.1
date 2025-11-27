@extends('layouts.app')

@section('content')

  @include('message')

  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Amenities</h1>

    <a href="{{ route('admin.amenities.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
      <ion-icon name="add-circle-outline" class="align-middle mr-1"></ion-icon>
      Add Amenity
    </a>
  </div>

  <!-- Card Container -->
  <div class="bg-white shadow-lg p-6 rounded-xl border border-gray-100">
    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
        <tr class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wider">
          <th class="px-4 py-3 text-left">#</th>
          <th class="px-4 py-3 text-left">Icon</th>
          <th class="px-4 py-3 text-left">Amenity Name</th>
          <th class="px-4 py-3 text-center">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">

        @forelse($amenities as $amenity)
          <tr class="border-b hover:bg-gray-50 transition">
            <td class="px-4 py-3">{{ $loop->iteration }}</td>

            <td class="px-4 py-3">
              @if($amenity->icon)
                <ion-icon name="{{ $amenity->icon }}" class="text-xl text-blue-600"></ion-icon>
              @else
                <span class="text-gray-400 italic">No icon</span>
              @endif
            </td>

            <td class="px-4 py-3 font-medium">{{ $amenity->name }}</td>

            <td class="px-4 py-3 text-center flex justify-center space-x-2">

              <a href="{{ route('admin.amenities.edit', $amenity->id) }}"
                 class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm transition">
                <ion-icon name="create-outline"></ion-icon>
              </a>

              <form method="POST" action="{{ route('admin.amenities.destroy', $amenity->id) }}"
                    onsubmit="return confirm('Are you sure to delete this amenity?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm transition">
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
              </form>

            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center py-4 text-gray-500 italic">
              No amenities found. Add the first one!
            </td>
          </tr>
        @endforelse

        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $amenities->links() }}
    </div>
  </div>

@endsection
