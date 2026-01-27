@extends('layouts.admin')

@section('title', 'Farmers - Admin Panel')

@section('content')
<h3 class="mb-4">👨‍🌾 Manage Farmers</h3>

<div class="card p-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Registered Farmers ({{ $farmers->count() }})</h5>
  </div>
  <table class="table table-hover">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Farm Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($farmers as $f)
        <tr>
          <td>{{ $f->UserID }}</td>
          <td>{{ $f->FullName }}</td>
          <td>{{ $f->FarmName }}</td>
          <td>{{ $f->Email }}</td>
          <td>{{ $f->Phone }}</td>
          <td class="action-btns">
            <form method="POST" action="{{ route('admin.deleteFarmer', $f->UserID) }}" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this farmer and related products?');"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-muted">No farmers found</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
