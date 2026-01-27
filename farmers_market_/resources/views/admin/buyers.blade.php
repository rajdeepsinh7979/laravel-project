@extends('layouts.admin')

@section('title', 'Buyers - Admin Panel')

@section('content')
<h3 class="mb-4">🛍️ Manage Buyers</h3>

<div class="card p-3">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">Registered Buyers ({{ $buyers->count() }})</h5>
  </div>
  <table class="table table-hover">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>About</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($buyers as $b)
        <tr>
          <td>{{ $b->UserID }}</td>
          <td>{{ $b->FullName }}</td>
          <td>{{ $b->Email }}</td>
          <td>{{ $b->Phone }}</td>
          <td>{{ $b->About }}</td>
          <td>
            <form method="POST" action="{{ route('admin.deleteBuyer', $b->UserID) }}" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this buyer? This will remove their orders too.');"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-muted">No buyers found</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
