@extends('layouts.app')

@section('content')
  <h1>{{ isset($route) ? 'Edit Route' : 'Add Route' }}</h1>

  <form action="{{ isset($route) ? route('admin.routes.update', $route->id) : route('admin.routes.store') }}" method="POST">
    @csrf
    @if(isset($route))
      @method('PUT')
    @endif

    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ $route->name ?? '' }}" required>
    </div>
    <div class="form-group">
      <label>Origin</label>
      <input type="text" name="origin" class="form-control" value="{{ $route->origin ?? '' }}" required>
    </div>
    <div class="form-group">
      <label>Destination</label>
      <input type="text" name="destination" class="form-control" value="{{ $route->destination ?? '' }}" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">{{ isset($route) ? 'Update' : 'Save' }}</button>
  </form>
@endsection
